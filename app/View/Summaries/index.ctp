<script type="text/javascript">
/* 同じ地域・世帯形態の月別平均食費配列に関する処理 */
// コントローラからjson形式でデータを取得する
var summaries = JSON.parse('<?php echo $summaries; ?>');
// コントローラから受け取った配列では不十分のため形成して配列に格納する
var summariesArray = [];
for(var i=0; i<summaries.length; i++){
	summariesArray[i] = [new Date(parseInt(summaries[i][0]['year']), parseInt(summaries[i][0]['month']-1), parseInt(summaries[i][0]['day'])), parseInt(summaries[i]['summaries']['average'])];
}

/* 同ログインユーザの月別平均食費配列に関する処理 */
// コントローラからjson形式でデータを取得する
var budgets = JSON.parse('<?php echo $budgets; ?>');
// コントローラから受け取った配列では不十分のため形成して配列に格納する
var budgetsArray = [];
for(var i=0; i<budgets.length; i++){
	budgetsArray[i] = [new Date(parseInt(budgets[i][0]['year']), parseInt(budgets[i][0]['month']-1), 1), parseInt(budgets[i][0]['money'])];
}

/* google chart 用に２つのチャートを結合する */
var chartArray = [];
// それぞれの配列で日付をキーとした連想配列
var budgetsList = {};
for(var i=0; i<budgetsArray.length; i++){
	var date = budgetsArray[i][0];
	// 一日をキーとする
	var key = new Date(date.getFullYear(),date.getMonth()+1,1);
	budgetsList[key] = budgetsArray[i][1];
}
var summariesList = {};
for(var i=0; i<summariesArray.length; i++){
	var date = summariesArray[i][0];
	// 一日をキーとする
	var key = new Date(date.getFullYear(),date.getMonth()+1,1);
	summariesList[key] = summariesArray[i][1];
}

var arrayIndex = 0;
for(key in budgetsList){
	// summariesにkeyが存在するか
	// var summariesVal = 0;
	// if(!summariesList[key] == undefined){
		summariesVal = summariesList[key];
	// }
	chartArray[arrayIndex] = [new Date(key), budgetsList[key], summariesVal];
	arrayIndex++;
}
console.log(chartArray);

/*
// summariesArrayとbudgetsArrayの最小値を比較する
var minDate = 99999;
var minIsBudgets = true;
if(summariesArray[0][0] < budgetsArray[0][0]){
	minDate = summariesArray[0][0];
	minIsBudgets = false;
}else{
	minDate = budgetsArray[0][0];
}
// summariesArrayとbudgetsArrayの最大値を比較する
var maxDate = 0;
var maxIsBudgets = true;
if(summariesArray[summariesArray.length-1][0] > budgetsArray[budgetsArray.length-1][0]){
	maxDate = summariesArray[summariesArray.length-1][0];
	maxIsBudgets = false;
}else{
	maxDate = budgetsArray[budgetsArray.length-1][0];
}
// 最小日時がBudgetsで最大日時もBudgetsの場合（true, true）
if(minIsBudgets && maxIsBudgets){
	
// 最小日時がBudgetsで最大日時はSummariesの場合（true, false）
}else if(minIsBudgets && !maxIsBudgets){

// 最小日時がSummariesで最大日時はBudgetsの場合（false, true）
}else if(!minIsBudgets && maxIsBudgets){

// 最小日時がSummariesで最大日時もSummariesの場合（false, false）
}else if(!minIsBudgets && !maxIsBudgets){
	
}
*/


/* google chart */
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(
	function() {
		var data = new google.visualization.DataTable();
		data.addColumn('date', '');
		data.addColumn('number', 'あなたの月別食費');
		data.addColumn('number', '同じ市区町村・世帯形態のユーザの月別食費');
		data.addRows(chartArray);
		var options = {
			hAxis: {format: 'yyyy/MM'},
			legend: 'none',
			colors:['#e67e22', '#d35400']
		};
		var chart = new google.visualization.AreaChart(document.getElementById('chart'));
		chart.draw(data, options);
	}
);
</script>
<h2><?php echo $this->Session->read('user.User.name'); ?>さんのこれまでの実績</h2>
<!-- graph -->
<div id="graph">
<div id="chart"></div>
</div>
<!-- //graph -->