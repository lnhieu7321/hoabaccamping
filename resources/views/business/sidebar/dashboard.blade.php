<div class="sidebar" id="sidebar">
	<div class="sidebar-inner slimscroll">
		<div id="sidebar-menu" class="sidebar-menu">
			<ul>
				<li class="active"> <a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> <span>Bảng điều khiển</span></a> </li>
				<li class="list-divider"></li>
				<li> <a href="{{ route('form/allbooking') }}"><i class="far fa-money-bill-alt"></i> <span>Quản lý đặt chỗ</span></a> </li>
				<li class="submenu"> <a href="#"><i class="fas fa-suitcase"></i> <span>Quản lý dịch vụ</span> <span class="menu-arrow"></span></a>
					<ul class="submenu_class" style="display: none;">
						<li><a href="{{ route('form/allservice') }}"> Tổng quan dịch vụ </a></li>
						<li><a href="{{ route('form/serviceadd') }}"> Thêm dịch vụ </a></li>
					</ul>
				</li>
				<li> <a href="{{ route('form/allrating') }}"><i class="far fa-money-bill-alt"></i> <span>Xem đánh giá và nhận xét</span></a> </li>
			</ul>
		</div>
	</div>
</div>