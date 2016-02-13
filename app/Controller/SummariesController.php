<?php

class SummariesController extends AppController{

  public function add(){
    $this->loadModel('User');
    $this->loadModel('Budget');
    $begin = date("Y-m-01");
    $end = date("Y-m-31");
    $savedata = array();
    //joinと
    $params['joins'] = array(
        array('table' => 'users',
            'alias' => 'user',
            'type' => 'inner',
            'conditions' => array(
                'Budget.user_id = user.id'
            )
        ),
        array('table' => 'cities',
            'alias' => 'city',
            'type' => 'inner',
            'conditions' => array(
                'city.id = user.current_city'
            )
        ),
    );
    $params['group'] = array(
        'city.id','user.type'
    );
    $params['fields'] = array(
      'Budget.user_id','Budget.date','SUM(Budget.money)','city.prefecture_id','city.id','user.type'
    );
    $params['conditions'] = array('Budget.date BETWEEN ? AND ?'=> array($begin, $end));

    //cityとusertype毎のデータ取得
    $data = $this->Budget->find('all', $params);

    //該当月においてmoneyを登録したuser数でmoneyを割り，averageを導出
    $params = array();
    foreach ($data as $key => $value) {
      $params['group'] = array(
        'Budget.user_id'
      );
      $params['fields'] = array(
        '*'
      );
      $params['conditions'] = array('Budget.date BETWEEN ? AND ?'=> array($begin, $end));
      $userNum = $this->Budget->find('all', $params);
      $value[0]['SUM(`Budget`.`money`)'] = (int)$value[0]['SUM(`Budget`.`money`)']/(int)$userNum;
      //savedataの成型
      $temp = array();
      $temp['pref_id'] = $value['city']['prefecture_id'];
      $temp['city_id'] = $value['city']['id'];
      $temp['average'] = $value[0]['SUM(`Budget`.`money`)'];
      $temp['type'] = $value['user']['type'];
      $temp['date'] = $value['Budget']['date'];
      array_push($savedata,$temp);
    }
    //$this->Summary->saveAll($savedata);

    //各ユーザのdepositの計算
    $users = $this->User->find('all');
    foreach ($users as $key => $value) {
      //summaryからaverage取得
      $ave_params = array();
      $ave_params['conditions'] = array(
        'Summary.pref_id' => $value['User']['current_pref'],
        'Summary.city_id' => $value['User']['current_city'],
        'Summary.date' => $begin,
        'Summary.type' => $value['User']['type']
      );

      $ave_params['fields'] = array(
        'Summary.average'
      );
      $average = $this->Summary->find('first',$ave_params);
      $average = $average['Summary']['average'];

      //今月の食費取得
      $params_user_budgets['fields'] = array(
        'SUM(Budget.money)'
      );
      $params_user_budgets['conditions'] = array(
        'Budget.date BETWEEN ? AND ?'=> array($begin, $end),
        'Budget.user_id' => $value['User']['id'],
      );

      //cityとusertype毎のデータ取得
      $monthly_budgets = $this->Budget->find('all', $params_user_budgets);
      $monthly_budgets = $monthly_budgets[0][0]['SUM(`Budget`.`money`)'];
      //差の導出,格納
      $deposit = $average - $monthly_budgets;
      $save_deposit = array();
      $save_deposit['id'] = $value['User']['id'];
      $save_deposit['deposit'] = $value['User']['deposit'] + $deposit;
      $this->User->saveAll($save_deposit);
    }

  }

  public function view(){
    if(null == $this->Session->read('user')){
      return $this->redirect(array('controller'=>'Users','action'=> 'login'));
    }else{
      $user = $this->Session->read('user');
    }

    $this->loadModel('User');
    $this->loadModel('Budget');
    $this->loadModel('Product');
    $begin = date("Y-m-01", strtotime(date('Y-m-1') . '-1 month'));
    $end = date("Y-m-31", strtotime(date('Y-m-1') . '-1 month'));

    //先月の食費取得
    $params_user_budgets['fields'] = array(
      'SUM(Budget.money)'
    );
    $params_user_budgets['conditions'] = array(
      'Budget.date BETWEEN ? AND ?'=> array($begin, $end),
      'Budget.user_id' => $user['User']['id'],
    );

    //cityとusertype毎のデータ取得
    $monthly_budgets = $this->Budget->find('all', $params_user_budgets);
    $monthly_budgets = $monthly_budgets[0][0]['SUM(`Budget`.`money`)'];
    if($monthly_budgets == null){
      $monthly_budgets = 0;
    }

    //deposit取得
    $user_info = $this->User->find('first',array(
        'conditions' => array('User.id' => $user['User']['id']),
        'fields' => '*',
    ));
    $deposit = $user_info['User']['deposit'];

    //userの生まれ故郷
    $birth_pref = $this->User->find('first',array(
        'conditions' => array('User.id' => $user['User']['id']),
        'fields' => 'User.from_pref'
    ));
    $birth_pref = $user_info['User']['from_pref'];

    //summaryからaverage取得
    $ave_params = array();
    $ave_params['conditions'] = array(
      'Summary.pref_id' => $user_info['User']['current_pref'],
      'Summary.city_id' => $user_info['User']['current_city'],
      'Summary.date' => $begin,
      'Summary.type' => $user_info['User']['type']
    );

    $ave_params['fields'] = array(
      'Summary.average'
    );
    $average = $this->Summary->find('first',$ave_params);
    $average = $average['Summary']['average'];
    debug($average);

    //先月の節約分で可能なふるさと納税リスト
    $monthly_list = $this->Product->getProducts($birth_pref, $monthly_budgets);

    //depositで可能なふるさと納税リスト
    $deposit_list = $this->Product->getProducts($birth_pref, $deposit);
  }

}
