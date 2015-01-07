<? include("database_info.php")?>
<?
	//$dsn = "mysql:host=localhost;dbname=meslap";
	//$user = "meslap";
	//$pass = "admin";
	$db = new PDO($dsn, $user, $pass);
	
	//simple Query
	//$db->query("update --");
	
	//prepare Query
	$statement = $db->prepare("select * from books");
	$statement->execute();

	while($row = $statement->fetch()){
		print_r($row);
	}

	//map
	$statement = $db->prepare("insert into books(authorid, title, isbn, pub_year) values(:authorid, :title, :isbn, :pub_year)");
	$statement->execute(array(
		'authorid'=>4,
		'title'=>"foundation",
		'isbn'=>"0-553-80371-9",
		'pub_year'=>1951
		)
	);

	//array..
	$statement = $db->prepare("insert into books(authorid, title, isbn, pub_year) values(?, ?, ?, ?)");
	$statement->excute(array(4,"foundation","0-553-80371-9", 1951));

?>