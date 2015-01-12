<!DOCTYPE html>
<html lang="ko">
<head>
  <?include("./include/common_header.php")?>
</head>
<body>
<?include("./include/db_connection.php")?>
<?
	$cPage = $_GET["cPage"];
	
	if($cPage == null)
	 $cPage = 1;
	$rowPerPage = 5;	//Row 개수
	$pagePerPage = 5;	//페이징 개수
	$rowIndex = ($cPage-1)*$rowPerPage;	//Row Index
	
	//Worship Logic
	$db = new PDO($dsn, $user, $pass);
	
	$countSql = "SELECT COUNT(ID) AS cnt FROM CMM_WORSHIP";
	$countStmt = $db->prepare($countSql);
	$countStmt->execute();
	$countRow = $countStmt->fetch();
	$worshipCount = $countRow["cnt"];
	$totalPage = ceil($worshipCount/$rowPerPage);	//총 페이지개수
	
	$pageEnd = ($cPage+$pagePerPage);
	if($pageEnd>$totalPage){
		$pageEnd = $totalPage;
	}
	
	//echo "worshipCount : ".$worshipCount."<br/>";
	//echo "pageEnd : ".$pageEnd."<br/>";
	//echo "totalPage : ".$totalPage."<br/>";

	$sql =	"SELECT *
				FROM (SELECT c.*, 
					@rownum := @rownum + 1 AS rowId
					FROM cmm_worship c, (SELECT @rownum := 0) r
					order by worship_date desc
			)w limit ".$rowIndex.", 5";
	$statement = $db->prepare($sql);
	$statement->execute();
	$worships = $statement->fetchAll(PDO::FETCH_ASSOC);
	//echo "test : ".$row["id"];
?>

<script>
function viewPage(rid){
	var form = parent.document.worshipForm;
	form.cPage.value = "<?echo $cPage?>";
	form.rId.value = rid;
	form.submit();
}
</script>
<!-- iFrame start-->
<div class="worship-content" style="padding-left:25px">
    <div class="row">
    	<div class="col-md-12">
	    	<div class="pull-right">
	            <select class="form-control">
	                <option>주제별 설교보기</option>
	                <!--
					<c:forEach var="category" items="${categorys}">
	                	<option value="${category }">${category }</option>
	                </c:forEach>
					-->
	            </select>
	        </div>
        </div>
    </div>
    <?foreach($worships as $row){?>
    	<div class="media" style="border:1px solid #e7e7e7">
	         <a class="pull-left" href="#">
	         	
				<?if($row["video_image"]==null){?>
	             <img class="media-object" src="./images/worship/default_video.jpg" />
	         	<?}else{?>
	         	
	         		<img class="media-object" src="./worship/video/<?echo $row["video_image"];?>" />
	         	
				<?}?>
	         </a>
	         <div class="media-body" style="padding-left:25px;padding-top:25px">
	             <div class="h5 media-heading"><b><a href="javascript:viewPage('<?echo $row["rowId"];?>')"><?echo $row["title"];?></a></b>
	             	<!-- <span class="label label-default">New</span>  -->
	             </div>
	             <div style="word-break: break-all">
	                 <?echo $row["bible_index"];?> <br/><small><?echo $row["worship_date"];?></small>
	                 <div class="pull-right" style="padding-right:15px">
	                 	 <c:if test="${!empty w.audioFileName}">
	                     	<span><a href="${cp}/worship/download.do?fileName=${w.audioFileName}"><img class="hoverImages" imgName="bt_audio" src="${cp}/images/main/bt_audio.jpg"/></a></span>
	                     </c:if>
	                     <c:if test="${!empty w.textFileName}">
	                     	<span><a href="${cp}/worship/download.do?fileName=${w.textFileName}"><img class="hoverImages" imgName="bt_ebook" src="${cp}/images/main/bt_ebook.jpg"/></a></span>
	                     </c:if>
	                 </div>
	             </div>
	         </div>
	     </div>
    <?}?>
	<div style="text-align:center">
		<ul class='pagination'>
		<li><a href="worship_inside_view.php?cPage=1">첫페이지</a></li>
		<?
			if(($cPage-1) < 0){
		?>
			<li class="disabled"><a href="#">&laquo;</a></li>
		<?
			}else{
		?>
			<li><a href="worship_inside_view.php?cPage=<?echo $cPage-1?>">&laquo;</a></li>
		<?
			}
		?>
		
		<?for($page=$cPage;$page<=$pageEnd;$page++){?>
			<li class="<?if($page==$cPage){?>active<?}?>"><a href="worship_inside_view.php?cPage=<?echo $page?>"><?echo $page?></a></li>
		<?}?>

		<?
			if(($cPage+1) > $totalPage){
		?>
			<li class="disabled"><a href="#">&raquo;</a></li>
		<?
			}else{
		?>
			<li><a href="worship_inside_view.php?cPage=<?echo $cPage+1?>">&raquo;</a></li>
		<?
			}
		?>
		<li><a href="worship_inside_view.php?cPage=<?echo $totalPage?>">마지막</a></li>
		</ul>
	</div>
</div>
<? $db = null;?>
</body>
</html>