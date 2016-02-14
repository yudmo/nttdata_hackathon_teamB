<?php
class Product extends AppModel {

  public function getProducts($pref_id, $price) {
    $params = array();
    $params['conditions'] = array(
      'Product.price >=' => $price
    );
    $params['order'] = array(
      "Product.pref_id = $pref_id DESC", "Product.price DESC"
    );
    $params['limit'] = 3;

    return $this->find('all', $params);

  }
}
