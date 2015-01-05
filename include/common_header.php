<!-- include/common_include.jsp start -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Meslap: Message For Love And Peace</title>
<meta name="viewport" content="width=device-width">
<!--
<link rel="shortcut icon" href="http://meslap.com/image/meslap_img.ico"/>
-->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="./frameworks/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="./frameworks/bootstrap/css/bootstrap-theme.min.css">

<link rel="stylesheet" href="./frameworks/bootstrap/css/datepicker3.css">
<link rel="stylesheet" href="./frameworks/fontawsome/css/font-awesome.min.css">
<link rel="stylesheet" href="./frameworks/jquery-magnific/magnific-popup.css">
<link rel="stylesheet" href="./frameworks/sweet-alert/sweet-alert.css">
<link rel="stylesheet" type="text/css" href="./css/default.css?v=1">
<!--[if lte IE 7]>
<link rel="stylesheet" type="text/css" href="${cp}/css/default_ie7.css" />
<![endif]-->

<!-- Latest compiled and minified JavaScript -->
<script src="./frameworks/jquery/jquery-1.11.2.min.js"></script>
<script src="./frameworks/bootstrap/js/bootstrap.min.js"></script>
<script src="./frameworks/bootstrap/js/bootstrap-datepicker.js"></script>
<script src="./frameworks/bootstrap/js/locales/bootstrap-datepicker.kr.js"></script>
<script src="./frameworks/jquery-magnific/jquery.magnific-popup.min.js"></script>
<script src="./frameworks/sweet-alert/sweet-alert.min.js"></script>
<!-- include/common_include.jsp end --> 
<style>
    .row{
        margin-right:0px;
    }
    th{
    	text-align:center
    }
</style>
<script>
$(document).ready(function(){
	console.log($(".input-group.date"));
	$(".input-group.date").datepicker({
	    format: "yyyy-mm-dd",
	    language: "kr",
	    todayHighlight: true
	});	
});
</script>