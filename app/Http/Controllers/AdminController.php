<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
public function showAdminLogin()
{
    return view('adminViews.login');
}
public function handleAdminLogin(Request $request)
{
    $request->validate([
        'email'=>'required|email',
        'password'=>'required'
    ]);
$email=$request->email;
$password=$request->password;
$admin=DB::select('select * from admin where email=? and password=?',[$email,$password]);

if (!$admin) {
    return back()->with('error', 'No admin with these credentials')->withInput();
}


session()->regenerate();
        session(['id' => $admin[0]->id]);
    return to_route('adminProfile');
}

///admin functionalities over users
public function adminProfile()
{
    if (!session()->has('id')) {
        return redirect()->route('adminLogin');
    }
$tests=DB::select('select * from tests');
    $users=DB::select('select * from users');
    return view('adminViews.index',['users'=>$users,'tests'=>$tests]);

}
public function deleteUser(Request $request)
{
    $request->validate([
        'user_mrn'=>'required'
    ]);

    $mrn=$request->user_mrn;   

    DB::delete('delete from users where mrn=?',[$mrn]);
    return back()->with('success','User deleted successfully');

   
}

public function editUserInfo(Request $request)
{

    
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
       'user_mrn'=>'required',
        'address' => 'required',
        'date' => 'required|date|age_above:16',
    ], [
        'date.age_above' => 'You must be at least 16 years old'
    ]);



$email= $request->input('email');
 $name = $request->input('name');
 $address= $request->input('address');
 $date=   $request->input('date');
$mrn=$request->input('user_mrn');

DB::update("UPDATE users SET username=?, email=?, address=?, birthdate=? WHERE mrn=?", [$name, $email, $address, $date, $mrn]);
return back()->with('success', 'User info updated successfully.');
    
   
}
public function addAppointment(Request $request)
{
    
    $request->validate([
    'date' => 'required|date|after_or_equal:today',
    'time' => 'required',
    'phone' => 'required|numeric',
    'selected' => 'required|integer|min:1|max:6', 
], [
    'date.after_or_equal' => 'The date must be after today.',
    'selected.min' => 'Please select a valid Test Type.',
    'selected.max' => 'Please select a valid Test Type.',
]);
    $mrn=$request->user_mrn;
    $date=$request->date;
    $time=$request->time;
    $phone=$request->phone;
    $testType=$request->selected;
    
    DB::insert("INSERT INTO appointments (mrn, date, time, phone_number, test_type) VALUES (?, ?, ?, ?, ?)", [$mrn, $date, $time, $phone, $testType]);
    return back()->with('success','Appointment added successfully');


    
}
    
public function adminAppoinments()
{
    if (!session()->has('id')) {
        return redirect()->route('adminLogin');
    }
    $appointments = DB::select('
    SELECT a.app_id, a.date, a.time, a.phone_number, t.name AS test_name, u.username AS user_name, u.email, u.mrn
    FROM appointments a
    JOIN tests t ON a.test_type = t.test_id
    JOIN users u ON a.mrn = u.mrn
    ORDER BY a.date DESC
');


    return view('adminViews.appointments',['appointments'=>$appointments]);
    
}

// public function updateUserAppointment(Request $request){
//     request()->validate([
//         'date' => 'required|date|after_or_equal:today',
//         'time' => 'required',
//         'phone' => 'required|numeric',
//         'selected' => 'required|integer|min:1|max:6',
    
//         'appointmentid' => 'required'
//     ], [
//         'date.after_or_equal' => 'The date must be after or equal to today.'
//     ]);
    
//     $date = request('date');
//     $time = request('time');
//     $phone = request('phone');
//     $testType = request('selected');
//     $app_id = request('appointmentid');
//     $mrn = request('mrn');
    
// DB::update("UPDATE appointments SET date=?, time=?, phone_number=?, test_type=? WHERE app_id=? AND mrn=?", [$date, $time, $phone, $testType, $app_id, $mrn]);
    
//     return back()->with('success', 'Appointment updated successfully.');
    
    
// }


public function logout()
{
    session()->invalidate();
    return redirect()->route('adminLogin');}

}