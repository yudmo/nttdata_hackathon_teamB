<H2>Sign up</H2>

<?php
$city_forjs = json_encode($city);
echo $this->Form->create('User',array('url' => array('controller' => 'users', 'action' => 'add')));

//usersテーブルに基づいたデータの入力欄
echo $this->Form->Input('name', array(
  'required' => true
));
echo $this->Form->Input('password', array(
  'required' => true
));
echo $this->Form->Input('from_pref', array(
  'required' => true,
  'type' => 'select',
  'label' => "出身都道府県",
  'options' => $pref
));
echo $this->Form->Input('current_pref', array(
  'required' => true,
  'type' => 'select',
  'label' => "現在お住いの都道府県",
  'options' => $pref,
  'onchange' => "change_city(this);"
));
echo $this->Form->Input('current_city', array(
  'required' => true,
  'type' => 'select',
  'label' => "現在お住いの市区町村",
  'options' => $city[1],
  'empty' => "選択してください"
));
echo $this->Form->Input('type', array(
  'required' => true,
  'type' => 'select',
  'label' => "家族形態",
  'options' => $family
));
echo $this->Form->end('Sign up');
?>
<script type="text/javascript">
function change_city(obj){

  var cityarray = <?php echo $city_forjs; ?>;
  //console.log(cityarray[obj.value]);
  //TODO UserCurrentCityのオプションに$cityarray[obj.value]を格納したい
  console.log($("#UserCurrentCity > option"));
  return;
}
</script>

