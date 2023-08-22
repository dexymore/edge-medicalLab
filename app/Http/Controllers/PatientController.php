<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    public function index()
    {
        return view('patientViews.index');
    }
    public function profile($mrn){
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
    
    
    
    
    public function viewDocument($url){

        return view('viewDocument',['url'=>$url])  ;
    }
    
    
    
}