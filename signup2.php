<?php
	//カッコ内のファイルを読み込む
	require('db-access.php');
	//セッションをスタートする
  $sql = "SELECT * FROM `login`";
  $stmt=$conn->prepare($sql);//SQLの実行準備
  $stmt->execute();
  $flag = 0;  //打たれた学籍番号が既に存在しているかのフラグ
  while($row=$stmt->fetch()){
    if($_POST["s_id"] == $row["id"]){
      $flag = 1;
    }
  }
  if($flag == 0){
    $id = $_POST["s_id"];
    $pass = $_POST["s_id"];
    $sql="INSERT INTO `login`(`id`, `password`) VALUES (:s_id,:s_pass)";
    $stmt=$conn->prepare($sql);//SQLの実行
    $stmt->bindParam(":s_id",$id);
    $stmt->bindParam(":s_pass",$pass);
    $stmt->execute();
  }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>新規登録｜情報処理試験対策</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
  <?php if($flag == 0): ?>
  <p>以下の番号で登録しました。</p>
    学籍番号<br>
    <input type="text" size="50%" readonly value=<?php echo $_POST["s_id"];?>><br>
    <p>※パスワードは学籍番号が初期値になっています。</p>
    <a href="index.php">ログインページへ</a>
  <?php else:?>
    <p>その番号は既に存在します。</p>
    <a href="signup.php">戻る</a>
  <?php endif;?>
</body>
</html>
