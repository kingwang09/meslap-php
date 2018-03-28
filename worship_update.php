<!DOCTYPE html>
<html lang="ko">
<head>
  <?include("./include/common_header.php")?>
  <script>
	function doSubmit(){
		var form = document.worshipForm;
		form.submit();
	}
  </script>
</head>
<body>
<?include("./include/common_menu.php")?>
<?include("./include/db_connection.php")?>
<?
	$id = $_GET["id"];
	//Worship Logic
	$db = new PDO($dsn, $user, $pass);

	$sql = "SELECT * FROM cmm_worship WHERE ID=:id";
	$statement = $db->prepare($sql);
	$statement->execute(array('id'=>$id));
	$row = $statement->fetch(PDO::FETCH_ASSOC);
?>
<br/>
<div class="content">
	<form action="worship_update_logic.php" id="worshipForm" name="worshipForm" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
		<input type="hidden" name="id" value="<?echo $id;?>" />
		<div class="gray-border">
			<h5 class="h4"><i class=""></i> <b>메인 화면 이미지</b></h5>
			<div class="form-group">
				<label for="mainBibleImage" class="col-sm-2 control-label">메인 암송 말씀 이미지</label>
				<div class="col-sm-10">
					<input type="file" name="mainBibleImage" id="mainBibleImage" class="form-control"/>
					<?echo $row["main_bible_image"];?>
				</div>
			</div>
			<div class="form-group">
				<label for="mainVideoImage" class="col-sm-2 control-label">말씀 동영상 링크 이미지</label>
				<div class="col-sm-10">
					<input type="file" name="mainVideoImage" id="mainVideoImage" class="form-control"/>
					<?echo $row["main_video_image"];?>
				</div>
			</div>
		</div>
		<br/>
		
		<div class="gray-border">
			<div class="h4"><i class=""></i> <b>말씀 목록</b></div>
			<div class="form-group">
				<label for="category" class="col-sm-2 control-label">분류</label>
				<div class="col-sm-10">
					<!-- 기존 등록된 카테고리 Distinct 목록 -->
					<select class="form-control">
						<!--php DB Loading-->
					</select>
					<input type="text" name="category" class="form-control" value="<?echo $row["category"];?>"/>
				</div>
			</div>
			<div class="form-group">
				<label for="title" class="col-sm-2 control-label">제목</label>
				<div class="col-sm-10">
					<textarea name="title" id="title" class="form-control" style="width:100%;height:50px"><?echo $row["title"];?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="bibleIndex" class="col-sm-2 control-label">본문 말씀 구절</label>
				<div class="col-sm-10">
					<textarea name="bibleIndex" id="bibleIndex" class="form-control" style="width:100%;height:50px"><?echo $row["bible_index"];?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="bible" class="col-sm-2 control-label">본문 말씀</label>
				<div class="col-sm-10">
					<textarea name="bible" id="bible" class="form-control" style="width:100%;height:150px"><?echo $row["bible"];?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="recitationBibleIndex" class="col-sm-2 control-label">암송 말씀 구절</label>
				<div class="col-sm-10">
					<textarea name="recitationBibleIndex" id="recitationBibleIndex" class="form-control" style="width:100%;height:50px"><?echo $row["recitation_bible_index"];?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="recitationBible" class="col-sm-2 control-label">암송 말씀</label>
				<div class="col-sm-10">
					<textarea name="recitationBible" id="recitationBible" class="form-control" style="width:100%;height:150px"><?echo $row["recitation_bible"];?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="youtubeUrl" class="col-sm-2 control-label">말씀 유투브 URL</label>
				<div class="col-sm-10">
					<input type="text" name="youtubeUrl" id="youtubeUrl" class="form-control" value="<?echo $row["youtube_url"];?>"/>
				</div>
			</div>
			<div class="form-group">
				<label for="worshipUrl" class="col-sm-2 control-label">찬양 유투브 URL</label>
				<div class="col-sm-10">
					<input type="text" name="worshipUrl" id="worshipUrl" class="form-control"/>
				</div>
			</div>
			<div class="form-group">
				<label for="soundCloudUrl" class="col-sm-2 control-label">사운드클라우드 URL</label>
				<div class="col-sm-10">
					<input type="text" name="soundCloudUrl" id="soundCloudUrl" class="form-control" value="<?echo $row["soundcloud_url"];?>"/>
				</div>
			</div>
			<div class="form-group">
				<label for="videoImage" class="col-sm-2 control-label">동영상 이미지</label>
				<div class="col-sm-10">
					<input type="file" name="videoImage" id="videoImage" class="form-control"/>
					<?echo $row["video_image"];?>
				</div>
			</div>
		</div>
		<br/>
		
		<div style="border:1px solid #e7e7e7">
			<div class="h4"><i class=""></i> <b>말씀 첨부파일</b></div>
			<!--
			<div class="form-group">
				<label for="videoImage" class="col-sm-2 control-label">말씀 오디오 파일</label>
				<div class="col-sm-10">
					<input type="file" name="audioFile" class="form-control"/>
				</div>
			</div>
			-->
			<div class="form-group">
				<label for="textFile" class="col-sm-2 control-label">말씀 텍스트 파일</label>
				<div class="col-sm-10">
					<input type="file" name="textFile" id="textFile" class="form-control"/>
					<?echo $row["text_file"];?>
				</div>
			</div>
			<div class="form-group">
				<label for="videoImage" class="col-sm-2 control-label">주보 파일</label>
				<div class="col-sm-10">
					<input type="file" name="juboFile01" id="juboFile01" class="form-control"/><br/>
					<input type="file" name="juboFile02" id="juboFile02" class="form-control"/><br/>
					<input type="file" name="juboFile03" id="juboFile03" class="form-control"/><br/>
					<?echo $row["jubo_file_01"];?> , <?echo $row["jubo_file_02"];?>, <?echo $row["jubo_file_03"];?>
				</div>
			</div>
			<div class="form-group">
				<label for="videoImage" class="col-sm-2 control-label">등록날짜</label>
				<div class="col-sm-10">
					<div class="input-group date">
					  <input type="text" name="worshipDate" class="form-control" value="<?echo date('Y-m-d',strtotime($row["worship_date"]));?>"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
					</div>
				</div>
			</div>
		</div>
		<div style="text-algin:center">
			<a href="javascript:doSubmit();" class="btn btn-default btn-xs">
				<i class="fa fa-floppy-o"></i> 등록 완료
			</a>
			&nbsp;
			<!-- 
			<input type="button" value="미리보기" class="btn btn-default btn-xs" />
			&nbsp;
			 -->
			<a href="worship_list.php" class="btn btn-default btn-xs">
				<i class="fa fa-th-list"></i> 목록으로
			</a>
		</div>
	</form>
</div>
<!-- 하단 주소 -->
<?include("./include/common_footer.php")?>
</body>
</html>
