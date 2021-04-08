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
	$cCategory = $_GET["cCategory"];
	if($cPage==null){
		$cPage = 1;
	}

	$whereSql = "";
	$orderBySql = " order by id desc ";
	if($cCategory != null){
		$whereSql = $whereSql." where category='".$cCategory."' ";
		$orderBySql = " order by id asc ";
	}
	
	//Worship Logic
	$db = new PDO($dsn, $user, $pass);

	
	$countSql = "SELECT COUNT(ID) AS cnt FROM cmm_worship".$whereSql;
	$countStmt = $db->prepare($countSql);
	$countStmt->execute();
	$countRow = $countStmt->fetch(PDO::FETCH_ASSOC);
	$worshipCount = $countRow["cnt"];

	$sql =	"SELECT *
				FROM (SELECT c.*
					,@rownum := @rownum + 1 AS rowId
					,DATE_FORMAT( worship_date,  '%Y%m%d' ) AS jubo_name
					FROM cmm_worship c, (SELECT @rownum := 0) r "
					.$whereSql
					.$orderBySql.
			")w";
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
					{src:'./worship/jubo/<?echo $row["jubo_name"];?>_1.gif'},
					{src:'./worship/jubo/<?echo $row["jubo_name"];?>_2.gif'},
					{src:'./worship/jubo/<?echo $row["jubo_name"];?>_3.gif'}
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
		}else if(rId><?echo $worshipCount?>){
			swal("알림","현재 보시는 말씀이 처음 말씀입니다.","info");
		}else{
			var form = document.worshipForm;
			form.rId.value = rId;
			form.cCategory.value = "<?echo $cCategory?>";
			form.submit();	
		}
	}
  </script>
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
		<input type="hidden" name="cCategory" value="<?echo $cCategory?>" />
	</form>

	<div class="worship-body-left">
		<?
		if(empty($row["youtube_url"])){
		?>
			<img src="./images/empty_video.jpg" style="width:575px;height:360px"/>
		<?
		}else{
		?>
			<iframe width="100%" height="360" src="//www.youtube.com/embed/<?echo $row["youtube_url"]?>?feature=player_detailpage&wmode=opaque" frameborder="0" allowfullscreen></iframe>
		<?
		}
		?>
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
             <a href="#" id="juboBtn"><img class="hoverImages" imgName="top_bt_paper" src="./images/main/top_bt_paper.jpg" /></a>
         </div>
	</div>
  	
    <!-- 말씀 Row -->
    <div style="clear:both;padding-top:15px;padding-left:25px">
       <pre class="worship"><?echo $row["bible"]?></pre>
    </div>
	<?
	if(!empty($row["worship_url"])){
	?>
		<!-- 찬양 Row -->
		<br/>
		<div style="clear:both;padding-top:15px;padding-left:25px">
			<iframe width="575px" height="360" src="//www.youtube.com/embed/<?echo $row["worship_url"]?>?feature=player_detailpage&wmode=opaque" frameborder="0" allowfullscreen></iframe>
		</div>
	<?
	}
	?>
	
    <br/>
</div>
<!-- iFrame start -->
<div class="ie7-wrapper">
<iframe src="./worship_inside_view.php?cPage=<?echo $cPage?>&category=<?echo $cCategory?>" width="100%" height="780px" frameborder="no"></iframe>
</div>

<!-- iFrame start-->
<? $db = null; ?>
<!-- 하단 주소 -->
<?include("./include/common_footer.php")?>
</body>
</html>