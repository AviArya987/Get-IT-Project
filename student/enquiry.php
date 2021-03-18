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
    public $slnomatch="";
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
    public function save()
    {
        $val="select slno_enquiry from key_gen";
        $r=mysqli_query($this->db_handle,$val);
        $f=0;
        while($db_field=mysqli_fetch_assoc($r))
        {
            $this->slnomatch=$_POST["tslno"];
            if($db_field['slno_enquiry']==$_POST["tslno"])
            {
                $f=1;
                break;
            }
        }
        if($this->db_handle && $f==1)
        {       
            $sql="insert into enquiry values($_POST[tslno],'$_POST[tname]','$_POST[tdob]','$_POST[tgender]','$_POST[tfname]','$_POST[taddress]',$_POST[tcontact],'$_POST[temail]','$_POST[tedu_qual]','$_POST[tsch_coll]','$_POST[tcourse]','$_POST[tcounsellor]','$_POST[tenqdd]','$_POST[tenqmm]','$_POST[tenqyyyy]','$_POST[tstatus]')";
            mysqli_query($this->db_handle,$sql);
            echo "Record Saved";

            $slno1=$_POST["tslno"]+1;
            $sql="update key_gen set slno_enquiry=$slno1";
            mysqli_query($this->db_handle,$sql);
        }
        if($f==0)
        {
            echo "<script>alert('Please Click on New Button')</script>";
        }
    }
    public function allsearch()
    {
        if($this->db_handle)
        {
            $r=mysqli_query($this->db_handle,"select * from enquiry");
            echo "<table cellpadding=3 cellspacing=10 border=0>";
            echo "<center>";
            while($db_field=mysqli_fetch_assoc($r))
            {
                echo "<tr>";
                echo "<td colspan=2>".$db_field['slno']."</td>";
                echo "<td colspan=2>".$db_field['name']."</td>";
                echo "<td colspan=2>".$db_field['dob']."</td>";
                echo "<td colspan=2>".$db_field['gender']."</td>";
                echo "<td colspan=2>".$db_field['fname']."</td>";
                echo "<td colspan=2>".$db_field['address']."</td>";
                echo "<td colspan=2>".$db_field['contact']."</td>";
                echo "<td colspan=2>".$db_field['email']."</td>";
                echo "<td colspan=2>".$db_field['edu_qual']."</td>";
                echo "<td colspan=2>".$db_field['sch_coll']."</td>";
                echo "<td colspan=2>".$db_field['course']."</td>";
                echo "<td colspan=2>".$db_field['counsellor']."</td>";
                echo "<td colspan=2>".$db_field['enqdd']."</td>";
                echo "<td colspan=2>".$db_field['enqmm']."</td>";
                echo "<td colspan=2>".$db_field['enqyyyy']."</td>";
                echo "<td colspan=2>".$db_field['status']."</td>";
                echo "<tr>";
            }
            echo "</center>";
            echo "</table>"; 
        }
    }
    function key_gen()
    {
        if($this->db_handle)
        {
            $r=mysqli_query($this->db_handle,"select * from key_gen");
            while($db_field=mysqli_fetch_assoc($r))
            {
                $this->slno=$db_field['slno_enquiry'];
            }
        }
    }
}
$ob=new enquiry();
if(isset($_REQUEST["bsave"]))
$ob->save();
if(isset($_REQUEST["bsearch"]))
$ob->search();
if(isset($_REQUEST["ball_search"]))
$ob->allsearch();
if(isset($_REQUEST["bnew"]))
$ob->key_gen();
?>
<html>
    <head>
        <title>EnquiryForm</title>
        <style>
            tr{
                color:white;
                text-transform:capitalize;
                font-size:16px;
                margin:0 25px;
            }
        </style>
        <link rel="stylesheet" href="style.css" type="text/css">
    </head>
    <body>
        <div class="container">
            <form name=f method="POST" action="enquiry.php">
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
                <div class="form-row">
                    <div class="input-data">
                        <input type="text" name="tstatus" value="<?php echo $ob->status;?>">
                        <div class="underline"></div>
                        <label>Status</label>
                    </div>
                </div>
                <div class="submit-btn">
                    <input type="submit" name="bsave" value="Save" class="btn">
                    <input type="submit" name="bsearch" value="Search" class="btn">
                    <input type="submit" name="ball_search" value="All Search" class="btn">
                    <input type="submit" name="bnew" value="New" class="btn">
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
