<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<body>
<?include("./include/db_connection.php")?>
<?
	$id = $_GET["id"];
	
	try{
		$db = new PDO($dsn, $user, $pass);
	}catch(Exception $error){
		die("Connection fail : ".$error->getMessage());
	}

	try{
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->beginTransaction();
		//map
		$statement = $db->prepare("DELETE FROM cmm_worship where id=:id LIMIT 1");
		$statement->bindParam(':id', $id);
		$db->commit();
	}catch(Exception $error){
		$db->rollback();
		echo "Transaction not Complete : ".$error->getMessage();
	}
	echo "delete success";
?>
</body>
</html>
