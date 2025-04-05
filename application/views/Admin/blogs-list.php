<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="row">
			<div class="col-sm-4 col-3">
				<h4 class="page-title"><?=$title?></h4>
			</div>
			<div class="col-sm-8 col-9 text-right m-b-20">
				<a href="#" class="btn btn-primary btn-rounded pull-right" data-toggle="modal" data-target="#add_post" onClick="javascript:$('form#add-post')[0].reset();var validator = $( 'form#add-post' ).validate();validator.resetForm();$('form#add-post select').val('').trigger('change');"><i class="fa fa-plus"></i> 
					Add Page
				</a>
			</div>
		</div>
		<?php
			$form_attribute=array(
					'name' => 'search-post',
					'class' => '',
					'method' =>"get",
					'autocomplete'=>"off",
					'id' => 'search-post',
					'novalidate' => 'novalidate',
					);
			$hidden = array('action' => 'search-posts');
			// Form Open
			echo form_open('admin/blogs_list',$form_attribute,$hidden);
		?>						
		<div class="row filter-row">
			<div class="col-sm-4 col-md-2">
				<div class="form-group form-focus">
					<label class="focus-label">Title</label>
					<input type="text" class="form-control floating" name="serach-query" id="serach-query" value="<?=(isset($searchpagesKeyword) && !empty($searchpagesKeyword))?$searchpagesKeyword:'';?>">
				</div>
			</div>
			<div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
				<div class="form-group form-focus">
					<label class="focus-label">From</label>
					<div class="cal-icon">
						<input class="form-control floating datetimepicker" type="text" name="date_from" id="date_from" value="<?=(isset($searchuserFromKeyword) && !empty($searchuserFromKeyword))?dateFormat("d-m-Y",$searchuserFromKeyword):'';?>">
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
				<div class="form-group form-focus">
					<label class="focus-label">To</label>
					<div class="cal-icon">
						<input class="form-control floating datetimepicker" type="text" name="date_to" id="date_to" value="<?=(isset($searchuserToKeyword) && !empty($searchuserToKeyword))?dateFormat("d-m-Y",$searchuserToKeyword):'';?>">
					</div>
				</div>
			</div>
			
			<div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
				<div class="form-group form-focus select-focus">
					<label class="focus-label">Status</label>
					<select class="select floating" name="status" id="status">
						<option value="">--Select--</option>
						<option value="1" <?=(isset($statusKeyword) && !empty($statusKeyword) && $statusKeyword==1)? 'selected':'';?>>Pending</option>
						<option value="2" <?=(isset($statusKeyword) && $statusKeyword != '' && $statusKeyword==2)? 'selected':'';?>>Publish</option>
						<option value="3" <?=(isset($statusKeyword) && $statusKeyword != '' && $statusKeyword==3)? 'selected':'';?>>Draft</option>
					</select>
				</div>
			</div>
			<div class="ml-3">
				<button type="submit" class="btn btn-success"> Search </button>
				<button type="button" class="btn btn-danger" onclick="javascript:window.location.href='<?=base_url('admin/blogs_list')?>';"> Clear</button>
			</div>					
		</div>
		<?php
			// Form Close
			echo form_close(); ?>
		<?php if($this->session->flashdata('post_success')){ ?>
			<div class="alert alert-success">
				<a href="#" class="close" data-dismiss="alert">&times;</a>
				<strong>Success!</strong> <?php echo $this->session->flashdata('post_success'); ?>
			</div>

		<?php }else if($this->session->flashdata('post_error')){  ?>
			<div class="alert alert-danger">
				<a href="#" class="close" data-dismiss="alert">&times;</a>
				<strong>Error!</strong> <?php echo $this->session->flashdata('post_error'); ?>
			</div>
		<?php }?>
		<div class="alert-container"></div>
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-striped custom-table datatable">
						<thead>
							<tr>
								<th>Sr.No.</th>
								<th>Title</th>
								<!-- <th>Ecternal URL</th> -->
								<th>Status</th>
								<th width="15%">Date Published</th>
								<th class="text-right">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$srno=1;
							$count = 0;
							$statusArray = [1=>'Pending',2=>'Publish',3=>'Draft'];
							foreach($blogsList as $blogsList){								
							$count++;
							$class=($count % 2 == 1) ? " odd" : " even";
							?>
							<tr role="row" class="<?=$class?>">
								<td><?=$srno?></td>
								<td><?=$blogsList->blog_title?></td>
								
								<!-- <td><?=$blogsList->slug?></td> -->
								<td>
									<div class="dropdown action-label">
										<a class="btn btn-white btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										<?php 
										switch($blogsList->status){
											case 1:
											echo '<i class="fa fa-dot-circle-o text-warning"></i> Pending';
											break;
											case 2:
											echo '<i class="fa fa-dot-circle-o text-success"></i> Publish';
											break;
											case 3:
											echo '<i class="fa fa-dot-circle-o text-danger"></i> Draft';
											break;
										}
										?>
										</a>
										<div class="dropdown-menu">
											<a class="dropdown-item" href="<?=base_url('admin/post_status?do=pending&post_id='.$blogsList->id)?>"><i class="fa fa-dot-circle-o text-warning"></i> Pending</a>
											<a class="dropdown-item" href="<?=base_url('admin/post_status?do=publish&post_id='.$blogsList->id)?>"><i class="fa fa-dot-circle-o text-success"></i> Publish</a>
											<a class="dropdown-item" href="<?=base_url('admin/post_status?do=draft&post_id='.$blogsList->id)?>"><i class="fa fa-dot-circle-o text-danger"></i> Draft</a>
										</div>
									</div>
								</td>
								<td><?=$blogsList->created_at?></td>
								<td class="text-right">
									<div class="dropdown dropdown-action">
										<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
										<div class="dropdown-menu dropdown-menu-right">
											<a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#edit_post" onClick="getEditData(<?=$blogsList->id?>);"><i class="fa fa-pencil m-r-5"></i> Edit</a>
											<a class="dropdown-item delete-post" href="javascript:void(0);" id="<?=$blogsList->id?>" data-toggle="modal" data-target="#delete_post"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
										</div>
									</div>
								</td>
							</tr>
							<?php $srno++; } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="add_post" class="modal custom-modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<div class="modal-content modal-lg" style="width:100%">
			<div class="modal-header">
				<h4 class="modal-title">Add Blog</h4>
			</div>
			<div class="modal-body">
				<div class="m-b-30">
					<?php
						$form_attribute=array(
								'name' => 'add-post',
								'class' => 'form-horizontal',
								'method'=>"post",
								'id' => 'add-post',
								'novalidate' => 'novalidate',
								);
						$hidden = array('action' => 'addBlog');
						// Form Open
						echo form_open_multipart('admin/add_blog',$form_attribute,$hidden);
					?>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">Blog Title <span class="text-danger">*</span></label>
								<input class="form-control required" type="text" name="blog_title" id="blog_title">
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">External URL <span class="text-danger">*</span></label>
								<input class="form-control required" type="text" name="slug" id="slug" >
							</div>							
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">Blog Image<span class="text-danger">*</span></label>
								<input class="form-control" type="file" name="blog_img">
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">Blog Description <span class="text-danger">*</span></label>
								<textarea class="form-control required" name="blog_description" id="blog_description"></textarea>
							</div>
						</div>	
						<div class="col-sm-12">
							<div class="form-group">
								<label class="display-block control-label">Blog Status <span class="text-danger">*</span></label>
								<div class="form-check form-check-inline">
									<input class="form-check-input required" type="radio" name="status" id="post_pending" value="1" checked>
									<label class="form-check-label" for="post_pending">Pending</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input required" type="radio" name="status" id="post_publish" value="2">
									<label class="form-check-label" for="post_publish">Publish</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input required" type="radio" name="status" id="post_draft" value="3">
									<label class="form-check-label" for="post_draft">Draft</label>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label">Date <span class="text-danger">*</span></label>
								<input class="form-control required" type="text" name="date" id="date">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label">State <span class="text-danger">*</span></label>
								<input class="form-control required" type="text" name="state" id="state">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label">Country<span class="text-danger">*</span></label>
								<input class="form-control required" type="text" name="country" id="country">
							</div>
						</div>
					</div>
					<div class="col-sm-7">								
						<div class="m-t-20">
							<button class="btn btn-primary btn-lg" type="submit">Create Blog</button>
						</div>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="edit_post" class="modal custom-modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<div class="modal-content modal-lg" style="width:100%">
			<div class="modal-header">
				<h4 class="modal-title">Edit Page</h4>
			</div>
			<div class="modal-body">
				<div class="m-b-30">
					<?php
						$form_attribute=array(
								'name' => 'edit-post',
								'class' => 'form-horizontal',
								'method'=>"post",
								'id' => 'edit-post',
								'novalidate' => 'novalidate',
								);
						$hidden = array('action' => 'editBlog','id'=>'');
						// Form Open
						echo form_open_multipart('admin/add_blog',$form_attribute,$hidden);
						?>
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">Blog Title <span class="text-danger">*</span></label>
									<input class="form-control required" type="text" name="blog_title" id="blog_title">
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">External URL<span class="text-danger">*</span></label>
									<input class="form-control required" type="text" name="slug" id="slug" >
								</div>							
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Blog Image<span class="text-danger">*</span></label>
									<input class="form-control" type="file" name="blog_img">
								</div>
							</div>
							<div class="col-md-6">
								<label>Blog Image</label><br>
								<img src="" id="blog_image" name="blog_image" width="120px">

							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">Blog Description <span class="text-danger">*</span></label>
									<textarea class="form-control required" name="blog_description" id="blog_description"></textarea>
								</div>
							</div>	
							<div class="col-sm-12">
								<div class="form-group">
									<label class="display-block control-label">Blog Status <span class="text-danger">*</span></label>
									<div class="form-check form-check-inline">
										<input class="form-check-input required" type="radio" name="status" id="post_pending" value="1" checked>
										<label class="form-check-label" for="post_pending">Pending</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input required" type="radio" name="status" id="post_publish" value="2">
										<label class="form-check-label" for="post_publish">Publish</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input required" type="radio" name="status" id="post_draft" value="3">
										<label class="form-check-label" for="post_draft">Draft</label>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label class="control-label">Date <span class="text-danger">*</span></label>
									<input class="form-control required" type="text" name="date" id="date">
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label class="control-label">State <span class="text-danger">*</span></label>
									<input class="form-control required" type="text" name="state" id="state">
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label class="control-label">Country<span class="text-danger">*</span></label>
									<input class="form-control required" type="text" name="country" id="country">
								</div>
							</div>
						</div>
						<div class="col-sm-7">								
							<div class="m-t-20">
								<button class="btn btn-primary btn-lg" type="submit">Save Changes</button>
							</div>
						</div>
					<?php
					// Form Close
					echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="delete_post" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content modal-md">
			<div class="modal-header">
				<h4 class="modal-title">Delete Page</h4>
			</div>
			<div class="modal-body card-box">
				<?php
				$form_attribute=array(
						'name' => 'delete-post',
						'class' => 'form-horizontal',
						'method'=>"post",
						'id' => 'delete-post',
						'novalidate' => 'novalidate',
						);
				$hidden = array('action' => 'deleteBlog','post_id'=>'');
				//Form Open
				echo form_open('admin/add_blog',$form_attribute,$hidden);
				?>
				<p><input type="checkbox" id="delete_check"> Do you want to delete the page now with his related table data? This cannot be undone.</p>
				<div class="m-t-20"> <a href="javascript:void(0);" class="btn btn-white" data-dismiss="modal">Close</a>						   
					<button type="submit" class="btn btn-danger">Delete</button>							
				</div>
			</div>
			<?php
			// Form Close
			echo form_close(); ?>
		</div>
	</div>
