<?php
	//カッコ内のファイルを読み込む
	require('db-access.php');
	//セッションをスタートする
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>ログイン｜情報処理試験対策</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
 <h1><a href="index.php">情報処理試験対策</a>
 <a href="signup.php">新規登録</a></h1>
<form action="" method="post">
<table>
<tr>
 <td>
  学籍番号<br>
  <input type="text" name="l_id" placeholder="学籍番号" autocomplete="new-password" value="" size="50%">
 <td>
</tr>
<tr>
 <td>
  パスワード<br>
  <input type="password" name="l_pass" placeholder="パスワード" autocomplete="new-password" value="" size="50%">
 <td>
</tr>
<tr>
 <td>
 <input type="submit" value="ログイン" >
 </td>
</tr>
</table>
</form>
<h3><a href="passwordreset.php">パスワードを忘れた場合</a></h3>
<?php
	$sql = "SELECT * FROM `login`";
	$stmt=$conn->prepare($sql);//SQLの実行準備
	//$row=$stmt->fetch();
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$flag = 0;		//入力された値の結果を保持(学籍番号が違う)
		$stmt->execute();//SQL実行
		while($row=$stmt->fetch()){
			if($row["id"] == $_POST["l_id"]){
				if($row["password"] == $_POST["l_pass"]){
					$flag = 1; //両方一致
					break;

				}
				$flag = 2; //パスワードが違う
				break;
			}
		}
		//echo $flag."<br>";
		if($flag==1){
			$_SESSION['id'] = $row["id"];
			$_SESSION['time'] = time();
			$_SESSION['login'] = 'success';
			header('Location: index.php');
			exit();
			echo "ログイン成功";
		}
		if($flag==2){
			echo "ログイン失敗";
			echo "<br>パスワードが違います。";
		}
		if($flag==0){
			echo "ログイン失敗";
			echo "<br>その学籍番号は存在しません。";
		}
	}
	?>
</html>
