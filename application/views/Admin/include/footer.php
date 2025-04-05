</div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script type="text/javascript" src="<?=base_url(); ?>assets/js/popper.min.js"></script>
    <script type="text/javascript" src="<?=base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="<?=base_url(); ?>assets/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="<?=base_url(); ?>assets/js/jquery.slimscroll.js"></script>
    <script type="text/javascript" src="<?=base_url(); ?>assets/js/select2.min.js"></script>
    <script type="text/javascript" src="<?=base_url(); ?>assets/js/moment.min.js"></script>
    <script type="text/javascript" src="<?=base_url(); ?>assets/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="<?=base_url(); ?>assets/plugins/morris/morris.min.js"></script>
    <script type="text/javascript" src="<?=base_url(); ?>assets/plugins/raphael/raphael-min.js"></script>
	<script type="text/javascript" src="<?=base_url(); ?>assets/plugins/light-gallery/js/lightgallery-all.min.js"></script>
	<script type="text/javascript" src="<?=base_url(); ?>assets/plugins/summernote/dist/summernote-bs4.min.js"></script>
	<script type="text/javascript" src="<?=base_url(); ?>assets/js/jquery-confirm.min.js"></script>
    <script type="text/javascript" src="<?=base_url(); ?>assets/js/app.js"></script>
    <script type="text/javascript" src="<?=base_url(); ?>assets/js/jquery.blockUI.js"></script>

	<script>
	$(".alert").delay(4000).fadeOut(200, function() {
		$(this).alert('close');
	});
	var path = location.pathname.split('?')[0];
	var start = path.lastIndexOf('/') + 1;
	//alert(start);
	var activeLink = path.substr(start);
	$("ul#menu li").removeClass('active');
	$("ul#menu li.submenu a").removeClass('active subdrop');
	$("ul#menu li.submenu ul.list-unstyled li a").removeClass('active subdrop');
	if(activeLink){
		var parent = $('ul#menu li.' + activeLink);
		var parent2 = $('ul.list-unstyled li a.' + activeLink);
		parent.addClass('active subdrop');
		parent2.addClass('active subdrop');
	}
	$('select').change(function(){
    if ($(this).val()!="")
		{
			$(this).valid();
		}
	});
	$(".lightgallery").lightGallery();
	</script>
</body>
</html>