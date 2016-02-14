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

// ログインユーザと同じ市区町村・同じ世帯形成のデータを受け取る
var resources = JSON.parse('<?php echo $resources; ?>');
var average = parseInt(resources[0]['Resource']['average']);
// 今月の月末日（日数）を取得
var thisMonthDays = new Date(<?= $thisYear ?>, <?= $thisMonth ?>, 0).getDate();
// 1日あたりの食費目安
var budgetPerDay = Math.round(average / thisMonthDays);
// グラフ描写用配列に目安の食費データを追加する
for(var i=0; i<budgetsComulArray.length; i++){
	// 日数を取得
	var day = budgetsComulArray[i][0].getDate();
	// 目安となる食費を挿入
	budgetsComulArray[i][2] = day * budgetPerDay;
}

/* google chart */
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(
	function() {
		var data = new google.visualization.DataTable();
		data.addColumn('date', '');
		data.addColumn('number', '累積食費');
		data.addColumn('number', '目安食費');
		data.addRows(budgetsComulArray);
		var options = {
			hAxis: {format: 'MM/dd'},
			legend: 'none',
			colors:['#e67e22', '#d35400']
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