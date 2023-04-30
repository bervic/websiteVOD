<?php
header( 'content-type: text/html; charset=utf-8' );
if(empty($_SESSION['username']))
{
	header("Location: index.php?id=".$_SESSION['id']);
	die("Redirecting to index.php");
}
?>