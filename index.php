<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Fliers services</title>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<script src="js/jquery2.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="main.js"></script>

		<style>
			@media screen and (max-width:480px){
				#search{width:80%;}
				#search_btn{width:30%;float:right;margin-top:-32px;margin-right:10px;}
			}
		</style>
	</head>
<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">	
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse" aria-expanded="false">
					<span class="sr-only"> navigation toggle</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="#" class="navbar-brand">Fliers services</a>
			</div>
		    <div class="collapse navbar-collapse" id="collapse">
			    <ul class="nav navbar-nav">
				    <li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
				    <li><a href="about.php"><span class="glyphicon glyphicon-book"></span> About us</a></li>
				    <li><a href="index2.php"><span class="glyphicon glyphicon-list-alt"></span> Services</a></li>
                </ul>
	        </div>
        </div>
    </div>
    <div class="container-fluid banner">
		<div class="row">
			<div class="col-md-8 offset-md-2 info">
				<h1 class="text-center">Best Flier services</h1>
				<p class="text-center">
					 Get a flier within a day, just sign up or go directly to the services
				</p>
				<a href="customer_registration.php?register=1" class="btn btn-md text-center">Sign up now</a>
			</div>
		</div>
	</div>
<style>
    body{
	margin:0;
	padding:0;
	background:#fff;
	font-family: 'Raleway',sans-serif;
	color: #fff;
}
.banner{
	height: 100vh;
	width: 100%;
	background-color: #dff0d8;
	background-position: top;
	background-size:cover;
	/*background-attachment: fixed;*/
	background-repeat: no-repeat;
}
.banner .info{
	margin-top:15%;
	transform: translateY(-15%);
}
.banner .info h1{
	font-size: 2.5em;
	font-weight: 700;
	color: black;
	letter-spacing: 2px;
}
.banner .info p{
	font-size: 2em;
	font-weight: 500;
	color: black;
	letter-spacing: 2px;
}
.banner .info a{
	margin-left:50%;
	transform: translateX(-50%);
	color: #fff;
	background: green;
	padding:10px 20px; 
	font-size: 2em;
	font-weight: 600;
}
.banner .info a:hover{
	background: black;
}
</style>
</body>
</html>
