<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="row">
			<div class="col-sm-4 col-3">
				<h4 class="page-title"><?=$title?></h4>
			</div>
			<div class="col-sm-8 col-9 text-right m-b-20">
				<a href="<?=base_url('admin/manage_course')?>" class="btn btn-primary btn-rounded pull-right" ><i class="fa fa-plus"></i> 
					Add course
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
			echo form_open('admin/courses_list',$form_attribute,$hidden);
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
				<button type="button" class="btn btn-danger" onclick="javascript:window.location.href='<?=base_url('admin/courses_list')?>';"> Clear</button>
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
							foreach($courseList as $courseList){								
							$count++;
							$class=($count % 2 == 1) ? " odd" : " even";
							?>
							<tr role="row" class="<?=$class?>">
								<td><?=$srno?></td>
								<td><?=$courseList->page_title?></td>
								<td><?=$courseList->slug?></td>
								<td>
									<div class="dropdown action-label">
										<a class="btn btn-white btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										<?php 
										switch($courseList->status){
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
											<a class="dropdown-item" href="<?=base_url('admin/post_status?do=pending&post_id='.$courseList->id)?>"><i class="fa fa-dot-circle-o text-warning"></i> Pending</a>
											<a class="dropdown-item" href="<?=base_url('admin/post_status?do=publish&post_id='.$courseList->id)?>"><i class="fa fa-dot-circle-o text-success"></i> Publish</a>
											<a class="dropdown-item" href="<?=base_url('admin/post_status?do=draft&post_id='.$courseList->id)?>"><i class="fa fa-dot-circle-o text-danger"></i> Draft</a>
										</div>
									</div>
								</td>
								<td><?=$courseList->created_at?></td>
								<td class="text-right">
									<div class="dropdown dropdown-action">
										<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
										<div class="dropdown-menu dropdown-menu-right">
											<a class="dropdown-item" href="manage_course/<?=$courseList->id?>" ><i class="fa fa-pencil m-r-5"></i> Edit</a>
											<a class="dropdown-item delete-post" href="javascript:void(0);" id="<?=$courseList->id?>" data-toggle="modal" data-target="#delete_post"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
								'name' => 'edit-course',
								'class' => 'form-horizontal',
								'method'=>"post",
								'id' => 'edit-course',
								'novalidate' => 'novalidate',
								);
							$hidden = array('action' => 'editCourse','id'=>'');
							echo form_open_multipart('admin/add_Course',$form_attribute,$hidden);
							?>
							<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">Banner heading <span class="text-danger">*</span></label>
									<input class="form-control required" type="text" name="banner_heading" id="banner_heading">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Banner Image <span class="text-danger">*</span></label>
									<input class="form-control" type="file" name="banner_img" id="banner_img" >
								</div>							
							</div>
							<div class="col-md-6">
									<label>Banner Image</label>
									<img src="" id="banner_image" name="banner_image" width="120px">
								</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">Content <span class="text-danger">*</span></label>
									<textarea class="form-control required" name="content" id="content"></textarea>

								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Students Counts <span class="text-danger">*</span></label>
									<input class="form-control required" type="text" name="stu_count" id="stu_count">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Lesson Counts <span class="text-danger">*</span></label>
									<input class="form-control required" type="text" name="lesson_count" id="lesson_count">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Rating Counts <span class="text-danger">*</span></label>
									<input class="form-control required" type="text" name="rating_count" id="rating_count">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Videos Counts <span class="text-danger">*</span></label>
									<input class="form-control required" type="text" name="videos_count" id="videos_count">
								</div>
							</div>
						</div>
							<div class="col-sm-7">								
								<div class="m-t-20">
									<button class="btn btn-primary btn-lg" type="submit">Save Changes</button>
								</div>
							</div>
						<?php echo form_close(); ?>
					</div>

					<div class="m-b-30">
						<h3>OUR USP's</h3>
						<?php
							$form_attribute=array(
								'name' => 'edit-usps',
								'class' => 'form-horizontal',
								'method'=>"post",
								'id' => 'edit-usps',
								'novalidate' => 'novalidate',
								);
							$hidden = array('action' => 'editusps','id'=>'');
							echo form_open_multipart('admin/add_usps',$form_attribute,$hidden);
							?>
							<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">USP's Main Heading <span class="text-danger">*</span></label>
									<input class="form-control required" type="text" name="usp_heading" id="usp_heading">
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">USP's Heading 1<span class="text-danger">*</span></label>
									<input class="form-control required" type="text" name="usp_heading1" id="usp_heading1">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">USP's Image 1<span class="text-danger">*</span></label>
									<input class="form-control" type="file" name="usp_img1" id="usp_img1" >
								</div>							
							</div>
							<div class="col-md-6">
									<label>USP's Image 1</label>
									<img src="" id="usp_image1" name="usp_image1" width="120px">
								</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">Content 1<span class="text-danger">*</span></label>
									<textarea class="form-control required" name="content1" id="content1"></textarea>

								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">USP's Heading 2<span class="text-danger">*</span></label>
									<input class="form-control required" type="text" name="usp_heading2" id="usp_heading2">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">USP's Image 2<span class="text-danger">*</span></label>
									<input class="form-control" type="file" name="usp_img2" id="usp_img2" >
								</div>							
							</div>
							<div class="col-md-6">
									<label>USP's Image 2</label>
									<img src="" id="usp_image2" name="usp_image2" width="120px">
								</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">Content 2<span class="text-danger">*</span></label>
									<textarea class="form-control required" name="content2" id="content2"></textarea>

								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">USP's Heading 3<span class="text-danger">*</span></label>
									<input class="form-control required" type="text" name="usp_heading3" id="usp_heading3">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">USP's Image 3<span class="text-danger">*</span></label>
									<input class="form-control" type="file" name="usp_img3" id="usp_img3" >
								</div>							
							</div>
							<div class="col-md-6">
									<label>USP's Image 3</label>
									<img src="" id="usp_image3" name="usp_image3" width="120px">
								</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">Content 3<span class="text-danger">*</span></label>
									<textarea class="form-control required" name="content3" id="content3"></textarea>

								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">USP's Heading 4<span class="text-danger">*</span></label>
									<input class="form-control required" type="text" name="usp_heading4" id="usp_heading4">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">USP's Image 4<span class="text-danger">*</span></label>
									<input class="form-control" type="file" name="usp_img4" id="usp_img4" >
								</div>							
							</div>
							<div class="col-md-6">
									<label>USP's Image 4</label>
									<img src="" id="usp_image4" name="usp_image4" width="120px">
								</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">Content 4<span class="text-danger">*</span></label>
									<textarea class="form-control required" name="content4" id="content4"></textarea>

								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">USP's Heading 5<span class="text-danger">*</span></label>
									<input class="form-control required" type="text" name="usp_heading5" id="usp_heading5">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">USP's Image 5<span class="text-danger">*</span></label>
									<input class="form-control" type="file" name="usp_img5" id="usp_img5" >
								</div>							
							</div>
							<div class="col-md-6">
									<label>USP's Image 5</label>
									<img src="" id="usp_image5" name="usp_image5" width="120px">
								</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">Content 5<span class="text-danger">*</span></label>
									<textarea class="form-control required" name="content5" id="content5"></textarea>

								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">USP's Heading 6<span class="text-danger">*</span></label>
									<input class="form-control required" type="text" name="usp_heading6" id="usp_heading6">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">USP's Image 6<span class="text-danger">*</span></label>
									<input class="form-control" type="file" name="usp_img6" id="usp_img6" >
								</div>							
							</div>
							<div class="col-md-6">
									<label>USP's Image 6</label>
									<img src="" id="usp_image6" name="usp_image6" width="120px">
								</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">Content 6<span class="text-danger">*</span></label>
									<textarea class="form-control required" name="content6" id="content6"></textarea>

								</div>
							</div>
							
						</div>
							<div class="col-sm-7">								
								<div class="m-t-20">
									<button class="btn btn-primary btn-lg" type="submit">Save Changes</button>
								</div>
							</div>
						<?php echo form_close(); ?>
					</div>

					<div class="m-b-30">
						<h3>Modes</h3>
						<?php
							$form_attribute=array(
								'name' => 'edit-modes',
								'class' => 'form-horizontal',
								'method'=>"post",
								'id' => 'edit-modes',
								'novalidate' => 'novalidate',
								);
							$hidden = array('action' => 'editmodes','id'=>'');
							echo form_open_multipart('admin/add_modes',$form_attribute,$hidden);
							?>
							<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">Modes Main Heading <span class="text-danger">*</span></label>
									<input class="form-control required" type="text" name="mode_heading" id="mode_heading">
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">Modes Heading 1<span class="text-danger">*</span></label>
									<input class="form-control required" type="text" name="mode_heading1" id="mode_heading1">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Modes Image 1<span class="text-danger">*</span></label>
									<input class="form-control" type="file" name="mode_img1" id="mode_img1" >
								</div>							
							</div>
							<div class="col-md-6">
									<label>Modes Image 1</label>
									<img src="" id="mode_image1" name="mode_image1" width="120px">
								</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">Mode Content 1<span class="text-danger">*</span></label>
									<textarea class="form-control required" name="mode_content1" id="mode_content1"></textarea>

								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">Modes Heading 2<span class="text-danger">*</span></label>
									<input class="form-control required" type="text" name="mode_heading2" id="mode_heading2">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Modes Image 2<span class="text-danger">*</span></label>
									<input class="form-control" type="file" name="mode_img2" id="mode_img2" >
								</div>							
							</div>
							<div class="col-md-6">
									<label>Modes Image 2</label>
									<img src="" id="mode_image2" name="mode_image2" width="120px">
								</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">Mode Content 2<span class="text-danger">*</span></label>
									<textarea class="form-control required" name="mode_content2" id="mode_content2"></textarea>

								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">Modes Heading 3<span class="text-danger">*</span></label>
									<input class="form-control required" type="text" name="mode_heading3" id="mode_heading3">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Modes Image 3<span class="text-danger">*</span></label>
									<input class="form-control" type="file" name="mode_img3" id="mode_img3" >
								</div>							
							</div>
							<div class="col-md-6">
									<label>Modes Image 3</label>
									<img src="" id="mode_image3" name="mode_image3" width="120px">
								</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">Mode Content 3<span class="text-danger">*</span></label>
									<textarea class="form-control required" name="mode_content3" id="mode_content3"></textarea>

								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">Modes Heading 4<span class="text-danger">*</span></label>
									<input class="form-control required" type="text" name="mode_heading4" id="mode_heading4">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Modes Image 4<span class="text-danger">*</span></label>
									<input class="form-control" type="file" name="mode_img4" id="mode_img4" >
								</div>							
							</div>
							<div class="col-md-6">
									<label>Modes Image 4</label>
									<img src="" id="mode_image4" name="mode_image4" width="120px">
								</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">Mode Content 4<span class="text-danger">*</span></label>
									<textarea class="form-control required" name="mode_content4" id="mode_content4"></textarea>

								</div>
							</div>
						</div>
						<div class="col-sm-7">								
							<div class="m-t-20">
								<button class="btn btn-primary btn-lg" type="submit">Save Changes</button>
							</div>
						</div>
						<?php echo form_close(); ?>
					</div>






					<div class="m-b-30">
						<h3>Testimonial</h3>
						<?php
						$form_attribute = array(
							'name' => 'edit-testimonial',
							'class' => 'form-horizontal',
							'method' => "post",
							'id' => 'edit-testimonial',
							'novalidate' => 'novalidate',
						);
						$hidden = array('action' => 'edittestimonial', 'id' =>'');
						echo form_open_multipart('admin/add_testimonial', $form_attribute, $hidden);
						?>

						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">Testimonial Main Heading <span class="text-danger">*</span></label>
									<input class="form-control required" type="text" name="testimonal_main_heading" id="testimonal_main_heading">
								</div>
							</div>
						</div>

						<div id="testimonial-container"></div>

						<button type="button" id="add-testimonial" class="btn btn-success">Add More</button>

						<div class="col-sm-7">
							<div class="m-t-20">
								<button class="btn btn-primary btn-lg" type="submit">Save Changes</button>
							</div>
						</div>

						<?php echo form_close(); ?>
					</div>

					<div class="m-b-30">
						<h3>FAQ</h3>
						<?php
						$form_attribute = array(
							'name' => 'edit-FAQ',
							'class' => 'form-horizontal',
							'method' => "post",
							'id' => 'edit-FAQ',
							'novalidate' => 'novalidate',
						);
						$hidden = array('action' => 'editFAQ', 'id' =>'');
						echo form_open_multipart('admin/add_FAQ', $form_attribute, $hidden);
						?>

						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">FAQ Main Heading <span class="text-danger">*</span></label>
									<input class="form-control required" type="text" name="faq_main_heading" id="faq_main_heading">
								</div>
							</div>
						</div>

						<div id="FAQ-container"></div>

						<button type="button" id="add-FAQ" class="btn btn-success">Add More</button>

						<div class="col-sm-7">
							<div class="m-t-20">
								<button class="btn btn-primary btn-lg" type="submit">Save Changes</button>
							</div>
						</div>

						<?php echo form_close(); ?>
					</div>




				</div>
			</div>
		</div>
	</div>

<div id="delete_post" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content modal-md">
			<div class="modal-header">
				<h4 class="modal-title">Delete Course</h4>
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
				$hidden = array('tag' => 'deleteCourse','post_id'=>'','type'=>'course');
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
        if ($("#add-post").length) {
            $("#add-post").validate({
                rules: {
                    "banner_heading": { required: true }
                },
                errorPlacement: function(error, element) {
                    if (element.attr("name") == "category_id[]") {
                        $("span[id^=catID-errorMsg]").html(error);
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
        }
        if ($("#edit-course").length) {
            $("#edit-course").validate({
                rules: {
                    "banner_heading": { required: true }
                },
                errorPlacement: function(error, element) {
                    if (element.attr("name") == "category_id[]") {
                        $("span[id^=catID-errorMsg]").html(error);
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
        }
    });
    function getEditData(post_id) {
		console.log(post_id);
        var editForm = $("form#edit-course");
        if (editForm.length) {
            var validator = editForm.validate();
            validator.resetForm();
        } else {
            console.error("Edit form not found");
            return;
        }
        var dataString = "request=edit_course_data&post_id=" + post_id;
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "ajax/ajaxProcess",
            dataType: 'json',
            data: dataString,
            success: function(res) {
				console.log(res);
				$("form[name=edit-course] input[name='id']").val(res.id);
				$("form[name=edit-usps] input[name='id']").val(res.id);
				$("form[name=edit-modes] input[name='id']").val(res.id);
				$("form[name=edit-testimonial] input[name='id']").val(res.id);
				$("form[name=edit-FAQ] input[name='id']").val(res.id);
                if (res.dataContent) {
					if(res.dataContent.banner){
						var banner = JSON.parse(res.dataContent.banner);
						$("form[name=edit-course] #banner_heading").val(banner.banner_heading);
						$("form[name=edit-course] #content").val(banner.content);
						$("form[name=edit-course] #stu_count").val(banner.stu_count);
						$("form[name=edit-course] #lesson_count").val(banner.lesson_count);
						$("form[name=edit-course] #rating_count").val(banner.rating_count);
						$("form[name=edit-course] #videos_count").val(banner.videos_count);
						var img_src = 'uploads/no-image100x100.jpg';
						if (banner.banner_img) {
							img_src = '../uploads/course_images/' + banner.banner_img;
						}
						$("form[name=edit-course] img#banner_image").prop('src', img_src);
					}
					if(res.dataContent.usps){
						var usps = JSON.parse(res.dataContent.usps);
						$("form[name=edit-usps] #usp_heading").val(usps.usp_heading);
						$("form[name=edit-usps] #usp_heading1").val(usps.usp_heading1);
						$("form[name=edit-usps] #content1").val(usps.content1);
						$("form[name=edit-usps] #usp_heading2").val(usps.usp_heading2);
						$("form[name=edit-usps] #content2").val(usps.content2);
						$("form[name=edit-usps] #usp_heading3").val(usps.usp_heading3);
						$("form[name=edit-usps] #content3").val(usps.content3);
						$("form[name=edit-usps] #usp_heading4").val(usps.usp_heading4);
						$("form[name=edit-usps] #content4").val(usps.content4);
						$("form[name=edit-usps] #usp_heading5").val(usps.usp_heading5);
						$("form[name=edit-usps] #content5").val(usps.content5);
						$("form[name=edit-usps] #usp_heading6").val(usps.usp_heading6);
						$("form[name=edit-usps] #content6").val(usps.content6);
						var img_src1 = 'uploads/no-image100x100.jpg';
						if (usps.usp_img1) {
							img_src1 = '../uploads/course_images/' + usps.usp_img1;
						}
						$("form[name=edit-usps] img#usp_image1").prop('src', img_src1);
						var img_src2 = 'uploads/no-image100x100.jpg';
						if (usps.usp_img2) {
							img_src2 = '../uploads/course_images/' + usps.usp_img2;
						}
						$("form[name=edit-usps] img#usp_image2").prop('src', img_src2);
						var img_src3 = 'uploads/no-image100x100.jpg';
						if (usps.usp_img3) {
							img_src3 = '../uploads/course_images/' + usps.usp_img3;
						}
						$("form[name=edit-usps] img#usp_image3").prop('src', img_src3);
						var img_src4 = 'uploads/no-image100x100.jpg';
						if (usps.usp_img4) {
							img_src4 = '../uploads/course_images/' + usps.usp_img4;
						}
						$("form[name=edit-usps] img#usp_image4").prop('src', img_src4);
						var img_src5 = 'uploads/no-image100x100.jpg';
						if (usps.usp_img5) {
							img_src5 = '../uploads/course_images/' + usps.usp_img5;
						}
						$("form[name=edit-usps] img#usp_image5").prop('src', img_src5);
						var img_src6 = 'uploads/no-image100x100.jpg';
						if (usps.usp_img6) {
							img_src6 = '../uploads/course_images/' + usps.usp_img6;
						}
						$("form[name=edit-usps] img#usp_image6").prop('src', img_src6);
					}

					if(res.dataContent.modes){
						var mode = JSON.parse(res.dataContent.modes);
						$("form[name=edit-modes] #mode_heading").val(mode.mode_heading);
						$("form[name=edit-modes] #mode_heading1").val(mode.mode_heading1);
						$("form[name=edit-modes] #mode_content1").val(mode.mode_content1);
						$("form[name=edit-modes] #mode_heading2").val(mode.mode_heading2);
						$("form[name=edit-modes] #mode_content2").val(mode.mode_content2);
						$("form[name=edit-modes] #mode_heading3").val(mode.mode_heading3);
						$("form[name=edit-modes] #mode_content3").val(mode.mode_content3);
						$("form[name=edit-modes] #mode_heading4").val(mode.mode_heading4);
						$("form[name=edit-modes] #mode_content4").val(mode.mode_content4);
						var img_src1 = 'uploads/no-image100x100.jpg';
						if (mode.mode_img1) {
							img_src1 = '../uploads/course_images/' + mode.mode_img1;
						}
						$("form[name=edit-modes] img#mode_image1").prop('src', img_src1);
						var img_src2 = 'uploads/no-image100x100.jpg';
						if (mode.mode_img2) {
							img_src2 = '../uploads/course_images/' + mode.mode_img2;
						}
						$("form[name=edit-modes] img#mode_image2").prop('src', img_src2);
						var img_src3 = 'uploads/no-image100x100.jpg';
						if (mode.mode_img3) {
							img_src3 = '../uploads/course_images/' + mode.mode_img3;
						}
						$("form[name=edit-modes] img#mode_image3").prop('src', img_src3);
						var img_src4 = 'uploads/no-image100x100.jpg';
						if (mode.mode_img4) {
							img_src4 = '../uploads/course_images/' + mode.mode_img4;
						}
						$("form[name=edit-modes] img#mode_image4").prop('src', img_src4);
					}

					if (res.dataContent.testimonials) {
						var parsedData = JSON.parse(res.dataContent.testimonials);

						// Check if parsedData contains main heading and testimonial array
						if (parsedData.testimonal_main_heading) {
							$("form[name=edit-testimonial] #testimonal_main_heading").val(parsedData.testimonal_main_heading);
						}

						if (parsedData.testimonials && parsedData.testimonials.length > 0) {
							var form = $("form[name=edit-testimonial]");
							form.find("#testimonial-container").empty(); // Clear previous testimonials

							$.each(parsedData.testimonials, function (index, testimonial) {
								var newTestimonial = `
									<div class="testimonial-section card px-3">
										<div class="d-flex justify-content-end p-3 row">
											<button type="button" class="btn btn-danger remove-section">Remove</button>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<div class="form-group">
													<label class="control-label">Testimonial Heading<span class="text-danger">*</span></label>
													<input class="form-control required" type="text" name="testimonal_heading[]" value="${testimonial.heading}">
												</div>    
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">Testimonial Image<span class="text-danger">*</span></label>
													<input class="form-control" type="file" name="testimonal_img[]">
												</div>
											</div>
											<div class="col-md-6">
												<label>Testimonial Image</label>
												<img src="<?= base_url('uploads/testimonial_images/') ?>${testimonial.image}" width="120px">
											</div>
											<div class="col-sm-12">
												<div class="form-group">
													<label class="control-label">Mode Content<span class="text-danger">*</span></label>
													<textarea class="form-control required" name="testimonal_content[]">${testimonial.content}</textarea>
												</div>
											</div>
										</div>
									</div>
								`;
								form.find("#testimonial-container").append(newTestimonial);
							});
						}
					}
					
					if (res.dataContent.faqs) {
						var parsedData = JSON.parse(res.dataContent.faqs);

						// Check if parsedData contains main heading and FAQ array
						if (parsedData.faq_main_heading) {
							$("form[name=edit-FAQ] #faq_main_heading").val(parsedData.faq_main_heading);
						}

						if (parsedData.FAQs && parsedData.FAQs.length > 0) {
							var form = $("form[name=edit-FAQ]");
							form.find("#FAQ-container").empty(); // Clear previous FAQs

							$.each(parsedData.FAQs, function (index, faq) {
								var newFAQ = `
									<div class="FAQ-section card px-3">
										<div class="d-flex justify-content-end p-3 row">
											<button type="button" class="btn btn-danger remove-section">Remove</button>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<div class="form-group">
													<label class="control-label">Question<span class="text-danger">*</span></label>
													<input class="form-control required" type="text" name="FAQ_Q[]" value="${faq.question}">
												</div>    
											</div>
											<div class="col-sm-12">
												<div class="form-group">
													<label class="control-label">Answer<span class="text-danger">*</span></label>
													<textarea class="form-control required" name="FAQ_A[]">${faq.answer}</textarea>
												</div>
											</div>
										</div>
									</div>
								`;
								form.find("#FAQ-container").append(newFAQ);
							});
						}
					}

				
				
				
				}
            }
        });
    }

   
</script>
<script>

$(document).ready(function() {
	$("body").on('click','.delete-post',function(event) {
		event.preventDefault();
		var stringArrayId=$(this).prop("id");
		if(stringArrayId > 0){
			$("form[name=delete-post] input[name='post_id']").val(stringArrayId);
		}
		//alert(stringArrayId);	
	});

	$("#add-FAQ").click(function() {
        var newTestimonial = `
            <div class="FAQ-section card px-3" >
				<div class="d-flex justify-content-end p-3 row">
					<button type="button" class="btn btn-danger remove-section">Remove</button>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<label class="control-label">Question<span class="text-danger">*</span></label>
							<input class="form-control required" type="text" name="FAQ_Q[]">
						</div>	
					</div>
					<div class="col-sm-12">
						<div class="form-group">
							<label class="control-label">Answer<span class="text-danger">*</span></label>
							<textarea class="form-control required" name="FAQ_A[]"></textarea>
						</div>
					</div>
				</div>
			</div>
        `;
        $("#FAQ-container").append(newTestimonial);
    });

    $(document).on("click", ".remove-section", function() {
        $(this).closest(".FAQ-section").remove();
    });



    $("#add-testimonial").click(function() {
        var newTestimonial = `
            <div class="testimonial-section card px-3" >
				<div class="d-flex justify-content-end p-3 row">
					<button type="button" class="btn btn-danger remove-section">Remove</button>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<label class="control-label">Testimonial Heading<span class="text-danger">*</span></label>
							<input class="form-control required" type="text" name="testimonal_heading[]">
						</div>	
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="control-label">Testimonial Image<span class="text-danger">*</span></label>
							<input class="form-control" type="file" name="testimonal_img[]">
						</div>
					</div>
					<div class="col-md-6">
						<label>Testimonial Image</label>
						<img src="" width="120px">
					</div>
					<div class="col-sm-12">
						<div class="form-group">
							<label class="control-label">Mode Content<span class="text-danger">*</span></label>
							<textarea class="form-control required" name="testimonal_content[]"></textarea>
						</div>
					</div>
				</div>
			</div>
        `;
        $("#testimonial-container").append(newTestimonial);
    });

    $(document).on("click", ".remove-section", function() {
        $(this).closest(".testimonial-section").remove();
    });
});
</script>