</div>
<script>
 	document.getElementById('delete-post').addEventListener('submit', function (event) {
        var deleteCheck = document.getElementById('delete_check');
        if (!deleteCheck.checked) {
            event.preventDefault();
            alert('Please confirm that you want to delete this page by checking the box.');
        }
    });
	$.validator.addMethod("checkPostTypeLength", function(value, element, param) {
		var len1 = $('form#'+param+' #post_display_order').val().length;
		var len2 = $('form#'+param+' #post_type').val().length;
		//alert(len2 +'==='+ len1+'======'+param);
		return len2 === len1;
	}, "Length should be same as Post Type!");
	$.validator.addMethod("checkEditPostNameAvailable", 
		function(value, element) {
				var result = false;
				post_id=$("form[name=edit-post] input[name='id']").val();
				$.ajax({
					type:"POST",
					async: false,
					dataType:"json",
					url: BASE_URL+"ajax/ajaxProcess", // script to validate in server side
					data : "post_name="+value+"&request=check-post-name&action=edit-post&post_id="+post_id,
					success: function(data) {
						//console.log(data);
						//$("form#edit-post #slug").val(data.slug);
						//return false;
						result = (data.dataContent== "0") ? true : false;
					}
				});
				// return true if SHOW NAME is exist in database
				return result; 
			}, 
			"This Post Title is already taken! Try another."
	);

	$.validator.addMethod("checkPostNameAvailable", 
		function(value, element) {
			var result = false;
			$.ajax({
				type:"POST",
				async: false,
				dataType:"json",
				url: BASE_URL+"ajax/ajaxProcess", // script to validate in server side
				data : "post_name="+value+"&request=check-post-name&action=add-post",
				success: function(data) {
					console.log(data);
				//	$("form#add-post #slug").val(data.slug);
					//return false;
					result = (data.dataContent== "0") ? true : false;
				}
			});
			// return true if SHOW NAME is exist in database
			return result; 
		}, 
		"This Post Title is already taken! Try another."
	);
	/*----------- BEGIN validate CODE -------------------------*/
	$('#add-post').validate({
		rules: {
			"page_title": {
				required: true,
				checkPostNameAvailable: true
			}
		},
		errorPlacement: function (error, element) {
			if (element.attr("name") == "category_id[]"){
				$("span[id^=catID-errorMsg]").html(error);
			}else {
				error.insertAfter(element);
			}
		}
	});
	$('#edit-post').validate({
		rules: {
			"page_title": {
				required: true,
				checkEditPostNameAvailable: true
			}
		},
		errorPlacement: function (error, element) {
			if (element.attr("name") == "category_id[]"){
				$("span[id^=catID-errorMsg]").html(error);
			}else {
				error.insertAfter(element);
			}
		}
	});

	function getEditData(post_id){
		var closeButton = '<span class="close-btn" style="position: absolute; top: 19px; left: 128px; font-size: 13px; font-weight: bold; color: #fff; background: #f62d51; border-radius: 50%; padding: 2px 4px; cursor: pointer;">x</span>';

		var validator = $( "form#edit-post" ).validate();
		validator.resetForm();

		var dataString="request=edit_blog_data&post_id="+post_id;
		//alert(dataString);
		//return false;
		jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>" + "ajax/ajaxProcess",
			dataType: 'json',
			data: dataString,
			success: function(res) {
				console.log(res.dataContent);
				//return false;
				if (res.dataContent)
				{
					if(res.dataContent != ''){
						$("form[name=edit-post] input[name='id']").val(res.dataContent.id);
						$("form[name=edit-post] #blog_title").val(res.dataContent.blog_title);
						$("form[name=edit-post] #slug").val(res.dataContent.slug);
						$("form[name=edit-post] #blog_description").val(res.dataContent.blog_description);
						$("form[name=edit-post] input[name=status][value='"+res.dataContent.status+"']").prop("checked",true).trigger('change');
						$("form[name=edit-post] #date").val(res.dataContent.date);
						$("form[name=edit-post] #state").val(res.dataContent.state);
						$("form[name=edit-post] #country").val(res.dataContent.country);
						var img_src1 = '../assets/img/placeholder.jpg';
						if (res.dataContent.blog_image) {
							img_src1 = '../uploads/blog_images/' + res.dataContent.blog_image;
							if ($("#blog_image").prev(".close-btn").length === 0) {
								$("#blog_image").before(closeButton);

							}
						}
						$("form[name=edit-post] img#blog_image").prop('src', img_src1);
						$("#blog_image").attr("data-db_name", "blog_image");
					}else if (res.dataContent == ''){
						console.log(res);
					}
				}
			}
		});
	}
	//delete slider
	$("body").on('click','.delete-post',function(event) {
		event.preventDefault();
		var stringArrayId=$(this).prop("id");
		if(stringArrayId > 0){
			$("form[name=delete-post] input[name='post_id']").val(stringArrayId);
		}
		//alert(stringArrayId);	
	});

