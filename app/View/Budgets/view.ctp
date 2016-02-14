<?php
// 今月を取得
$thisYear = date('Y');
$thisMonth = date('m');

?>
<script type="text/javascript">
// 今月の日数別累計食費を取得する
var budgets = JSON.parse('<?php echo $budgets; ?>');
// コントローラーから取得した配列では不十分なので変換
var budgetsArray = [];
for(var i=0; i<budgets.length; i++){
	budgetsArray[i] = [new Date(parseInt(budgets[i][0]['year']), parseInt(budgets[i][0]['month']-1), parseInt(budgets[i][0]['day'])), parseInt(budgets[i][0]['money'])];
}
// 日別の食費が算出できたので、次は日別で累計食費を算出
var budgetsComulArray = [];
var comulValue = 0;
for(var i=0; i<budgetsArray.length; i++){
	comulValue += budgetsArray[i][1];
	budgetsComulArray[i] = [budgetsArray[i][0], comulValue];
}

/* google chart */
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(
	function() {
		var data = new google.visualization.DataTable();
		data.addColumn('date', '');
		data.addColumn('number', '累積食費');
		data.addRows(budgetsComulArray);
		var options = {
			hAxis: {format: 'MM/dd'},
			legend: 'none',
			colors:['#e67e22']
		};
		var chart = new google.visualization.AreaChart(document.getElementById('chart'));
		chart.draw(data, options);
	}
);
</script>
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
<!-- graph -->
<div id="graph">
<h3><?= $thisYear ?>/<?= $thisMonth ?>のグラフ</h3>
<div id="chart"></div>
</div>
<!-- //graph -->