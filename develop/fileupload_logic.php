<!doctype html>
<html lang="ko">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>Document</title>
 </head>
 <body>
  <?php
	$videoFileName = $_FILES["userfile"]["name"];
	$mainBibleFileName = $_FILES["mainbible"]["name"];
	
	
	$uploadPath = "./images/";
	$uploadVideoImagePath = $uploadPath."video/";
	$uploadMainBiblePath = $uploadPath."mainBible/";
	
	if(!file_exists($uploadVideoImagePath)){
		mkdir($uploadVideoImagePath, 0777, true);
	}
	if(!file_exists($uploadMainBiblePath)){
		mkdir($uploadMainBiblePath, 0777);
	}
	

	echo '<pre>';
	$uploadFile1 = $uploadVideoImagePath.basename($videoFileName);
	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadFile1)) {
		echo "파일이 유효하고, 성공적으로 업로드 되었습니다.\n";
	} else {
		print "파일 업로드 공격의 가능성이 있습니다!\n";
	}
	
	$uploadFile2 = $uploadMainBiblePath.basename($mainBibleFileName);
	if (move_uploaded_file($_FILES['mainbible']['tmp_name'], $uploadFile2)) {
		echo "파일이 유효하고, 성공적으로 업로드 되었습니다.\n";
	} else {
		print "파일 업로드 공격의 가능성이 있습니다!\n";
	}

	echo '자세한 디버깅 정보입니다:';
	print_r($_FILES);

	print "</pre>";
  ?>
 </body>
</html>
