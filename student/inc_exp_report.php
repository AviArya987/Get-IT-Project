<?php
include 'connect.php';
include './partials/menu.php';
class inc_exp_rep extends connect
{
	public $totinc=0;
	public $totexp=0;
	public $bal=0;

	public function inc_exp_rep()
	{
		parent::connect();
	}
	public function report()
	{
		$tdt=$_POST["ttdt"];
		$tm=substr($tdt,5,2);
		$fdt=$_POST["tfdt"];
		$fm=substr($fdt,5,2);
		if($this->db_handle)
		{
			$sql="select * from inc_exp order by month";
			$r=mysqli_query($this->db_handle,$sql);
			echo "<center>";
			echo "<table cellpadding=4 cellspacing=8 border=0>";
			while($db_field=mysqli_fetch_assoc($r))
			{
				if($db_field['month']>=$fm && $db_field['month']<=$tm)
				{
					echo "<tr>";
					echo "<td colspan=4>".$db_field['month']."</td>";
                	echo "<td colspan=4>".$db_field['date']."</td>";
                	echo "<td colspan=4>".$db_field['iamt']."</td>";
                	echo "<td colspan=4>".$db_field['idesc']."</td>";
                	echo "<td colspan=4>".$db_field['eamt']."</td>";
                	echo "<td colspan=4>".$db_field['edesc']."</td>";
                	echo "<td colspan=4>".$db_field['bal']."</td>";
                	echo "<tr>";
					$this->totinc=$db_field['iamt']+$this->totinc;
					$this->totexp=$db_field['eamt']+$this->totexp;
				}
			}
			echo "<table>";
			echo "</center>";
			$this->bal=$this->totinc-$this->totexp;
			echo "Total income = ".$this->totinc;
			echo "Total expense = ".$this->totexp;
			echo "Balance = ".$this->bal;
		}
	}
}
$ob=new inc_exp_rep();
if(isset($_REQUEST["bsearch"]))
$ob->report();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		form{
			margin:10px 0;
		}
		td{
			margin:20px 90px;
			text-transform: uppercase;
		}
		input{
			margin:0 10px;
			text-transform: uppercase;
		}
		header{
			margin-top:0;
		}
	</style>
</head>
<body>
	<center>
	<form action="inc_exp_report.php" method="POST" name=f>
		<table>
		<tr>	
			<td>From<input type="date" name="tfdt"></td>
			<td>To<input type="date" name="ttdt"></td>
			<td><input type="submit" name="bsearch" value="Search"></td>
		</tr>
		</table>
	</form>
	</center>
</body>
</html>