$(document).ready(function(){

	var serviceList;

	function getservices(){
		$.ajax({
			url : '../admin/classes/Services.php',
			method : 'POST',
			data : {GET_service:1},
			success : function(response){
				//console.log(response);
				var resp = $.parseJSON(response);
				if (resp.status == 202) {

					var serviceHTML = '';

					serviceList = resp.message.services;

					if (serviceList) {
						$.each(resp.message.services, function(index, value){

							serviceHTML += '<tr>'+
								              '<td>'+''+'</td>'+
								              '<td>'+ value.service_title +'</td>'+
								              '<td><img width="60" height="60" src="../service_images/'+value.service_image+'"></td>'+
								              '<td>'+ value.service_price +'</td>'+
								
								              '<td>'+ value.cat_title +'</td>'+
								              '<td><a class="btn btn-sm btn-success edit-service" style="color:#fff;"><span style="display:none;">'+JSON.stringify(value)+'</span><i class="fas fa-pencil-alt"></i></a>&nbsp;<a pid="'+value.service_id+'" class="btn btn-sm btn-danger delete-service" style="color:#fff;"><i class="fas fa-trash-alt"></i></a></td>'+
								            '</tr>';

						});

						$("#service_list").html(serviceHTML);
					}

					


					var catSelectHTML = '<option value="">Select Category</option>';
					$.each(resp.message.categories, function(index, value){

						catSelectHTML += '<option value="'+ value.cat_id +'">'+ value.cat_title +'</option>';

					});


				}
			}

		});
	}

	getservices();

	$(".add-service").on("click", function(){

		$.ajax({

			url : '../admin/classes/Services.php',
			method : 'POST',
			data : new FormData($("#add-service-form")[0]),
			contentType : false,
			cache : false,
			processData : false,
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					$("#add-service-form").trigger("reset");
					$("#add_service_modal").modal('hide');
					getservices();
					// window.location.href = "index.php";
					//window.location = '../admin/classes/Services.php';
				}else if(resp.status == 303){
					// window.location.href = "Services.php";
					alert(resp.message);
					
				}
			}

		});

	});


	$(document.body).on('click', '.edit-service', function(){

		console.log($(this).find('span').text());

		var service = $.parseJSON($.trim($(this).find('span').text()));

		console.log(service);

		$("input[name='e_service_name']").val(service.service_title);
		$("select[name='e_category_id']").val(service.cat_id);
		$("textarea[name='e_service_desc']").val(service.service_desc);
		$("input[name='e_service_price']").val(service.service_price);
		$("input[name='e_service_keywords']").val(service.service_keywords);
		$("input[name='e_service_image']").siblings("img").attr("src", "../service_images/"+service.service_image);
		$("input[name='pid']").val(service.service_id);
		$("#edit_service_modal").modal('show');

	});

	$(".submit-edit-service").on('click', function(){

		$.ajax({

			url : '../admin/classes/Services.php',
			method : 'POST',
			data : new FormData($("#edit-service-form")[0]),
			contentType : false,
			cache : false,
			processData : false,
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					$("#edit-service-form").trigger("reset");
					$("#edit_service_modal").modal('hide');
					getservices();
					alert(resp.message);
					window.location.href = "Services.php";
				}else if(resp.status == 303){
					alert(resp.message);
				}
			}

		});


	});

	$(document.body).on('click', '.delete-service', function(){

		var pid = $(this).attr('pid');
		if (confirm("Are you sure to delete this item ?")) {
			$.ajax({

				url : '../admin/classes/Services.php',
				method : 'POST',
				data : {DELETE_service: 1, pid:pid},
				success : function(response){
					console.log(response);
					var resp = $.parseJSON(response);
					if (resp.status == 202) {
						getservices();
					}else if (resp.status == 303) {
						alert(resp.message);
					}
				}

			});
		}else{
			alert('Cancelled');
		}
		

	});

});