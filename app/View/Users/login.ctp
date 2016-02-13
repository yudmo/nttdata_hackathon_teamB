<h2>ログイン</h2>

  <?php
  echo $this->Form->create('User',array('url' => array('controller' => 'users', 'action' => 'login')));

  //usersテーブルに基づいたデータの入力欄
  echo $this->Form->Input('name', array(
    'required' => true, 'class' => 'form-control'
  ));
  echo $this->Form->Input('password', array(
    'required' => true, 'class' => 'form-control'
  ));
  echo $this->Form->submit('ログイン', array('class'=>'btn btn-custom'));
  ?>