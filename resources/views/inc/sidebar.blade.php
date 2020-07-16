@role('super admin')
	<aside>
		<div class="logo">
			<img src="{{asset('img/logo.png')}}" alt="">
		</div>
		<div class="menu_list">
			<ul>
				<li><a href="/dashboard"><span class="material-icons">home</span>Dashboard</a></li>
				<li><a href="">Đơn hàng</a></li>
				<li>
					<a href="/products">Kho hàng</a>
					<ul class="child_list">
						<li><a href="/products">Tất cả sản phẩm</a></li>
						<li><a href="/products/create">Đăng sản phẩm</a></li>
						<li><a href="/product-category">Quản lý danh mục</a></li>
						<li><a href="/product-brand">Quản lý thương hiệu</a></li>
					</ul>
				</li>
				<li><a href="/report">Báo cáo</a></li>
				<li><a href="/users">Quản trị viên</a></li>
			</ul>
		</div>
	</aside>
@else 

	<aside>
		<div class="logo">
			<img src="{{asset('img/logo.png')}}" alt="">
		</div>
		<div class="menu_list">
			<ul>
				<li><a href="/dashboard">Dashboard</a></li>
				<li><a href="">Đơn hàng</a></li>
				<li><a href="/report">Báo cáo</a></li>
			</ul>
		</div>
	</aside>

@endrole