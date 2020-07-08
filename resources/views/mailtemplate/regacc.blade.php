<h2 style="">Email Yêu Cầu Tạo Tài Khoản</h2>

<p>Bạn vừa nhận được 1 email yêu cầu kích hoạt tài khoản, xem thông tin bên dưới:</p>

<ul>
	<li>Tên Nhân viên: {{ $staff_name }}</li>
	<li>Email yêu cầu: {{ $email }}</li>
</ul>

<p>Nhấn vào đường dẫn tại đây để thiết lập tài khoản mới cho nhân viên: 
	<a href="http://laravel-storage/new-staff/{{$staff_name}}/{{$email}}" target="_blank">Kích Hoạt</a></p>
