<?php 

//編集機能

         	 			
	if((isset($_POST["editnum"])&&$_POST["pas3"]) && (!empty($_POST["editnum"])&& $_POST["pas3"])){
	//１編集番号が定義かつ空でない場合の処理 

		$editnum=$_POST["editnum"];
	if(isset($_POST["edit"])){
	//2編集ボタンが押された時の処理
		//投稿番号の取得


		$filename='mission_3-5-3.txt';
		$fp=fopen($filename,"a");
		$lines = file($filename, FILE_IGNORE_NEW_LINES);
		$lines = file($filename);
	

	if(file_exists($filename)&&$lines){
	//ファイルがあれば最終行から投稿番号取得
		$lastLine=$lines[count($lines) -1];
 		$num = explode('<>', $lastLine)[0];
 		$num++;
	}else{
		$num=1;
	}//ifが終了
			//繰り返し
			foreach ($lines as $key) {
				$array2=explode("<>",$key);
	
	if(($_POST["editnum"]==$array2[0])&&($_POST["pas3"]===$array2[4])){
	//３編集番号が定義かつ空でない・かつ編集ボタンが押され、編集番号と投稿番号が一致した時の処理
		$number=$array2[0];//編集ボタンから送信された編集対象番号
		$name=$array2[1];
		$comment=$array2[2];
		

	}//3
			}//繰り返し終了
	fclose($fp);
	}//2
	}//1

   

//編集時の処理
	if(isset($_POST["send"])&&(!empty($_POST["number"]) && $_POST["name"] && $_POST["comment"] && $_POST["pas1"])){
		//1編集対象番号の隠しフォームが空でない状態で送信ボタンが押されたときの処理
		$filename="mission_3-5-3.txt";
		//投稿番号の取得
		$lines = file($filename, FILE_IGNORE_NEW_LINES);
		$lines = file($filename);
   		$fp=fopen($filename,"a");
	if(file_exists($filename)&&$lines){
	//2ファイルがあれば最終行から投稿番号取得
		$lastLine=$lines[count($lines) -1];
 		$num = explode('<>', $lastLine)[0];
 		$num++;
	}else{
		$num=1;
	}//2終了

		fclose($fp);
		$fp=fopen($filename,"w");
		fclose($fp);
		$fp=fopen($filename,"a");
			//(3)繰り返し
			foreach ($lines as $key) {
				$array2=explode("<>",$key);

	if($_POST["number"]==$array2[0]){
		//4隠しフォームに入っている編集番号と投稿番号が等しい場合の処理
		$name = $_POST["name"];
		$comment = $_POST["comment"];
		$pass=$_POST["pas1"];
		//タイムゾーンの設定
		date_default_timezone_set('Asia/Tokyo');
		$date = date("Y/m/d H:i:s");
		//投稿番号の取得
		$num=$_POST["number"];

		$array1=array($num,$name,$comment,$date,$pass);
		$contents=implode("<>",$array1);
		fwrite($fp,$contents."<>"."\r\n");//投稿内容の差し替え
		
	}else{
		//隠しフォームに入っている編集番号と投稿番号が等しくない場合の処理

		fwrite($fp,$key);//ファイルにそのまま書き込み

	}//4の終了

			}//(3)foreachの終了
   fclose($fp);

	}//1の終了
?>


<html>
	<head>
		<meta charset="utf-8">
	</head>
        		<title>mission_3-5-3</title>

	<body>

	<h1>自分の趣味について語ろう！</h1>
	<h2>自由に書き込んでください！</h2>	
		<!--入力フォーム・送信ボタン-->
		<form method="POST" action="mission_3-5-3.php">
		<!--名前入力フォーム-->
		名前:<input type="text" name="name" placeholder="名前" value="<?php
   //編集番号を受け取った場合の処理
   $filename='mission_3-5-3.txt';
   $lines=file($filename);
		//繰り返し	
		foreach ($lines as $key) {
			$array2=explode("<>",$key,);
	if((isset($_POST['editnum']) &&$_POST['pas3'])&& (!empty($_POST['editnum'])&&$_POST['pas3']) && (isset($array2[0]) && $_POST['edit'])&&
( $_POST['editnum']==$array2[0])&&($_POST['pas3']===$array2[4])){
		echo $array2[1];
	}//ifの終了
		}//繰り返し終了
                                                                              ?>"
