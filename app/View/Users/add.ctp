<h2>アカウント登録</h2>

<?php
// デフォルト（東京都）の番号を設定
$default_pref_num = 13;

echo $this->Form->create('User',array('url' => array('controller' => 'users', 'action' => 'add')));

//usersテーブルに基づいたデータの入力欄
echo $this->Form->Input('name', array(
  'required' => true,
  'class' => 'form-control'
));
echo $this->Form->Input('password', array(
  'required' => true,
  'class' => 'form-control'
));
echo $this->Form->Input('from_pref', array(
  'required' => true,
  'type' => 'select',
  'label' => "出身都道府県",
  'options' => $pref,
  'value' => $default_pref_num,
  'class' => 'form-control'
));
echo $this->Form->Input('current_pref', array(
  'required' => true,
  'type' => 'select',
  'label' => "現在お住いの都道府県",
  'options' => $pref,
  'value' => $default_pref_num,
  'onchange' => "changeCurrentPref(this);",
  'class' => 'form-control'
));
for($i=1; $i<=count($city); $i++){
	echo $this->Form->Input('current_city', array(
		'required' => true,
		'type' => 'select',
		'label' => array(
			'text' => "現在お住いの市区町村",
			// デフォルトの東京都以外の場合
			'class' => $i==$default_pref_num?'':'disno'
		),
		'options' => $city[$i],
		'empty' => "選択してください",
		'class' => $i==$default_pref_num?'form-control':'form-control disno',
		'data-parent' => $i,
		'onchange' => 'changeCurrentCity(this);'
	));
}
echo $this->Form->Input('current_city', array(
	'required' => true,
	'class' => 'form-control disno',
	'label' => false
));
echo $this->Form->Input('type', array(
  'required' => true,
  'type' => 'select',
  'label' => "家族形態",
  'options' => $family,
  'class' => 'form-control'
));
echo $this->Form->submit('アカウント登録', array('class'=>'btn btn-custom'));
?>
<script type="text/javascript">
$(function(){
	// ページ読み込み時に「現在のお住まいの市区町村」を表示しない設定になっている親要素のマージンを消去する
	$('label[for="UserCurrentCity"].disno').each(function(index, element) {
		$(element).parent('div').css('margin-bottom', '0');
	});
	// セレクトボックスはあくまでも選択用とし、バリデーションチェックはおこなわない
	$('select[name="data[User][current_city]"]').removeAttr('name id required')
	// 現在の市区町村を内包する要素のマージンを0に設定
	$('input[name="data[User][current_city]"]').parent('div').css('margin-bottom', '0');
	
});
function changeCurrentPref(obj){
	// 現在の都道府県番号を取得する
	var currentPrefNum = obj.value;
	// 現在表示されている市区町村のマージンを0に設定する
	$('label[for="UserCurrentCity"]').not(".disno").parent('div').css('margin-bottom', '0');
	// 現在表示されている市区町村を非表示にする
	$('label[for="UserCurrentCity"]').not(".disno").next('select').addClass('disno').removeAttr('required').attr('id', '');
	$('label[for="UserCurrentCity"]').not(".disno").addClass('disno');
	// 選択された都道府県番号に適合する市区町村を表示する
	$('select[data-parent="'+currentPrefNum+'"]').removeClass('disno').attr('required', true).attr('id', 'UserCurrentCity');
	$('select[data-parent="'+currentPrefNum+'"]').prev('label').removeClass('disno');
	// 選択された都道府県番号に適合する市区町村のマージンを設定する
	$('label[for="UserCurrentCity"]').not(".disno").parent('div').css('margin-bottom', '10px');
}
function changeCurrentCity(obj){
	// 選択された市区町村の値を取得する
	var currentCityNum = obj.value;
	// インプットテキストに設定する
	$('input[name="data[User][current_city]"]').val(currentCityNum);
}
</script>

