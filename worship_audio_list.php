<!DOCTYPE html>
<html lang="ko">
<head>
  <?include("./include/common_header.php")?>
</head>
<body>
<?include("./include/db_connection.php")?>
<?
	$rowCount = 3;

	try{
		$db = new PDO($dsn, $user, $pass);
	}catch(Exception $error){
		die("Connection fail : ".$error->getMessage());
	}

	$sql =	"SELECT *
				FROM (SELECT c.*, 
					@rownum := @rownum + 1 AS rowId
					FROM cmm_worship c, (SELECT @rownum := 0) r
					order by worship_date desc
			)w limit 0,".$rowCount;

	$statement = $db->prepare($sql);
	$statement->execute();
	$worshipCount = $statement->rowCount();
	$worships = $statement->fetchAll();
?>
<div class="alert alert-info" role="alert">
  <a href="#" class="alert-link">호스팅 용량상 MP3 말씀 다운로드는 한달씩만 가능합니다.</a>
</div>
<h3>모바일용 설교듣기 <span class="label label-default">new</span></h3>
<br/>
<div class="row" style="margin:0">

<?foreach($worships as $row){?>
  <div class="col-sm-3 col-md-3">
    <div class="thumbnail">
      <img src="./worship/video/<?echo $row["video_image"];?>" alt="...">
      <div class="caption">
        <h4><?echo $row["title"];?></h4>
        <p><?echo $row["bible_index"];?></p>
		<small><?echo date('Y-m-d',strtotime($row["worship_date"]));?></small>
		<p>
		  <br/>
		  <a href="<?echo $row["soundcloud_url"];?>" TARGET="_blank" class="btn btn-primary" role="button">MP3다운로드</a>
		  
		</p>
      </div>
    </div>
  </div>
 <?}?>
 </div>

<?$db = null;?>
<!-- 하단 주소 -->
<?include("./include/common_footer.php")?>
</body>
</html>
