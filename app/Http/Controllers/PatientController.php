<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    public function index()
    {
        $mrn = session()->get('mrn');
        $user = DB::table('users')->where('mrn', $mrn)->first();
        $tests = DB::select("SELECT * FROM tests");
        // Creating a new stdClass object to hold patient data
        $patient = new \stdClass();

        // Checking if the user and mrn are valid before assigning values
        if ($user) {
            $patient->email = $user->email;
            $patient->username = $user->username;
            $patient->birthdate = $user->birthdate;
            $patient->address = $user->address;
        }



        if ($mrn || $patient) {
            // Using the route() function instead of to_route()
            return view('patientViews.index', ['patient' => $patient, 'mrn' => $mrn, 'tests' => $tests]);
        }

        return view('patientViews.index', ['tests' => $tests]);
    }

    public function profile()
    {

        $mrn = session()->get('mrn');

        $patient  =  DB::table('users')->where('mrn', $mrn)->first();
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
        if ($patient == null) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return view('patientViews.profile', ['patient' => $patient, 'appointments' => $appointments, 'reports' => $reports,  'mrn' => $mrn]);
    }
    public function updateUserInfo(Request $request)
    {

        $request->validate([
            'username_input' => 'required',
            'email_input' => 'required|email',

            'address_input' => 'required',
            'date_input' => 'required|date|age_above:16',
        ], [
            'date_input.age_above' => 'You must be at least 16 years old to register.'
        ]);






        $email = $request->input('email_input');
        $name = $request->input('username_input');
        $mrn = session()->get('mrn');
        $birthdate = $request->input('date_input');
        $address = $request->input('address_input');

        DB::table('users')
            ->where('mrn', $mrn)
            ->update([
                'username' => $name,
                'email' => $email,
                'birthdate' => $birthdate,
                'address' => $address
            ]);
        return to_route('profile')
            ->with('success', 'User info updated successfully.');
    }
    public function updatePassword(Request $request)
    {


        $request->validate([
            'current_password' => 'required',
            'new_password' =>  'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z]).+$/',
        ], [
            'old_password.required' => 'The old password field is required.',
            'new_password.required' => 'The new password field is required.',
            'new_password.min' => 'The new password must be at least 8 characters.',
        ]);

        $currentPassword = $request->input('current_password');
        $newPassword = $request->input('new_password');
        $mrn = session()->get('mrn');

        $user = DB::select("SELECT * FROM users WHERE mrn = ? ", [$mrn]);

        if ($user == null) {
            return back()->with('error', 'Wrong email')->withInput();
        }

        if (Hash::check($currentPassword, $user[0]->password)) {
            $newHashedPassword = Hash::make($newPassword);
            DB::update("UPDATE users SET password = ? WHERE mrn = ?", [$newHashedPassword, $mrn]);
            return back()->with('success', 'Password updated successfully.');
        } else {
            return back()->with('error', 'Wrong password');
        }
    }




    public function deleteAppointments(Request $request)
    {

        $app_id = $request->input('app_id');

        // Delete the appointment using raw SQL query
        DB::delete("DELETE FROM appointments WHERE app_id = ?", [$app_id]);

        return to_route('profile')
            ->with('success', 'Appointment deleted successfully.');
    }

    public function UpdateAppointments(Request $request)
    {

        request()->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'phone' => 'required|numeric|digits:11',
            'selected' => 'required',

            'appointmentid' => 'required'
        ], [
            'date.after_or_equal' => 'The date must be after or equal to today.'
        ]);


        $app_id = $request->input('appointmentid');
        $date = $request->input('date');
        $time = $request->input('time');
        $phone = $request->input('phone');
        $testType = $request->input('selected');
        $mrn = session()->get('mrn');




        // Retrieve the patient appointment once
        $patientAppointment = DB::table('appointments')
            ->where('app_id', $app_id)
            ->first();

        // Use the original appointment values if inputs are null




        if ($testType == "0") {
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


        return to_route('profile')
            ->with('success', 'Appointment updated successfully.');
    }


    function makeAppointment(Request $request)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'phone' => 'required|numeric|digits:11',
            'selected' => 'required|integer|min:1|max:6',
        ], [
            'date.after_or_equal' => 'The date must be after today.',
            'selected.min' => 'Please select a valid Test Type.',
            'selected.max' => 'Please select a valid Test Type.',
        ]);



        $mrn = session()->get('mrn');
        $date = request('date');
        $time = request('time');
        $phone = request('phone');
        $testType = request('selected');





        DB::insert("INSERT INTO appointments (mrn, date, time, phone_number, test_type) VALUES (?, ?, ?, ?, ?)", [$mrn, $date, $time, $phone, $testType]);


        return to_route('profile');
    }



    public function showSignup()
    {

        return view("patientviews.signup");
    }

    public function handleSignup(Request $request)
    {


        $validator = $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z]).+$/',

            'address' => 'required',
            'date' => 'required|date|age_above:16',
        ], [
            'date.age_above' => 'You must be at least 16 years old to register.'
        ]);

        //  if($validator->fails()){
        //      return back()->with('error', 'Wrong password')->withInput();}

        $email = $request->input('email');
        $name = $request->input('username');
        $password = $request->input('password');
        $address = $request->input('address');
        $date =   $request->input('date');
        $hashedPassword = Hash::make($password);

        DB::insert("INSERT INTO users (username, email, password, address, birthdate) VALUES (?, ?, ?, ?, ?)", [$name, $email, $hashedPassword, $address, $date]);

        $mrn = DB::select("SELECT mrn FROM users WHERE email = ? ", [$email]);
        session()->regenerate();
        session(['mrn' => $mrn[0]->mrn]);
        return to_route('profile');
    }


    public function showLogin()
    {
        return view("patientviews.login");
    }

    public function handleLogin(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $user = DB::select("SELECT * FROM users WHERE email = ? ", [$email]);
        if ($user == null) {
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

    public function logout()
    {

        session()->invalidate();
        return to_route('index');
    }




    public function viewDocument($url)
    {

        return view('viewDocument', ['url' => $url]);
    }
}
