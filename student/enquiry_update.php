<?php
include 'connect.php';
include './partials/menu.php';
class enquiry extends connect
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
	public function enquiry()
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
	public function update()
	{
		$sql="update enquiry set name='$_POST[tname]',dob='$_POST[tdob]',gender='$_POST[tgender]',fname='$_POST[tfname]',
		address='$_POST[taddress]',contact=$_POST[tcontact],email='$_POST[temail]',edu_qual='$_POST[tedu_qual]',sch_coll='$_POST[tsch_coll]',
		course='$_POST[tcourse]',counsellor='$_POST[tcounsellor]',enqdd='$_POST[tenqdd]',enqmm='$_POST[tenqmm]',enqyyyy='$_POST[tenqyyyy]',
		status='$_POST[tstatus]' where slno=$_POST[tslno]";
		mysqli_query($this->db_handle,$sql);
		echo "Record Updated";
	}
}
$ob=new enquiry();
if(isset($_REQUEST["bupdate"]))
$ob->update();
if(isset($_REQUEST["bsearch"]))
$ob->search();

?>
<html>
	<head>
		<title>EnquiryForm</title>
		<link rel="stylesheet" href="style.css" type="text/css">
	</head>
	<body>
        <div class="container">
            <form name=f method="POST" action="enquiry_update.php">
                <div class="form-row">
                    <div class="input-data">
                        <input type="text" name="tslno" value="<?php echo $ob->slno; ?>">
                        <div class="underline"></div>
                        <label>Serial Number</label>
                    </div>
                    <div class="input-data">
                        <input type="text" name="tname" value="<?php echo $ob->name; ?>">
                        <div class="underline"></div>
                        <label>Name</label>
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
                        <input type="text" name="tcounsellor" value="<?php echo $ob->status;?>">
                        <div class="underline"></div>
                        <label>Status</label>
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
                        <input type="text" name="taddress" value="<?php echo $ob->address; ?>">
                        <div class="underline"></div>
                        <label>Address</label>
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
                <div class="submit-btn">
                    <input type="submit" name="bupdate" value="Update" class="btn">
                    <input type="submit" name="bsearch" value="Search"class="btn">
                </div>
            </form>
        </div>
    </body>
	<script>
		function only_num(e)
		{
			if(e.which==46)
				return false;
		}
	</script>
</html>
