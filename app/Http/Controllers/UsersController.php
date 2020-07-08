<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Mail;

class UsersController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth', ['except' => ['requestAccount', 'sendMail']]);
    }

    public function index() {
        $users = User::all();
        $data = array(
            'users'     =>     $users,
        );

        return view('users.index')->with($data);
    }

    // Request account 
    public function requestAccount() {
    	return view('users.request');
    }

    // Handle Request Form
    public function sendMail( Request $request ) {
    	$input = $request->all();
    	
    	$email = $input["email"];
    	$staff_name = $input["staff_name"];

    	$data = array(
    		'email'			=>		$email,
    		'staff_name'	=>		$staff_name,
    	);

    	Mail::send('mailtemplate.regacc', $data, function($message) use ($email){
    		$message->from($email);
	        $message->to('dinhhoangbaochan@gmail.com', 'test')->subject('Visitor Feedback!');
	    });
        
        return redirect('request-account')->with('success', 'Đã gửi mail thành công, quản trị viên sẽ liên lạc với bạn!');

    }

    // Create account for staff
    public function createStaffAccount($id, $staff_name) {

    	$args = array(
    		'id'			=>		$id,
    		'staff_name'	=>		$staff_name,
    	);

    	return view('users.newstaff')->with($args);
    }

    // Submit form to create account
    public function createStaff( Request $request ) {

    	// Create new user
    	$user = new User;

    	$user->name = $request->input('staff_name');
    	$user->email = $request->input('email');
    	$user->password = Hash::make($request->input('password'));

    	$user->save();

    	// Assign role 
    	$staffRole = Role::find(2);
    	$user->assignRole($staffRole);

    	return redirect('/users')->with('success','Đã tạo nhân viên');

    }

    // Delete staff 
    public function deleteStaff($id) {
    	$user = User::find($id);
    	$user->delete();

        return redirect('/users')->with('success','Đã xoá user' );
    }

    // Update staff
    public function update( Request $request ) {
    	$name = $request->input('user_name');

    	return $name;
    }

}
