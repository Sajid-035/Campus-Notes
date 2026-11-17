<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AcademicDepartment;
use App\Models\AcademicSemester;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
        $semesters = AcademicSemester::active()->get();
        return view('auth.register', compact('departments', 'semesters'));
    }

    protected function validator(array $data)
    {
        $data['institution_name'] = trim((string) ($data['institution_name'] ?? ''));
        $data['institutional_id_number'] = trim((string) ($data['institutional_id_number'] ?? ''));

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:190', 'unique:users'],
            'account_type' => ['required', 'in:student,teacher,staff'],
            'institution_name' => ['required', 'string', 'max:190'],
            'institutional_id_number' => ['required', 'string', 'max:80', Rule::unique('users', 'institutional_id_number')->where(fn ($query) => $query->where('institution_name', $data['institution_name']))],
            'academic_department_id' => ['required', Rule::exists('academic_departments', 'id')->where('is_active', true)],
            'student_batch' => ['nullable', Rule::requiredIf(fn () => ($data['account_type'] ?? null) === 'student'), 'string', 'max:30'],
            'semester' => ['nullable', Rule::requiredIf(fn () => ($data['account_type'] ?? null) === 'student'), 'integer', Rule::exists('academic_semesters', 'number')->where('is_active', true)],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'account_type' => $data['account_type'],
            'institution_name' => $data['institution_name'],
            'institutional_id_number' => $data['institutional_id_number'],
            'academic_department_id' => $data['academic_department_id'],
            'student_batch' => $data['student_batch'] ?? null,
            'semester' => $data['semester'] ?? null,
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
