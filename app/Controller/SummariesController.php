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
    $params['condtions'] = array('Budget.date BETWEEN ? AND ?'=> array($begin, $end));

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
      $params['condtions'] = array('Budget.date BETWEEN ? AND ?'=> array($begin, $end));
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
    $this->Summary->saveAll($savedata);
  }

}
