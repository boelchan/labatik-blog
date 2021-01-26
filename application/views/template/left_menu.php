<div class="page-sidebar-wrapper">
	<!-- BEGIN SIDEBAR -->
	<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
	<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
	<div class="page-sidebar navbar-collapse collapse">
		<!-- BEGIN SIDEBAR MENU -->
		<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
		<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
		<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
		<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<?php $page_sidebar_menu_closed = ($this->input->cookie('sidebar_closed')) ? 'page-sidebar-menu-closed' : '' ; ?>
		<?php  ?>
		<!-- <li class="heading">
                <h3 class="uppercase">Master</h3>
            </li> -->

		<ul class="page-sidebar-menu <?php echo $page_sidebar_menu_closed ?> " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
			<li class="nav-item <?php if ($this->uri->segment(1) == 'Dashboard') echo 'active' ?> ">
				<a href="<?php echo site_url('dashboard') ?>" class="nav-link">
					<i class="icon-bar-chart"></i>
                    <span class="title">Dashboard</span>
                </a>
            </li>
			<li class="nav-item">
				<a href="<?php echo site_url() ?>" class="nav-link" target="_blank">
					<i class="icon-frame"></i>
                    <span class="title">Lihat Blog</span>
                </a>
            </li>
			
			<li class="heading">
				<h3 class="uppercase">Blog</h3>
			</li>
			<li class="nav-item <?php if ($this->uri->segment(1) == 'blogPost') echo 'active' ?> ">
				<a href="<?php echo site_url('blogPost') ?>" class="nav-link">
					<i class="icon-pencil"></i>
					<span class="title">Artikel</span>
				</a>
			</li>			

			<li class="heading">
				<h3 class="uppercase">Pengaturan</h3>
			</li>
			<li class="nav-item <?php if ($this->uri->segment(1) == 'page') echo 'active' ?> ">
				<a href="<?php echo site_url('page') ?>" class="nav-link">
					<i class="icon-settings"></i>
					<span class="title">Halaman</span>
				</a>
			</li>

			<li class="heading">
				<h3 class="uppercase">Akun</h3>
			</li>
			<li class="nav-item <?php if ($this->uri->segment(1) == 'Users') echo 'active' ?> ">
				<a href="<?php echo site_url('Users') ?>" class="nav-link">
					<i class="icon-users"></i>
					<span class="title">Operator</span>
				</a>
			</li>
            <li class="nav-item <?php if ($this->uri->segment(1) == 'UbahKataSandi') echo 'active' ?> ">
				<a href="<?php echo site_url('UbahKataSandi') ?>" class="nav-link">
					<i class="icon-key"></i>
                    <span class="title">Ubah Kata Sandi</span>
                </a>
            </li>
            <li class="nav-item  ">
				<a href="<?php echo site_url('auth/logout') ?>" class="nav-link ">
					<i class="icon-logout"></i>
                    <span class="title">Keluar</span>
                </a>
            </li>

		</ul>

		<!-- END SIDEBAR MENU -->
	</div>
	<!-- END SIDEBAR -->
</div>
