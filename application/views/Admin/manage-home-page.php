<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="row">
			<div class="col-sm-4 col-3">
				<h4 class="page-title"><?=$title?></h4>
			</div>
			
		</div>
		<div class="alert-container"></div> 
		<div class="row">
			<div class="col-md-12">
				<div class="m-b-30">
					<form id="create-page" method="post">
					<input type="hidden" class="post_id" name="post_id">

						<div class="mb-3">
							<label for="page_title" class="form-label">Page Title <span class="text-danger">*</span></label>
							<input type="text" class="form-control" id="page_title" name="page_title" required>
						</div>
						
						<div class="row mb-3">
							<div class="col-md-6">
								<label for="slug" class="form-label">Page URL Last Path <span class="text-danger">*</span></label>
								<input type="text" class="form-control" id="slug" required name="slug">
							</div>
							<div class="col-md-6">
								<label for="seo_title" class="form-label">SEO Page Title <span class="text-danger">*</span></label>
								<input type="text" class="form-control" id="seo_title" required name="seo_title">
							</div>
						</div>
						
						<div class="mb-3">
							<label for="seo_description" class="form-label">SEO Description <span class="text-danger">*</span></label>
							<textarea class="form-control" id="seo_description" required name="seo_description"></textarea>
						</div>
						
						<div class="mb-3">
							<label class="form-label">Page Status</label>
							<div>
								<input type="radio" name="status" value="1" checked> Pending
								<input type="radio" name="status" value="2"> Publish
								<input type="radio" name="status" value="3"> Draft
							</div>
						</div>
						
						<button type="submit" class="btn btn-primary">Create Page</button>
					</form>
				</div>
				<div class="m-b-30">
					<form id="add-banner" method="post" enctype="multipart/form-data">
						<input type="hidden" class="post_id" name="post_id">

						<div class="mb-3">
							<label for="banner_heading" class="form-label">Banner Heading <span class="text-danger">*</span></label>
							<input type="text" class="form-control" id="banner_heading" name="banner_heading" required>
						</div>
						
						<div class="mb-3 row">

							<div class="col-md-6">
								<label for="banner_img" class="form-label">Banner Image</label>
								<input type="file" class="form-control" id="banner_img" name="banner_img">
							</div>
							<div class="col-md-6">
								<label>Banner Image</label><br>
								<img src="" id="banner_image" name="banner_image" width="120px">
							</div>
						</div>
						
						<div class="mb-3">
							<label for="banner_content" class="form-label">Banner Content </label>
							<textarea class="form-control" id="banner_content" name="banner_content" ></textarea>
						</div>
						
						<div class="row">
							<div class="col-md-6 mb-3">
								<label for="stu_count" class="form-label">Students Count </label>
								<input type="number" class="form-control" id="stu_count" name="stu_count">
							</div>
							<div class="col-md-6 mb-3">
								<label for="lesson_count" class="form-label">Lesson Count </label>
								<input type="number" class="form-control" id="lesson_count" name="lesson_count">
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6 mb-3">
								<label for="rating_count" class="form-label">Rating Count </label>
								<input type="number" class="form-control" id="rating_count" name="rating_count">
							</div>
							<div class="col-md-6 mb-3">
								<label for="videos_count" class="form-label">Videos Count </label>
								<input type="number" class="form-control" id="videos_count" name="videos_count">
							</div>
						</div>
						
						<button type="submit" class="btn btn-primary">Save Changes</button>
					</form>
				</div>

				<div class="m-b-30">	
					<h3>Solutions</h3>
					<form id="add-solution" enctype="multipart/form-data">
					<input type="hidden" class="post_id" name="post_id">

						<div class="form-group">
							<label>Solution Main Heading <span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="solution_heading" id="solution_heading" required>
						</div>

						<div id="solution-sections">
						<?php 
							$totalsolution = 4;
							for ($i = 1; $i <= $totalsolution; $i++) { ?>
								<div class="row mb-3">
									<div class="col-md-12 mb-3">
										<label>Solution Title <?= $i ?> </label>
										<input type="text" class="form-control" name="solution_title<?= $i ?>" id="solution_title<?= $i ?>">
									</div>

									<div class="col-md-6 mb-3">
										<label>Solution <?= $i ?> Image </label>
										<input type="file" class="form-control usp-img" name="solution_img<?= $i ?>" id="solution_img<?= $i ?>" data-preview="solution_image<?= $i ?>">
									</div>

									<div class="col-md-6 mb-3">
										<label>Preview</label><br>
										<img src="" id="solution_image<?= $i ?>" class="img-preview" width="120px">
									</div>

									<div class="col-md-6 mt-2">
										<label>Buttton Text <?= $i ?> </label>
										<input type="text" class="form-control" name="solution_btn_txt<?= $i ?>" id="solution_btn_txt<?= $i ?>">
									</div>
									<div class="col-md-6 mt-2">
										<label>Buttton Url <?= $i ?> </label>
										<input type="text" class="form-control" name="solution_btn_url<?= $i ?>" id="solution_btn_url<?= $i ?>">
									</div>
								</div>
							<?php } ?>
						</div>

						<button type="submit" class="btn btn-primary mt-3">Save Changes</button>
					</form>
				</div>

				<div class="m-b-30">
					<h3>Categories</h3>
					<form id="add-cat" enctype="multipart/form-data">
					<input type="hidden" class="post_id" name="post_id">

						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="category_heading" >Category Heading<span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="category_heading" name="category_heading" required >
								</div>
							</div>
						</div>  
						<div class="row mb-3">
							<div class="col-md-12">
								<label for="category" class="form-label">Category </label>
								<select id="category_select" name="categories[]" multiple placeholder="Select Category" style="width: 100%" class="form-control"> 
									<?php foreach ($categoryList as $category): ?>
										<option value="<?php echo htmlspecialchars($category->id); ?>">
											<?php echo htmlspecialchars($category->page_title); ?>
										</option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="row">
						<div class="col-md-6 mt-2">
							<label>Buttton Text  </label>
							<input type="text" class="form-control" name="cat_btn_txt" id="cat_btn_txt">
						</div>
						<div class="col-md-6 mt-2">
							<label>Buttton Url  </label>
							<input type="text" class="form-control" name="cat_btn_url" id="cat_btn_url">
						</div>
						</div>
						<button type="submit" class="btn btn-primary mt-3">Save Changes</button>
					</form>
				</div>	

				<div class="m-b-30">	
					<h3>OUR USP's</h3>
					<form id="add-usp" enctype="multipart/form-data">
					<input type="hidden" class="post_id" name="post_id">

						<div class="form-group">
							<label>USP's Main Heading <span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="usp_heading" id="usp_heading" required>
						</div>

						<!-- Dynamic USP Fields -->
						<div id="usp-sections">
						<?php 
							$totalUSPs = 6;
							for ($i = 1; $i <= $totalUSPs; $i++) { ?>
								<div class="row mb-3">
									<div class="col-md-12 mb-3">
										<label>USP's Heading <?= $i ?> </label>
										<input type="text" class="form-control" name="usp_heading<?= $i ?>" id="usp_heading<?= $i ?>">
									</div>

									<div class="col-md-6 mb-3">
										<label>USP's Image <?= $i ?> </label>
										<input type="file" class="form-control usp-img" name="usp_img<?= $i ?>" id="usp_img<?= $i ?>" data-preview="usp_image<?= $i ?>">
									</div>

									<div class="col-md-6 mb-3">
										<label>Preview</label><br>
										<img src="" id="usp_image<?= $i ?>" class="img-preview" width="120px">
									</div>

									<div class="col-md-12 mt-2">
										<label>Content <?= $i ?> </label>
										<textarea class="form-control" name="content<?= $i ?>" id="content<?= $i ?>"></textarea>
									</div>
								</div>
							<?php } ?>
						</div>

						<button type="submit" class="btn btn-primary mt-3">Save Changes</button>
					</form>
				</div>
				<div class="m-b-30">
					<h3>Modes</h3>
					<form id="add-mode" enctype="multipart/form-data">
					<input type="hidden" class="post_id" name="post_id">

						<div class="form-group">
							<label>Modes Main Heading <span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="mode_heading" id="mode_heading" required>
						</div>

						<div id="modes-sections">
						<?php 
							$totalModes = 4;
							for ($i = 1; $i <= $totalModes; $i++) { ?>
								<div class="row mb-3">
									<div class="col-md-12 mb-3">
										<label>Mode Heading <?= $i ?> </label>
										<input type="text" class="form-control" name="mode_heading<?= $i ?>" id="mode_heading<?= $i ?>">
									</div>

									<div class="col-md-6 mb-3">
										<label>Mode Image <?= $i ?> </label>
										<input type="file" class="form-control mode-img" name="mode_img<?= $i ?>" id="mode_img<?= $i ?>" data-preview="mode_image<?= $i ?>">
									</div>

									<div class="col-md-6 mb-3">
										<label>Preview</label><br>
										<img src="" id="mode_image<?= $i ?>" class="img-preview" width="120px">
									</div>

									<div class="col-md-12 mt-2">
										<label>Mode Content <?= $i ?> </label>
										<textarea class="form-control" name="mode_content<?= $i ?>" id="mode_content<?= $i ?>"></textarea>
									</div>
								</div>
							<?php } ?>
						</div>

						<button type="submit" class="btn btn-primary mt-3">Save Changes</button>
					</form>
				</div>
				<div class="m-b-30">
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
				<div class="m-b-30">
					<h3>Blogs</h3>
					<form id="add-blog" enctype="multipart/form-data">
					<input type="hidden" class="post_id" name="post_id">

						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="blog_heading" >Blog Heading</label>
									<input type="text" class="form-control" id="blog_heading" name="blog_heading" >
								</div>
							</div>
						</div>  
						<div class="row">
							<div class="col-md-12">
								<?php //print_r($blogList); ?>
								<div class="form-group">
									<label for="blog_select">Select Blogs</label> 
									<select id="blog_select" name="blogs[]" multiple placeholder="Select Blogs" style="width: 100%"class="form-control" > 
									<?php foreach ($blogList as $blogs): ?>
										<option value="<?php echo $blogs->id; ?>"><?php echo $blogs->blog_title; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div>
						<button type="submit" class="btn btn-primary mt-3">Save Changes</button>
					</form>
				</div>	
						

				<div class="m-b-30">
					<h3>FAQ</h3>
					<form id="add-faq" enctype="multipart/form-data">
					<input type="hidden" class="post_id" name="post_id">

					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">FAQ Heading <span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="faq_heading" id="faq_heading" required>
							</div>
						</div>
					</div>

					<div id="faq-container"></div>
					<div class="row">
						<div class="col-md-12">
							<button type="button" id="add-faq-btn" class="btn btn-success">Add More</button>
						</div>
					</div>

						<button type="submit" class="btn btn-primary mt-3">Save Changes</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>



