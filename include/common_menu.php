<script>
function newPopup(){
	window.open('http://wowccm.net/player/autoplayer10.htm', 'music', 'height=200,width=150');
}
$(document).ready(function(){
	var changeImage = function(obj, hover){
		var imgName = $(obj).attr("imgName");
		var ext = $(obj).attr("ext");//확장자
		ext = ext ? ext : "jpg";
		imgName = hover? imgName+"_hover." : imgName+".";
		
		var imgFullName = "./images/main/"+imgName+ext;
		$(obj).attr("src",imgFullName);
	};
	
	$(".hoverImages").hover(
			function(){
				changeImage(this, true);
			},
			function(){
				changeImage(this, false);
			}
	);
	
	$(".mainMenu").mouseenter(function(){
		var left = $(this).position().left;
		var menuId = $(this).attr("menuId");
		var standardPosition = $("#stanardPosition").position();
		$(".main-dropdown").css({"visibility":"hidden"});
		$("#"+menuId).css({"left":standardPosition.left,"visibility":"visible"});
	});
	
	
	$(".main-dropdown").mouseleave(function(){
		$(".main-dropdown").css({"visibility":"hidden"});
	});
	
	$("body").click(function(){
		$(".main-dropdown").css({"visibility":"hidden"});
	});
});
</script>
<!-- 상단 메인 메뉴 -->
<!-- Meslap Logo -->
<div class="wrapper">
	<div class="site-navigation-item">
	    <a href="index.php"><img src="./images/main/logo.jpg" alt="Meslap Logo" /></a>
	</div>
	<!-- About Meslap -->
	<div class="site-navigation-item site-navigation-about-meslap" style="padding-left:60px">
	    <span id="stanardPosition" class="site-navigation-about-meslap">
	        <a href="about_intro.php"><img class="mainMenu hoverImages" src="./images/main/main_menu_about_meslap.jpg" imgName="main_menu_about_meslap" alt="AboutMeslap" menuId="aboutMenu" /></a>
	    </span>
	    <div class="main-dropdown site-navigation-dropdown-about-meslap" id="aboutMenu">            
	        <img src="./images/main/roll_about_meslap.jpg" usemap="#about_map"/>
	        <map name="about_map">
	        	<area shape="rect" coords="187,125,225,154" href="about_gospel.php" alt="말씀">
	            <area shape="rect" coords="232,125,290,154" href="about_intro.php" alt="교회소개">
	            <area shape="rect" coords="297,125,354,154" href="about_members.php" alt="교인등록">
	            <area shape="rect" coords="361,125,419,154" href="about_times.php" alt="예배시간">
	            <area shape="rect" coords="427,125,492,154" href="about_road.php" alt="오시는길">
	        </map>
	    </div>
	</div>
	<!-- Worship -->
	<div class="site-navigation-item site-navigation-worship-meslap">
	    <span class="site-navigation-worship-meslap">
	        <a href="worship_view.php"><img class="mainMenu hoverImages" src="./images/main/main_menu_worship_meslap.jpg" imgName="main_menu_worship_meslap" alt="WorshipMeslap" menuId="worshipMenu"/></a>
	    </span>
	    <div class="main-dropdown site-navigation-dropdown-worship-meslap" id="worshipMenu">            
	        <img src="./images/main/roll_worship_meslap.jpg" usemap="#worship_map"/>
	        <map name="worship_map">
	            <area shape="rect" coords="186,124,251,154" href="worship_view.php" alt="replay_movie">
	            <area shape="rect" coords="259,124,347,154" href="board_bible.php" alt="replay_audio">
	        </map>
	    </div>
	</div>
	<!-- Mission -->
	<div class="site-navigation-item site-navigation-mission-meslap">
	    <span class="site-navigation-mission-meslap">
	        <a href="mission_intro.php"><img class="mainMenu hoverImages" src="./images/main/main_menu_mission_meslap.jpg" imgName="main_menu_mission_meslap" alt="MissionMeslap" menuId="missionMenu" /></a>
	    </span>
	    <div class="main-dropdown site-navigation-dropdown-mission-meslap" id="missionMenu">            
	        <img src="./images/main/roll_mission_meslap.jpg" usemap="#mission_map"/>
	        <map name="mission_map">
	            <area shape="rect" coords="186,145,263,174" href="mission_intro.php" alt="replay_movie">
	            <area shape="rect" coords="269,145,319,174" href="mission_gallery.php" alt="replay_audio">
	        </map>
	    </div>
	</div>
	<!-- News -->
	<div class="site-navigation-item site-navigation-news-meslap" style="padding-right:30px">
	    <span class="site-navigation-news-meslap">
	        <a href="board_notice.php"><img class="mainMenu hoverImages" src="./images/main/main_menu_news_meslap.jpg" imgName="main_menu_news_meslap" alt="NewsMeslap" menuId="newsMenu" /></a>
	    </span>
	    <div class="main-dropdown site-navigation-dropdown-news-meslap" id="newsMenu">            
	        <img src="./images/main/roll_news_meslap.jpg" usemap="#news_map"/>
	        <map name="news_map">
	            <area shape="rect" coords="186,124,252,154" href="board_notice.php" alt="replay_movie">
	        </map>
	    </div>
	</div>
	<!-- e-mail 
	<div class="site-navigation-item site-navigation-email">
	</div>
	-->
	<a href="mailto:meslaphelper@naver.com"><img class="hoverImages" src="./images/main/mail.jpg" imgName="mail" ext="jpg" style="padding-right:13px"/></a>
	<a href="https://www.facebook.com/meslap3" target="_new"><img class="hoverImages" src="./images/main/facebook.jpg" imgName="facebook" ext="jpg" style="padding-right:13px"/></a>
	<!-- kakao music 
	<div class="site-navigation-item site-navigation-kakaomusic">
	
	http://wowccm.net/wow_winme/play01.html
	</div>
	-->
	<a href="javascript:newPopup();"><img class="hoverImages" src="./images/main/kakao.jpg" imgName="kakao" ext="jpg" /></a>
	&nbsp;
	
</div>
<hr class="separator_top" >