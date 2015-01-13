<!DOCTYPE html>
<html lang="ko">
<head>
  <?include("./include/common_header.php")?>
  <script>
  function popupMobileAudio(){
	  window.open('${cp}/sermon.htm', 'audio', 'height=600px,width=385px');
  }
  </script>
</head>
<body>

<?include("./include/common_menu.php")?>
<div class="subTitle">
	<img src="./images/worship/worship_submenu02.jpg" usemap="#worship_sub_map"/>
	<map name="worship_sub_map">
    	<area shape="rect" coords="0,56,61,76" href="worship_view.php" alt="말씀">
        <area shape="rect" coords="67,56,151,76" href="board_bible.php" alt="성경공부자료">    
    </map>
</div>
<div class="line_1px"></div>
<div class="content" style="height:650px">
	<div>
		<img src="./images/copyright.jpg" />
	</div>
	<iframe src="http://kingwang09.cafe24.com/xe/bible" width="100%" height="600px" frameborder="no"/>
</div>
<!-- 하단 주소 -->
<?include("./include/common_footer.php")?>
</body>
</html>