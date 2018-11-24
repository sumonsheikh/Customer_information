<?php
include('config.php');
$user="CREATE TABLE user(
uid INT(10) NOT NULL AUTO_INCREMENT,
userName VARCHAR(100) NOT NULL,
email VARCHAR(100) NOT NULL,
password VARCHAR(100) NOT NULL,
PRIMARY KEY(uid))";

$customer_info="CREATE TABLE customer_info(
cid INT(10) NOT NULL AUTO_INCREMENT,
customerName VARCHAR(100) NOT NULL,
email VARCHAR(100) NOT NULL,
address VARCHAR(100) NOT NULL,
phone VARCHAR(100) NOT NULL,
PRIMARY KEY(cid))";
$result=mysqli_query($myconn,$user);
if($result===TRUE)
{
	echo"User info table created";
}
else
{
		echo"User info table not created";

}

$result2=mysqli_query($myconn,$customer_info);
if($result2===TRUE)
{
	echo"Customer Information  table created";
}
else
{
		echo"Customer Information table not created";

}

?>