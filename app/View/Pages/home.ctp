<?php $this->layout = ""; ?>
<!doctype html>
<html>
<head>
<?php
echo $this->fetch('meta');
echo $this->fetch('css');
echo $this->fetch('script');
?>
<!-- stylesheet -->
<?php
echo $this->Html->css('bootstrap.min');
echo $this->Html->css('bootstrap-select');
echo $this->Html->css('jquery-ui.min');
echo $this->Html->css('reset');
echo $this->Html->css('page_home');
?>
<!-- javascript -->
<?php
echo $this->Html->script('jquery-1.11.3.min');
echo $this->Html->script('jquery-ui.min');
echo $this->Html->script('jquery.animate-colors-min');
echo $this->Html->script('page_home');
?>
<meta charset="UTF-8">
<title>Setsuyaku De Neeke</title>
</head>

<body>
<!-- header -->
<div id="header">
<div class="inner">
<h1><a href="#"><img src="img/top/i_logo.png" alt="PosTom" width="210" height="70"></a></h1>
<!-- PC向けメニュー -->
<ul id="hnav" class="hidden-xs">
<li><a href="#col2">サービス</a></li>
<li><a href="#col3">特徴</a></li>
<li><a href="#col4">ムービー</a></li>
<li><a href="#col5">アカウント登録</a></li>
<li><a href="users/login">ログイン</a></li>
</ul>
<!-- スマートフォン向けメニュー -->
<ul id="smHnav" class="visible-xs">
<!-- 開発中 -->
</ul>
</div>
</div>
<!-- // header -->

<!-- column 1 -->
<div id="col1" class="cd-fixed-bg cd-bg-1">
<div class="inner cd-container">
<h2>節約して 美味しいもの 食べよう．</h2>
<h3>日々の生活の中で何を考え食生活を過ごしていますか？</h3>
<h4>
Setsuyaku De Neekeを利用して、苦しい節約生活にピリオドをうちましょう。<br>
このアプリを使えば、他のユーザーとの食費の比較ができ、浮いたお金でふるさと納税をすることで、美味しいお肉などの生鮮食品が自宅に届きます。<br>
これを機会に故郷へ恩返しをしてみてはどうですか？
</h4>
</div> 
</div> 
<!-- //column 1 -->

<!-- column 2 -->
<div id="col2" class="cd-scrolling-bg cd-color-1">
<div class="inner cd-container">
<p class="tit">ダミータイトルです</p>
<p class="txt">これはダミーテキストです。これはダミーテキストです。これはダミーテキストです。これはダミーテキストです。これはダミーテキストです。これはダミーテキストです。</p>
<p class="thumb"><img src="https://placehold.jp/48/330000/845f4b/600x480.png?text=%E3%83%A9%E3%83%B3%E3%83%87%E3%82%A3%E3%83%B3%E3%82%B0%E3%82%A4%E3%83%A1%E3%83%BC%E3%82%B8" alt="ダミー画像" width="600" height="480"></p>
</div> 
</div>
<!-- // column 2 -->

<!-- column 3 -->
<div id="col3" class="cd-fixed-bg cd-bg-2 no-min-height">
<div class="inner cd-container">
<p class="tit">ダミータイトルです。/p>
<p class="txt">これはダミーテキストです。これはダミーテキストです。これはダミーテキストです。これはダミーテキストです。これはダミーテキストです。これはダミーテキストです。</p>
<p class="thumb"><img src="https://placehold.jp/48/330000/845f4b/600x480.png?text=%E3%83%A9%E3%83%B3%E3%83%87%E3%82%A3%E3%83%B3%E3%82%B0%E3%82%A4%E3%83%A1%E3%83%BC%E3%82%B8" alt="ダミー画像" width="600" height="480"></p>
</div> 
</div> 
<!-- // column 3 -->

<!-- column 4 -->
<div id="col4" class="cd-scrolling-bg cd-color-3">
<div class="inner cd-container">
<p class="tit">ダミータイトルです。</p>
<p class="txt">これはダミーテキストです。これはダミーテキストです。これはダミーテキストです。これはダミーテキストです。これはダミーテキストです。これはダミーテキストです。</p>
<p class="thumb"><img src="https://placehold.jp/48/330000/845f4b/600x480.png?text=%E3%83%A9%E3%83%B3%E3%83%87%E3%82%A3%E3%83%B3%E3%82%B0%E3%82%A4%E3%83%A1%E3%83%BC%E3%82%B8" alt="ダミー画像" width="600" height="480"></p>
</div> 
</div> 
<!-- // column 4 -->

<!-- column 5 -->
<div id="col5" class="cd-scrolling-bg cd-color-2">
<div class="inner cd-container">
<p class="tit">ダミータイトルです。</p>
<p class="txt">これはダミーテキストです。これはダミーテキストです。これはダミーテキストです。これはダミーテキストです。これはダミーテキストです。これはダミーテキストです。</p>
<div class="error-messages disno"></div>
<div class="signup-form">
<form action="users/add" id="UserAddForm" method="post" accept-charset="utf-8">
<div class="disno">
<input type="hidden" name="_method" value="POST">
</div>
<dl class="input text">
<dt><label for="UserUsername" class="required">User Name</label></dt>
<dd><input name="data[User][name]" class="form-control required" maxlength="100" type="text" id="UserName"></dd>
</dl>
<dl class="input password">
<dt><label for="UserPassword" class="required">Password</label></dt>
<dd><input name="data[User][password]" class="form-control required" type="password" id="UserPassword"></dd>
</dl>
<dl class="input password">
<dt><label for="UserPasswordConfirm" class="required">Password(Confirm)</label></dt>
<dd><input name="data[User][password_confirm]" class="form-control required" type="password" id="UserPasswordConfirm"></dd>
</dl>
<div class="submit">
<input class="btn btn-custom" type="submit" value="アカウント登録">
</div>
</form>
</div>

</div> 
</div> 
<!-- // column 5 -->

<!-- footer -->
<div id="footer">
<div class="inner">
<p id="copyright">Coptyright &copy; University of Tsukuba Graduate School of Systems and Information Engineering Team: もりやこでら</p>
</div>
</div>
<!-- // footer -->

<!-- page top -->
<div class="pagetop disno hidden-xs">
<a href="#col1">
PAGE TOP
</a>
</div>
<!-- // page top -->
</body>
</html>


