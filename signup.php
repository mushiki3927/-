<?php
	//カッコ内のファイルを読み込む
	require('db-access.php');
	//セッションをスタートする
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>新規登録｜情報処理試験対策</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
  <p>以下の情報を入力してください。</p>
  <form action="signup2.php" method="post">
  <table>
  <tr>
    学籍番号<br>
    <input type="text" name="s_id" placeholder="学籍番号" autocomplete="new-password" value="" size="50%"><br>
  </tr>
  <tr>
   <input type="submit" value="登録" >
  </tr>
  </table>
  </form>
</body>
</html>
