<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>404 Page Not Found</title>
<style type="text/css">

::selection { background-color: #E13300; color: white; }
::-moz-selection { background-color: #E13300; color: white; }

html{
	position: relative;
	height: 100%;
}

body { 
	min-height: 100%;
	background-color: #fff; 
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #4F5155;
	display: flex;
	align-items: center;
	justify-content: center;
}

a {
	color: #003399;
	background-color: transparent;
	font-weight: normal;
}

h1 {
	display: block;
	width: 100%;
	color: #444;
	background-color: transparent; 
	font-size: 19px;
	font-weight: normal;
	margin: 0 0 0px 0;
	padding: 14px 15px 0px 15px;
}

code {
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
	font-size: 12px;
	background-color: #f9f9f9; 
	color: #002166;
	display: block;
	margin: 14px 0 14px 0;
	padding: 12px 10px 12px 10px;
}

#container {
	height: 100%;
	flex-wrap: wrap;
	text-align: center;
	margin: 10px;  
}

p {
	display: block;
	width: 100%;
	margin: 12px 15px 12px 15px;
}
</style>
</head>
<body>
	<div id="container">
		<h1><?php echo $heading; ?></h1>
		<?php echo $message; ?>
	</div>
</body>
</html>