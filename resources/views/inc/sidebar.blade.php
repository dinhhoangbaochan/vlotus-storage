@role('super admin')
	<aside>
		<div class="logo">
			<img src="{{asset('img/logo.png')}}" alt="">
		</div>
		<div class="menu_list">
			<ul>
				
				<li><a href="/users"> <span class="material-icons">group</span>Quản lý User</a></li>
				<li><a href=""><span class="material-icons">account_tree</span>Quản lý vận đơn</a></li> <!-- đơn hàng vận chuyển ra ngoài -->
				<li>
					<a href="/storage"> <span class="material-icons">storefront</span>Quản lý kho</a>
					<ul class="child_list">
						<li><a href="/products">Quản lý sản phẩm</a></li>
						<li><a href="/product-category">Quản lý danh mục</a></li>
						<li><a href="/product-brand">Quản lý thương hiệu</a></li>
						<li><a href="/orders/import">Quản lý nhập hàng</a></li>
						<li><a href="">Quản lý xuất hàng</a></li>
						<li><a href="">Quản lý hạn sử dụng</a></li>
						<li><a href="">Quản lý xuất chuyển kho</a></li>
						<li><a href="">Quản lý đổi trả</a></li>
					</ul>
				</li>

				<li><a href="/report"><span class="material-icons">list_alt</span>Report</a></li>
				<li><a href=""><span class="material-icons">emoji_flags</span>Notification</a></li>

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