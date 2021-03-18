<?php
include 'connect.php';
include './partials/menu.php';
class enquiry extends connect
{
	public $slno="";
	public function enquiry()
	{
		parent::connect();
	}
	
	public function delete()
	{
		$sql="delete from enquiry where slno=$_POST[tslno]";
		mysqli_query($this->db_handle,$sql);
		echo '<script>alert("Record Deleted")</script>';
	}
}
$ob=new enquiry();
if(isset($_REQUEST["bdelete"]))
$ob->delete();
?>

<html>
<head>
<title>EnquiryForm</title>
<style>
	header{
		margin-top:0;
	}
</style>
</head>
<body>
	<center>
	<form name=f method="POST" action="enquiry_delete.php">
	<table>
	<tr>
	<td>Serial Number</td>
	<td><input type="text" name="tslno"/></td>
	</tr>
	<tr>
	<td><input type="submit" name="bdelete" value="Delete"></td>
	</tr>
	</table>
	</form>
	</center>
</body>
</html>
