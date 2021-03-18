<?php
include 'connect.php';
include './partials/menu.php';
class admission extends connect
{
	public $slno="";
	public $name="";
	public $dob="";
	public $gender="";
	public $fname="";
	public $address="";
	public $contact="";
	public $email="";	
	public $edu_qual="";
	public $sch_coll="";
	public $course="";
	public $counsellor="";
	public $enqdd="";
	public $enqmm="";
	public $enqyyyy="";
	public $status="";
	public $cfee="";
	public $enrollno="";

	public function admission()
	{
		parent::connect();
	}
	public function search()
	{
		if($this->db_handle)
		{
			$val=$_POST["tslno"];
			$r=mysqli_query($this->db_handle,"select * from enquiry where slno=".$val);
			while($db_field=mysqli_fetch_assoc($r))
			{
				$this->slno=$db_field['slno'];
				$this->name=$db_field['name'];
				$this->dob=$db_field['dob'];
				$this->gender=$db_field['gender'];
				$this->fname=$db_field['fname'];
				$this->address=$db_field['address'];
				$this->contact=$db_field['contact'];
				$this->email=$db_field['email'];
				$this->edu_qual=$db_field['edu_qual'];
				$this->sch_coll=$db_field['sch_coll'];
				$this->course=$db_field['course'];
				$this->counsellor=$db_field['counsellor'];
				$this->enqdd=$db_field['enqdd'];
				$this->enqmm=$db_field['enqmm'];
				$this->enqyyyy=$db_field['enqyyyy'];
				$this->status=$db_field['status'];
			}
		}
	}
	public function save()
	{
		$val="select enroll from admission";
		$r=mysqli_query($this->db_handle,$val);
		$f=0;
		while($db_field=mysqli_fetch_assoc($r))
		{
			if($db_field['enroll']==$_POST["tenroll"])
			{
				$f=1;
				break;
			}
		}
               
		
		$val1="select slno from enquiry";
		$r1=mysqli_query($this->db_handle,$val1);
		$f1=0;
		while($db_field=mysqli_fetch_assoc($r1))
		{
			if($db_field['slno']==$_POST["tslno"])
			{
				$f1=1;
				break;
			}
		}

		$val2="select slno from admission";
		$r2=mysqli_query($this->db_handle,$val2);
		$f2=0;
		while($db_field=mysqli_fetch_assoc($r2))
		{
			if($db_field['slno']==$_POST["tslno"])
			{
				$f2=1;
				break;
			}
		}
                
		if($this->db_handle && $f==0 && $f1==1 && f2==0)
		{		

			$sql="insert into admission values($_POST[tslno],'$_POST[tname]','$_POST[tdob]','$_POST[tgender]','$_POST[tfname]','$_POST[taddress]',$_POST[tcontact],
			'$_POST[temail]','$_POST[tedu_qual]','$_POST[tsch_coll]','$_POST[tcourse]','$_POST[tcounsellor]','$_POST[tenqdd]','$_POST[tenqmm]','$_POST[tenqyyyy]',
			'$_POST[tstatus]',$_POST[tcfee],'$_POST[tenroll]')";
			mysqli_query($this->db_handle,$sql);
			echo "Record Saved";

			//Update enquiry set status to 'a' for slno
			mysqli_query($this->db_handle,"update enquiry set status='a' where slno='$_POST[tslno]'");
		}
		if($f==1)
		{
			echo "<script>alert('Enrollment No. already exists')</script>";
		}
		if($f1==0)
		{
			echo "<script>alert('Serial No. does not exists in enquiry')</script>";
		}
		if($f2==1)
		{
			echo "<script>alert('Serial No. already exists in admission')</script>";
		}
	}
	public function allsearch_admission()
	{
		if($this->db_handle)
		{
			$r=mysqli_query($this->db_handle,"select * from admission");
			echo "<table cellpadding=3 cellspacing=10>";
			while($db_field=mysqli_fetch_assoc($r))
			{
				echo "<tr>";
				echo "<td>".$db_field['slno']."</td>";
				echo "<td>".$db_field['enroll']."</td>";
				echo "<td>".$db_field['name']."</td>";
				echo "<td>".$db_field['dob']."</td>";
				echo "<td>".$db_field['gender']."</td>";
				echo "<td>".$db_field['fname']."</td>";
				echo "<td>".$db_field['address']."</td>";
				echo "<td>".$db_field['contact']."</td>";
				echo "<td>".$db_field['email']."</td>";
				echo "<td>".$db_field['edu_qual']."</td>";
				echo "<td>".$db_field['sch_coll']."</td>";
				echo "<td>".$db_field['course']."</td>";
				echo "<td>".$db_field['cfee']."</td>";
				echo "<td>".$db_field['counsellor']."</td>";
				echo "<td>".$db_field['enqdd']."</td>";
				echo "<td>".$db_field['enqmm']."</td>";
				echo "<td>".$db_field['enqyyyy']."</td>";
				echo "<tr>";
			}
			echo "</table>";
		}
	}
	public function allsearch_enquiry()
	{
		if($this->db_handle)
		{
			$r=mysqli_query($this->db_handle,"select * from enquiry");
			echo "<table cellpadding=3 cellspacing=10>";
			echo "<center>";
			while($db_field=mysqli_fetch_assoc($r))
			{
				echo "<tr>";
				echo "<td>".$db_field['slno']."</td>";
				echo "<td>".$db_field['name']."</td>";
				echo "<td>".$db_field['dob']."</td>";
				echo "<td>".$db_field['gender']."</td>";
				echo "<td>".$db_field['fname']."</td>";
				echo "<td>".$db_field['address']."</td>";
				echo "<td>".$db_field['contact']."</td>";
				echo "<td>".$db_field['email']."</td>";
				echo "<td>".$db_field['edu_qual']."</td>";
				echo "<td>".$db_field['sch_coll']."</td>";
				echo "<td>".$db_field['course']."</td>";
				echo "<td>".$db_field['counsellor']."</td>";
				echo "<td>".$db_field['enqdd']."</td>";
				echo "<td>".$db_field['enqmm']."</td>";
				echo "<td>".$db_field['enqyyyy']."</td>";
				echo "<td>".$db_field['status']."</td>";
				echo "<tr>";
			}
			echo "</center>";
			echo "</table>";
		}	
	}
}
$ob=new admission();
if(isset($_REQUEST["bsave"]))
$ob->save();
if(isset($_REQUEST["bsearch"]))
$ob->search();
if(isset($_REQUEST["ball_search_enquiry"]))
$ob->allsearch_enquiry();
if(isset($_REQUEST["ball_search_admission"]))
$ob->allsearch_admission();
?>
<html>
<head>
<title>Admission Form</title>
	<style>
        tr{
            color:white;
            text-transform:capitalize;
            font-size:16px;
            margin:0 40px;
        }
        .btn1{
        	margin-left:25px;
        	padding:10px;
        	margin-top:13px;
        	border:none;
        	background: -webkit-linear-gradient(left, #003366,#004080);
        	border-radius:9px;
        	color:#fff;
        	font-size:15px;
        }
    </style>
<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
	<div class="container">
    <form name=f method="POST" action="admission.php">
        <div class="form-row">
            <div class="input-data">
                <input type="text" name="tslno" value="<?php echo $ob->slno; ?>">
                <div class="underline"></div>
                <label>Serial Number</label>
            </div>
            <div class="input-data">
                <input type="text" name="tenroll" value="<?php echo $ob->enrollno; ?>">
                <div class="underline"></div>
                <label>Enrollment Number</label>
            </div>
        </div>
         <div class="form-row">
            <div class="input-data">
                <input type="text" name="tname" value="<?php echo $ob->name; ?>">
                <div class="underline"></div>
                <label>Name</label>
            </div>
            <div class="input-data">
                <input type="text" name="tstatus" value="<?php echo $ob->status; ?>">
                <div class="underline"></div>
                <label>Status</label>
            </div>
        </div>
        <div class="form-row">
            <div class="input-data">
                <input type="text" name="tdob" value="<?php echo $ob->dob; ?>">
                <div class="underline"></div>
                <label>Date of Birth</label>
            </div>
            <div class="input-data">
                <input type="text" name="tgender" value="<?php echo $ob->gender; ?>">
                <div class="underline"></div>
                <label>Gender</label>
            </div>
        </div>
        <div class="form-row">
            <div class="input-data">
                <input type="text" name="tfname" value="<?php echo $ob->fname; ?>">
                <div class="underline"></div>
                <label>Father's Name</label>
            </div>
            <div class="input-data">
                <input type="text" name="taddress" value="<?php echo $ob->address; ?>">
                <div class="underline"></div>
                <label>Address</label>
            </div>
        </div>
        <div class="form-row">
            <div class="input-data">
                <input type="number" name="tcontact" onkeypress="return only_num(event)"value="<?php echo $ob->contact; ?>">
                <div class="underline"></div>
                <label>Contact</label>
            </div>
            <div class="input-data">
                <input type="text" name="temail" value="<?php echo $ob->email; ?>">
                <div class="underline"></div>
                <label>Email</label>
            </div>
        </div>
        <div class="form-row">
            <div class="input-data">
                <input type="text" name="tedu_qual" value="<?php echo $ob->edu_qual; ?>">
                <div class="underline"></div>
                <label>Educ. Qualification</label>
            </div>
            <div class="input-data">
                <input type="text" name="tsch_coll" value="<?php echo $ob->sch_coll; ?>">
                <div class="underline"></div>
                <label>School or College</label>
            </div>
        </div>
        <div class="form-row">
            <div class="input-data">
                <input type="text" name="tcourse" value="<?php echo $ob->course; ?>">
                <div class="underline"></div>
                <label>Course</label>
            </div>
            <div class="input-data">
                <input type="text" name="tcounsellor" value="<?php echo $ob->counsellor; ?>">
                <div class="underline"></div>
                <label>Counsellor</label>
            </div>
        </div>

        <div class="form-row">
            <div class="input-data">
                <input type="text" name="tenqdd" value="<?php echo $ob->enqdd; ?>">
                <div class="underline"></div>
                <label>Enquiry DD</label>
            </div>
            <div class="input-data">
                <input type="text" name="tenqmm" value="<?php echo $ob->enqmm; ?>">
                <div class="underline"></div>
                <label>Enquiry MM</label>
            </div>
            <div class="input-data">
                <input type="text" name="tenqyyyy" value="<?php echo $ob->enqyyyy; ?>">
                <div class="underline"></div>
                <label>Enquiry YYYY</label>
            </div>
        </div>
        <a href="./photo_upload/test.htm"><input type="button" name="bpic" value="Upload Image" class="btn1"></input></a>
        <div class="submit-btn">
        	<input type="submit" name="bsave" value="Save" class="btn">
			<input type="submit" name="bsearch" value="Search" class="btn">
			<input type="submit" name="ball_search_enquiry" value="All Search Enquiry" class="btn">
			<input type="submit" name="ball_search_admission" value="All Search Admission" class="btn">
			<input type="submit"  class="btn" name="bp_search" value="P_Search" onclick="window.open('psearch.php')">
			<input type="submit"  class="btn" name="bnew" value="New">
        </div>
    </form>
	</div>
</body>
</html>

