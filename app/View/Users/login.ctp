<h2>Log in</h2>

  <?php
  echo $this->Form->create('User',array('url' => array('controller' => 'users', 'action' => 'login')));

  //usersテーブルに基づいたデータの入力欄
  echo $this->Form->Input('name', array(
    'required' => true
  ));
  echo $this->Form->Input('password', array(
    'required' => true
  ));
  echo $this->Form->end('Log in');
  ?>