</script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>

$(document).ready(function () {
    $("#date").datepicker({
        dateFormat: "yy-mm-dd",  // Format: YYYY-MM-DD
        changeMonth: true,
        changeYear: true,
        yearRange: "1900:2100"   // Customize range if needed
    });
	$(document).on("click", ".close-btn", function () {
	var post_id=$("form[name=edit-post] input[name='id']").val();
	var parentDiv = $(this).closest(".row");
	var fileInput = parentDiv.find('input[type="file"]');
	var inputName = fileInput.attr("name");

	var image = parentDiv.find("img");
	var dbName = image.attr("data-db_name");

	var data = {
		id: post_id,
		tag: "blog",
		image_name: "blog_image",
		dbName: "blogs"
	};

	var closeBtn = $(this); // Save reference to clicked button

	$.ajax({
		url: "<?php echo base_url('admin/delete_image'); ?>",
		type: "POST",
		data: data,
		dataType: "json",
		success: function (response) {
			if (response.status == 'success') {
				var alertHtml = `
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>Success!</strong> ${response.message}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				`;

				// Append alert somewhere in your DOM
				// Example: inside a div with id="alert-container"
				$(".alert-container").html(alertHtml);

				closeBtn.remove(); // Correct context
				$('#edit_post').modal('hide');
				// getEditData();
			}
			console.log("Image removed:", response);
		},
		error: function (xhr) {
			console.log("Error:", xhr.responseText);
		}
	});
});
});

</script>