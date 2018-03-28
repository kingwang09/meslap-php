<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<body>
<?include("./include/db_connection.php")?>
<?
	
	$mainBibleImage = $_FILES["mainBibleImage"];
	$mainVideoImage = $_FILES["mainVideoImage"];
	$category = $_POST["category"];
	$title = $_POST["title"];
	$bibleIndex = $_POST["bibleIndex"];
	$bible = $_POST["bible"];
	$recitationBibleIndex = $_POST["recitationBibleIndex"];
	$recitationBible = $_POST["recitationBible"];
	$youtubeUrl = $_POST["youtubeUrl"];
	$worshipUrl = $_POST["worshipUrl"];
	$soundCloudUrl = $_POST["soundCloudUrl"];
	$videoImage = $_FILES["videoImage"];
	$textFile = $_FILES["textFile"];
	$juboFile01 = $_FILES["juboFile01"];
	$juboFile02 = $_FILES["juboFile02"];
	$juboFile03 = $_FILES["juboFile03"];
	$worshipDate = $_POST["worshipDate"];

	
	/*
		main : 메인말씀, 메인영상
		video : 목록 영상
		jubo : 주보
		text : 텍스트파일
	*/
	$uploadPath = "./worship/";
	$uploadMainPath = $uploadPath."main/";
	$uploadVideoPath = $uploadPath."video/";
	$uploadJuboPath = $uploadPath."jubo/";
	$uploadTextPath = $uploadPath."text/";
	
	if(!file_exists($uploadMainPath)){
		mkdir($uploadMainPath, 0777, true);
	}
	if(!file_exists($uploadVideoPath)){
		mkdir($uploadVideoPath, 0777);
	}
	if(!file_exists($uploadJuboPath)){
		mkdir($uploadJuboPath, 0777);
	}
	if(!file_exists($uploadTextPath)){
		mkdir($uploadTextPath, 0777);
	}
	
	//Main Image's
	$mainBibleImageFileName = $uploadMainPath.basename($mainBibleImage["name"]);
	$mainVideoImageFileName = $uploadMainPath.basename($mainVideoImage["name"]);
	
	move_uploaded_file($mainBibleImage['tmp_name'], $mainBibleImageFileName);
	move_uploaded_file($mainVideoImage['tmp_name'], $mainVideoImageFileName);
	
	//Video Image's
	$videoImageFileName = $uploadVideoPath.basename($videoImage["name"]);
	move_uploaded_file($videoImage['tmp_name'], $videoImageFileName);
	
	//Jubo Image's
	$jubo01ImageFileName = $uploadJuboPath.basename($juboFile01["name"]);
	$jubo02ImageFileName = $uploadJuboPath.basename($juboFile02["name"]);
	$jubo03ImageFileName = $uploadJuboPath.basename($juboFile03["name"]);
	
	move_uploaded_file($juboFile01['tmp_name'], $jubo01ImageFileName);
	move_uploaded_file($juboFile02['tmp_name'], $jubo02ImageFileName);
	move_uploaded_file($juboFile03['tmp_name'], $jubo03ImageFileName);

	//Text File's
	$textFileName = $uploadTextPath.basename($textFile["name"]);
	move_uploaded_file($textFile['tmp_name'], $textFileName);
	
	try{
		$db = new PDO($dsn, $user, $pass);
	}catch(Exception $error){
		die("Connection fail : ".$error->getMessage());
	}

	try{
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->beginTransaction();
		//map
		$statement = $db->prepare("insert into cmm_worship(category, title, bible_index, bible, recitation_bible_index, recitation_bible, youtube_url, worship_url, soundcloud_url, main_bible_image, main_video_image, video_image, text_file, jubo_file_01, jubo_file_02, jubo_file_03, worship_date) values(:category, :title, :bibleIndex, :bible, :recitationBibleIndex, :recitationBible, :youtubeUrl, :worshipUrl, :soundCloudUrl, :mainBibleImage, :mainVideoImage, :videoImage, :textFile, :juboFile01, :juboFile02, :juboFile03, :worshipDate)");
		$statement->execute(array(
			'category'=>$category,
			'title'=>$title,
			'bibleIndex'=>$bibleIndex,
			'bible'=>$bible,
			'recitationBibleIndex'=>$recitationBibleIndex,
			'recitationBible'=>$recitationBible,
			'youtubeUrl'=>$youtubeUrl,
			'worshipUrl'=>$worshipUrl,
			'soundCloudUrl'=>$soundCloudUrl,
			'mainBibleImage'=>$mainBibleImage["name"],
			'mainVideoImage'=>$mainVideoImage["name"],
			'videoImage'=>$videoImage["name"],
			'textFile'=>$textFile["name"],
			'juboFile01'=>$juboFile01["name"],
			'juboFile02'=>$juboFile02["name"],
			'juboFile03'=>$juboFile03["name"],
			'worshipDate'=>$worshipDate
			)
		);
		$db->commit();
	}catch(Exception $error){
		$db->rollback();
		echo "Transaction not Complete : ".$error->getMessage();
	}
	echo "success!!!";
?>
</body>
</html>
