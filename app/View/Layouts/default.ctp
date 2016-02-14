<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<!-- meta -->
	<meta name="viewport" content="width=device-width,initial-scale=1.0" />
	<title>
		<?php echo $this->fetch('title'); ?> - Setsuyaku De Neeke
	</title>
	<?php
		echo $this->Html->meta('icon');
		/********************************************************
		 * style sheet
		 ********************************************************/
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('bootstrap-select');
		echo $this->Html->css('jquery-ui.min');
		echo $this->Html->css('reset');
		echo $this->Html->css('base');
		echo $this->Html->css('font-awesome.min');
		// ページ固有のスタイルシートを読み込む
		switch($this->name){
			case 'Users':
				//echo $this->Html->css('page_user');
				break;
			case 'Budgets':
				echo $this->Html->css('page_budget');
				break;
			case 'Summaries':
				echo $this->Html->css('page_summary');
				break;
		}

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		/********************************************************
		 * javascirpt
		 ********************************************************/
		echo $this->Html->script('jquery-1.11.3.min');
		echo $this->Html->script('jquery.animate-colors-min');
		echo $this->Html->script('easeljs-0.8.0.min');
		echo $this->Html->script('bootstrap.min');
		echo $this->Html->script('bootstrap-select');
		echo $this->Html->script('jquery-ui.min');
		echo $this->Html->script('common');
	?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<?php
		// ページ固有のjavascriptを読み込む
		switch($this->name){
			case 'Users':
				//echo $this->Html->script('page_user');
				break;
			case 'Budgets':
				echo $this->Html->script('page_budget');
				break;
			case 'Summaries':
				echo $this->Html->script('page_summary');
				break;
		}
	?>
<script type="text/javascript">
	// コントローラを取得
	var controller = "<?php echo $this->name; ?>";
	// アクションを取得
	var action = "<?php echo $this->action; ?>";
</script>
	<!-- fonts -->
    <link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
</head>
<body>
<!-- contents -->
<div id="contents">
<!-- contents.dashboard -->
<div id="dashboard">
<h1 id="logo">
<?php
echo $this->Html->image('i_logo.svg', array(
	"alt" => "PosTom",
	'url' => array('controller' => 'summaries', 'action' => 'index'),
	'width' => 130,
	'height' => 130
));
?>
</h1>
<ul id="gNav">
<li id="gNavMy"><a href="<?php echo $this->Html->url(array('controller' => 'summaries', 'action' => 'index')); ?>"><i class="fa fa-male fa-2x"></i><span>マイページ</span></a></li>
<li id="gNavThis"><a href="<?php echo $this->Html->url(array('controller' => 'budgets', 'action' => 'view')); ?>"><i class="fa fa-calendar fa-2x"></i><span>今月ページ</span></a></li>
<li id="gNavLast"><a href="<?php echo $this->Html->url(array('controller' => 'summaries', 'action' => 'view')); ?>"><i class="fa fa-calculator fa-2x"></i><span>月末ページ</span></a></li>
</ul>
</div>
<!-- //contents.dashboard -->
<!-- contents.main -->
<div id="main">

<!-- header -->
<div id="header">
	<ul id="hNav">
	<?php
	// ログインしているユーザ名取得
	// $user = AuthComponent::user();
	// $username = $user['username'];
	// ここでは仮にkoderaというユーザでログインしていることとします
	$username = 'kodera';
	// ログインか否かで表示を変更
	if($username != null){
		$logoutLink = $this->Html->url(array('controller' => 'users', 'action' => 'logout'));
		$mypageLink = $this->Html->url(array('controller' => 'summaries', 'action' => 'index'));
		echo '<li><a href="' . $logoutLink . '">ログアウト</a></li>';
		echo '<li><a href="' . $mypageLink . '">マイページ</a></li>';
	}else{
		$signupLink = $this->Html->url(array('controller' => 'users', 'action' => 'add'));
		$signinLink = $this->Html->url(array('controller' => 'users', 'action' => 'login'));
		echo '<li><a href="' . $signinLink . '">アカウント登録</a></li>';
		echo '<li><a href="' . $signupLink . '">ログイン</a></li>';
	}
	?>
	</ul>
</div>
<!-- //header -->
<?php echo $this->Flash->render(); ?>
<?php echo $this->fetch('content'); ?>
<!-- sql dump -->
<div id="sqldump">
<?php echo $this->element('sql_dump'); ?>
</div>
<!--//sql dump-->
</div>
<!-- //contents.main -->
</div>
<!-- //contents -->
</body>
</html>
