<?php
include 'connect.php';
include './partials/menu.php';
class inc_exp extends connect
{
	public $iamt=0;
	public $idesc="";
	public $eamt=0;
	public $edesc="";
	public $bal=0;
	public function inc_exp()
	{
		parent::connect();
	}
	public function save()
	{
		$this->iamt=$_POST["tiamt"];
		$this->eamt=$_POST["teamt"];
		$this->bal=$this->iamt-$this->eamt;
		if($this->db_handle)
		{
			$dt=$_POST["tdate"];
			$mm=substr($dt,5,2);
			$dd=substr($dt,8,2);
			$sql="insert into inc_exp(month,date,iamt,idesc,eamt,edesc,bal) values('$mm','$dd',$this->iamt,'$_POST[tidesc]',$this->eamt,'$_POST[tedesc]',$this->bal)";
			mysqli_query($this->db_handle,$sql);
			echo "RECORD SAVED";
		}
	}
}
$ob=new inc_exp();
if(isset($_REQUEST["bsave"]))
$ob->save();
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>INCOME EXPENSE</title>
	<style>
		header{
			margin-top:0px;
		}
	</style>
</head>
<body>
	<center style="margin:20px 0">
	<table>
	<form name=f method="POST" action="income_expense.php">
	<tr><td><input type="date" name="tdate"></td></tr>
	<tr>
	<td colspan=2><label for="income">INCOME</label></td>
	<td colspan=2><label for="income">EXPENSE</label></td>
	</tr>
	<tr>
	<td><input type="number" onkeypress="return only_num(event)" name="tiamt"/></td>
	<td><input type="text" name="tidesc"/></td>
	<td><input type="number" onkeypress="return only_num(event)" name="teamt"/></td>
	<td><input type="text" name="tedesc"/></td>
	</tr>
	<tr>
	<td><input type="submit" name="bsave" value="SAVE"></td>
	</tr>
	</form>
	</table>
	</center>
</body>
<script>
        function only_num(e)
        {
            if(e.which==46)
                return false;
        }
    </script>
</html>