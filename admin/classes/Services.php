<?php 
session_start();

class services
{
	
	private $con;

	function __construct()
	{
		include_once("Database.php");
		$db = new Database();
		$this->con = $db->connect();
	}

	public function getservices(){
		$q = $this->con->query("SELECT p.service_id, p.service_title, p.service_price, p.service_desc, p.service_image, p.service_keywords, c.cat_title, c.cat_id FROM services p JOIN categories c ON c.cat_id = p.service_cat");
		
		$services = [];
		if ($q->num_rows > 0) {
			while($row = $q->fetch_assoc()){
				$services[] = $row;
			}
			//return ['status'=> 202, 'message'=> $ar];
			$_DATA['services'] = $services;
		}

		$categories = [];
		$q = $this->con->query("SELECT * FROM categories");
		if ($q->num_rows > 0) {
			while($row = $q->fetch_assoc()){
				$categories[] = $row;
			}
			//return ['status'=> 202, 'message'=> $ar];
			$_DATA['categories'] = $categories;
		}



		return ['status'=> 202, 'message'=> $_DATA];
	}

	public function addservice($service_name,
								
								$category_id,
								$service_desc,
								
								$service_price,
								$service_keywords,
								$file){


		$fileName = $file['name'];
		$fileNameAr= explode(".", $fileName);
		$extension = end($fileNameAr);
		$ext = strtolower($extension);

		if ($ext == "jpg" || $ext == "jpeg" || $ext == "png") {
			

			if ($file['size'] > (1024 * 2)) {
				
				$uniqueImageName = time()."_".$file['name'];
				if (move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/final_exam/service_images/".$uniqueImageName)) {
					
					$q = $this->con->query("INSERT INTO `services`(`service_cat`, `service_title`, `service_price`, `service_desc`, `service_image`, `service_keywords`) VALUES ('$category_id', '$service_name', '$service_price', '$service_desc', '$uniqueImageName', '$service_keywords')");

					if ($q) {
						return ['status'=> 202, 'message'=> 'service Added Successfully..!'];
						
					}else{
						return ['status'=> 303, 'message'=> 'Failed to run query'];
					}

				}else{
					return ['status'=> 303, 'message'=> 'Failed to upload image'];
				}

			}else{
				return ['status'=> 303, 'message'=> 'Large Image ,Max Size allowed 2MB'];
			}

		}else{
			return ['status'=> 303, 'message'=> 'Invalid Image Format [Valid Formats : jpg, jpeg, png]'];
		}

	}


