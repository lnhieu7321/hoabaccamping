<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>Camping</title>

	<link rel="shortcut icon" type="image/x-icon" href="/assets/images/icon_logo.png">
	<link rel="stylesheet" href="/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="/assets/plugins/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="/assets/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="/assets/plugins/datatables/datatables.min.css">
	<link rel="stylesheet" href="/assets/css/feathericon.min.css">
	<link rel="stylesheet" href="/assets/plugins/morris/morris.css">
	<link rel="stylesheet" href="/assets/css/style.css">


</head>

<body>
	<div class="main-wrapper">
		<div class="header">
			<a href="javascript:void(0);" id="toggle_btn"> <i class="fe fe-text-align-left"></i> </a>
			<div class="header-left">
				<a href="{{route('dashboard')}}" class="logo logo-big"> <img src="/assets/images/nentrang.png" width="30" height="50" alt="logo"> </a>
				<a href="{{route('dashboard')}}" class="logo logo-small"> <img src="/assets/images/icon_logo.png" alt="Logo" width="20" height="20"> </a>
			</div>

			<a class="mobile_btn" id="mobile_btn"> <i class="fas fa-bars"></i> </a>
			<ul class="nav user-menu">
				<li class="nav-item dropdown noti-dropdown">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"> <i class="fe fe-bell"></i> <span class="badge badge-pill">3</span> </a>

				</li>
				<li class="nav-item dropdown has-arrow">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"> <span class="user-img"><img class="rounded-circle" src="{{ Auth::user()->businesses->logo }}" width="40" height="40" alt=""></span> </a>
					<div class="dropdown-menu">
						<div class="user-header">
							<div class="avatar avatar-sm"> <img src="{{ Auth::user()->businesses->logo }}" alt="" class="avatar-img rounded-circle"> </div>
							<div class="user-text">
								<h6>{{ Auth::user()->businesses->business_name }}</h6>
								<p class="text-muted mb-0">{{ Auth::user()->email }}</p>
							</div>
						</div>
						<a class="dropdown-item" href="{{route('profile.edit')}}">{{ __('Thông tin của tôi') }}</a>
						<a class="dropdown-item" href="{{route('profile.change')}}">{{ __('Đổi mật khẩu') }}</a>
						<form method="POST" action="{{ route('logout') }}">
							@csrf
							<a class="dropdown-item" href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">{{ __('Đăng xuất') }}</a>
						</form>
					</div>
				</li>
			</ul>

		</div>
		<div class="sidebar" id="sidebar">
			<div class="sidebar-inner slimscroll">
				<div id="sidebar-menu" class="sidebar-menu">
					<ul>
						<li> <a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> <span>Bảng điều khiển</span></a> </li>
						<li class="list-divider"></li>
						<li class="active"> <a href="{{ route('form/allbooking') }}"><i class="far fa-money-bill-alt"></i> <span>Quản lý đặt chỗ</span></a> </li>
						<li class="submenu"> <a href="#"><i class="fas fa-suitcase"></i> <span>Quản lý dịch vụ</span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="{{ route('form/allservice') }}"> Tổng quan dịch vụ </a></li>
								<li><a href="{{ route('form/serviceadd') }}"> Thêm dịch vụ </a></li>
							</ul>
						</li>
						<li> <a href="{{ route('form/allrating') }}"><i class="fas fa-splotch"></i> <span>Đánh giá và nhận xét</span></a> </li>
					</ul>
				</div>
			</div>
		</div>
		@yield('content')
	</div>
	<script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
	<script src="assets/js/jquery-3.5.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="assets/plugins/datatables/datatables.min.js"></script>
	<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/plugins/raphael/raphael.min.js"></script>
	<script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
	<script src="assets/js/script.js"></script>
	@yield('js-custom')
	@yield('script')

</body>

</html>