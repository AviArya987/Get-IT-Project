<?php
include 'connect.php';
class feedetails extends connect
{
    public $recpno="";
    public $enroll="";
    public $name="";
    public $course="";
    public $cfee=0;
    public $tinsg=0;
    public $bal=0;

    public function enquiry()
    {
        parent::connect();
    }
    public function search()
    {
        $val=$_POST["tenroll"];
        $r=mysqli_query($this->db_handle,"select * from admission where enroll="."'".$val."'");
        while($db_field=mysqli_fetch_assoc($r))
        {
            $this->enroll=$db_field['enroll'];
            $this->name=$db_field['name'];
            $this->course=$db_field['course'];
            $this->cfee=$db_field['cfee'];
        }
        // Finding total fee paid by particular student
        $sum=0;

        $r2=mysqli_query($this->db_handle,"select fpaid from fee_detail where enroll="."'".$val."'");
        while($db_field=mysqli_fetch_assoc($r2))
        {
            $sum=$sum+$db_field['fpaid'];
        }
        $this->tinsg=$sum;
        $this->bal=$this->cfee-$this->tinsg;
    }
    function all_search()
    {
        if($this->db_handle)
        {
            $r=mysqli_query($this->db_handle,"select * from admission");
            echo "<table border=1>";
            while($db_field=mysqli_fetch_assoc($r))
            {
                echo "<tr>";
                echo "<td>".$db_field['enroll']."</td>";
                echo "<td>".$db_field['name']."</td>";
                echo "<td>".$db_field['course']."</td>";
                echo "<td>".$db_field['cfee']."</td>";
                echo "<tr>";
            }
            echo "</table>"; 
        }
    }
    public function save()
    {
        $val="select recpno from key_gen";
        $r=mysqli_query($this->db_handle,$val);
        $f=0;
        while($db_field=mysqli_fetch_assoc($r))
        {
            if($db_field['recpno']==$_POST["trecpno"])
            {
                $f=1;
                break;
            }
        }
        if($this->db_handle && $f==1)
        {       
            $dt=$_POST["tdt"];
            $dd=substr($dt,8,2);
            $mm=substr($dt,5,2);
            $yyyy=substr($dt,0,4);

            $sql="insert into fee_detail values('$_POST[trecpno]','$_POST[tenroll]','$_POST[tname]','$_POST[tcourse]','$_POST[tcfee]',$this->tinsg,$this->bal,'$_POST[tfpaid]','$dd','$mm','$yyyy',
            '$_POST[ttakenby]')";
            mysqli_query($this->db_handle,$sql);
            echo "Record Saved";

            $recpno1=$_POST["trecpno"]+1;
            $sql="update key_gen set recpno=$recpno1";
            mysqli_query($this->db_handle,$sql);
        }
        if($f==0)
        {
            echo "<script>alert('Please Click on New Button')</script>";
        }
    }
    
    function recpno_gen()
    {
        if($this->db_handle)
        {
            $r=mysqli_query($this->db_handle,"select recpno from key_gen");
            while($db_field=mysqli_fetch_assoc($r))
            {
                $this->recpno=$db_field['recpno'];
            }
        }
    }
}
$ob=new feedetails();
if(isset($_REQUEST["bsave"]))
$ob->save();
if(isset($_REQUEST["bsearch"]))
$ob->search();
if(isset($_REQUEST["bnew"]))
$ob->recpno_gen();
if(isset($_REQUEST["ball_search"]))
$ob->all_search();
?>
<html>
<head>
<title>Fee Details Form</title>
<style>
    .btn
    {
        border-radius:10px;
        margin:3rem 0;
        height:32px;
        background:-webkit-linear-gradient(right, #003366, #004080, #0059b3);
        font-size:20px;
        color:white;
        border-color:transparent;
        font-weight:80;
    }
    form{
        margin-top: 3.5rem;
        width:450px;
        height:480px;
        box-shadow:7px 7px 30px #000;
        padding:0 auto;
        padding-top:2rem;

    }
    input[type=text]
    {
        margin:2.5px 0;
    }
    .font{
        font-weight:70;
        font-size:20px;
        /*margin-right:1rem;*/
    }
    body{
        background:url("./1.jpg");
        background-repeat:no-repeat;
        background-position:top;
        background-size:cover;
    }
    table{
        margin-top:3rem;
    }
</style>
</head>
<body >
    <center>
    <form name=f method="POST" action="feedetails.php">
    <table>
    <tr>
    <td class="font">Receipt No.</td>
    <td><input type="text" name="trecpno" value="<?php echo $ob->recpno; ?>"></td>
    </tr>
    <tr>
    <td class="font">Enrollment No.</td>
    <td><input type="text" name="tenroll" value="<?php echo $ob->enroll; ?>"/></td>
    <td><input type="submit" name="bsearch" value="Search"></td>
    </tr>
    <tr>
    <td class="font">Name</td>
    <td><input type="text" name="tname" value="<?php echo $ob->name; ?>"></td>
    </tr>
    <tr>
    <td class="font">Course</td>
    <td><input type="text" name="tcourse" value="<?php echo $ob->course; ?>"/></td>
    </tr>
    <tr>
    <td class="font">Course Fee</td>
    <td><input type="number" onkeypress="return only_num(event)" name="tcfee" value="<?php echo $ob->cfee; ?>"/></td>
    </tr>
    <tr>
    <td class="font">Installment Given</td>
    <td><input type="number" onkeypress="return only_num(event)" name="tinsg" value="<?php echo $ob->tinsg; ?>"/></td>
    </tr>
    <tr>
    <td class="font">Balance</td>
    <td><input type="number" onkeypress="return only_num(event)" name="tbal" value="<?php echo $ob->bal; ?>"/></td>
    </tr>
    <tr>
    <td class="font">Fee Paid</td>
    <td><input type="number" onkeypress="return only_num(event)" name="tfpaid"/></td>
    </tr>
    <tr>
    <td class="font">Date</td>
    <td><input type="date" name="tdt"/></td>
    </tr>
    <tr>
    <td class="font">Taken By</td>
    <td><input type="text" name="ttakenby"/></td>
    </tr>
    <tr>
        <td><input type="submit" name="bsave" value="Save" class="btn"></td>
        <td><input type="submit" name="ball_search" value="All Search" class="btn"></td>
        <td><input type="submit" name="bnew" value="New" class="btn"></td>
    </tr>
    </table>
    </form>
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
