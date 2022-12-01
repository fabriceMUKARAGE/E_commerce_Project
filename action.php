<?php
session_start();
$ip_add = getenv("REMOTE_ADDR");
include "db.php";
if(isset($_POST["category"])){
	$category_query = "SELECT * FROM categories";
	$run_query = mysqli_query($con,$category_query) or die(mysqli_error($con));
	echo "
		<div class='nav nav-pills'>
			<li class='panel panel-success'><a href='#'><h4>Sample theme Fliers</h4></a></li>
	";
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$cid = $row["cat_id"];
			$cat_name = $row["cat_title"];
			echo "
					<li><a href='#' class='category' cid='$cid'>$cat_name</a></li>
			";
		}
		echo "</div>";
	}
}

if(isset($_POST["page"])){
	$sql = "SELECT * FROM services";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
	$pageno = ceil($count/9);
	for($i=1;$i<=$pageno;$i++){
		echo "
			<li><a href='#' page='$i' id='page'>$i</a></li>
		";
	}
}
if(isset($_POST["getservice"])){
	$limit = 9;
	if(isset($_POST["setPage"])){
		$pageno = $_POST["pageNumber"];
		$start = ($pageno * $limit) - $limit;
	}else{
		$start = 0;
	}
	$service_query = "SELECT * FROM services LIMIT $start,$limit";
	$run_query = mysqli_query($con,$service_query);
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$pro_id    = $row['service_id'];
			$pro_cat   = $row['service_cat'];
		
			$pro_title = $row['service_title'];
			$pro_price = $row['service_price'];
			$pro_image = $row['service_image'];
			echo "
				<div class='col-md-4'>
							<div class='panel panel-success'>
								<div class='panel-heading'>$pro_title</div>
								<div class='panel-body'>
									<img src='service_images/$pro_image' style='width:220px; height:250px;'/>
								</div>
								<div class='panel-heading'>".CURRENCY.". $pro_price
									<button pid='$pro_id' style='float:right;' id='service' class='btn btn-warning'>Get the Service</button>
								</div>
							</div>
						</div>	
			";
		}
	}
}
if(isset($_POST["get_seleted_Category"]) || isset($_POST["search"])){
	if(isset($_POST["get_seleted_Category"])){
		$id = $_POST["cat_id"];
		$sql = "SELECT * FROM services WHERE service_cat = '$id'";
	}
	else {
		$keyword = $_POST["keyword"];
		$sql = "SELECT * FROM services WHERE service_keywords LIKE '%$keyword%'";
	}
	
	$run_query = mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($run_query)){
			$pro_id    = $row['service_id'];
			$pro_cat   = $row['service_cat'];
			
			$pro_title = $row['service_title'];
			$pro_price = $row['service_price'];
			$pro_image = $row['service_image'];
			echo "
				<div class='col-md-4'>
							<div class='panel panel-success'>
								<div class='panel-heading'>$pro_title</div>
								<div class='panel-body'>
									<img src='service_images/$pro_image' style='width:220px; height:250px;'/>
								</div>
								<div class='panel-heading'>$.$pro_price
								<button pid='$pro_id' style='float:right;' id='service' class='btn btn-warning'>Get the Service</button>
								</div>
							</div>
						</div>	
			";
		}
	}
	


	if(isset($_POST["addToCart"])){
		

		$p_id = $_POST["proId"];
		

		if(isset($_SESSION["uid"])){

		$user_id = $_SESSION["uid"];

		$sql = "SELECT * FROM cart WHERE p_id = '$p_id' AND user_id = '$user_id'";
		$run_query = mysqli_query($con,$sql);
		$count = mysqli_num_rows($run_query);
		if($count > 0){
			echo "
				<div class='alert alert-warning'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Services is already added into the list, get more fliers and pay..!</b>
				</div>
			";//not in video
		} else {
			$sql = "INSERT INTO `cart`
			(`p_id`, `ip_add`, `user_id`, `qty`) 
			VALUES ('$p_id','$ip_add','$user_id','1')";
			if(mysqli_query($con,$sql)){
				echo "
					<div class='alert alert-success'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Service is Added..!</b>
					</div>
				";
			}
		}
		}else{
			$sql = "SELECT id FROM cart WHERE ip_add = '$ip_add' AND p_id = '$p_id' AND user_id = -1";
			$query = mysqli_query($con,$sql);
			if (mysqli_num_rows($query) > 0) {
				echo "
					<div class='alert alert-warning'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							<b>Flier sample is already added into the list, get more and pay..!</b>
					</div>";
					exit();
			}
			$sql = "INSERT INTO `cart`
			(`p_id`, `ip_add`, `user_id`, `qty`) 
			VALUES ('$p_id','$ip_add','-1','1')";
			if (mysqli_query($con,$sql)) {
				echo "
					<div class='alert alert-success'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Your Flier sample has been added to the list!</b>
					</div>
				";
				exit();
			}
			
		}
		
		
		
		
	}

