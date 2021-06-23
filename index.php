<?php
	//カッコ内のファイルを読み込む
	require('db-access.php');
	require('logincheck.php');
	//セッションをスタートする
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>メインページ｜情報処理試験対策</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1><a href="index.php">情報処理試験対策</a>
    <a href="logout.php">ログアウト</a></h1>
  </header>
  <form action="" method="post">
    <table>
      <tr>
        <h2><a href="resultinput.php">模擬試験結果入力</a></h2>
      </tr>
      <tr>
        <h2><a href="record.php">過去の成績</a></h2>
      </tr>
      <tr>
        <h2><a href="pastquestion.php">過去問</a></h2>
      </tr>
      <tr>
        <h2><a href="passwordchange.php">パスワード変更</a></h2>
      </tr>
    </table>
  </form>
</body>
</html>
