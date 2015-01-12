<!DOCTYPE html>
<html lang="ko">
<head>
  <?include("./include/common_header.php")?>
</head>
<body>
<?include("./include/common_menu.php")?>
<br/>
<?
	$dsn = "mysql:host=127.0.0.1;dbname=ojt";
	$user = "ojt";
	$pass = "ojt";
	try{
		$db = new PDO($dsn, $user, $pass);
	}catch(Exception $error){
		die("Connection fail : ".$error->getMessage());
	}

	$statement = $db->prepare("select * from cmm_worship");
	$statement->execute();
	$worshipCount = $statement->rowCount();
	$worships = $statement->fetchAll();
	//while($row = $statement->fetch()){
	//	print_r($row);
	//}
?>

<div class="content">
	<div class="pull-right">
		<a href="worship_write.php" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i> 말씀 등록</a>
	</div>
	<br/>
	<table class="table table-condense">
		<thead>
			<tr>
				<th>카테고리</th>
				<th>제목</th>
				<th>본문 말씀 구절</th>
				<th>암송 말씀 구절</th>
				<th>예배일자</th>
				<th>작업</th>
			</tr>
		</thead>
		<tbody>
			<?if($worshipCount==0){?>
			<tr>
				<td colspan="4" align="center">현재 말씀이 존재하지 않습니다.</td>
			</tr>
			<?}else{?>
				<?foreach($worships as $row){?>
				<tr>
					<td><?echo $row["category"];?></td>
					<td><a href="${cp}/worship/view.do?id=${worship.id}"><?echo $row["title"];?></a></td>
					<td><?echo $row["bible_index"];?></td>
					<td><?echo $row["recitation_bible_index"];?></td>
					<td><?echo $row["worship_date"];?></td>
					<td>
						<a href="${cp}/worship/admin/update.do?id=${worship.id}"><i class="glyphicon glyphicon-edit"></i></a>
						<a href="javascript:deleteWorship('${worship.id}');"><i class="glyphicon glyphicon-trash"></i></a>
					</td>
				</tr>
				<?}?>
			<?}?>
		</tbody>	
	</table>
</div>

<?$db = null;?>
<!-- 하단 주소 -->
<?include("./include/common_footer.php")?>
</body>
</html>
