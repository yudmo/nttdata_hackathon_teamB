<h2>先月の食費</h2>
<p class="titPrice">&yen;<?php echo number_format($monthly_budgets);?></p>
<h2>同じ地域(<?php echo $pref_name.'-'.$city_name;?>)・家族形態(<?php echo $type;?>)の平均食費</h2>
<p class="titPrice colorGray">&yen;<?php echo number_format($average);?></p>
<div id="message">
<?php
if($monthly_budgets <= $average){
  echo '<p class="posiMsg">平均より'."&#165;".number_format($average - $monthly_budgets).'浮いたよ!</p>';
}else{
  echo '<p class="negaMsg">平均より'."&#165;".number_format($monthly_budgets - $average).'オーバー・・・</p>';
}
?>
</div>

<h3>先月で浮いた金額でできるふるさと納税はこちら</h3>
<ul class="furusatoList">
<?php
foreach ($monthly_list as $key => $value) {
?>
	<li>
	<a href="<?= $value['Product']['page_url'] ?>" target="_blank">
	<div class="imgArea">
		<p class="thub"><img src="<?= $value['Product']['image_url'] ?>" alt="<?= $value['Product']['name'] ?>" width="100" height="100"></p>
	</div>
	<div class="txtArea">
		<p class="tit"><?= $value['Product']['name'] ?></p>
		<p class="price">&yen;<?= number_format($value['Product']['price']) ?></p>
		<p class="txt"><?= $value['Product']['description'] ?></p>
	</div>
	</a>
	</li>
<?php
}
?>
</ul>

<h3>これまでの浮いた金額(&yen;<?php echo number_format($deposit);?>)でできるふるさと納税はこちら</h3>
<ul class="furusatoList">
<?php
foreach ($deposit_list as $key => $value) {
?>
	<li>
	<a href="<?= $value['Product']['page_url'] ?>" target="_blank">
	<div class="imgArea">
		<p class="thub"><img src="<?= $value['Product']['image_url'] ?>" alt="<?= $value['Product']['name'] ?>" width="100" height="100"></p>
	</div>
	<div class="txtArea">
		<p class="tit"><?= $value['Product']['name'] ?></p>
		<p class="price">&yen;<?= number_format($value['Product']['price']) ?></p>
		<p class="txt"><?= $value['Product']['description'] ?></p>
	</div>
	</a>
	</li>
<?php
}
?>
</ul>