><br>
                     <!--名前入力フォーム終了-->

		<!--コメント入力フォーム-->
		コメント:<input type="text"name="comment" placeholder="コメント"value="<?php
   //編集番号を受け取った場合の処理
		//繰り返し
		foreach ($lines as $key) {
			$array2=explode("<>",$key);
	if((isset($_POST['editnum'])&&$_POST['pas3'])&&( !empty($_POST['editnum']) &&$_POST['pas3']) && (isset($array2[0])&&$_POST["edit"]) &&
( $_POST['editnum']==$array2[0])&&($_POST['pas3']===$array2[4])){
		echo $array2[2];
	}//ifの終了
		}//繰り返し終了
                                                                                       ?>"
                         >

                <!--コメント入力フォーム終了-->
		<!--編集番号受け取り隠しフォーム-->
		<input type="hidden"name="number" value="<?php
   //編集番号を受け取った場合の処理
		//繰り返し
		foreach ($lines as $key) {
			$array2=explode("<>",$key,4);
	if((isset($_POST['editnum'])&&$_POST['pas3'])&& ( !empty($_POST['editnum'])&&$_POST['pas3']) && (isset($array2[0]) && $_POST["edit"]) &&
($_POST['editnum']==$array2[0])){
		echo $array2[0];
	}//ifの終了
		}//繰り返し終了
                                                      ?>"
		><br>
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

		$filename='mission_3-5-3.txt';
		$lines = file($filename, FILE_IGNORE_NEW_LINES);
		$lines = file($filename);
			foreach ($lines as $key) {
				//繰り返し開始
				$array2=explode("<>",$key);
			}
	//新規投稿時のエラー表示
	if(isset($_POST["send"])&& empty($_POST["name"])){
		echo "名前が入力されていません。";
	}elseif(isset($_POST["send"])&& empty($_POST["comment"])){
		echo "コメントが入力されていません。";
	}elseif(isset($_POST["send"])&& empty($_POST["pas1"])){
		echo "パスワードが入力されていません。";
	}
	
	//削除エラー
	if(isset($_POST["delete"])&& empty($_POST["delnum"])){
		echo "削除番号が入力されていません。";
	}elseif(isset($_POST["delete"])&& empty($_POST["pas2"])){
		echo "パスワードが入力されていません。";
	}elseif(isset($_POST["delete"])&& ($_POST["pas2"]!==$array2[4])){
		echo "パスワードが違います。";
	}

	//編集エラー
	if(isset($_POST["edit"])&& empty($_POST["editnum"])){
		echo "編集番号が入力されていません。";
	}elseif(isset($_POST["edit"])&& empty($_POST["pas3"])){
		echo "パスワードが入力されていません。";
	}elseif(isset($_POST["edit"])&& ($_POST["pas3"]!==$array2[4])){
		echo "パスワードが違います。";
	}
?>
	<h3>-----------------------------------------</h3>
	<h3>【投稿一覧】</h3>
<?php
	
	if (($_SERVER['REQUEST_METHOD'] !== 'POST') &&(file_exists($filename)&&$lines)){
			foreach ($lines as $key) {
				//繰り返し開始
				$array2=explode("<>",$key);

				echo $array2[0].$array2[1].$array2[2].$array2[3]."<br>";
			}//繰り返し終了
	}elseif((isset($_POST["name"]) && $_POST["comment"] && $_POST["pas1"] ) &&(!empty($_POST["name"])&& $_POST["comment"])&& $_POST["pas1"] ){
	
	//1名前・コメントが定義かつ空でない	
		$name = $_POST["name"];
		$comment = $_POST["comment"];
	if(isset($_POST["send"]) &&  empty($_POST["number"])){
		//タイムゾーンの設定
		date_default_timezone_set('Asia/Tokyo');
		$date = date("Y/m/d H:i:s");
		//投稿番号の取得
		$filename='mission_3-5-3.txt';
		$fp=fopen($filename,"a");
		$lines = file($filename, FILE_IGNORE_NEW_LINES);
		$lines = file($filename);
	if(file_exists($filename)&&$lines){
		//4ファイルが存在する場合
		$lastLine=$lines[count($lines) -1];
		$num = explode('<>', $lastLine)[0];
		$num++;
	}else{
		$num=1;
	}//4の終了
	//パスワード
	$pass=$_POST["pas1"];
	$array1=array($num,$name,$comment,$date,$pass,);
	$contents=implode("<>",$array1) ;
	fwrite($fp,  implode("<>",$array1) ."<>"."\r\n",);			
	fclose($fp);		
	$filename="mission_3-5-3.txt";
	$lines = file($filename, FILE_IGNORE_NEW_LINES);
	$lines=file($filename);
				foreach ($lines as $key) {
				//繰り返し開始
				$array2=explode("<>",$key,);
				echo $array2[0].$array2[1].$array2[2].$array2[3]."<br>";
			}//繰り返し終了

	}//2
	}

