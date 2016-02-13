<?php

class UsersController extends AppController{

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
      debug($this->request->data);
      $this->User->saveAll($this->request->data['User']);
      return $this->redirect(array('action'=> 'login'));
    }
  }



  public function login(){

  }

}
