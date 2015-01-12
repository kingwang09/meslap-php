<!DOCTYPE html>
<html lang="ko">
<head>
  <?include("./include/common_header.php")?>
  
</head>
<body>
<?include("./include/common_menu.php")?>

<?include("./include/db_connection.php")?>
<?
	$rId = $_GET["rId"];
	$cPage = $_GET["cPage"];
	
	if($cPage==null)
		$cPage = 1;
	
	//Worship Logic
	$db = new PDO($dsn, $user, $pass);

	$countSql = "SELECT COUNT(ID) AS cnt FROM CMM_WORSHIP";
	$countStmt = $db->prepare($countSql);
	$countStmt->execute();
	$countRow = $countStmt->fetch();
	$worshipCount = $countRow["cnt"];

	
	$sql =	"SELECT *
				FROM (SELECT c.*, 
					@rownum := @rownum + 1 AS rowId
					FROM cmm_worship c, (SELECT @rownum := 0) r
					order by worship_date desc
			)w";
	if($rId!=null){
		$sql = $sql." where rowId=".$rId;
	}else{
		$sql = $sql." limit 1";
	}


	$statement = $db->prepare($sql);
	$statement->execute();
	$row = $statement->fetch(PDO::FETCH_ASSOC);
	
	//print_r($row);
	//echo "test : ".$row["id"];
?>
<script>
	$(document).ready(function(){

		$("#juboBtn").magnificPopup({
				items:[
					{src:'./worship/jubo/<?echo $row["jubo_file_01"];?>'},
					{src:'./worship/jubo/<?echo $row["jubo_file_02"];?>'},
					{src:'./worship/jubo/<?echo $row["jubo_file_03"];?>'}
				],
				gallery:{
					enabled:true
				},
				type:'image'
		 });

	});
	function viewPage(rId){
		if(rId<=0){
			swal("알림","현재 보시는 말씀이 최신 말씀입니다.","info");
		}else if(rId>=<?echo $worshipCount?>){
			swal("알림","현재 보시는 말씀이 처음 말씀입니다.","info");
		}else{
			var form = document.worshipForm;
			form.rId.value = rId;
			form.submit();	
		}
	}
  </script>
<br/>
<div class="subTitle">
	<img src="./images/worship/worship_submenu01.jpg" usemap="#worship_sub_map"/>
	<map name="worship_sub_map">
    	<area shape="rect" coords="0,56,61,76" href="worship_view.php" alt="말씀">
        <area shape="rect" coords="67,56,151,76" href="board_bible.php" alt="성경공부자료">
    </map>
</div>
<div class="line_1px"></div>
<div class="worship-content">
	<form id="worshipForm" name="worshipForm" action="worship_view.php">
		<input type="hidden" name="rId" value="<?echo $row["rowId"]?>" />
		<input type="hidden" name="cPage" value="<?echo $cPage?>" />
	</form>

	<div class="worship-body-left">
		<iframe width="100%" height="360" src="//www.youtube.com/embed/<?echo $row["youtube_url"]?>?feature=player_detailpage&wmode=opaque" frameborder="0" allowfullscreen></iframe>
		
	</div>
	<div class="worship-body-right">
		<a href="javascript:viewPage('<?echo $row["rowId"]+1;?>');" style="padding-right:30px"><img src="./images/worship/left.jpg" /></a>
		<a href="javascript:viewPage('<?echo $row["rowId"]-1;?>');"><img src="./images/worship/right.jpg" /></a>
		<div style="padding-top:34px">
			<div class="h4"><b><?echo str_replace("\n","<br/>",$row["title"]);?></b></div> <!-- Title 말씀제목 -->
			<div class="h5"><b><?echo $row["bible_index"]?></b></div> <!-- sub 말씀구절 -->
			<small><?echo date('Y-m-d', strtotime($row["worship_date"]))?></small>     <!-- 날짜 -->
		</div>
		<div style="padding-top:25px">
			<div class="h5" style="width:95px;background-color:#5a7296;color:white;font-size:16px;height:20px">한주 암송구절</div>
            <p style="word-wrap: break-word;"><?echo $row["recitation_bible"]?></p>
            <?$row["recitation_bible_index"]?>
		</div>
		<div style="padding-top:25px">
			<!--
			<c:if test="${!empty worship.audioFileName}">
             <a href="${cp}/worship/download.do?fileName=${worship.audioFileName}"><img class="hoverImages" imgName="top_bt_audio" src="./images/main/top_bt_audio.jpg"/></a>
            </c:if>
            <c:if test="${!empty worship.textFileName}">
             <a href="${cp}/worship/download.do?fileName=${worship.textFileName}"><img class="hoverImages" imgName="top_bt_ebook" src="./images/main/top_bt_ebook.jpg"/></a>
            </c:if>
			-->
             <a href="#" id="juboBtn"><img class="hoverImages" imgName="top_bt_paper" src="./images/main/top_bt_paper.jpg" /></a>
         </div>
	</div>
  	
    <!-- 말씀 Row -->
    <div style="clear:both;padding-top:15px;padding-left:25px">
       <pre class="worship"><?echo $row["bible"]?></pre>
    </div>
    
    <br/>
</div>
<!-- iFrame start -->
<div class="ie7-wrapper">
<iframe src="./worship_inside_view.php?cPage=<?echo $cPage?>" width="100%" height="780px" frameborder="no"></iframe>
</div>

<!-- iFrame start-->
<? $db = null; ?>
<!-- 하단 주소 -->
<?include("./include/common_footer.php")?>
</body>
</html>