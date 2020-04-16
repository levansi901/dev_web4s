<!DOCTYPE html>

<html lang="en">

	<!-- begin::Head -->
	<head>
		<base href="">
		<meta charset="utf-8" />
		<title>Web4s | {if !empty($title_for_layout)}{$title_for_layout}{else}Admin Control panel{/if}</title>
		<meta name="description" content="Updates and statistics">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!--begin::Fonts -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

		<!--end::Fonts -->

		<!--begin::Page Vendors Styles(used by this page) -->

		<!--end::Page Vendors Styles -->

		<!--begin::Global Theme Styles(used by all pages) -->
		<link href="{ADMIN_PATH}/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="{ADMIN_PATH}/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

		<!--end::Global Theme Styles -->

		<!--begin::Layout Skins(used by all pages) -->
		<link href="{ADMIN_PATH}/assets/css/skins/header/base/light.css" rel="stylesheet" type="text/css" />
		<link href="{ADMIN_PATH}/assets/css/skins/header/menu/light.css" rel="stylesheet" type="text/css" />
		<link href="{ADMIN_PATH}/assets/css/skins/brand/dark.css" rel="stylesheet" type="text/css" />
		<link href="{ADMIN_PATH}/assets/css/skins/aside/dark.css" rel="stylesheet" type="text/css" />

		<!--end::Layout Skins -->
		<link rel="shortcut icon" href="{ADMIN_PATH}/favicon.ico" />
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

		<!-- begin:: Page -->

		<!-- begin:: Header Mobile -->
		<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
			<div class="kt-header-mobile__logo">
				<a href="index.html">
					<img alt="Logo" src="{ADMIN_PATH}/assets/media/logos/logo-light.png" />
				</a>
			</div>
			<div class="kt-header-mobile__toolbar">
				<button class="kt-header-mobile__toggler kt-header-mobile__toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
				<button class="kt-header-mobile__toggler" id="kt_header_mobile_toggler"><span></span></button>
				<button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
			</div>
		</div>
		<!-- end:: Header Mobile -->


		<div class="kt-grid kt-grid--hor kt-grid--root">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

				<!-- begin:: Aside -->

				<!-- Uncomment this to display the close button of the panel
				<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
				-->
				<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

					<!-- begin:: Aside -->

					{$this->element('Admin.layout/logo')}

					<!-- end:: Aside -->

					<!-- begin:: Aside Menu -->

					{$this->element('Admin.layout/menu_left')}

					<!-- end:: Aside Menu -->
				</div>

				<!-- end:: Aside -->
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

					<!-- begin:: Header -->
					<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

						<!-- begin:: Header Menu -->

						{$this->element('Admin.layout/header_menu')}

						<!-- end:: Header Menu -->

						<!-- begin:: Header Topbar -->
						{$this->element('Admin.layout/header_topbar')}

						<!-- end:: Header Topbar -->
					</div>

					<!-- end:: Header -->
					<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
						{$this->fetch('content')}
					</div>

					<!-- begin:: Footer -->
					<!-- end:: Footer -->
				</div>
			</div>
		</div>

		<!-- end:: Page -->

		<!-- begin::Quick Panel -->
		{$this->element('Admin.layout/quick_panel')}
		<!-- end::Quick Panel -->

		<!-- begin::Scrolltop -->
		<div id="kt_scrolltop" class="kt-scrolltop">
			<i class="fa fa-arrow-up"></i>
		</div>

		<!-- end::Scrolltop -->

		<!-- begin::Sticky Toolbar -->
		<ul class="kt-sticky-toolbar" style="margin-top: 30px;">
			<li class="kt-sticky-toolbar__item kt-sticky-toolbar__item--success" id="kt_demo_panel_toggle" data-toggle="kt-tooltip" title="Check out more demos" data-placement="right">
				<a href="#" class=""><i class="flaticon2-drop"></i></a>
			</li>
			<li class="kt-sticky-toolbar__item kt-sticky-toolbar__item--brand" data-toggle="kt-tooltip" title="Layout Builder" data-placement="left">
				<a href="#"><i class="flaticon2-gear"></i></a>
			</li>
			<li class="kt-sticky-toolbar__item kt-sticky-toolbar__item--warning" data-toggle="kt-tooltip" title="Documentation" data-placement="left">
				<a href="#"><i class="flaticon2-telegram-logo"></i></a>
			</li>
			<li class="kt-sticky-toolbar__item kt-sticky-toolbar__item--danger" id="kt_sticky_toolbar_chat_toggler" data-toggle="kt-tooltip" title="Chat Example" data-placement="left">
				<a href="#" data-toggle="modal" data-target="#kt_chat_modal"><i class="flaticon2-chat-1"></i></a>
			</li>
		</ul>

		<!-- end::Sticky Toolbar -->
		
		<!-- begin::Input hidden -->
		<input type="hidden" id="csrf_token" value="{$this->getRequest()->getAttribute('csrfToken')}">
		<!-- end::Input hidden -->
		
		<!--begin::Global Theme Bundle(used by all pages) -->
		<script src="{ADMIN_PATH}/assets/plugins/global/plugins.bundle.js" type="text/javascript"></script>
		<script src="{ADMIN_PATH}/assets/js/scripts.bundle.js" type="text/javascript"></script>
		<script src="{ADMIN_PATH}/assets/js/main.js" type="text/javascript"></script>
		<!--end::Global Theme Bundle -->

		<!--begin::Page Vendors(used by this page) -->


		<!--end::Page Vendors -->

		<!--begin::Page Scripts(used by this page) -->

		{if !empty($js_page)}
	        {foreach from = $js_page item = js_file}
	            <script src="{ADMIN_PATH}{$js_file}" type="text/javascript"></script>
	        {/foreach}
	    {/if}

		<!--end::Page Scripts -->
	</body>

	<!-- end::Body -->
</html>