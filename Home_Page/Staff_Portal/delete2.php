<?php
if(isset($_GET["id"]))
{
	$AID=$_GET["id"];
    $db=new mysqli("localhost","gsvproject","gsvpsg123@123","pro1",3308);
{
	echo('Connection error' .mysqli_connect_error());
}
$sql="DELETE FROM announcement WHERE AID=$AID";
$res=$db->query($sql);
if ($res)
{
	header('location:sview_Announcement.php');
}
else
  {
    echo"<p class='error'>Failed to Delete Documents</p>";
  }
}
?>