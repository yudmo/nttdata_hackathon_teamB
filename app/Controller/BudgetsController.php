<?php

class BudgetsController extends AppController{
	
	public $helpers = array('Html', 'Form');
	public $uses = array('Budget','Category');
	
	public function view(){
		// ログイン中のユーザID
		$user_id = $this->Session->read('user.User.id');
		// 今年
		$this_year = date('Y');
		// 今月
		$this_month = date('m');
		// 今月のデータを取得
		$budgets = $this->Budget->query("SELECT YEAR(date) AS year, MONTH(date) AS month, DAY(date) AS day, sum(money) AS money FROM budgets WHERE user_id = ".$user_id." AND MONTH(date) = ".$this_month." AND YEAR(date) = ".$this_year." GROUP BY DAY(date) ORDER BY DAY(date);");
		$this->set('budgets', json_encode($budgets));
		// データ追加フォーム用のカテゴリリストを変数にセット
		$this->set('select1', $this->Category->find('list', array( 
			'fields' => array( 'id', 'name')
		)));
	}
	
	public function add(){
		if($this->request->is('post')){
			// 一応、初期化
			$this->request->data['Budget']['user_id'] = 0;
			// ログイン中のユーザIDをポストされたデータにセットする
			$this->request->data['Budget']['user_id'] = $this->Session->read('user.User.id');
			if($this->Budget->save($this->request->data)){
				// 登録が完了したら「今月ページ」にリダイレクト
				$this->redirect(array('action'=>'view'));
				$this->set('msg', 'データを追加しました');
			}
		}
	}
}