//Count User cart item
if (isset($_POST["count_item"])) {
	//When user is logged in then we will count number of item in cart by using user session id
	if (isset($_SESSION["uid"])) {
		$sql = "SELECT COUNT(*) AS count_item FROM cart WHERE user_id = $_SESSION[uid]";
	}else{
		//When user is not logged in then we will count number of item in cart by using users unique ip address
		$sql = "SELECT COUNT(*) AS count_item FROM cart WHERE ip_add = '$ip_add' AND user_id < 0";
	}
	
	$query = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($query);
	echo $row["count_item"];
	exit();
}
//Count User cart item

//Get Cart Item From Database to Dropdown menu
if (isset($_POST["Common"])) {

	if (isset($_SESSION["uid"])) {
		//When user is logged in this query will execute
		$sql = "SELECT a.service_id,a.service_title,a.service_price,a.service_image,b.id,b.qty FROM services a,cart b WHERE a.service_id=b.p_id AND b.user_id='$_SESSION[uid]'";
	}else{
		//When user is not logged in this query will execute
		$sql = "SELECT a.service_id,a.service_title,a.service_price,a.service_image,b.id,b.qty FROM services a,cart b WHERE a.service_id=b.p_id AND b.ip_add='$ip_add' AND b.user_id < 0";
	}
	$query = mysqli_query($con,$sql);
	if (isset($_POST["getCartItem"])) {
		//display cart item in dropdown menu
		if (mysqli_num_rows($query) > 0) {
			$n=0;
			while ($row=mysqli_fetch_array($query)) {
				$n++;
				$service_id = $row["service_id"];
				$service_title = $row["service_title"];
				$service_price = $row["service_price"];
				$service_image = $row["service_image"];
				$cart_item_id = $row["id"];
				$qty = $row["qty"];
				echo '
					<div class="row">
						<div class="col-md-3">'.$n.'</div>
						<div class="col-md-3"><img class="img-responsive" src="service_images/'.$service_image.'" /></div>
						<div class="col-md-3">'.$service_title.'</div>
						<div class="col-md-3">'.CURRENCY.''.$service_price.'</div>
					</div>';
				
			}
			?>
				<a style="float:right;" href="cart.php" class="btn btn-info">Edit&nbsp;&nbsp;<span class="glyphicon glyphicon-edit"></span></a>
			<?php
			exit();
		}
	}
	if (isset($_POST["checkOutDetails"])) {
		if (mysqli_num_rows($query) > 0) {
			//display user cart item with "Ready to checkout" button if user is not login
			echo "<form method='post' action='login_form.php'>";
				$n=0;
				while ($row=mysqli_fetch_array($query)) {
					$n++;
					$service_id = $row["service_id"];
					$service_title = $row["service_title"];
					$service_price = $row["service_price"];
					$service_image = $row["service_image"];
					$cart_item_id = $row["id"];
					$qty = $row["qty"];

					echo 
						'<div class="row">
								<div class="col-md-2">
									<div class="btn-group">
										<a href="#" remove_id="'.$service_id.'" class="btn btn-danger remove"><span class="glyphicon glyphicon-trash"></span></a>
									</div>
								</div>
								<input type="hidden" name="service_id[]" value="'.$service_id.'"/>
								<input type="hidden" name="" value="'.$cart_item_id.'"/>
								<div class="col-md-2"><img class="img-responsive" src="service_images/'.$service_image.'"></div>
								<div class="col-md-2">'.$service_title.'</div>
								<div class="col-md-2"><input type="text" class="form-control qty" value="'.$qty.'" ></div>
								<div class="col-md-2"><input type="text" class="form-control price" value="'.$service_price.'" readonly="readonly"></div>
								<div class="col-md-2"><input type="text" class="form-control total" value="'.$service_price.'" readonly="readonly"></div>
							</div>';
				}
				
				echo '<div class="row">
							<div class="col-md-8"></div>
							<div class="col-md-4">
								<b class="net_total" style="font-size:20px;"> </b>
					</div>';
				if (!isset($_SESSION["uid"])) {
					echo '<input type="submit" style="float:right;" name="login_user_with_service" class="btn btn-success btn-lg" value="Ready to Checkout" >
							</form>';
					
				}else if(isset($_SESSION["uid"])){
					//Paypal checkout form
					echo '
						</form>
						<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
							<input type="hidden" name="cmd" value="_cart">
							<input type="hidden" name="business" value="shoppingcart@ecommerceastro.com">
							<input type="hidden" name="upload" value="1">';
							  
							$x=0;
							$sql = "SELECT a.service_id,a.service_title,a.service_price,a.service_image,b.id,b.qty FROM services a,cart b WHERE a.service_id=b.p_id AND b.user_id='$_SESSION[uid]'";
							$query = mysqli_query($con,$sql);
							while($row=mysqli_fetch_array($query)){
								$x++;
								echo  	
									'<input type="hidden" name="item_name_'.$x.'" value="'.$row["service_title"].'">
								  	 <input type="hidden" name="item_number_'.$x.'" value="'.$x.'">
								     <input type="hidden" name="amount_'.$x.'" value="'.$row["service_price"].'">
								     <input type="hidden" name="quantity_'.$x.'" value="'.$row["qty"].'">';
								}
							  
							echo   
								'<input type="hidden" name="return" value="http://localhost/finalproject/payment_success.php"/>
					                <input type="hidden" name="notify_url" value="http://localhost/finalproject/payment_success.php">
									<input type="hidden" name="cancel_return" value="http://localhost/finalproject/cancel.php"/>
									<input type="hidden" name="currency_code" value="USD"/>
									<input type="hidden" name="custom" value="'.$_SESSION["uid"].'"/>
									<input style="float:right;margin-right:80px;" type="image" name="submit"
										src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/blue-rect-paypalcheckout-60px.png" alt="PayPal Checkout"
										alt="PayPal - The safer, easier way to pay online">
								</form>';
				}
			}
	}
	
	
}

//Remove Item From cart
if (isset($_POST["removeItemFromCart"])) {
	$remove_id = $_POST["rid"];
	if (isset($_SESSION["uid"])) {
		$sql = "DELETE FROM cart WHERE p_id = '$remove_id' AND user_id = '$_SESSION[uid]'";
	}else{
		$sql = "DELETE FROM cart WHERE p_id = '$remove_id' AND ip_add = '$ip_add'";
	}
	if(mysqli_query($con,$sql)){
		echo "<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Flier is removed from the list</b>
				</div>";
		exit();
	}
}


//Update Item From cart
if (isset($_POST["updateCartItem"])) {
	$update_id = $_POST["update_id"];
	$qty = $_POST["qty"];
	if (isset($_SESSION["uid"])) {
		$sql = "UPDATE cart SET qty='$qty' WHERE p_id = '$update_id' AND user_id = '$_SESSION[uid]'";
	}else{
		$sql = "UPDATE cart SET qty='$qty' WHERE p_id = '$update_id' AND ip_add = '$ip_add'";
	}
	if(mysqli_query($con,$sql)){
		echo "<div class='alert alert-success'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>service is updated</b>
				</div>";
		exit();
	}
}




?>






