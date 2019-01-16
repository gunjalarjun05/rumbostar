<?php

$serverhost="exceptionaire.co";
$username="etpl2012_rumbo";
$password="v7ST5w{1@Kkc";

$conn=mysql_connect($serverhost,$username,$password);

$db=mysql_select_db("etpl2012_rumbostar");

if($db)
{
  echo "connection sucessfully";	
}
else
{
	echo "please try again";
}
?>