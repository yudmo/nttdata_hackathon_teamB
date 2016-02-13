<?php
class Pref extends AppModel {
  public $hasMany = array(
                    'City' => array('order' => 'idx'));
}
