<?php session_start(); ?>
<?php include_once("./templates/top.php"); ?>
<?php include_once("./templates/navbar.php"); ?>
<div class="container-fluid">
  <div class="row">
    
    <?php include "./templates/sidebar.php"; ?>

      <div class="row">
      	<div class="col-10">
      		<h2>Customers</h2>
      	</div>
      </div>
      
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Order #</th>
              <th>service Id</th>
              <th>service Name</th>
              <th>Number of fliers requested</th>
              <th>Payment Status</th>
            </tr>
          </thead>
          <tbody id="customer_order_list">
           
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="add_service_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add-service-form" enctype="multipart/form-data">
        	<div class="row">
        		<div class="col-12">
        			<div class="form-group">
		        		<label>service Name</label>
		        		<input type="text" name="service_name" class="form-control" placeholder="Enter service Name">
		        	</div>
        		</div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Brand Name</label>
		        		<select class="form-control brand_list" name="brand_id">
		        			<option value="">Select Brand</option>
		        		</select>
		        	</div>
        		</div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Category Name</label>
		        		<select class="form-control category_list" name="category_id">
		        			<option value="">Select Category</option>
		        		</select>
		        	</div>
        		</div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>service Description</label>
		        		<textarea class="form-control" name="service_desc" placeholder="Enter service desc"></textarea>
		        	</div>
        		</div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>service Price</label>
		        		<input type="number" name="service_price" class="form-control" placeholder="Enter service Price">
		        	</div>
        		</div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>service Keywords <small>(eg: apple, iphone, mobile)</small></label>
		        		<input type="text" name="service_keywords" class="form-control" placeholder="Enter service Keywords">
		        	</div>
        		</div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>service Image <small>(format: jpg, jpeg, png)</small></label>
		        		<input type="file" name="service_image" class="form-control">
		        	</div>
        		</div>
        		<input type="hidden" name="add_service" value="1">
        		<div class="col-12">
        			<button type="button" class="btn btn-primary add-service">Add service</button>
        		</div>
        	</div>
        	
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->

<?php include_once("./templates/footer.php"); ?>



<script type="text/javascript" src="./js/customers.js"></script>