//削除機能
   $filename="mission_3-5-3.txt";
   $lines = file($filename, FILE_IGNORE_NEW_LINES);
   $lines=file($filename);

	if(isset($_POST["delnum"]) && empty($_POST["delnum"])){
	//1削除番号が定義かつ空の場合の処理
			foreach ($lines as $key) {
			//(2)繰り返し開始
				$array2=explode("<>",$key,);
	if(isset($_POST["delete"])){
	//3 1かつ削除ボタンが押されたとき
		echo $array2[0].$array2[1].$array2[2].$array2[3]."<br>";
	}//3の終了
			}//(2)繰り返し終了
	}//1の終了

	if((isset($_POST["delnum"])&& $_POST["pas2"]) && (!empty($_POST["delnum"])&& $_POST["pas2"])){
		//1削除番号が定義かつ空でない場合の処理
		//ファイルを一旦空にする
		$fp=fopen($filename,"w");
		fclose($fp);
		//追記モード
		$fp=fopen($filename,"a");
			foreach ($lines as $key) {
				//(2)繰り返し開始
				$array2=explode("<>",$key);
				$delnum=$array2[0];

	if(($_POST["delnum"]!==$delnum )||($_POST["pas2"]!==$array2[4])){
	
	//3投稿番号と受け取った削除番号が一致しなかった場合
		fwrite($fp, $key);

	if(isset($_POST["delete"])){
	//4削除ボタンが押されたとき
			

	echo $array2[0].$array2[1].$array2[2].$array2[3]."<br>";
			
	}//4の終了
	}//3の終了
	}//(2)
				
		fclose($fp);
		
	
	}//1の終了


//編集機能
   $filename="mission_3-5-3.txt";
   $lines = file($filename, FILE_IGNORE_NEW_LINES);
   $lines = file($filename);
   $fp=fopen($filename,"a");


	if((isset($_POST["editnum"])&& $_POST["pas3"]) &&(!empty($_POST["editnum"]) && $_POST["pas3"]) ){
	//1編集番号が定義かつ空でない場合 
		$editnum=$_POST["editnum"];
	if(isset($_POST["edit"])){
	//2編集ボタンが押されたとき
	//投稿番号の取得
	if(file_exists($filename)&&$lines){
		$lastLine=$lines[count($lines) -1];
 		$num = explode('<>', $lastLine)[0];
 		$num++;
	}else{
		$num=1;
	}//ifの終了

			foreach ($lines as $key) {
			//(3)繰り返し開始
				$array2=explode("<>",$key);

	if(($_POST["editnum"]==$array2[0])&&($_POST["pas3"]==$array2[4])) {
	//4投稿番号と受け取った編集番号が一致した時
		$number=$array2[0];
		$name=$array2[1];
		$comment=$array2[2];
		$pass=$array2[4];
	}//4
	}//(3)
	}//2
	}//1
   fclose($fp);

	if((isset($_POST["send"]))&& (!empty($_POST["number"]) && $_POST["name"] && $_POST["comment"] && $_POST["pas1"])) {
	//1送信ボタンが押されかつ隠しフォームが空でない場合
		$name = $_POST["name"];
		$comment = $_POST["comment"];
		//タイムゾーンの設定
		date_default_timezone_set('Asia/Tokyo');
		$date = date("Y/m/d H:i:s");
		$filename='mission_3-5-3.txt';
		$lines = file($filename, FILE_IGNORE_NEW_LINES);
		$lines = file($filename);
		$pass= $_POST["pas1"];
		$fp=fopen($filename,"a");
	if(file_exists($filename)&&$lines){
		$lastLine=$lines[count($lines) -1];
		$num = explode('<>', $lastLine)[0];
		$num++;
	}else{
		$num=1;
	}
		fclose($fp);
	
		$fp=fopen($filename,"w");
		fclose($fp);
		$fp=fopen($filename,"a");  
		$array1=array($num,$name,$comment,$date,$pass);
		$contents=implode("<>",$array1);
			foreach ($lines as $key) {
			//(3)開始
				$array2=explode("<>",$key);


	if($_POST["number"]==$array2[0]){
		//4隠しフォームの番号と投稿番号が一致した場合

	
		$num=$_POST["number"];
		$array1=array($num,$name,$comment,$date,$pass);
		$contents=implode("<>",$array1);
		$array2=explode("<>",$key);
		fwrite($fp,$contents."<>"."\r\n");//差し替え
		echo $array2[0].$array2[1].$array2[2].$array2[3]."<br>";
	}else{

		fwrite($fp,$key);
	
		echo $array2[0].$array2[1].$array2[2].$array2[3]."<br>";
		
	}//4終了
			}//(3)終了
		fclose($fp);

	}//1の終了

?>

	</body>

<html>
