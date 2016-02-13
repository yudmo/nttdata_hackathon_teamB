<h2>今月ページ</h2>
<!-- entry -->
<div id="entry">
<div class="messages">
<?php
if(!empty($msg)){
	// データ直後のリダイレクトである場合、メッセージを受け取り表示する
	echo '<p>'.$msg.'</p>';
}
?>
</div>
<?php
echo $this->Form->create('Budget', array('action'=>'add'));
echo $this->Form->input('date', array('class' => 'form-control'));
echo $this->Form->input('money', array('class' => 'form-control'));
echo $this->Form->input( 'category', array( 
    'type' => 'select', 
    'options' => $select1,
	'class' => 'form-control'
));
echo $this->Form->submit('追加', array('class'=>'btn btn-custom'));
?>
</div>
<!-- //entry -->