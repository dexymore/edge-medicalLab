<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class PatientController extends Controller
{
    public function index()
    {
        return view('patientViews.index');
    }
    public function profile(){
   
         $mrn= session()->get('mrn');
  
        $patient  =  DB::table('users')->where('mrn',$mrn)->first();
        $appointments = DB::table('appointments')
        ->join('tests', 'appointments.test_type', '=', 'tests.test_id')
        ->where('appointments.mrn', $mrn)
        ->whereDate('appointments.date', '>', now()) // Change condition to >
        ->select('appointments.*', 'tests.name as test_name')
        ->get();
    
       
       
       
        $reports = DB::table('reports as r')
        ->join('users as u', 'r.mrn', '=', 'u.mrn')
        ->join('appointments as a', 'r.appointment_id', '=', 'a.app_id')
        ->join('tests as t', 'a.test_type', '=', 't.test_id')
        ->where('u.mrn', $mrn)
        ->select('r.report_id', 'r.url', 'u.username', 'u.email', 'u.mrn', 'a.date', 'a.time', 'a.phone_number', 't.name as test_name')
        ->get();
    
    
        // $tests = DB::table('tests')->where('mrn',$mrn)->get();
        if($patient == null){
            return response()->json(['error' => 'User not found'], 404);

        }
        
        return view('patientViews.profile',['patient'=>$patient , 'appointments'=>$appointments , 'reports'=>$reports,  'mrn'=>$mrn]);
    }
    public function updateUserInfo(Request $request){
        $email = $request->input('email_input');
        $name= $request->input('username_input');
        $mrn = $request->input('mrn');
        $age = $request->input('age_input');
        $address = $request->input('address_input');
     $pateint = DB::table('users')->where('mrn',$mrn)->first();
   $attributesChanged = $pateint->username !== $name ||
                             $pateint->email !== $email ||
                             $pateint->age !== $age ||
                             $pateint->address !== $address;
        if (!$attributesChanged) {
            
            return redirect()->route('profile', ['mrn' => $request->input('mrn')]);
        }
        DB::table('users')
        ->where('mrn', $mrn)
        ->update([
            'username' => $name,
            'email' => $email,
            'age' => $age,
            'address' => $address
        ]);
        return redirect()->route('profile', ['mrn' => $request->input('mrn')])
                         ->with('success', 'User info updated successfully.');
        
    }
    public function updatePassword(){
        //
    }
    public function deleteAppointments(Request $request)
    {
        
        $app_id = $request->input('app_id');
    
        // Delete the appointment using raw SQL query
        DB::delete("DELETE FROM appointments WHERE app_id = ?", [$app_id]);
    
        return redirect()->route('profile', ['mrn' => $request->input('mrn')])
                     ->with('success', 'Appointment deleted successfully.');
    }

    public function UpdateAppointments(Request $request)
    {
        $app_id = $request->input('appointmentid');
        $date = $request->input('date');
        $time = $request->input('time');
        $phone = $request->input('phone');
        $testType = $request->input('selected');
        $mrn = $request->input('mrn');
    
        // Retrieve the patient appointment once
        $patientAppointment = DB::table('appointments')
            ->where('app_id', $app_id)
            ->first();
    
        // Use the original appointment values if inputs are null
        $date = $date ?? $patientAppointment->date;
        $time = $time ?? $patientAppointment->time;
    
        // Check if any attributes have changed
        $attributesChanged = $patientAppointment->date !== $date ||
                             $patientAppointment->time !== $time ||
                             $patientAppointment->phone_number !== $phone ||
                             $testType != "0"; // Check if testType is not "0"
    
                             
        if (!$attributesChanged) {
            
            return redirect()->route('profile', ['mrn' => $request->input('mrn')]);
        }
        if($testType == "0"){
            $testType = $patientAppointment->test_type;
        }
    
        // Update the appointment
        DB::table('appointments')
            ->where('app_id', $app_id)
            ->where('mrn', $mrn)
            ->update([
                'phone_number' => $phone,
                'test_type' => $testType,
                'time' => $time,
                'date' => $date
            ]);
    
        return redirect()->route('profile', ['mrn' => $request->input('mrn')])
                         ->with('success', 'Appointment updated successfully.');
    }
    
    
public function showSignup(){

    return view("patientviews.signup");
}

public function handleSignup(Request $request){


    $request->validate([
        'username' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8',
        'address' => 'required',
        'date' => 'required|date|age_above:16',
    ], [
        'date.age_above' => 'You must be at least 16 years old to register.'
    ]);
    
 
    
    $email= $request->input('email');
     $name = $request->input('username');
     $password = $request->input('password');
     $address= $request->input('address');
     $date=   $request->input('date');
 $hashedPassword = Hash::make($password);
 
 DB::insert("INSERT INTO users (username, email, password, address, birthdate) VALUES (?, ?, ?, ?, ?)", [$name, $email, $hashedPassword, $address, $date]);

 $mrn = DB::select("SELECT mrn FROM users WHERE email = ? ", [$email]);
    session()->regenerate();
        session(['mrn' => $mrn[0]->mrn]);
return to_route('profile');

     
}

    
    public function showLogin(){
        return view("patientviews.login");
    }

    public function handleLogin(Request $request){
    $email = $request->input('email');
    $password = $request->input('password');
    
    $user = DB::select("SELECT * FROM users WHERE email = ? ", [$email]);
    if($user == null){
       return back()->with('error', ' wrong email')->withInput();
    }

    if (Hash::check($password, $user[0]->password)) {
     
session()->regenerate();
        session(['mrn' => $user[0]->mrn]);
return to_route('profile');
        
    } else {
        return back()->with('error', ' wrong password');
    }
    
    }
    
public function logout(){
    
session()->invalidate();
return to_route('index');
    

    
}

    
    public function viewDocument($url){

        return view('viewDocument',['url'=>$url])  ;
    }
    
    
    
}