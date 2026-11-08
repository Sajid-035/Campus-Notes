<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index']]);
        $this->middleware('permission:user-list', ['only' => ['show']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request): View
    {
        $data = User::latest()->paginate(5);

        return view('users.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create(): View
    {
        $roleQuery = Role::query();
        if (!auth()->user()->hasRole('Super Admin')) {
            $roleQuery->whereNotIn('name', ['Super Admin', 'Admin']);
        }
        $roles = $roleQuery->pluck('name', 'name')->all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles'    => 'required|array|min:1',
            'roles.*'  => 'required|string|exists:roles,name',
        ]);

        $input = $request->only(['name', 'email']);
        $input['password'] = Hash::make($request->input('password'));
        $input['account_status'] = 'pending';
        $input['application_submitted_at'] = now();

        $this->assertAssignableRoles($request->input('roles', []));
        $user = User::create($input);
        $this->ensureCampusIdentity($user);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    public function show($id): View
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    public function edit($id): View
    {
        $user = User::findOrFail($id);
        abort_if(($user->hasRole('Super Admin') || $user->hasRole('Admin')) && !auth()->user()->hasRole('Super Admin'), 403);
        $roleQuery = Role::query();
        if (!auth()->user()->hasRole('Super Admin')) {
            $roleQuery->whereNotIn('name', ['Super Admin', 'Admin']);
        }
        $roles = $roleQuery->pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles'    => 'required|array|min:1',
            'roles.*'  => 'required|string|exists:roles,name',
        ]);

        $input = $request->only(['name', 'email']);
        if ($request->filled('password')) {
            $input['password'] = Hash::make($request->input('password'));
        }

        $user = User::findOrFail($id);
        abort_if(($user->hasRole('Super Admin') || $user->hasRole('Admin')) && !auth()->user()->hasRole('Super Admin'), 403);
        $this->assertAssignableRoles($request->input('roles', []));
        $user->update($input);

        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        User::findOrFail($id)->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }

    private function assertAssignableRoles(array $roleNames): void
    {
        if (!auth()->user()->hasRole('Super Admin') && array_intersect($roleNames, ['Super Admin', 'Admin'])) {
            abort(403, 'You are not allowed to assign an administrative super role.');
        }
    }

    private function ensureCampusIdentity(User $user): void
    {
        $identity = str_pad((string) $user->id, 5, '0', STR_PAD_LEFT);
        $year = now()->format('Y');
        $user->update([
            'student_id' => $user->student_id ?: 'CN-' . $year . '-' . $identity,
            'application_number' => $user->application_number ?: 'APP-' . $year . '-' . $identity,
        ]);
    }
}
