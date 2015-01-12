<!DOCTYPE html>
<html lang="ko">
<head>
  <?include("./include/common_header.php")?>
</head>
<body>
<?include("./include/common_menu.php")?>
<br/>
<?include("./include/db_connection.php")?>
<?
	$cPage = $_GET["cPage"];
	
	if($cPage == null)
	 $cPage = 1;

	$rowPerPage = 15;
	$rowIndex = ($cPage-1)*$rowPerPage;	//Row Index

	try{
		$db = new PDO($dsn, $user, $pass);
	}catch(Exception $error){
		die("Connection fail : ".$error->getMessage());
	}
	
	$countSql = "SELECT COUNT(ID) AS cnt FROM CMM_WORSHIP";
	$countStmt = $db->prepare($countSql);
	$countStmt->execute();
	$countRow = $countStmt->fetch();
	$worshipCount = $countRow["cnt"];
	$totalPage = ceil($worshipCount/$rowPerPage);	//총 페이지개수


	$sql =	"SELECT *
				FROM (SELECT c.*, 
					@rownum := @rownum + 1 AS rowId
					FROM cmm_worship c, (SELECT @rownum := 0) r
					order by worship_date desc
			)w limit ".$rowIndex.",".$rowPerPage;

	$statement = $db->prepare($sql);
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
				<th>ID</th>
				<th>RID</th>
				<th>제목</th>
				<th>예배일자</th>

				<th>유투브</th>
				<th>주보</th>
				<th>텍스트</th>
				<th>오디오</th>

				<th>작업</th>
			</tr>
		</thead>
		<tbody>
			<?if($worshipCount==0){?>
			<tr>
				<td colspan="7" align="center">현재 말씀이 존재하지 않습니다.</td>
			</tr>
			<?}else{?>
				<?foreach($worships as $row){?>
				<tr>
					<td><?echo $row["category"];?></td>
					<td width="10"><?echo $row["id"];?></td>
					<td width="10"><?echo $row["rowId"];?></td>
					<td width="300" align="left"><a href="${cp}/worship/view.do?id=${worship.id}"><?echo $row["title"];?></a></td>
					<td><?echo date('Y-m-d',strtotime($row["worship_date"]));?></td>

					<td>
						<?if($row["youtube_url"]!=null){?>
							<?echo "O";?>
						<?}else{?>
							<?echo "X";?>
						<?}?>
					</td>
					<td>
						<?if($row["jubo_file_01"]!=null){?>
							<?echo "O";?>
						<?}else{?>
							<?echo "X";?>
						<?}?>
					</td>
					<td>
						<?if($row["text_file"]!=null){?>
							<?echo "O";?>
						<?}else{?>
							<?echo "X";?>
						<?}?>
					</td>
					<td>
						<?if($row["soundcloud_url"]!=null){?>
							<?echo "O";?>
						<?}else{?>
							<?echo "X";?>
						<?}?>
					</td>


					<td>
						<a href="javascript:deleteWorship('${worship.id}');"><i class="glyphicon glyphicon-trash"></i></a>
					</td>
				</tr>
				<?}?>
			<?}?>
		</tbody>	
	</table>
	<div style="text-align:center">
		<ul class='pagination'>
		<li><a href="worship_list.php?cPage=1">첫페이지</a></li>
		<?
			if(($cPage-1) < 0){
		?>
			<li class="disabled"><a href="#">&laquo;</a></li>
		<?
			}else{
		?>
			<li><a href="worship_list.php?cPage=<?echo $cPage-1?>">&laquo;</a></li>
		<?
			}
		?>
		
		<?for($page=1;$page<=$totalPage;$page++){?>
			<li class="<?if($page==$cPage){?>active<?}?>"><a href="worship_list.php?cPage=<?echo $page?>"><?echo $page?></a></li>
		<?}?>

		<?
			if(($cPage+1) > $totalPage){
		?>
			<li class="disabled"><a href="#">&raquo;</a></li>
		<?
			}else{
		?>
			<li><a href="worship_list.php?cPage=<?echo $cPage+1?>">&raquo;</a></li>
		<?
			}
		?>
		<li><a href="worship_list.php?cPage=<?echo $totalPage?>">마지막</a></li>
		</ul>
	</div>
</div>

<?$db = null;?>
<!-- 하단 주소 -->
<?include("./include/common_footer.php")?>
</body>
</html>
