<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AcademicDepartment;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $departments = AcademicDepartment::where('is_active', true)->orderBy('name')->get();
        return view('auth.register', compact('departments'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:190', 'unique:users'],
            'institution_name' => ['required', 'string', 'max:190'],
            'academic_department_id' => ['required', 'exists:academic_departments,id'],
            'student_batch' => ['required', 'string', 'max:30'],
            'semester' => ['required', 'integer', 'min:1', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'institution_name' => $data['institution_name'],
            'academic_department_id' => $data['academic_department_id'],
            'student_batch' => $data['student_batch'],
            'semester' => $data['semester'],
            'account_status' => 'pending',
            'application_submitted_at' => now(),
        ]);

        $identity = str_pad((string) $user->id, 5, '0', STR_PAD_LEFT);
        $user->update([
            'student_id' => 'CN-' . now()->format('Y') . '-' . $identity,
            'application_number' => 'APP-' . now()->format('Y') . '-' . $identity,
        ]);

        return $user;
    }
}
