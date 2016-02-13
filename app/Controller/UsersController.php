<?php

class UsersController extends AppController{

  public $components = array('Auth');

  public function beforeFilter(){
    $this->Auth->allow();
  }

  public function add(){
    $this->loadModel('Prefecture');
    if($this->request->is('get')){
      $family = array(0 => '単身世帯', 1 => '2人以上世帯');
      $this->set('family', $family);
      $location = $this->Prefecture->allPref();
      $this->set('location', $location);
      $pref = array();
      $city = array();
      foreach($location as $key => $value) {
        $pref[$value['Prefecture']['id']] = $value['Prefecture']['name'];
        foreach ($value['City'] as $key => $value) {
          $city[$value['prefecture_id']][$value['id']] = $value['name'];
        }
      }
      $this->set('pref', $pref);
      $this->set('city', $city);
    }else{
      $this->request->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
      $this->User->saveAll($this->request->data['User']);
      return $this->redirect(array('action'=> 'login'));
    }
  }



  public function login(){
    if($this->request->is('get')){

    }else{
      $pas = AuthComponent::password($this->data['User']['password']);
      $us = $this->data['User']['name'];
      $res = $this->User->find('all', array(
         'fields' => array('id','name'),
         'conditions' => array(
            'name' => $us,
            'password' =>  $pas)
      ));
      //debug($res);
      if(empty($res)){
        $data = 'Username or password is not correct!';
        $this->set('data', $data);
      }else{
        $this->Session->write('user', $res[0]);
        debug($this->Session->read('user'));
        //$this->redirect('/');
      }
    }
  }

  public function logout(){
    if($this->request->is('get')){
      if(null !== $this->Session->read('user')){
        $this->Session->delete('user');
      }
     $this->redirect('/');
    }
  }

}
