<!DOCTYPE html>
<html lang="ko">
<head>
  <?include("./include/common_header.php")?>
  <script>
  function popupMobileAudio(){
	  //window.open('${cp}/sermon.htm', 'audio', 'height=600px,width=385px');
	  alert("아직 준비중입니다. ^^");
  }
  function popupNotice(url){
	
		window.open(url, 'notice', 'height=400px,width=655px');
  }
  </script>
</head>
<body>

<?include("./include/common_menu.php")?>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
 <!-- Indicators -->
 <ol class="carousel-indicators">
     <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
     <!--<li data-target="#carousel-example-generic" data-slide-to="1"></li>-->
 </ol>

 <!-- Wrapper for slides -->
 <div class="carousel-inner">
     <div class="item active">
     	 <div style="width:100%;text-align:center">
			<a href="javascript:popupNotice('http://kingwang09.cafe24.com/xe/notice/111');">
         	<img src="./images/main/20150322_main_banner.jpg" alt="...">
			</a>
         </div>
         <div class="carousel-caption">

         </div>
     </div>
    <!--
     <div class="item">
         <div style="width:100%;text-align:center">
         	<img src="./images/main/banner_20150111.jpg" alt="..." >
         </div>
         <div class="carousel-caption">
         </div>
     </div>
	-->
 </div>

 <!-- Controls
 <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
     <span class="glyphicon glyphicon-chevron-left"></span>
 </a>
 <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
     <span class="glyphicon glyphicon-chevron-right"></span>
 </a>
 -->
</div>

<div class="main-banner">
 <!-- 메인 배너 하단 메뉴 - 1st --> 
 	<ul class="init-ul">
 		<li class="init-li">
 			<a href="about_intro.php" style="padding-right:10px">
				<img src="./images/body_menu_about_meslap.gif" alt="AboutMeslap" />
			</a>
 		</li>
 		<li class="init-li">
 			<a href="worship_view.php" style="padding-right:10px">
	            <img src="./images/body_menu_worship.gif" alt="Worship" />
	        </a>
 		</li>
 		<li class="init-li">
 			<a href="mission_intro.php" style="padding-right:10px">
	            <img src="./images/body_menu_mission.gif" alt="Mission" />
	        </a>
 		</li>
 		<li class="init-li">
 			<a href="board_notice.php">
	            <img src="./images/body_menu_news.gif" alt="News" />
	        </a>
 		</li>
 	</ul>
</div>
<?include("./include/db_connection.php")?>
<?
	$db = new PDO($dsn, $user, $pass);

	$sql = "SELECT * FROM cmm_worship order by worship_date desc limit 1";
	$statement = $db->prepare($sql);
	$statement->execute();
	$row = $statement->fetch(PDO::FETCH_ASSOC);
?>
<div class="sub-banner">
	<div class="sub-banner-body">
		<div class="sub-banner-body-left">
			<!-- Weekly Bible : 매주 암송말씀 
			<img src="./worship/main/20150111_main_bible.jpg" alt="WeeklyBible" style="float:left;padding-right:10px"/>
			-->
			<img src="./worship/main/<?echo $row["main_bible_image"]?>" alt="WeeklyBible" style="float:left;padding-right:10px"/>
			<!--
	        <img src="${cp}/worshipFiles/${recentWorship.mainBibleImageFileName}" style="float:left;padding-right:10px"/>
			-->
	        
	        <a href="worship_view.php" class="block-products-list-item-icon" style="float:left;padding-bottom:10px">
	            <img src="./worship/main/<?echo $row["main_video_image"]?>" />
	        </a>
	        
	        <img src="./images/main/main_link.jpg" alt="Replay" usemap="#replay_map">
	        <map name="replay_map">
	            <area shape="rect" coords="14,46,158,94" href="http://www.youtube.com/channel/UCXUHra_EuT3T2vD8j3BDuJQ" alt="replay_movie">
	            <area shape="rect" coords="174,46,308,94" href="javascript:popupMobileAudio()" alt="replay_audio">
	            <area shape="rect" coords="322,46,476,94" href="http://www.cts.tv/progsm2/index.asp?PID=P264&DPID=46750&Order=" alt="cts_link">
	        </map>
		</div>
		<div class="sub-banner-body-right">
	       <a href="about_gospel.php"><img src="./images/good_news.jpg" alt="GoodNews" style="float:left;padding-right:10px"/></a>
	       
		   <a href="about_times.php"><img src="./images/worship_time_table.gif" alt="WorshipTimeTable" style="float:left;padding-bottom:10px"/></a>
	       
	       <a href="about_road.php" class="block-products-list-item-icon" style="float:left">
	           <img src="./images/location.gif" alt="Location" />
	       </a>
		</div>
	</div>
</div>
<?$db = null;?>
<!-- 하단 주소 -->
<?include("./include/common_footer.php")?>
</body>
</html>
