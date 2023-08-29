<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\File;


class AdminController extends Controller
{
    public function showAdminLogin()
    {
        return view('adminViews.login');
    }
    public function handleAdminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $email = $request->email;
        $password = $request->password;
        $admin = DB::select('select * from admin where email=? and password=?', [$email, $password]);

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
        $tests = DB::select('select * from tests');
        $users = DB::select('select * from users');
        return view('adminViews.index', ['users' => $users, 'tests' => $tests]);
    }
    public function deleteUser(Request $request)
    {
        $request->validate([
            'user_mrn' => 'required'
        ]);

        $mrn = $request->user_mrn;

        DB::delete('delete from users where mrn=?', [$mrn]);
        return back()->with('success', 'User deleted successfully');
    }

    public function editUserInfo(Request $request)
    {


        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'user_mrn' => 'required',
            'address' => 'required',
            'date' => 'required|date|age_above:16',
        ], [
            'date.age_above' => 'You must be at least 16 years old'
        ]);



        $email = $request->input('email');
        $name = $request->input('name');
        $address = $request->input('address');
        $date =   $request->input('date');
        $mrn = $request->input('user_mrn');

        DB::update("UPDATE users SET username=?, email=?, address=?, birthdate=? WHERE mrn=?", [$name, $email, $address, $date, $mrn]);
        return back()->with('success', 'User info updated successfully.');
    }
    public function addAppointment(Request $request)
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
        $mrn = $request->user_mrn;
        $date = $request->date;
        $time = $request->time;
        $phone = $request->phone;
        $testType = $request->selected;

        DB::insert("INSERT INTO appointments (mrn, date, time, phone_number, test_type) VALUES (?, ?, ?, ?, ?)", [$mrn, $date, $time, $phone, $testType]);
        return back()->with('success', 'Appointment added successfully');
    }

    public function adminAppoinments()
    {
        if (!session()->has('id')) {
            return redirect()->route('adminLogin');
        }
        $appointments = DB::select('
                SELECT a.app_id, a.date, a.time, a.phone_number, t.name AS test_name, u.username AS user_name, u.email, u.mrn, u.address
                FROM appointments a
                JOIN tests t ON a.test_type = t.test_id
                JOIN users u ON a.mrn = u.mrn
                ORDER BY a.date DESC
            ');

        // dd($appointments);



        return view('adminViews.appointments', ['appointments' => $appointments]);
    }

    public function updateUserAppointment(Request $request)
    {

        request()->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'phone' => 'required|numeric|digits:11',
            'selected' => 'required|integer',
            'user_mrn' => 'required',
            'app_id' => 'required'
        ], [
            'date.after_or_equal' => 'The date must be after or equal to today.'
        ]);


        $date = $request->input('date');
        $time = $request->input('time');
        $phone = $request->input('phone');
        $testType = $request->input('selected');
        $app_id = $request->input('app_id');
        $mrn = $request->input('user_mrn');

        $patientAppointment = DB::table('appointments')
            ->where('app_id', $app_id)
            ->first();

        // Use the original appointment values if inputs are null




        if ($testType == "0") {
            $testType = $patientAppointment->test_type;
        }



        DB::update("UPDATE appointments SET date=?, time=?, phone_number=?, test_type=? WHERE app_id=? AND mrn=?", [$date, $time, $phone, $testType, $app_id, $mrn]);

        return back()->with('success', 'Appointment updated successfully.');
    }

    public function deleteUserAppointment(Request $request)
    {
        $request->validate([
            'app_id' => 'required'
        ]);

        $app_id = $request->app_id;

        DB::delete('delete from appointments where app_id=?', [$app_id]);
        return back()->with('success', 'Appointment deleted successfully');
    }

    public function adminReports()
    {
        if (!session()->has('id')) {
            return redirect()->route('adminLogin');
        }
        $reports = DB::select(' SELECT r.report_id, r.url,r.app_id, u.username, u.address, u.email, u.mrn, a.date, a.time, a.phone_number,t.test_id, t.name AS test_name
    FROM reports r
    JOIN users u ON r.mrn = u.mrn
    JOIN appointments a ON r.app_id = a.app_id
    JOIN tests t ON a.test_type = t.test_id
    ');

        return view('adminViews.reports', ['reports' => $reports]);
    }








    public function uploadFile(Request $request)
    {
        $request->validate([
            'app_id' => 'required',
            'mrn' => 'required',
            'file' => 'required|mimes:pdf|max:2048',
        ], [
            'file.mimes' => 'Please upload a valid PDF file.',
            'file.max' => 'The file size must be less than 2 MB.'
        ]);
    
        $app_id = $request->app_id;
        $mrn = $request->mrn;
        $file = $request->file('file'); // Use 'file' key to retrieve the uploaded file
    
        // Fetch data using plain SQL statements
    
        $usernameData = DB::select("SELECT username FROM users WHERE mrn = ?", [$mrn])[0];
        $appointmentData = DB::select("SELECT time, date FROM appointments WHERE app_id = ?", [$app_id])[0];
    
        $username = $usernameData->username;
        $time = $appointmentData->time;
        $appointmentDate = $appointmentData->date;
    
        $hashedFileName = hash('sha256', $mrn . '_' . $appointmentDate . '_' . $username . '_' . str_replace(':', '_', $time)) . '.pdf';
    
        // Store the file in the "uploads" folder within the "public" disk using Storage module
        $file->storeAs('temp', $hashedFileName, 'public'); // Store temporarily
    
        // Move the temporarily stored file to the "uploads" folder
        Storage::disk('public')->move('temp/' . $hashedFileName, 'uploads/' . $hashedFileName);
    
        // Insert data using plain SQL statements
        $reportId = DB::table('reports')->insertGetId([
            'url' => $hashedFileName,
            'mrn' => $mrn,
            'app_id' => $app_id
        ]);
    
        return redirect()->back()->with('success', 'File uploaded successfully.');
    }
    


    public function updateFile(Request $request) {
        $request->validate([
            'report_id' => 'required',
            'app_id' => 'required',
            'file' => 'required|mimes:pdf|max:2048',
        ], [
            'file.mimes' => 'Please upload a valid PDF file.',
            'file.max' => 'The file size must be less than 2 MB.'
        ]);
    
        $app_id = $request->app_id;
        $mrn = $request->mrn;
        $reportId = $request->report_id;
        $file = $request->file;
    
        // ... (retrieve other data from the database)
    
        $usernameData = DB::select("SELECT username FROM users WHERE mrn = ?", [$mrn])[0];
        $appointmentData = DB::select("SELECT time, date FROM appointments WHERE app_id = ?", [$app_id])[0];
        $username = $usernameData->username;
        $time = $appointmentData->time;
        $appointmentDate = $appointmentData->date;
    
        // ... (generate hashed file name and other data)
        $hashedFileName = hash('sha256', $mrn . '_' . $appointmentDate . '_' . $username . '_' . str_replace(':', '_', $time)) . '.pdf';
    
        DB::update("UPDATE reports SET url = ? WHERE report_id = ?", [$hashedFileName, $reportId]);
    
        $file->storeAs('uploads', $hashedFileName, 'public');
    
        return redirect()->back()->with('success', 'File uploaded successfully.');
    }
    
    

    

    public function AdmindeleteReport(Request $request)
    {
        $request->validate([
            'user_report_id' => 'required',
        ]);
    
        $report_id = $request->user_report_id;
        $oldFileName = DB::table('reports')->where('report_id', $report_id)->value('url');
    
        $filePath = public_path('uploads/' . $oldFileName);
    
        if (File::exists($filePath)) {
            try {
                File::delete($filePath);
                DB::delete('DELETE FROM reports WHERE report_id = ?', [$report_id]);
                return back()->with('success', 'Report deleted successfully');
            } catch (\Exception $e) {
                return back()->with('error', 'Error deleting file: ' . $e->getMessage());
            }
        } else {
      
            return back()->with('error', 'File not found for deletion');
        }
    }
    

    public function logoutAdmin()
    {
        session()->invalidate();
        return redirect()->route('adminLogin');
    }
}