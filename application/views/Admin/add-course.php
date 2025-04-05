<?php
// print_r($this->session->userdata()); die;
?>
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="row">
			<div class="col-sm-4 col-3">
				<h4 class="page-title"><?=$title?></h4>
			</div>
			<div class="col-sm-8 col-9 text-right m-b-20">
				<a href="<?php echo base_url(); ?>admin/courses_list" class="btn btn-primary btn-rounded pull-right" ><i class="fa fa-arrow-left"></i> 
					Course List
				</a>
			</div>
		</div>
		<div class="alert-container"></div> 
		<div class="row">
			<div class="col-md-12">
				<div class="m-b-30">
					<form id="create-page" method="post">
						<input type="hidden" class="post_id" name="post_id" value="<?=(isset($post_id) ? $post_id : '')?>">
						<div class="row mb-3">
							<div class="col-md-6">
								<label for="page_title" class="form-label">Page Title <span class="text-danger">*</span></label>
								<input type="text" class="form-control" id="page_title" name="page_title" required>
							</div>
							<div class="col-md-6">
								<label for="slug" class="form-label">Page URL Last Path <span class="text-danger">*</span></label>
								<input type="text" class="form-control" id="slug" required name="slug">
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-md-12">
								<label for="category" class="form-label">Category <span class="text-danger">*</span></label>
								<select id="category_select" name="categories[]" multiple placeholder="Select Category" style="width: 100%" class="form-control"> 
									<?php foreach ($categoryList as $category): ?>
										<option value="<?php echo htmlspecialchars($category->id); ?>">
											<?php echo htmlspecialchars($category->page_title); ?>
										</option>
									<?php endforeach; ?>
								</select>

							</div>
						</div>
						
						<div class="row mb-3">
							<div class="col-md-6">
								<label class="form-label">Page Status</label>
								<div>
									<input type="radio" name="status" value="1" checked> Pending
									<input type="radio" name="status" value="2"> Publish
									<input type="radio" name="status" value="3"> Draft
								</div>
							</div>
							<div class="col-md-6">
							<label class="form-label">Details</label>
								<div class="ml-4">
									<input type="checkbox" class="form-check-input" id="isDetail"  name="isDetail" >
									<label class="form-check-label" for="isDetail">Show Details </label>
								</div>	
							</div>	
						</div>	
						
						<button type="submit" class="btn btn-primary">Create Page</button>
					</form>
				</div>
				<div class="showHide" style="display: none;">
					<div class="m-b-30">
						<form id="add-banner" method="post" enctype="multipart/form-data">
						<input type="hidden" class="post_id" name="post_id">
							<div class="mb-3">
								<label for="banner_heading" class="form-label">Banner Heading <span class="text-danger">*</span></label>
								<input type="text" class="form-control" id="banner_heading" name="banner_heading" required>
							</div>
							<div class="mb-3 row ">
								<div class="col-md-6">
									<label for="banner_img" class="form-label">Banner Image</label>
									<input type="file" class="form-control" id="banner_img" name="banner_img">
								</div>
								<div class="col-md-6">
									<label>Preview</label><br>
									<img src="" id="banner_image" name="banner_image" width="120px">
								</div>
							</div>
							<div class="mb-3">
								<label for="banner_content" class="form-label">Banner Content </label>
								<textarea class="form-control" id="banner_content" name="banner_content" ></textarea>
							</div>
							<div class="row">
								<div class="col-md-4 mb-3">
									<label for="duration" class="form-label">Duration</label>
									<input type="number" class="form-control" id="duration" name="duration">
								</div>
								<div class="col-md-4 mb-3">
									<label for="language" class="form-label">Language </label>
									<input type="text" class="form-control" id="language" name="language">
								</div>
								<div class="col-md-4 mb-3">
									<label for="start_date" class="form-label">Start Date </label>
									<input type="text" class="form-control" id="start_date" name="start_date">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 mb-3">
									<label for="price" class="form-label">Price </label>
									<input type="number" class="form-control" id="price" name="price">
								</div>
								<div class="col-md-6 mb-3">
									<label for="btn_url" class="form-label">Videos Count </label>
									<input type="text" class="form-control" id="btn_url" name="btn_url">
								</div>
							</div>
							<button type="submit" class="btn btn-primary">Save Changes</button>
						</form>
					</div>
					<div class="m-b-30">
						<h3>INFO</h3>
						<form id="add-info" method="post" name="info_form"enctype="multipart/form-data">
							<input type="hidden" class="post_id" name="post_id">
							<div class="row">
								<div class="col-md-6 mb-3">
									<label for="name" class="form-label">Name</label>
									<input type="text" class="form-control" id="name" name="name" required>
								</div>
								<div class="col-md-6 mb-3">
									<label for="email" class="form-label">Email</label>
									<input type="email" class="form-control" id="email" name="email" required>
								</div>
								<div class="col-md-6 mb-3">
									<label for="phone_no" class="form-label">Phone No.</label>
									<input type="text" class="form-control" id="phone_no" name="phone_no" required>
								</div>
								<div class="col-md-6 mb-3">
									<label for="email2" class="form-label">Email 2</label>
									<input type="email" class="form-control" id="email2" name="email2" required>
								</div>
							</div>
								<div class="mb-3 row ">
									<div class="col-md-6">
										<label for="info_img" class="form-label">INFO Image</label>
										<input type="file" class="form-control" id="info_img" name="info_img">
									</div>
									<div class="col-md-6">
										<label>Preview</label>
										<img src="" id="info_image" name="info_image" width="120px">
									</div>
								</div>
								<div class="mb-3 row ">
									<div class="col-md-6">
										<label for="info_file" class="form-label">INFO File</label>
										<input type="file" class="form-control" id="info_file" name="info_file">
									</div>
									<div class="col-md-6">
										<label>Preview</label>
										<embed id="info_file" src="" width="100%" type="application/pdf" height="100px" >

										<!-- <img src="" id="info_file" name="info_file" width="120px"> -->
									</div>
								</div>
							<button type="submit" class="btn btn-primary">Save Changes</button>
						</form>
					</div>
					<div class="m-b-30">    
						<h3>About Course</h3>
						<form id="add_about" enctype="multipart/form-data">
							<input type="hidden" class="post_id" name="post_id">
							<div class="form-group">
								<label>About Heading <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="about_heading" id="about_heading" required>
							</div>
							<div class="form-group">
								<label>About Content</label>
								<textarea id="about_content_editor" name="about_content"></textarea>
							</div>
							<div class="form-group">
								<label>About Button Url</label>
								<input type="text" class="form-control" name="about_btn_url" id="about_btn_url">
							</div>
							<button type="submit" class="btn btn-primary mt-3">Save Changes</button>
						</form>
					</div>    
					<div class="m-b-30">    
						<h3>Audience profile</h3>
						<form id="add_audience_profile" enctype="multipart/form-data">
							<input type="hidden" class="post_id" name="post_id">
							<div class="form-group">
								<label>Audience Profile Heading <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="ap_heading" id="ap_heading" required>
							</div>
							<div class="form-group">
								<label>Audience Profile Content</label>
								<textarea id="ap_content_editor" name="ap_content"></textarea>
							</div>
							<div class="form-group">
								<label>Audience Profile Button Url</label>
								<input type="text" class="form-control" name="ap_btn_url" id="ap_btn_url">
							</div>
							<button type="submit" class="btn btn-primary mt-3">Save Changes</button>
						</form>
					</div> 
					<div class="m-b-30">    
						<h3>Program Deliveriables</h3>
						<form id="add_pd" enctype="multipart/form-data">
							<input type="hidden" class="post_id" name="post_id">
							<div class="form-group">
								<label>Program Deliveriables Heading <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="pd_heading" id="pd_heading" required>
							</div>
							<div class="form-group">
								<label>Program Deliveriables Content</label>
								<textarea id="pd_editor" name="pd_content"></textarea>
							</div>
							<div class="form-group">
								<label>Program Deliveriables Button Url</label>
								<input type="text" class="form-control" name="pd_btn_url" id="pd_btn_url">
							</div>
							<button type="submit" class="btn btn-primary mt-3">Save Changes</button>
						</form>
					</div>    
					<div class="m-b-30">    
						<h3>Course Outline</h3>
						<form id="add_co" enctype="multipart/form-data">
							<input type="hidden" class="post_id" name="post_id">
							<div class="form-group">
								<label>Course Outline Heading <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="co_heading" id="co_heading" required>
							</div>
							<div class="form-group">
								<label>Course Outline Content</label>
								<textarea id="co_editor"  name="co_content"></textarea>
							</div>
							<div class="form-group">
								<label>Course Outline Button Url</label>
								<input type="text" class="form-control" name="co_btn_url" id="co_btn_url">
							</div>
							<button type="submit" class="btn btn-primary mt-3">Save Changes</button>
						</form>
					</div>
					<div class="m-b-30">    
						<h3>Program Outcomes</h3>
						<form id="add_po" enctype="multipart/form-data">
							<input type="hidden" class="post_id" name="post_id">
							<div class="form-group">
								<label>Program Outcomes Heading <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="po_heading" id="po_heading" required>
							</div>
							<div class="form-group">
								<label>Program Outcomes Content</label>
								<textarea id="po_editor" name="po_content"></textarea>
							</div>
							<div class="form-group">
								<label>Program Outcomes Button Url</label>
								<input type="text" class="form-control" name="po_btn_url" id="po_btn_url">
							</div>
							<button type="submit" class="btn btn-primary mt-3">Save Changes</button>
						</form>
					</div>        
					<div class="m-b-30">    
						<h3>Related Course</h3>
						<form id="add_related_course" enctype="multipart/form-data">
							<input type="hidden" class="post_id" name="post_id">
							<div class="form-group">
								<label>Course Heading <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="related_course_heading" id="related_course_heading" required>
							</div>
							<div class="form-group">
								<label for="course_select">Select Course</label> 
									<select id="course_select" name="courses[]" multiple placeholder="Select Course" style="width: 100%"class="form-control" > 
									<?php foreach ($courseList as $course): ?>
										<option value="<?php echo $course->id; ?>"><?php echo $course->page_title; ?></option>
										<?php endforeach; ?>
									</select>
							</div>
							<button type="submit" class="btn btn-primary mt-3">Save Changes</button>
						</form>
					</div> 
					<div class="m-b-30">	
						<h3>Why EY</h3>
						<form id="add-why_EY" enctype="multipart/form-data">
							<input type="hidden" class="post_id" name="post_id">
							<div class="form-group">
								<label>Why Ey Heading <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="why_ey_heading" id="why_ey_heading" required>
							</div>
							<div id="why-ey-sections">
							<?php 
								$totalwhy = 8;
								for ($i = 1; $i <= $totalwhy; $i++) { ?>
									<div class="row mb-3">
										<div class="col-md-12 mb-3">
											<label>Why EY Title <?= $i ?> </label>
											<input type="text" class="form-control" name="why_ey_title<?= $i ?>" id="why_ey_title<?= $i ?>">
										</div>
										<div class="col-md-6 mb-3">
											<label>Why EY <?= $i ?> Image </label>
											<input type="file" class="form-control why-ey-img" name="why_ey_img<?= $i ?>" id="why_ey_img<?= $i ?>" data-preview="why_ey_image<?= $i ?>">
										</div>
										<div class="col-md-6 mb-3">
											<label>Preview</label><br>
											<img src="" id="why_ey_image<?= $i ?>" class="img-preview" width="120px">
										</div>
										<div class="col-md-12 mt-2">
											<label>Why EY Content <?= $i ?> </label>
											<textarea class="form-control" name="why_ey_content<?= $i ?>" id="why_ey_content<?= $i ?>"></textarea>
										</div>
									</div>
									<hr>
								<?php } ?>
							</div>
							<button type="submit" class="btn btn-primary mt-3">Save Changes</button>
						</form>
					</div>
					<div class="m-b-30">
						<h3>Testimonals</h3>
						<form id="add-testimonials" enctype="multipart/form-data">
							<input type="hidden" class="post_id" name="post_id">
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label class="control-label">Testimonial Main Heading <span class="text-danger">*</span></label>
										<input class="form-control" type="text" name="testimonal_main_heading" id="testimonal_main_heading" required>
									</div>
								</div>
							</div>

							<div id="testimonial-container"></div>
							<div class="row">
								<div class="col-md-12">
									<button type="button" id="add-testimonial" class="btn btn-success">Add More</button>
								</div>
							</div>

							<button type="submit" class="btn btn-primary mt-3">Save Changes</button>
						</form>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>



