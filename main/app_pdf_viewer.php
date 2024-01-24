<?php
	include_once("./common/common.php");

	$file_title = $_GET['file']; 
	$file_path = '/main/download';
	$file_path = '.'.urldecode($file_path)."/{$file_title}";

	header('Content-type: application/pdf');
	header('Content-Disposition: inline; filename="{$file_title}"');
	header('Content-Transfer-Encoding: binary');
	header('Content-Length: '.filesize($file_path));
	header('Accept-Ranges: bytes');

	readfile($file_path);
?>