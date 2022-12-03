<?php

require "config/constants.php";

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Fliers service</title>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<script src="js/jquery2.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="main.js"></script>
		<link rel="stylesheet" type="text/css" href="style.css"/>
	</head>
<body>
<div class="wait overlay">
	<div class="loader"></div>
</div>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">	
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse" aria-expanded="false">
					<span class="sr-only">navigation</span>
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
				<li><a href="index2.php"><span class="glyphicon glyphicon-list-alt"></span> Service</a></li>
			</ul>
		</div>
	</div>
	</div>
	<p><br/></p>
	<p><br/></p>
	<p><br/></p>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8" id="cart_msg">
				<!--Cart Message--> 
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-success">
					<div class="panel-heading">fliers Checkout</div>
					<div class="row">
					<div class="col-lg-6">
						<form action="" method="POST" id="form_id">
							<div class="form-group">
								<h5><label for="inputName">Name</label></h5>

								<input type="text" name="name" class="form-control" placeholder="Enter your name" pattern="[a-zA-Z. ]{1,50}" required>
							</div>
							<div class="form-group">
								<h5><label for="inputMobile">Mobile</label></h5>

								<input type="tel" name="phone" class="form-control" placeholder="Enter your mobile number" pattern="[0-9]{10}" maxlength="10" required>
							</div>
							<div class="form-group">
								<h5><label for="inputMessage">Message</label></h5>
								<input type="text" name="message" class="form-control" placeholder="Write more details for the flier(s) you are looking for" required>
							</div>
							<button type="submit" name="submit" class="btn btn-primary btn-success" tabindex="5">Send</button><br>
						</form>
					</div>
				</div>
				<?php
					//Submitting the message into the database
					$servername = "localhost";
					$username = "root";
					$password = "";
					$db = "exam";

					// Create connection
					$con = mysqli_connect($servername, $username, $password,$db);

					// Check connection
					if (!$con) {
						die("Connection failed: " . mysqli_connect_error());
					}

					if(isset($_POST['submit'])){
						// Taking all 5 values from the form data(input)
						$name =  $_POST['name'];
						$phone = $_POST['phone'];
						$message =  $_POST['message'];

						// Performing insert query execution
						// here our table name is college
						$sql = "insert into Themessage (name, phone, message) values ('$name','$phone','$message')";
						if(mysqli_query($con, $sql)){
							echo "<center><h3>welcome done! You can now pay</h3></center>";
						} else{
							echo "ERROR: Hush! Sorry $sql. "
								. mysqli_error($con);
						}
						
						// Close connection
						mysqli_close($con);
					}

				?>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-2 col-xs-2"><b>Action</b></div>
							<div class="col-md-2 col-xs-2"><b>flier Image</b></div>
							<div class="col-md-2 col-xs-2"><b>flier Name</b></div>
							<div class="col-md-2 col-xs-2"><b>Number of fliers needed</b></div>
							<div class="col-md-2 col-xs-2"><b>flier Price</b></div>
							<div class="col-md-2 col-xs-2"><b>Price in <?php echo CURRENCY; ?></b></div>
						</div>
						<div id="cart_checkout"></div>

						</div> 
					</div>
					<div class="panel-footer"></div>
				</div>
			</div>
			<div class="col-md-2"></div>
			
		</div>



<script>var CURRENCY = '<?php echo CURRENCY; ?>';</script>
</body>	
</html>
















		