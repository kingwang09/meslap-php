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
	<img src="./images/news/news_submenu01.jpg" usemap="#news_sub_map"/>
</div>
<div class="line_1px"></div>
<div class="content" style="height:650px">
	<iframe src="http://localhost/xe/notice" width="100%" height="600px" frameborder="no"/>
</div>
<!-- 하단 주소 -->
<?include("./include/common_footer.php")?>
</body>
</html>