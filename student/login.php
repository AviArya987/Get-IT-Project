<?php
include 'connect.php';
class login extends connect
{
	public $id="";
	public $pwd="";
	public function login()
	{
		parent::connect();
	}
	public function lg()
	{
		if($this->db_handle)
        {
        	$f=0;
        	$f1=0;
            $this->id=$_POST["tid"];
            $this->pwd=$_POST["tpwd"];
            $r=mysqli_query($this->db_handle,"select * from login");
            while($db_field=mysqli_fetch_assoc($r))
            {
            	if($db_field['id']==$_POST["tid"])
	            {
	            	$f=1;
	            	if($db_field['pwd']==$_POST["tpwd"])
	            	{
	            		$f1=1;
	            		break;
	            	}
	            }
	        }
	        if($f==1)
	      	{
	      		if($f1==1)
	      		{
	      			$r1=mysqli_query($this->db_handle,"select * from login where id='$this->id' and pwd='$this->pwd'");
	      			while($db_field=mysqli_fetch_assoc($r1)) 
	      			{
			       		if($db_field['counter']>0)
			            {
			       			$d=$db_field['id'];
			       			$p=$db_field['pwd'];
			       			$ct=$db_field['counter']-1;
			        		mysqli_query($this->db_handle,"update login set counter=$ct
			          			where id='$d' and pwd='$p'");
			        		echo "<script>window.open('enquiry.php')</script>";
			       		}
			            else
			            {
			            	echo "<script>alert('Your trial has been expired get our pro version now')</script>";
			          	}
			        }
		        }
		        else
	            {
	         		$f4=0;
	            	$chance=mysqli_query($this->db_handle,"select * from login_chance");
	            	while($db_field=mysqli_fetch_assoc($chance))
	           		{
	           			if($db_field['chance']>0)
	           			{
	           				$f4=1;
	           				break;
	           			}
	           		}
	           		if($f4==1)
	           		{
	           			mysqli_query($this->db_handle,"update login_chance set chance=chance-1");
	           			echo "<script>alert('Please check the Password')</script>";
	           		}
	           		else
	           		{
	           			mysqli_query($this->db_handle,"update login_chance set chance=4");
	           			echo "<script>window.close()</script>";
	           		}
	        	}
	        }
	        else
	        {
	        	$f3=0;
	            $chance=mysqli_query($this->db_handle,"select * from login_chance");
	            while($db_field=mysqli_fetch_assoc($chance))
	            {
	            	if($db_field['chance']>0)
	            	{
	            		$f3=1;
	            		break;
	            	}
	            }
	            if($f3==1)
	           	{
	           		mysqli_query($this->db_handle,"update login_chance set chance=chance-1");
	       			echo "<script>alert('Please check the ID')</script>";
	      		}
	           	else
        		{
	           		mysqli_query($this->db_handle,"update login_chance set chance=4");
	           		echo "<script>window.close()</script>";
	          	}
	        }
	    }
	}
	public function signup()
	{
		if($this->db_handle)
		{
			$id=$_POST["tsid"];
			$pwd=$_POST["tspwd"];
			$cpwd=$_POST["tcpwd"];
			if($pwd==$cpwd)
			{
				$f=0;
				$sql="select id from login";
				$r=mysqli_query($this->db_handle,$sql);
				while($db_field=mysqli_fetch_assoc($r))
				{
					if($db_field['id']==$id)
					{
						$f=1;
						break;
					}
				}
				if($f==1)
				{
					echo "User ID already exists";
				}
				else
				{
					$r1="insert into login(id,pwd,counter) values('$id','$pwd',4)";
					mysqli_query($this->db_handle,$r1);
					echo "User has been created";
				}
			}
			else
			{
				echo "Passwords does not match";
			}
		}
	}
}

$ob=new login();
if(isset($_REQUEST["blogin"]))
$ob->lg();
if(isset($_REQUEST["bsignup"]))
$ob->signup();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Login</title>
		<style>
	    	@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
		*{
		  margin: 0;
		  padding: 0;
		  box-sizing: border-box;
		  font-family: 'Poppins', sans-serif;
		}
		html,body{
		  display: grid;
		  height: 100%;
		  width: 100%;
		  place-items: center;
		  background: -webkit-linear-gradient(left, #003366,#004080,#0059b3
		, #0073e6);
		}
		::selection{
		  background: #1a75ff;
		  color: #fff;
		}
		.wrapper{
		  overflow: hidden;
		  max-width: 390px;
		  background: #fff;
		  padding: 30px;
		  border-radius: 15px;
		  box-shadow: 0px 15px 20px rgba(10px,20px,0,8px,0.5px);
		}
		.wrapper .title-text{
		  display: flex;
		  width: 200%;
		}
		.wrapper .title{
		  width: 50%;
		  font-size: 35px;
		  font-weight: 600;
		  text-align: center;
		  transition: all 0.6s cubic-bezier(0.68,-0.55,0.265,1.55);
		}
		.wrapper .slide-controls{
		  position: relative;
		  display: flex;
		  height: 50px;
		  width: 100%;
		  overflow: hidden;
		  margin: 30px 0 10px 0;
		  justify-content: space-between;
		  border: 1px solid lightgrey;
		  border-radius: 15px;
		}
		.slide-controls .slide{
		  height: 100%;
		  width: 100%;
		  color: #fff;
		  font-size: 18px;
		  font-weight: 500;
		  text-align: center;
		  line-height: 48px;
		  cursor: pointer;
		  z-index: 1;
		  transition: all 0.6s ease;
		}
		.slide-controls label.signup{
		  color: #000;
		}
		.slide-controls .slider-tab{
		  position: absolute;
		  height: 100%;
		  width: 50%;
		  left: 0;
		  z-index: 0;
		  border-radius: 15px;
		  background: -webkit-linear-gradient(left,#003366,#004080,#0059b3
		, #0073e6);
		  transition: all 0.6s cubic-bezier(0.68,-0.55,0.265,1.55);
		}
		input[type="radio"]{
		  display: none;
		}
		#signup:checked ~ .slider-tab{
		  left: 50%;
		}
		#signup:checked ~ label.signup{
		  color: #fff;
		  cursor: default;
		  user-select: none;
		}
		#signup:checked ~ label.login{
		  color: #000;
		}
		#login:checked ~ label.signup{
		  color: #000;
		}
		#login:checked ~ label.login{
		  cursor: default;
		  user-select: none;
		}
		.wrapper .form-container{
		  width: 100%;
		  overflow: hidden;
		}
		.form-container .form-inner{
		  display: flex;
		  width: 200%;
		}
		.form-container .form-inner form{
		  width: 50%;
		  transition: all 0.6s cubic-bezier(0.68,-0.55,0.265,1.55);
		}
		.form-inner form .field{
		  height: 50px;
		  width: 100%;
		  margin-top: 20px;
		}
		.form-inner form .field input{
		  height: 100%;
		  width: 100%;
		  outline: none;
		  padding-left: 15px;
		  border-radius: 15px;
		  border: 1px solid lightgrey;
		  border-bottom-width: 2px;
		  font-size: 17px;
		  transition: all 0.3s ease;
		}
		.form-inner form .field input:focus{
		  border-color: #1a75ff;
		   box-shadow: inset 0 0 3px #fb6aae; 
		}
		.form-inner form .field input::placeholder{
		  color: #999;
		  transition: all 0.3s ease;
		}
		form .field input:focus::placeholder{
		  color: #1a75ff;
		}
		.form-inner form .pass-link{
		  margin-top: 5px;
		}
		.form-inner form .signup-link{
		  text-align: center;
		  margin-top: 30px;
		}
		.form-inner form .pass-link a,
		.form-inner form .signup-link a{
		  color: #1a75ff;
		  text-decoration: none;
		}
		.form-inner form .pass-link a:hover,
		.form-inner form .signup-link a:hover{
		  text-decoration: underline;
		}
		form .btn{
		  height: 50px;
		  width: 100%;
		  border-radius: 15px;
		  position: relative;
		  overflow: hidden;
		}
		form .btn .btn-layer{
		  height: 100%;
		  width: 300%;
		  position: absolute;
		  left: -100%;
		  background: -webkit-linear-gradient(right,#003366,#004080,#0059b3
		, #0073e6);
		  border-radius: 15px;
		  transition: all 0.4s ease;;
		}
		form .btn:hover .btn-layer{
		  left: 0;
		}
		form .btn input[type="submit"]{
		  height: 100%;
		  width: 100%;
		  z-index: 1;
		  position: relative;
		  background: none;
		  border: none;
		  color: #fff;
		  padding-left: 0;
		  border-radius: 15px;
		  font-size: 20px;
		  font-weight: 500;
		  cursor: pointer;
		}
		</style>
	</head>
	<body>
	    <div class="wrapper">
	      <div class="title-text">
	        <div class="title login">Login Form</div>
	        <div class="title signup">Signup Form</div>
	      </div>
	      <div class="form-container">
	        <div class="slide-controls">
	          <input type="radio" name="slide" id="login" checked>
	          <input type="radio" name="slide" id="signup">
	          <label for="login" class="slide login">Login</label>
	          <label for="signup" class="slide signup">Signup</label>
	          <div class="slider-tab"></div>
	        </div>
	        <div class="form-inner">
	          <form class="login" name=f method="POST" action="login.php">
	            <div class="field">
	              <input type="text" name="tid" placeholder="User ID">
	            </div>
	            <div class="field">
	              <input type="password" name="tpwd" placeholder="Password">
	            </div>
	            <div class="field btn">
	              <div class="btn-layer"></div>
	              <input type="submit" value="Login" name="blogin">
	            </div>
	            <div class="signup-link">Not a member? <a href="">Signup now</a></div>
	          </form>
	          <form action="login.php" method="POST" name=f class="signup">
	            <div class="field">
	              <input type="text" name="tsid" placeholder="Email Address" required>
	            </div>
	            <div class="field">
	              <input type="password" name="tspwd" placeholder="Password" required>
	            </div>
	            <div class="field">
	              <input type="password" name="tcpwd" placeholder="Confirm password" required>
	            </div>
	            <div class="field btn">
	              <div class="btn-layer"></div>
	              <input type="submit" name="bsignup" value="Signup">
	            </div>
	          </form>
	        </div>
	      </div>
	    </div>
	</body>
	<script>
      const loginText = document.querySelector(".title-text .login");
      const loginForm = document.querySelector("form.login");
      const loginBtn = document.querySelector("label.login");
      const signupBtn = document.querySelector("label.signup");
      const signupLink = document.querySelector("form .signup-link a");
      signupBtn.onclick = (()=>{
        loginForm.style.marginLeft = "-50%";
        loginText.style.marginLeft = "-50%";
      });
      loginBtn.onclick = (()=>{
        loginForm.style.marginLeft = "0%";
        loginText.style.marginLeft = "0%";
      });
      signupLink.onclick = (()=>{
        signupBtn.click();
        return false;
      });
    </script>
</html>