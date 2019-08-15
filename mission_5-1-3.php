<?php 

//編集機能
	//データベース接続 
	$dsn = 'データベース名';
	$user = 'ユーザー名';
	$password = 'パスワード';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));



	//テーブル作成
	$sql = "CREATE TABLE IF NOT EXISTS board1"
	." ("
	. "id INT AUTO_INCREMENT PRIMARY KEY,"
	. "name char(32),"
	. "comment TEXT,"
	. "creation_time  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,"
	. "pas1 TEXT"
	.");";
	$stmt = $pdo->query($sql);
         	 			
	if((isset($_POST['editnum'])&&$_POST['pas3'] && $_POST['edit'] ) && (!empty($_POST['editnum'])&& $_POST['pas3'])){
	//編集番号が定義かつ空でなく編集ボタンが押されたときの処理 
		$editnum=$_POST['editnum'];
		$pas3=$_POST['pas3'];

	}
   

?>


<html>
	<head>
		<meta charset="utf-8">
	</head>
        		<title>mission_5-1-3</title>

	<body>


	<h1>最近購入してよかったものを共有しよう！</h1>
	<h2>自分が実際に使ってみて、人にお勧めしたいポイントを教えてね</h2>
		<!--入力フォーム・送信ボタン-->
		<form method="POST" action="mission_5-1-3.php">
		<!--名前入力フォーム-->
		名前:<input type="text" name="name" placeholder="名前" value="<?php
		
		//編集番号を受け取った場合の処理
	if((isset($_POST['editnum'])&&$_POST['pas3'] && $_POST['edit'] ) && (!empty($_POST['editnum'])&& $_POST['pas3'])){
			$editnum=$_POST['editnum'];
		$pas3=$_POST['pas3'];

		//表示
		$sql = "SELECT * FROM board1 where id='$editnum' and pas1='$pas3'";
		$stmt = $pdo->query($sql);
		$results = $stmt->fetchAll();
				foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		echo $row['name'];
				}
	}
										?>"
	
><br>
                     <!--名前入力フォーム終了-->

		<!--コメント入力フォーム-->
		コメント:<input type="text"name="comment" placeholder="コメント"value="<?php
		
		//編集番号を受け取った場合の処理
	if((isset($_POST['editnum'])&&$_POST['pas3'] && $_POST['edit'] ) && (!empty($_POST['editnum'])&& $_POST['pas3'])){
		//表示
		$sql = "SELECT * FROM board1 where id='$editnum' and pas1='$pas3'";
		$stmt = $pdo->query($sql);
		$results = $stmt->fetchAll();
				foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
	
		echo $row['comment'];
				}

	}

											?>"
                         >

                <!--コメント入力フォーム終了-->
		<!--編集番号受け取り隠しフォーム-->
		<input type="hidden"name="number" value="<?php
		
		//編集番号を受け取った場合の処理
	if((isset($_POST['editnum'])&&$_POST['pas3'] && $_POST['edit'] ) && (!empty($_POST['editnum'])&& $_POST['pas3'])){
		//表示
		$sql = "SELECT * FROM board1 where id='$editnum' and pas1='$pas3'";
		$stmt = $pdo->query($sql);
		$results = $stmt->fetchAll();
				foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		echo $row['id'];
				}


	}

						?>"	><br>
		<!--編集番号受け取り隠しフォーム終了-->
		<!--パスワード1-->
		パスワード：<input type="password" name="pas1" placeholder="パスワード">

			<!--送信ボタン-->
			<input type="submit"name="send" value="送信"><br><br>
 
		<!--削除番号入力フォーム-->		
		削除対象番号:<input type="text" name="delnum" placeholder="削除番号"><br>
		<!--パスワード2-->
		パスワード：<input type="password" name="pas2" placeholder="パスワード">

			<!--削除ボタン-->
			<input type="submit"name="delete" value="削除"><br><br>
		<!--編集番号入力フォーム-->
		編集対象番号:<input type="text" name="editnum" placeholder="編集番号"><br>
		<!--パスワード2-->
		パスワード：<input type="password" name="pas3" placeholder="パスワード">

			<!--編集ボタン-->
			<input type="submit"name="edit"value="編集"><br><br>

		</form>


