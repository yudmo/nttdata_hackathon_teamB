<?php
class Product extends AppModel {

  public function getProducts($pref_id, $price) {
    $params = array();
    $params['conditions'] = array(
      'Product.price <=' => $price
    );
    $params['order'] = array(
      "Product.pref_id = $pref_id", "Product.price DESC"
    );

    return $this->find('all', $params);

  }
}