<script>
	function createHiddenInput(value) {
		// Remove existing hidden input if any
		$(".prev_img").remove();

		// Create a new hidden input element
		var hiddenInput = $('<input>', {
			type: 'hidden',
			class: 'prev_img',
			name: 'prev_img',
			value: value
		});

		return hiddenInput;
	}
	function getEditData(tag = '') {
		var closeButton = '<span class="close-btn" style="position: absolute; top: 19px; left: 128px; font-size: 13px; font-weight: bold; color: #fff; background: #f62d51; border-radius: 50%; padding: 2px 4px; cursor: pointer;">x</span>';
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "ajax/getHomepage",
            dataType: 'json',
			data: tag,
            success: function(res) {
				console.log(res.dataContent[0]);
				var data = res.dataContent[0];
				$(".post_id").val(data.id);
				$("#page_title").val(data.page_title);
				$("#slug").val(data.slug);
				$("#seo_title").val(data.seo_title);
				$("#seo_description").val(data.seo_description);
				// $("name [status]").val(data.status);
				$("input[name='status'][value='" + data.status + "']").prop("checked", true);
				if(data.banner){
					var banner = JSON.parse(data.banner);
					$("#banner_heading").val(banner.banner_heading);
					$("#banner_content").val(banner.banner_content);
					$("#stu_count").val(banner.stu_count);
					$("#lesson_count").val(banner.lesson_count);
					$("#rating_count").val(banner.rating_count);
					$("#videos_count").val(banner.videos_count);
					var banner_src = '../assets/img/placeholder.jpg'
					if(banner.banner_img){
						banner_src = '../uploads/home_images/' + banner.banner_img;
						if ($("#banner_image").prev(".close-btn").length === 0) {
							$("#banner_image").before(closeButton);
						}
						$("#banner_image").prev(".prev_img").remove();
						
					}
					$("#banner_image").prop('src', banner_src);
					$("#banner_image").attr("data-db_name", "banner");
				}
				if(data.usps){
					var usps = JSON.parse(data.usps);
					$("#usp_heading").val(usps["usp_heading"]);

					for (let i = 1; i < 7; i++) {
						$("#usp_heading" + i).val(usps["usp_heading" + i]);
						$("#content" + i).val(usps["content" + i]);

						var usp_src = '../assets/img/placeholder.jpg'; // Default image path
						if (usps["usp_img" + i]) {
							usp_src = '../uploads/home_images/' + usps["usp_img" + i];
							if ($("#usp_image" + i).prev(".close-btn").length === 0) {
								$("#usp_image" + i).before(closeButton);
							}
						}

						$("#usp_image" + i).prop('src', usp_src);
						$("#usp_image" + i).attr("data-db_name", "usps");
					}

				}
				if(data.solutions){
					var solution = JSON.parse(data.solutions);
					$("#solution_heading").val(solution["solution_heading"]);

					for (let i = 1; i < 5; i++) {
						$("#solution_title" + i).val(solution["solution_title" + i]);
						$("#solution_btn_url" + i).val(solution["solution_btn_url" + i]);

						var solution_src = '../assets/img/placeholder.jpg'; // Default image path
						if (solution["solution_img" + i]) {
							solution_src = '../uploads/home_images/' + solution["solution_img" + i];
							if ($("#solution_image" + i).prev(".close-btn").length === 0) {
							$("#solution_image" + i).before(closeButton);
							}
						}

						$("#solution_image" + i).prop('src', solution_src);
						$("#solution_image" + i).attr("data-db_name", "solutions");

					}

				}
				
				if (data.categories) {
					var catData = JSON.parse(data.categories);
					$("#category_heading").val(catData["category_heading"]);
					$("#cat_btn_txt").val(catData["cat_btn_txt"]);
					$("#cat_btn_url").val(catData["cat_btn_url"]);
					var selected_cat = JSON.parse(catData.category_select);
					cat.setChoiceByValue(selected_cat);
				}
				
				if(data.modes){
					var modes = JSON.parse(data.modes);
					$("#mode_heading").val(modes["mode_heading"]);
					for (let i = 1; i < 5; i++) {
						$("#mode_heading" + i).val(modes["mode_heading" + i]);
						if ($("#mode_content" + i).hasClass("summernote")) {
							$("#mode_content" + i).summernote('code', modes["mode_content" + i] || '');
						} else {
							$("#mode_content" + i).val(modes["mode_content" + i]);
						}
						var mode_src = '../assets/img/placeholder.jpg'; // Default image path
						if (modes["mode_img" + i]) {
							mode_src = '../uploads/home_images/' + modes["mode_img" + i];
							if ($("#mode_image" + i).prev(".close-btn").length === 0) {
								$("#mode_image" + i).before(closeButton);
							}

						}
						$("#mode_image" + i).prop('src', mode_src);
						$("#mode_image" + i).attr("data-db_name", "modes");

					}
				}
				if (data.testimonials) {
					var testimonialsData = JSON.parse(data.testimonials);
					$("#testimonal_main_heading").val(testimonialsData["testimonal_main_heading"]);
					$("#testimonial-container").empty();

					var testimonialArray = testimonialsData.testimonials;
					$.each(testimonialArray, function(index, testimonial) { 
						var src = '';
						var baseUrl = "<?= base_url('uploads/home_images/') ?>"; // Store base URL in a variable

						if (testimonial.image && testimonial.image !== 'null') {
							src = baseUrl + testimonial.image;
						} else {
							src = '../assets/img/placeholder.jpg';
						}
						
						var newTestimonial = `
							<div class="testimonial-section card px-3" >
								<div class="d-flex justify-content-end p-3 row">
									<button type="button" class="btn btn-danger remove-section">Remove</button>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label class="control-label">Testimonial Heading</label>
											<input class="form-control " type="text" name="testimonal_heading[]" value="${testimonial.heading}">
										</div>	
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Testimonial Image</label>
											<input class="form-control" type="file" name="testimonal_img[]">
										</div>
									</div>
									<div class="col-md-6">
										<label>Testimonial Image</label><br>
										<span class="close-btn" style="position: absolute; top: 19px; left: 128px; font-size: 13px; font-weight: bold; color: #fff; background: #f62d51; border-radius: 50%; padding: 2px 4px; cursor: pointer;">x</span>
										<img src="${src}" class="img-preview" width="120px" data-db_name="testimonials">
									</div>

									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Name</label>
											<input class="form-control " type="text" name="testimonal_name[]"value="${testimonial.name}">
										</div>	
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Profession</label>
											<input class="form-control " type="text" name="testimonal_profession[]" value="${testimonial.profession}">
										</div>	
									</div>
									<div class="col-sm-12">
										<div class="form-group">
											<label class="control-label">Testimonial Content</label>
											<textarea class="form-control" name="testimonal_content[]">${testimonial.content}</textarea>
										</div>
									</div>
								</div>
							</div>
						`;
						$("#testimonial-container").append(newTestimonial);
					});
				}
				if (data.blogs) {
					var blogsData = JSON.parse(data.blogs);
					$("#blog_heading").val(blogsData["blog_heading"]);
					var selected_blog = JSON.parse(blogsData.blog_select);
					blogs.setChoiceByValue(selected_blog);
				}
				if (data.faqs) {
					var faqsData = JSON.parse(data.faqs);
					$("#faq_heading").val(faqsData["faq_heading"]);
					var faqArray = faqsData.faqs;
					$("#faq-container").empty();

					$.each(faqArray, function(index, faq) { 
						var newFaq = `
							<div class="FAQ-section card px-3" >
								<div class="d-flex justify-content-end p-3 row">
									<button type="button" class="btn btn-danger remove-section">Remove</button>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label class="control-label">Question</label>
											<input class="form-control" type="text" name="FAQ_Q[]" value="${faq.question}">
										</div>	
									</div>
									<div class="col-sm-12">
										<div class="form-group">
											<label class="control-label">Answer</label>
											<textarea class="form-control" name="FAQ_A[]">${faq.answer}</textarea>
										</div>
									</div>
								</div>
							</div>
						`;
						$("#faq-container").append(newFaq);
					})
				}
			}
		})
	}
	function saveData(formData) {
		// console.log("Form Data:");
		// for (var pair of formData.entries()) {
		//     console.log(pair[0] + ": " + pair[1]);
		// }
		$.ajax({
			url: 'add_home_page',
			type: 'POST',
			data: formData,
			contentType: false,  // Important for FormData
			processData: false,  // Important for FormData
			dataType: 'json',  // Expect JSON response
			success: function(response) {
				console.log(response)
				$(".alert-container").html(''); // Clear existing alerts

				let alertHtml = '';
				if (response.status === "post_success") {
					getEditData();
					alertHtml = `
						<div class="alert alert-success">
							<a href="#" class="close" data-dismiss="alert">&times;</a>
							<strong>Success!</strong> ${response.message}
						</div>
					`;
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
	var blogs;
	var cat;
    $(document).ready(function() {
		blogs = new Choices('#blog_select', { removeItemButton: true });
		cat = new Choices('#category_select', { removeItemButton: true });
		$('[id^="mode_content"]').each(function(){
				$(this).addClass("summernote").summernote();
			});
		$(document).on("click", ".close-btn", function () {
	var parentDiv = $(this).closest(".row");
	var fileInput = parentDiv.find('input[type="file"]');
	var inputName = fileInput.attr("name");

	var image = parentDiv.find("img");
	var dbName = image.attr("data-db_name");

	var data = {
		id: $(".post_id").val(),
		tag: "home",
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
				closeBtn.remove(); // Correct context
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

		$("#add-faq-btn").click(function() {
			var newTestimonial = `
				<div class="FAQ-section card px-3" >
					<div class="d-flex justify-content-end p-3 row">
						<button type="button" class="btn btn-danger remove-section">Remove</button>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">Question</label>
								<input class="form-control" type="text" name="FAQ_Q[]">
							</div>	
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">Answer</label>
								<textarea class="form-control" name="FAQ_A[]"></textarea>
							</div>
						</div>
					</div>
				</div>
			`;
			$("#faq-container").append(newTestimonial);
		});

		$(document).on("click", ".remove-section", function() {
			$(this).closest(".FAQ-section").remove();
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
				var formData = new FormData(form); // Use the current form
				formData.append("tag", "create_page"); 
				formData.append("type", "home_page"); 
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
				formData.append("type", "home_page"); 

				saveData(formData);
            }
        });
		$('#add-usp').validate({
			rules: {
                usp_heading: "required",
            },
            messages: {
                usp_heading: "Please enter a USP heading",
            },
            submitHandler: function(form) {
                var formData = new FormData(form); // Use the current form
				formData.append("tag", "add_usp"); 
				formData.append("type", "home_page"); 

				saveData(formData);
            }
        });
		$('#add-solution').validate({
			rules: {
                solution_heading: "required",
            },
            messages: {
                solution_heading: "Please enter a Solution heading",
            },
            submitHandler: function(form) {
                var formData = new FormData(form); // Use the current form
				formData.append("tag", "add_solution"); 
				formData.append("type", "home_page"); 

				saveData(formData);
            }
        });

		$('#add-cat').validate({
			rules: {
                category_heading: "required",
            },
            messages: {
                category_heading: "Please enter a Category heading",
            },
            submitHandler: function(form) {
                var formData = new FormData(form); // Use the current form
				formData.append("tag", "add_cat"); 
				formData.append("type", "home_page"); 
				saveData(formData);
            }
        });
		$('#add-mode').validate({
			rules: {
                mode_heading: "required",
            },
            messages: {
                mode_heading: "Please enter a Mode heading",
            },
            submitHandler: function(form) {
                var formData = new FormData(form); // Use the current form
				formData.append("tag", "add_mode"); 
				formData.append("type", "home_page"); 

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
				formData.append("type", "home_page"); 

				saveData(formData);
            }
        });
		$('#add-blog').validate({
			rules: {
                blog_heading: "required",
            },
            messages: {
                blog_heading: "Please enter a Blog heading",
            },
            submitHandler: function(form) {
                var formData = new FormData(form); // Use the current form
				formData.append("tag", "add_blogs"); 
				formData.append("type", "home_page"); 

				saveData(formData);
            }
        });
		$('#add-faq').validate({
			rules: {
                faq_heading: "required",
            },
            messages: {
                faq_heading: "Please enter a FAQ heading",
            },
            submitHandler: function(form) {
                var formData = new FormData(form); // Use the current form
				formData.append("tag", "add_faq"); 
				formData.append("type", "home_page"); 

				saveData(formData);
            }
        });

    });
</script>
