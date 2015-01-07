<!doctype html>
<html lang="ko">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>Document</title>
 </head>
 <body>
<?
	$dbUrl = "mysql:host=localhost;dbname=ojt";
	$user = "ojt";
	$pass = "ojt";
	$db = new PDO($dbUrl, $user, $pass);
	$statement = $db->prepare("select * from CMM_BOARD");
	$statement->execute();

	while($row = $statement->fetch()){
		echo print_r($row);
	}
?>
 </body>
</html>
