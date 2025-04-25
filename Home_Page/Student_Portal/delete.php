<?php
if(isset($_GET["id"]))
{
	$BID=$_GET["id"];
    $db=new mysqli("localhost","gsvproject","gsvpsg123@123","pro1",3308);
{
	echo('Connection error' .mysqli_connect_error());
}
$sql="DELETE FROM udocuments WHERE BID=$BID";
$res=$db->query($sql);
if ($res)
{
	header('location:view_documents.php');
}
else
  {
    echo"<p class='error'>Failed to Delete Documents</p>";
  }
}
?>