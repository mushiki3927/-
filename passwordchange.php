<?php
	//カッコ内のファイルを読み込む
	require('db-access.php');
	require('logincheck.php');
	//セッションをスタートする
  echo $_SESSION['id'];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>パスワード変更｜情報処理試験対策</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>パスワード変更</h1>
  <form action="" method="post">
    <table>
      <tr>
       <td>
        旧パスワード<br>
        <input type="password" name="l_pass" placeholder="旧パスワード" autocomplete="new-password" value="" size="50%">
       <td>
      </tr>
      <tr>
       <td>
        新パスワード(６桁以上)<br>
        <input type="password" name="n_pass1" placeholder="新パスワード" autocomplete="new-password" value="" size="50%">
       <td>
      </tr>
      <tr>
       <td>
        新パスワード(再入力)<br>
        <input type="password" name="n_pass2" placeholder="新パスワード(再入力)" autocomplete="new-password" value="" size="50%">
       <td>
      </tr>
      <tr>
       <td>
       <input type="submit" value="パスワード変更" >
       </td>
      </tr>
    </table>
  </form>
  <?php
  	$sql = "SELECT * FROM `login` WHERE id =:l_id";
  	$stmt = $conn->prepare($sql);//SQLの実行準備
    $l_id = $_SESSION['id'];
    $stmt->bindParam(":l_id",$l_id);
		$stmt->execute();//SQL実行
  	$row=$stmt->fetch();
  	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  		$flag = 0;		//入力された値の結果を保持(旧パスワードが違う)
			if($row["password"] == $_POST["l_pass"]){
				if($_POST["n_pass1"] == $_POST["n_pass2"]){
					$flag = 1; //両方一致
          if(strlen($_POST["n_pass1"]) < 6){
            $flag = 3;
          }
				}else{
          $flag = 2; //新パスワードが一致しない
        }
			}
  		//echo $flag."<br>";
  		if($flag == 1){
        $sql="UPDATE `login` SET `password` = :password WHERE id =:l_id";
        $stmt = $conn->prepare($sql);//SQLの実行準備
        $l_id = $_SESSION['id'];
        $stmt->bindParam(":l_id",$l_id);
        $password = $_POST["n_pass1"];
        $stmt->bindParam(":password",$password);
        $stmt->execute();//SQL実行
  			header('Location: logout.php');
  			exit();
  			echo "変更完了";
  		}
  		if($flag == 2){
  			echo "変更失敗";
  			echo "<br>新パスワードが再入力と違います。";
  		}
      if($flag == 3){
        echo "変更失敗";
        echo "<br>新パスワードは６桁以上で入力してください。";
      }
  		if($flag == 0){
  			echo "変更失敗";
  			echo "<br>旧パスワードが違います<br>";
  		}
  	}
  ?>
</body>
</html>
