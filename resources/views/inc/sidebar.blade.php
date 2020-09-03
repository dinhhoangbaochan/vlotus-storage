@role('super admin')

	<aside>

		<div class="logo">

			<a href="{{ url('dashboard') }}"><img src="{{asset('img/logo.png')}}"></a>

		</div>

		<div class="menu_list">

			<ul>

				

				<li><a href="{{ url('users') }}"> <span class="material-icons">group</span>Quản lý User</a></li>

				<li><a href="javascript:void(0)"><span class="material-icons">account_tree</span>Quản lý vận đơn</a></li> 

				<li>
					<a href="{{ url('/products') }}"><span class="material-icons">shopping_cart</span>Quản lý sản phẩm</a>

					<ul class="child_list">
						<li><a href="{{ url('/products') }}">Tất cả sản phẩm</a></li>
						<li><a href="{{ url('/product-category') }}">Danh mục sản phẩm</a></li>
						<li><a href="javascript:void(0)">Đơn vị tính</a></li>
					</ul>
				</li>

				<li>

					<a href="{{ url('/storage') }}"> <span class="material-icons">storefront</span>Quản lý kho</a>

					<ul class="child_list">

						<li><a href="{{ url('/storage') }}">Quản lý tồn kho</a></li>
						<li><a href="{{ url('all-expiration') }}">Quản lý hạn sử dụng</a></li>
						<li><a href="{{ url('/orders/import') }}">Quản lý nhập hàng</a></li>
						<li><a href="{{ url('/orders/export') }}">Quản lý xuất hàng</a></li>
						<li><a href="javascript:void(0)">Quản lý xuất chuyển kho</a></li>
{{-- 						<li><a href="javascript:void(0)">Quản lý xuất chuyển kho</a></li>
						<li><a href="javascript:void(0)">Quản lý đổi trả</a></li>
 --}}
					</ul>

				</li>



				<li><a href="javascript:void(0)"><span class="material-icons">list_alt</span>Report</a></li>

				<li><a href="javascript:void(0)"><span class="material-icons">emoji_flags</span>Notification</a></li>



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