<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="row">
			<div class="col-sm-4 col-3">
				<h4 class="page-title"><?=$title?></h4>
			</div>
			<div class="col-sm-8 col-9 text-right m-b-20">
				<a href="<?=base_url('admin/manage_category')?>" class="btn btn-primary btn-rounded pull-right" ><i class="fa fa-plus"></i> 
					Add Category
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
			echo form_open('admin/category_list',$form_attribute,$hidden);
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
				<button type="button" class="btn btn-danger" onclick="javascript:window.location.href='<?=base_url('admin/category_list')?>';"> Clear</button>
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
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-striped custom-table datatable">
						<thead>
							<tr>
								<th>Sr.No.</th>
								<th>Title</th>
								<th>Slug</th>
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
							foreach($categoryList as $categoryList){								
							$count++;
							$class=($count % 2 == 1) ? " odd" : " even";
							?>
							<tr role="row" class="<?=$class?>">
								<td><?=$srno?></td>
								<td><?=$categoryList->page_title?></td>
								<td><?=$categoryList->slug?></td>
								<td>
									<div class="dropdown action-label">
										<a class="btn btn-white btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										<?php 
										switch($categoryList->status){
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
											<a class="dropdown-item" href="<?=base_url('admin/post_status?do=pending&post_id='.$categoryList->id)?>"><i class="fa fa-dot-circle-o text-warning"></i> Pending</a>
											<a class="dropdown-item" href="<?=base_url('admin/post_status?do=publish&post_id='.$categoryList->id)?>"><i class="fa fa-dot-circle-o text-success"></i> Publish</a>
											<a class="dropdown-item" href="<?=base_url('admin/post_status?do=draft&post_id='.$categoryList->id)?>"><i class="fa fa-dot-circle-o text-danger"></i> Draft</a>
										</div>
									</div>
								</td>
								<td><?=$categoryList->created_at?></td>
								<td class="text-right">
									<div class="dropdown dropdown-action">
										<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
										<div class="dropdown-menu dropdown-menu-right">
											<a class="dropdown-item" href="manage_category/<?=$categoryList->id?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
											<a class="dropdown-item delete-post" href="javascript:void(0);" id="<?=$categoryList->id?>" data-toggle="modal" data-target="#delete_post"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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

<div id="delete_post" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content modal-md">
			<div class="modal-header">
				<h4 class="modal-title">Delete Category</h4>
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
				$hidden = array('tag' => 'deleteCategory','post_id'=>'','type'=>'category');
				//Form Open
				echo form_open('admin/add_home_page',$form_attribute,$hidden);
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
    document.addEventListener("DOMContentLoaded", function() {
        const deleteForm = document.getElementById('delete-post');
        if (deleteForm) {
            deleteForm.addEventListener('submit', function(event) {
                var deleteCheck = document.getElementById('delete_check');
                if (!deleteCheck.checked) {
                    event.preventDefault();
                    alert('Please confirm that you want to delete this page by checking the box.');
                }
            });
        }
    });

$(document).ready(function() {
	$("body").on('click','.delete-post',function(event) {
		event.preventDefault();
		var stringArrayId=$(this).prop("id");
		if(stringArrayId > 0){
			$("form[name=delete-post] input[name='post_id']").val(stringArrayId);
		}
		//alert(stringArrayId);	
	});
});
</script>