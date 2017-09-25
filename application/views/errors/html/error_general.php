<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>General Error</title>

<style type="text/css">
.errmsg {
	position:absolute;
   	width:70%;
	left:50%;
    top:50%;
    margin-top:-160px;
	margin-left:-20%;
}
.errmsg_img {
	float:left;
	margin-right:100px;
}
.errmsg_txt {
	margin-top:150px;
	display:block;
	height:150px;
}
@media screen and (max-width: 480px) {
	.errmsg, .errmsg_img, .errmsg_txt {
		float: none;
		width: auto;
		left:0;
		margin-left:5%;
	}
}
</style>
</head>

<body>
<div class="errmsg">
	<img src="/wp-content/themes/fuseki/imgs/strongoops.jpg" width="400" height="309" class="errmsg_img">
	<div class="errmsg_txt">
		<h1>General Error by CodeIgniter</h1>
	</div>
</div>

</body>
</html>
