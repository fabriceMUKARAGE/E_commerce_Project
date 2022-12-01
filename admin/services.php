<?php session_start(); ?>
<?php include_once("./templates/top.php"); ?>
<?php include_once("./templates/navbar.php"); ?>
<div class="container-fluid">
  <div class="row">
    
    <?php include "./templates/sidebar.php"; ?>

      <div class="row">
      	<div class="col-10">
      		<h2>Fliers List</h2>
      	</div>
      	<div class="col-2">
      		<a href="#" data-toggle="modal" data-target="#add_service_modal" class="btn btn-success btn-sm">Add Service</a>
      	</div>
      </div>
      
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Image</th>
              <th>Price</th>
              <th>Template type</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="service_list">

          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>



<!-- Add service Modal start -->
<div class="modal fade" id="add_service_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add-service-form" enctype="multipart/form-data">
        	<div class="row">
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Service Name</label>
		        		<input type="text" name="service_name" class="form-control" placeholder="Enter service Name">
		        	</div>
        		</div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Category Name</label>
		        		<select class="form-control category_list" name="category_id">
		        			<option value="">Select template type</option>
		        		</select>
		        	</div>
        		</div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Service Description</label>
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
		        		<label>service Keywords <small>(eg: Ads, workshop, Advertizing)</small></label>
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
        			<button type="button" class="btn btn-success add-service">Add Service</button>
        		</div>
        	</div>
        	
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Add service Modal end -->

<!-- Edit service Modal start -->
<div class="modal fade" id="edit_service_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit-service-form" enctype="multipart/form-data">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label>Service Name</label>
                <input type="text" name="e_service_name" class="form-control" placeholder="Enter service Name">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Category Name</label>
                <select class="form-control category_list" name="e_category_id">
                  <option value="">Select Category</option>
                </select>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Service Description</label>
                <textarea class="form-control" name="e_service_desc" placeholder="Enter service desc"></textarea>
              </div>
            </div>

            <div class="col-12">
              <div class="form-group">
                <label>Service Price</label>
                <input type="number" name="e_service_price" class="form-control" placeholder="Enter service Price">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Service Keywords <small>(eg: Ads, workshop, Advertizing)</small></label>
                <input type="text" name="e_service_keywords" class="form-control" placeholder="Enter service Keywords">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Service Image <small>(format: jpg, jpeg, png)</small></label>
                <input type="file" name="e_service_image" class="form-control">
                <img src="../service_images/1.0x0.jpg" class="img-fluid" width="50">
              </div>
            </div>
            <input type="hidden" name="pid">
            <input type="hidden" name="edit_service" value="1">
            <div class="col-12">
              <button type="button" class="btn btn-success submit-edit-service">Add Service</button>
            </div>
          </div>
          
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Edit service Modal end -->

<?php include_once("./templates/footer.php"); ?>



<script type="text/javascript" src="./js/services.js"></script>