<script>
	function getEditData(tag = '') {
    var closeButton = '<span class="close-btn" style="position: absolute; top: 19px; left: 128px; font-size: 13px; font-weight: bold; color: #fff; background: #f62d51; border-radius: 50%; padding: 2px 4px; cursor: pointer;">x</span>';
    jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>ajax/getCourse",
        dataType: 'json',
        data: { 'post_id': $('.post_id').val() },
        success: function (res) {
            if (res.dataContent[0] !== '' && res.dataContent[0] !== 'undefined') {
                var data = res.dataContent[0];
                console.log(data);
                if (data) {
                    $(".post_id").val(data.id);
                    $("#page_title").val(data.page_title);
                    $("#slug").val(data.slug);
                    $("input[name='status'][value='" + data.status + "']").prop("checked", true);

                    if (data.is_detail == 1) {
                        $('#isDetail').prop('checked', true);
                        $('.showHide').show();
                    } else {
                        $('#isDetail').prop('checked', false);
                        $('.showHide').hide();
                    }

                    if (data.banner) {
                        var banner = JSON.parse(data.banner);
                        $("#banner_heading").val(banner.banner_heading);
                        $("#banner_content").val(banner.banner_content);
                        $("#stu_count").val(banner.stu_count);
                        $("#lesson_count").val(banner.lesson_count);
                        $("#rating_count").val(banner.rating_count);
                        $("#videos_count").val(banner.videos_count);

                        var banner_src = '<?= base_url('assets/img/placeholder.jpg') ?>';
                        if (banner.banner_img) {
                            banner_src = '<?= base_url('uploads/course_images/') ?>' + banner.banner_img;
                            $("#banner_image").before(closeButton);
                        }
                        $("#banner_image").prop('src', banner_src);
                        $("#banner_image").attr("data-db_name", "banner");
                    }

                    if (data.info) {
                        var info = JSON.parse(data.info);
                        $("#name").val(info.name);
                        $("#email").val(info.email);
                        $("#phone_no").val(info.phone_no);
                        $("#email2").val(info.email2);

                        var info_src = '<?= base_url('assets/img/placeholder.jpg') ?>';
                        if (info.info_img) {
                            info_src = '<?= base_url('uploads/course_images/') ?>' + info.info_img;
                            $("#info_image").before(closeButton);
                        }
                        $("#info_image").prop('src', info_src);
                        $("#info_image").attr("data-db_name", "info");

                        var info_file_src = '<?= base_url('assets/img/placeholder.jpg') ?>';
                        if (info.info_file) {
                            info_file_src = '<?= base_url('uploads/course_images/') ?>' + info.info_file;
                        }
                        $("#info_file").prop('src', info_file_src);
                    }

                    if (data.about) {
                        var about = JSON.parse(data.about);
                        $("#about_heading").val(about.about_heading);
                        $("#about_btn_url").val(about.about_btn_url);
                        $("#about_content_editor").hasClass("summernote") ?
                            $("#about_content_editor").summernote('code', about.about_content || '') :
                            $("#about_content_editor").val(about.about_content);
                    }

                    if (data.audience_profile) {
                        var ap = JSON.parse(data.audience_profile);
                        $("#ap_heading").val(ap.ap_heading);
                        $("#ap_btn_url").val(ap.ap_btn_url);
                        $("#ap_content_editor").hasClass("summernote") ?
                            $("#ap_content_editor").summernote('code', ap.ap_content || '') :
                            $("#ap_content_editor").val(ap.ap_content);
                    }

                    if (data.program_deliveriables) {
                        var pd = JSON.parse(data.program_deliveriables);
                        $("#pd_heading").val(pd.pd_heading);
                        $("#pd_btn_url").val(pd.pd_btn_url);
                        $("#pd_editor").hasClass("summernote") ?
                            $("#pd_editor").summernote('code', pd.pd_content || '') :
                            $("#pd_editor").val(pd.pd_content);
                    }

                    if (data.course_outline) {
                        var co = JSON.parse(data.course_outline);
                        $("#co_heading").val(co.co_heading);
                        $("#co_btn_url").val(co.co_btn_url);
                        $("#co_editor").hasClass("summernote") ?
                            $("#co_editor").summernote('code', co.co_content || '') :
                            $("#co_editor").val(co.co_content);
                    }

                    if (data.program_outcomes) {
                        var po = JSON.parse(data.program_outcomes);
                        $("#po_heading").val(po.po_heading);
                        $("#po_btn_url").val(po.po_btn_url);
                        $("#po_editor").hasClass("summernote") ?
                            $("#po_editor").summernote('code', po.po_content || '') :
                            $("#po_editor").val(po.po_content);
                    }

                    if (data.related_course) {
                        var rc = JSON.parse(data.related_course);
                        $("#related_course_heading").val(rc.related_course_heading);
                        var selected_related_course = JSON.parse(rc.course_select);
                        course.setChoiceByValue(selected_related_course);
                    }

                    if (data.why_EY) {
                        var why_ey = JSON.parse(data.why_EY);
                        $("#why_ey_heading").val(why_ey.why_ey_heading);
                        for (let i = 1; i < 9; i++) {
                            $("#why_ey_title" + i).val(why_ey["why_ey_title" + i]);
                            $("#why_ey_content" + i).val(why_ey["why_ey_content" + i]);

                            var why_ey_src = '<?= base_url('assets/img/placeholder.jpg') ?>';
                            if (why_ey["why_ey_img" + i]) {
                                why_ey_src = '<?= base_url('uploads/course_images/') ?>' + why_ey["why_ey_img" + i];
                                if ($("#why_ey_image" + i).prev(".close-btn").length === 0) {
                                    $("#why_ey_image" + i).before(closeButton);
                                }
                            }
                            $("#why_ey_image" + i).prop('src', why_ey_src);
                            $("#why_ey_image" + i).attr("data-db_name", "why_EY");
                        }
                    }

                    if (data.category) {
                        var catData = JSON.parse(data.category);
                        cat.setChoiceByValue(catData);
                    }

                    if (data.testimonials) {
                        var tData = JSON.parse(data.testimonials);
                        $("#testimonal_main_heading").val(tData.testimonal_main_heading);
                        $("#testimonial-container").empty();

                        var testimonialArray = tData.testimonials;
                        var defaultImg = "<?= base_url('assets/img/placeholder.jpg') ?>";
                        var baseUrl = "<?= base_url('uploads/course_images/') ?>";

                        $.each(testimonialArray, function (index, testimonial) {
                            var src = (testimonial.image && testimonial.image !== 'null') ? baseUrl + testimonial.image : defaultImg;

                            var newTestimonial = `
                            <div class="testimonial-section card px-3">
                                <div class="d-flex justify-content-end p-3 row">
                                    <button type="button" class="btn btn-danger remove-section">Remove</button>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label">Testimonial Heading</label>
                                            <input class="form-control" type="text" name="testimonal_heading[]" value="${testimonial.heading}">
                                        </div>	
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Testimonial Image</label>
                                            <input class="form-control" type="file" name="testimonal_img[]">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Testimonial Image</label>
                                        <img src="${src}" width="120px">
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Name</label>
                                            <input class="form-control" type="text" name="testimonal_name[]" value="${testimonial.name}">
                                        </div>	
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Profession</label>
                                            <input class="form-control" type="text" name="testimonal_profession[]" value="${testimonial.profession}">
                                        </div>	
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label">Testimonial Content</label>
                                            <textarea class="form-control" name="testimonal_content[]">${testimonial.content}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                            $("#testimonial-container").append(newTestimonial);
                        });
                    }
                }
            }
        }
    });
}

	function saveData(formData) {
		$.ajax({
			url: '<?=base_url('admin/add_home_page')?>',
			type: 'POST',
			data: formData,
			contentType: false, 
			processData: false, 
			dataType: 'json', 
			success: function(response) {
				$(".alert-container").html(''); 
				let alertHtml = '';
				if (response.status === "post_success") {
					alertHtml = `
						<div class="alert alert-success">
							<a href="#" class="close" data-dismiss="alert">&times;</a>
							<strong>Success!</strong> ${response.message}
						</div>
					`;
					$(".post_id").attr("value",response.post_id); 
					getEditData();
				} else if (response.status === "post_error") {
					alertHtml = `
						<div class="alert alert-danger">
							<a href="#" class="close" data-dismiss="alert">&times;</a>
							<strong>Error!</strong> ${response.message}
						</div>
					`;
				}
				$(".alert-container").html(alertHtml);
				$("html, body").animate({ scrollTop: 0 }, "slow");
			},
			error: function(xhr, status, error) {
				console.log(xhr);
				console.log(status);
				console.log(error);

				$(".alert-container").html(`
					<div class="alert alert-danger">
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						<strong>Error!</strong> Something went wrong. Please try again.
					</div>
				`);
				$("html, body").animate({ scrollTop: 0 }, "slow");
			}
		});
	}
	var course;
	var cat;
    $(document).ready(function() {
		$('#isDetail').change(function() {
            if ($(this).is(':checked')) {
                $('.showHide').show(); // Show div
            } else {
                $('.showHide').hide(); // Hide div
            }
        });
		if ($.fn.summernote) {
			$('#about_content_editor').addClass("summernote").summernote();
			$('#ap_content_editor').addClass("summernote").summernote();
			$('#pd_editor').addClass("summernote").summernote();
			$('#co_editor').addClass("summernote").summernote();
			$('#po_editor').addClass("summernote").summernote();
			
		
		} else {
			console.error("Summernote is not loaded properly!");
		}
		course = new Choices('#course_select', { removeItemButton: true });

		// blogs = new Choices('#blog_select', { removeItemButton: true });
		cat = new Choices('#category_select', { removeItemButton: true });
		$(document).on("click", ".close-btn", function () {
	var parentDiv = $(this).closest(".row");
	var fileInput = parentDiv.find('input[type="file"]');
	var inputName = fileInput.attr("name");

	var image = parentDiv.find("img");
	var dbName = image.attr("data-db_name");

	var data = {
		id: $(".post_id").val(),
		tag: "course",
		image_name: inputName,
		dbName: dbName
	};

	var closeBtn = $(this); // Save reference to clicked button

	$.ajax({
		url: "<?php echo base_url('admin/delete_image'); ?>",
		type: "POST",
		data: data,
		dataType: "json",
		success: function (response) {
			if (response.status == 'success') {
				closeBtn.remove();
				getEditData();
			}
			console.log("Image removed:", response);
		},
		error: function (xhr) {
			console.log("Error:", xhr.responseText);
		}
	});
});
		getEditData();
		$("#add-testimonial").click(function() {
			var newTestimonial = `
				<div class="testimonial-section card px-3" >
					<div class="d-flex justify-content-end p-3 row">
						<button type="button" class="btn btn-danger remove-section">Remove</button>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">Testimonial Heading</label>
								<input class="form-control " type="text" name="testimonal_heading[]">
							</div>	
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Testimonial Image</label>
								<input class="form-control" type="file" name="testimonal_img[]">
							</div>
						</div>
						<div class="col-md-6">
							<label>Testimonial Image</label>
							<img src="" width="120px">
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Name</label>
								<input class="form-control " type="text" name="testimonal_name[]">
							</div>	
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Profession</label>
								<input class="form-control " type="text" name="testimonal_profession[]">
							</div>	
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">Mode Content</label>
								<textarea class="form-control" name="testimonal_content[]"></textarea>
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
		$('#create-page').validate({
            rules: {
                page_title: "required",
                slug: "required",
                seo_title: "required",
                seo_description: "required"
            },
            messages: {
                page_title: "Please enter a page title",
                slug: "Please enter a page URL",
                seo_title: "Please enter an SEO title",
                seo_description: "Please enter an SEO description"
            },
            submitHandler: function(form) {
				var formData = new FormData(form);
				formData.append("tag", "create_page"); 
				formData.append("type", "course"); 
                saveData(formData);
            }
        });

		$('#add-banner').validate({
			rules: {
                banner_heading: "required",
                
            },
            messages: {
                banner_heading: "Please enter a Banner heading",
            },
            submitHandler: function(form) {
                var formData = new FormData(form); // Use the current form
				formData.append("tag", "add_banner"); 
				formData.append("type", "course"); 
				saveData(formData);
            }
        });
		$('#add-info').validate({
			rules: {
				name: {
					required: true,
					minlength: 3
				},
				email: {
					required: true,
					email: true
				},
				phone_no: {
					required: true,
					digits: true,
					minlength: 10,
					maxlength: 15
				},
				email2: {
					email: true
				}
			},
			messages: {
				name: {
					required: "Please enter a Name",
					minlength: "Name must be at least 3 characters"
				},
				email: {
					required: "Please enter an Email",
					email: "Please enter a valid Email"
				},
				phone_no: {
					required: "Please enter a Phone Number",
					digits: "Only numbers are allowed",
					minlength: "Phone number must be at least 10 digits",
					maxlength: "Phone number cannot exceed 15 digits"
				},
				email2: {
					email: "Please enter a valid Email"
				}
			},
			submitHandler: function(form) {
				var formData = new FormData(form);
				formData.append("tag", "add_info"); 
				formData.append("type", "course"); 
				saveData(formData);
			}
		});

		$('#add-why_EY').validate({
			rules: {
                why_ey_heading: "required",
            },
            messages: {
                why_ey_heading: "Please enter a why_ey heading",
            },
            submitHandler: function(form) {
                var formData = new FormData(form); // Use the current form
				formData.append("tag", "add_why_ey"); 
				formData.append("type", "course"); 
				saveData(formData);
            }
        });
		$('#add_about').validate({
			rules: {
                about_heading: "required",
            },
            messages: {
                about_heading: "Please enter a About Heading",
            },
            submitHandler: function(form) {
                var formData = new FormData(form); // Use the current form
				formData.append("tag", "add_about"); 
				formData.append("type", "course"); 
				saveData(formData);
            }
        });
		$('#add_audience_profile').validate({
			rules: {
                ap_heading: "required",
            },
            messages: {
                ap_heading: "Please enter a Audience Profile Heading",
            },
            submitHandler: function(form) {
                var formData = new FormData(form); // Use the current form
				formData.append("tag", "add_ap"); 
				formData.append("type", "course"); 
				saveData(formData);
            }
        });
		$('#add_pd').validate({
			rules: {
                pd_heading: "required",
            },
            messages: {
                pd_heading: "Please enter a Program Deliveriables Heading",
            },
            submitHandler: function(form) {
                var formData = new FormData(form); // Use the current form
				formData.append("tag", "add_pd"); 
				formData.append("type", "course"); 
				saveData(formData);
            }
        });
		$('#add_co').validate({
			rules: {
                co_heading: "required",
            },
            messages: {
                co_heading: "Please enter a Course Outline Heading",
            },
            submitHandler: function(form) {
                var formData = new FormData(form); // Use the current form
				formData.append("tag", "add_co"); 
				formData.append("type", "course"); 
				saveData(formData);
            }
        });
		$('#add_po').validate({
			rules: {
                po_heading: "required",
            },
            messages: {
                po_heading: "Please enter a Program Outcomes Heading",
            },
            submitHandler: function(form) {
                var formData = new FormData(form); // Use the current form
				formData.append("tag", "add_po"); 
				formData.append("type", "course"); 
				saveData(formData);
            }
        });
		$('#add_related_course').validate({
			rules: {
                related_course_heading: "required",
            },
            messages: {
                related_course_heading: "Please enter a Course Heading Heading",
            },
            submitHandler: function(form) {
                var formData = new FormData(form); // Use the current form
				formData.append("tag", "add_related_course"); 
				formData.append("type", "course"); 
				saveData(formData);
            }
        });
		$('#add-testimonials').validate({
			rules: {
                testimonal_main_heading: "required",
            },
            messages: {
                testimonal_main_heading: "Please enter a Testimonal heading",
            },
            submitHandler: function(form) {
                var formData = new FormData(form); // Use the current form
				formData.append("tag", "add_testimonial"); 
				formData.append("type", "course"); 
				saveData(formData);
            }
        });

    });
</script>