<?php

	//新規投稿時のエラー表示
	if(isset($_POST['send'])&& empty($_POST['name'])){
		echo "名前が入力されていません。";
	}elseif(isset($_POST['send'])&& empty($_POST['comment'])){
		echo "コメントが入力されていません。";
	}elseif(isset($_POST['send'])&& empty($_POST['pas1'])){
		echo "パスワードが入力されていません。";
	}


	//削除エラー
	if(isset($_POST['delete'])&& empty($_POST['delnum'])){
		echo "削除番号が入力されていません。";
	}elseif(isset($_POST['delete'])&& empty($_POST['pas2'])){
		echo "パスワードが入力されていません。";
	}
		
	

		$sql = "SELECT * FROM board1";
		$stmt = $pdo->query($sql);
		$results = $stmt->fetchAll();
				foreach ($results as $row){
	
	if((isset($_POST['delnum']) &&$_POST['pas2']&&$_POST['delete'])&& (!empty($_POST['delnum'])&& $_POST['pas2']) &&
	(($row['id']==$_POST['delnum']) &&($row['pas1']!==$_POST['pas2']))){
	
		echo "パスワードが違います。";
	}
				}

	//編集エラー

	if(isset($_POST['edit'])&& empty($_POST['editnum'])){
		echo "編集番号が入力されていません。";
	}elseif(isset($_POST['edit'])&& empty($_POST['pas3'])){
		echo "パスワードが入力されていません。";
	}
		$sql = "SELECT * FROM board1";
		$stmt = $pdo->query($sql);
		$results = $stmt->fetchAll();
				foreach ($results as $row){
	
	if((isset($_POST['editnum'])&&$_POST['pas3'] && $_POST['edit'] ) && (!empty($_POST['editnum'])&& $_POST['pas3'])&&
	(($row['id']==$_POST['editnum']) &&($row['pas1']!==$pas3))){

		echo "パスワードが違います。";
	}
				}
?>
	<h3>-----------------------------------------</h3>
	<h3>【投稿一覧】</h3>
<?php


	if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			//データ表示
	$sql = 'SELECT * FROM board1';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
			foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		echo $row['id'].',';
		echo $row['name'].',';
		echo $row['comment'].',';
		echo $row['creation_time'].'<br>';

	echo "<hr>";
			}
	}



//投稿機能

        if ((isset($_POST['name']) && $_POST['comment'] && $_POST['pas1'] ) &&(!empty($_POST['name'])&& $_POST['comment'] && $_POST['pas1'] )&&
	isset($_POST['send']) && empty($_POST["number"])){
	



	//データ入力
	$sql = $pdo -> prepare("INSERT INTO board1 (name, comment,pas1) VALUES (:name, :comment,:pas1)");
	$sql -> bindParam(':name', $name, PDO::PARAM_STR);
	$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
	$sql -> bindParam(':pas1', $pas1, PDO::PARAM_STR);

		$name     = $_POST['name']   ;
		$comment = $_POST['comment'];
		$pas1 =	$_POST['pas1'];
	$sql -> execute();
	


	//データ表示
	$sql = 'SELECT * FROM board1';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
			foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		echo $row['id'].',';
		echo $row['name'].',';
		echo $row['comment'].',';
		echo $row['creation_time'].'<br>';

	echo "<hr>";
			}

	}//if終了




//削除機能
	

	if((isset($_POST['delnum']) &&$_POST['pas2'])&& (!empty($_POST['delnum'])&& $_POST['pas2']) &&
	isset($_POST['delete'])){//削除番号とパスワードが定義かつ空でなく削除ボタンが押されたとき
		$delnum=$_POST['delnum'];	
		$pas2=$_POST['pas2'];
		
		//削除番号とid・パスワードが一致したら削除
		$sql = "delete from board1 where id='$delnum' and  pas1='$pas2'";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':id' , $id, PDO::PARAM_INT);
		$stmt->bindParam(':pas1' , $pas1, PDO::PARAM_INT);	
		$stmt->execute();
		
		//表示
		$sql = 'SELECT * FROM board1';
		$stmt = $pdo->query($sql);
		$results = $stmt->fetchAll();
			foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		echo $row['id'].',';
		echo $row['name'].',';
		echo $row['comment'].',';
		echo $row['creation_time'].'<br>';

	echo "<hr>";
			}
	}

//編集時の処理
	if((isset($_POST['send']))&&(!empty($_POST['number']) && $_POST['name'] && $_POST['comment'] && $_POST['pas1'])){
	//編集対象番号の隠しフォームが空でない状態で送信ボタンが押されたときの処理
		$editnum=$_POST['editnum'];
		$pas3=$_POST['pas3'];
		$number=$_POST['number'];


	$name=$_POST['name'];
	$comment=$_POST['comment'];
	$pas1=$_POST['pas1'];
	$id=$number;


	//編集
	$sql = 'update board1 set name=:name,comment=:comment,pas1=:pas1 where id=:id';
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':name', $name, PDO::PARAM_STR);
	$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
	$stmt->bindParam(':pas1', $pas1, PDO::PARAM_STR);
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();
	

	$sql = 'SELECT * FROM board1';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
			foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		echo $row['id'].',';
		echo $row['name'].',';
		echo $row['comment'].',';
		echo $row['creation_time'].'<br>';

		echo "<hr>";
			}

	}


?>

	<body>
<html>

