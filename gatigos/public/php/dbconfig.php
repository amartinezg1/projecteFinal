<?php
class DBConnection{
	function getConnection(){
	  //change to your database server/user name/password
		//mysql_connect("localhost","root","") or
	$db = mysqli_connect('localhost', 'root', '', 'gatigos');

         die("Could not connect: " . mysqli_error($db));	
	}
}
?>