	public function editserviceWithImage($pid,
										$service_name,
										
										$category_id,
										$service_desc,
									
										$service_price,
										$service_keywords,
										$file){


		$fileName = $file['name'];
		$fileNameAr= explode(".", $fileName);
		$extension = end($fileNameAr);
		$ext = strtolower($extension);

		if ($ext == "jpg" || $ext == "jpeg" || $ext == "png") {
			

			if ($file['size'] > (1024 * 2)) {
				
				$uniqueImageName = time()."_".$file['name'];
				if (move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/ecommerce-app-h/service_images/".$uniqueImageName)) {
					
					$q = $this->con->query("UPDATE `services` SET 
										`service_cat` = '$category_id', 
										`service_title` = '$service_name', 
										`service_price` = '$service_price', 
										`service_desc` = '$service_desc', 
										`service_image` = '$uniqueImageName', 
										`service_keywords` = '$service_keywords'
										WHERE service_id = '$pid'");

					if ($q) {
						return ['status'=> 202, 'message'=> 'service Modified Successfully..!'];
					}else{
						return ['status'=> 303, 'message'=> 'Failed to run query'];
					}

				}else{
					return ['status'=> 303, 'message'=> 'Failed to upload image'];
				}

			}else{
				return ['status'=> 303, 'message'=> 'Large Image ,Max Size allowed 2MB'];
			}

		}else{
			return ['status'=> 303, 'message'=> 'Invalid Image Format [Valid Formats : jpg, jpeg, png]'];
		}

	}

	public function editserviceWithoutImage($pid,
										$service_name,
										$category_id,
										$service_desc,				
										$service_price,
										$service_keywords){

		if ($pid != null) {
			$q = $this->con->query("UPDATE `services` SET 
										`service_cat` = '$category_id', 										
										`service_title` = '$service_name', 										
										`service_price` = '$service_price', 
										`service_desc` = '$service_desc',
										`service_keywords` = '$service_keywords'
										WHERE service_id = '$pid'");

			if ($q) {
				return ['status'=> 202, 'message'=> 'service updated Successfully'];
			}else{
				return ['status'=> 303, 'message'=> 'Failed to run query'];
			}
			
		}else{
			return ['status'=> 303, 'message'=> 'Invalid service id'];
		}
		
	}




	public function addCategory($name){
		$q = $this->con->query("SELECT * FROM categories WHERE cat_title = '$name' LIMIT 1");
		if ($q->num_rows > 0) {
			return ['status'=> 303, 'message'=> 'Category already exists'];
		}else{
			$q = $this->con->query("INSERT INTO categories (cat_title) VALUES ('$name')");
			if ($q) {
				return ['status'=> 202, 'message'=> 'New Category added Successfully'];
			}else{
				return ['status'=> 303, 'message'=> 'Failed to run query'];
			}
		}
	}

	public function getCategories(){
		$q = $this->con->query("SELECT * FROM categories");
		$ar = [];
		if ($q->num_rows > 0) {
			while ($row = $q->fetch_assoc()) {
				$ar[] = $row;
			}
		}
		return ['status'=> 202, 'message'=> $ar];
	}

	public function deleteservice($pid = null){
		if ($pid != null) {
			$q = $this->con->query("DELETE FROM services WHERE service_id = '$pid'");
			if ($q) {
				return ['status'=> 202, 'message'=> 'service removed from stocks'];
			}else{
				return ['status'=> 202, 'message'=> 'Failed to run query'];
			}
			
		}else{
			return ['status'=> 303, 'message'=>'Invalid service id'];
		}

	}

	public function deleteCategory($cid = null){
		if ($cid != null) {
			$q = $this->con->query("DELETE FROM categories WHERE cat_id = '$cid'");
			if ($q) {
				return ['status'=> 202, 'message'=> 'Category removed'];
			}else{
				return ['status'=> 202, 'message'=> 'Failed to run query'];
			}
			
		}else{
			return ['status'=> 303, 'message'=>'Invalid cattegory id'];
		}

	}
	
	

	public function updateCategory($post = null){
		extract($post);
		if (!empty($cat_id) && !empty($e_cat_title)) {
			$q = $this->con->query("UPDATE categories SET cat_title = '$e_cat_title' WHERE cat_id = '$cat_id'");
			if ($q) {
				return ['status'=> 202, 'message'=> 'Category updated'];
			}else{
				return ['status'=> 202, 'message'=> 'Failed to run query'];
			}
			
		}else{
			return ['status'=> 303, 'message'=>'Invalid category id'];
		}

	}


	

}


if (isset($_POST['GET_service'])) {
	if (isset($_SESSION['admin_id'])) {
		$p = new services();
		echo json_encode($p->getservices());
		exit();
	}
}


if (isset($_POST['add_service'])) {

	extract($_POST);
	if (!empty($service_name) 
	&& !empty($category_id)
	&& !empty($service_desc)
	&& !empty($service_price)
	&& !empty($service_keywords)
	&& !empty($_FILES['service_image']['name'])) {
		

		$p = new services();
		$result = $p->addservice($service_name,								
								$category_id,
								$service_desc,							
								$service_price,
								$service_keywords,
								$_FILES['service_image']);
		
		header("Content-type: application/json");
		echo json_encode($result);
		http_response_code($result['status']);
		exit();


	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Empty fields']);
		exit();
	}



	
}


if (isset($_POST['edit_service'])) {

	extract($_POST);
	if (!empty($pid)
	&& !empty($e_service_name) 
	
	&& !empty($e_category_id)
	&& !empty($e_service_desc)

	&& !empty($e_service_price)
	&& !empty($e_service_keywords) ) {
		
		$p = new services();

		if (isset($_FILES['e_service_image']['name']) 
			&& !empty($_FILES['e_service_image']['name'])) {
			$result = $p->editserviceWithImage($pid,
								$e_service_name,								
								$e_category_id,
								$e_service_desc,							
								$e_service_price,
								$e_service_keywords,
								$_FILES['e_service_image']);
		}else{
			$result = $p->editserviceWithoutImage($pid,
								$e_service_name,								
								$e_category_id,
								$e_service_desc,							
								$e_service_price,
								$e_service_keywords);
		}

		echo json_encode($result);
		exit();


	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Empty fields']);
		exit();
	}



	
}


if (isset($_POST['add_category'])) {
	if (isset($_SESSION['admin_id'])) {
		$cat_title = $_POST['cat_title'];
		if (!empty($cat_title)) {
			$p = new services();
			echo json_encode($p->addCategory($cat_title));
		}else{
			echo json_encode(['status'=> 303, 'message'=> 'Empty fields']);
		}
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Session Error']);
	}
}

if (isset($_POST['GET_CATEGORIES'])) {
	$p = new services();
	echo json_encode($p->getCategories());
	exit();
	
}

if (isset($_POST['DELETE_service'])) {
	$p = new services();
	if (isset($_SESSION['admin_id'])) {
		if(!empty($_POST['pid'])){
			$pid = $_POST['pid'];
			echo json_encode($p->deleteservice($pid));
			exit();
		}else{
			echo json_encode(['status'=> 303, 'message'=> 'Invalid service id']);
			exit();
		}
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Invalid Session']);
	}


}


if (isset($_POST['DELETE_CATEGORY'])) {
	if (!empty($_POST['cid'])) {
		$p = new services();
		echo json_encode($p->deleteCategory($_POST['cid']));
		exit();
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Invalid details']);
		exit();
	}
}

if (isset($_POST['edit_category'])) {
	if (!empty($_POST['cat_id'])) {
		$p = new services();
		echo json_encode($p->updateCategory($_POST));
		exit();
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Invalid details']);
		exit();
	}
}

?>