<h2>先月の食費</h2>
<p>&yen;<?php echo number_format($monthly_budgets);?></p>
<h2>同じ地域(<?php echo $pref_name.'-'.$city_name;?>)・家族形態(<?php echo $type;?>)の平均食費</h2>
<p>&yen;<?php echo number_format($average);?></p>
<?php
if($monthly_budgets <= $average){
  echo '平均より'."&#165;".number_format($average - $monthly_budgets).'浮いたよ!';
}else{
  echo '平均より'."&#165;".number_format($monthly_budgets - $average).'オーバー・・・';
}
?>

<h2>先月で浮いた金額でできるふるさと納税はこちら</h2>
<?php
  foreach ($monthly_list as $key => $value) {
    debug($value);
  }
?>

<h2>これまでの浮いた金額(&yen;<?php echo number_format($deposit);?>)でできるふるさと納税はこちら</h2>
<?php
  foreach ($deposit_list as $key => $value) {
    debug($value);
  }
?>