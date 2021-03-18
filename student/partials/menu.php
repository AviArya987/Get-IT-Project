<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		@import url('https://fonts.googleapis.com/css?family=Montserrat:500');

		*{
			box-sizing:border-box;
			margin:0;
			padding:0;
		}
		li,a,button{
			font-family:"Montserrat",sans-serif;
			font-weight:500;
			font-size:16px;
			color:#edf0f1;
			text-decoration:none;
		}
		header{
			display:flex;
			justify-content:space-between;
			width:100vw;
			/*background-color:#24252A;*/
			background: -webkit-linear-gradient(left, #003366,#004080);
			/*box-shadow:4px -20px 30px #000;*/
			align-items:center;
			padding:15px 20px;
			margin-top:-45px;
			margin-bottom:30px;
		}
		h2{
			cursor:pointer;
			color:#fff;
		}
		.nav-links{
			list-style:none;
		}
		.nav-links li{
			display:inline-block;
			padding:0px 20px;
			position:relative;
			background:-webkit-linear-gradient(left, #003366,#004080);;
		}
		.nav-links li a{
			transition:all 0.4s ease 0s;
			display: block;
			line-height:30px;
		}
		.nav-links li a:hover{
			color:#0088a9;
		}
		.nav-links ul{
			position:absolute;
			top:30px;
			display:none;
			z-index: 2;
		}
		.nav-links ul li{
			width:180px;
			float:none;
			border-bottom:1px solid rgba(0,136,169,1);
		}
		.nav-links ul li a{
			margin:5px 0;
		}
		nav ul li:hover > ul{
			display:block;
		}
		button{
			padding:9px 25px;
			background-color:rgba(0,136,169,1);
			border:none;
			border-radius:50px;
			cursor:pointer;
			transition:all 0.3s ease;
		}
		button:hover{
			background-color:rgba(0,136,169,0.8);
		}
	</style>
</head>
<body>
	<header>
		<h2>Get It Project Pvt. Ltd.</h2>
		<nav>
			<ul class="nav-links">
				<li><a href="#">Enquiry</a>
					<ul>
						<li><a href="enquiry.php">Enquiry</a></li>
						<li><a href="enquiry_update.php">Enquiry Update</a></li>
						<li><a href="enquiry_delete.php">Enquiry Delete</a></li>
					</ul>
				</li>
				<li><a href='admission.php'>Admission</a></li>
				<li><a href="feedetails.php">Fee Details</a></li>
				<li><a href="#">Income Expense</a>
					<ul>
						<li><a href="income_expense.php">Income Expense</a></li>
						<li><a href="inc_exp_report.php">Inc Exp Report</a></li>
					</ul>
				</li>
			</ul>
		</nav>
		<a class="cta" href="#"><button>About Us</button></a>
	</header>
</body>
</html>