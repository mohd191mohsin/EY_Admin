<div class="sidebar" id="sidebar">
	<div class="sidebar-inner slimscroll">
		<div id="sidebar-menu" class="sidebar-menu">
			<ul id="menu">
				<li class="dashboard">
					<a href="<?= base_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
				</li>
				<li class="submenu">
					<a href="#" class="manage_home_page"><i class="fa fa-newspaper-o" aria-hidden="true"></i><span> Page Management</span><span class="menu-arrow"></span></a>
					<ul class="list-unstyled" style="display: none;">
						<li><a href="<?= base_url('admin/manage_home_page'); ?>" class="manage_home_page">Manage Home Page</a></li>
						<li><a href="<?= base_url('admin/category_list'); ?>" class="category_list">Manage Category Page</a></li>
					</ul>
				</li>
				<li class="submenu">
					<a href="#" class="courses_list"><i class="fa fa-newspaper-o" aria-hidden="true"></i><span> Courses Management</span><span class="menu-arrow"></span></a>
					<ul class="list-unstyled" style="display: none;">
						<li><a href="<?= base_url('admin/courses_list'); ?>" class="courses_list">Manage Courses</a></li>
					</ul>
				</li>
				<li class="submenu">
					<a href="#" class="blogs_list"><i class="fa fa-newspaper-o" aria-hidden="true"></i><span> Blogs Management</span><span class="menu-arrow"></span></a>
					<ul class="list-unstyled" style="display: none;">
						<li><a href="<?= base_url('admin/blogs_list'); ?>" class="blogs_list">Manage Blog</a></li>
					</ul>
				</li>
				
				
			</ul>
		</div>
	</div>
</div>