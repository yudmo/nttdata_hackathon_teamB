<?php
class Prefecture extends AppModel {
  public $hasMany = array(
    'City' => array('order' => 'id'));

  public function allPref() {
    return $this->find('all');
  }

}
?>
