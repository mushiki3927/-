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
<title>パスワードリセット｜情報処理試験対策</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>パスワードリセット</h1>
  <form action="" method="post">
    <table>
      <tr>
       <td>
        パスワードをリセットします。<br>学籍番号を入力してください。<br>
        <input type="text" name="r_id" placeholder="学籍番号" autocomplete="new-password" value="" size="50%">
       <td>
      </tr>
      <tr>
       <td>
       <input type="submit" value="パスワードリセット" >
       </td>
      </tr>
    </table>
  </form>
  <?php
  $sql = "SELECT * FROM `login`";
	$stmt=$conn->prepare($sql);//SQLの実行準備
	//$row=$stmt->fetch();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  		$flag = 0;		//入力された値の結果を保持(学籍番号が違う)
  		$stmt->execute();//SQL実行
  		while($row=$stmt->fetch()){
  			if($row["id"] == $_POST["r_id"]){
  					$flag = 1; //両方一致
  					break;
  			}
  		}
  		//echo $flag."<br>";
  		if($flag == 1){
        $sql="UPDATE `login` SET `password` = :password WHERE id =:r_id";
        $stmt = $conn->prepare($sql);//SQLの実行準備
        $r_id = $_POST["r_id"];
        $stmt->bindParam(":r_id",$r_id);
        $password = $_POST["r_id"];
        $stmt->bindParam(":password",$password);
        $stmt->execute();//SQL実行
  			header('Location: login.php');
  			exit();
  			echo "変更完了";
  		}
  		if($flag == 0){
  			echo "変更失敗";
  			echo "<br>その学籍番号は存在しません。<br>";
  		}
  	}
  ?>
</body>
</html>
