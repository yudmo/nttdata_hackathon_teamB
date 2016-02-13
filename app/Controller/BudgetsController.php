<?php

class BudgetsController extends AppController{
	
	public $helpers = array('Html', 'Form');
	public $uses = array('Budget','Category');
	
	public function view(){
		$this->set( 'select1', $this->Category->find('list', array( 
			'fields' => array( 'id', 'name')
		)));
	}
	
	public function add(){
		if($this->request->is('post')){
			// 一応、初期化
			$this->request->data['Budget']['user_id'] = 0;
			// ログイン中のユーザIDをポストされたデータにセットする
			$this->request->data['Budget']['user_id'] = $this->Session->read('user.id');
			if($this->Budget->save($this->request->data)){
				// 登録が完了したら「今月ページ」にリダイレクト
				$this->redirect(array('action'=>'view'));
				$this->set('msg', 'データを追加しました');
			}
		}
	}
}
