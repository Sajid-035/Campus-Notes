<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicDepartment;
use App\Models\AcademicResource;
use App\Models\AcademicResourceCategory;
use App\Models\AcademicSemester;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AcademicSettingsController extends Controller
{
    public function index(): View
    {
        $departments = AcademicDepartment::withCount('resources')->orderBy('sort_order')->orderBy('name')->get();
        $semesters = AcademicSemester::orderBy('sort_order')->orderBy('number')->get();
        $categories = AcademicResourceCategory::withCount('resources')->orderBy('sort_order')->orderBy('name')->get();

        return view('backend.academic-settings.index', compact('departments', 'semesters', 'categories'));
    }

    public function storeDepartment(Request $request): RedirectResponse
    {
        $request->merge(['code' => strtoupper((string) $request->input('code'))]);
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'code' => ['required', 'string', 'max:20', 'alpha_dash', 'unique:academic_departments,code'],
            'description' => ['nullable', 'string', 'max:2000'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ]);
        $data['code'] = strtoupper($data['code']);
        $data['slug'] = $this->uniqueDepartmentSlug($data['name'], $data['code']);
        $data['is_active'] = true;
        $data['sort_order'] = $data['sort_order'] ?? 0;
        AcademicDepartment::create($data);

        return back()->with('success', 'Department added successfully.');
    }

    public function updateDepartment(Request $request, AcademicDepartment $department): RedirectResponse
    {
        $request->merge(['code' => strtoupper((string) $request->input('code'))]);
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'code' => ['required', 'string', 'max:20', 'alpha_dash', Rule::unique('academic_departments', 'code')->ignore($department->id)],
            'description' => ['nullable', 'string', 'max:2000'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'is_active' => ['nullable', 'boolean'],
        ]);
        $data['code'] = strtoupper($data['code']);
        $data['slug'] = $this->uniqueDepartmentSlug($data['name'], $data['code'], $department->id);
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $department->update($data);

        return back()->with('success', 'Department updated successfully.');
    }

    public function destroyDepartment(AcademicDepartment $department): RedirectResponse
    {
        $department->delete();
        return back()->with('success', 'Department deleted. Existing resources will keep their submissions with no department assigned.');
    }

    public function storeSemester(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'number' => ['required', 'integer', 'min:1', 'max:255', 'unique:academic_semesters,number'],
            'name' => ['required', 'string', 'max:100', 'unique:academic_semesters,name'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ]);
        $data['is_active'] = true;
        $data['sort_order'] = $data['sort_order'] ?? $data['number'];
        AcademicSemester::create($data);

        return back()->with('success', 'Semester option added successfully.');
    }

    public function updateSemester(Request $request, AcademicSemester $semester): RedirectResponse
    {
        $data = $request->validate([
            'number' => ['required', 'integer', 'min:1', 'max:255', Rule::unique('academic_semesters', 'number')->ignore($semester->id)],
            'name' => ['required', 'string', 'max:100', Rule::unique('academic_semesters', 'name')->ignore($semester->id)],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'is_active' => ['nullable', 'boolean'],
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? $data['number'];
        $oldNumber = $semester->number;
        DB::transaction(function () use ($semester, $data, $oldNumber) {
            $semester->update($data);
            if ((int) $oldNumber !== (int) $data['number']) {
                User::where('semester', $oldNumber)->update(['semester' => $data['number']]);
                AcademicResource::where('semester', $oldNumber)->update(['semester' => $data['number']]);
            }
        });

        return back()->with('success', 'Semester option updated successfully.');
    }

    public function destroySemester(AcademicSemester $semester): RedirectResponse
    {
        $inUse = AcademicResource::where('semester', $semester->number)->exists()
            || User::where('semester', $semester->number)->exists();
        if ($inUse) {
            return back()->with('error', 'This semester is already used by users or resources. Deactivate it instead of deleting it.');
        }
        $semester->delete();
        return back()->with('success', 'Semester option deleted.');
    }

    public function storeCategory(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:academic_resource_categories,name'],
            'description' => ['nullable', 'string', 'max:2000'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ]);
        $data['slug'] = $this->uniqueCategorySlug($data['name']);
        $data['is_active'] = true;
        $data['sort_order'] = $data['sort_order'] ?? 0;
        AcademicResourceCategory::create($data);

        return back()->with('success', 'Resource category added successfully.');
    }

    public function updateCategory(Request $request, AcademicResourceCategory $category): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', Rule::unique('academic_resource_categories', 'name')->ignore($category->id)],
            'description' => ['nullable', 'string', 'max:2000'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'is_active' => ['nullable', 'boolean'],
        ]);
        $data['slug'] = $this->uniqueCategorySlug($data['name'], $category->id);
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $oldName = $category->name;
        DB::transaction(function () use ($category, $data, $oldName) {
            AcademicResource::where('category', $oldName)->update(['category' => $data['name']]);
            $category->update($data);
        });

        return back()->with('success', 'Resource category updated successfully.');
    }

    public function destroyCategory(AcademicResourceCategory $category): RedirectResponse
    {
        if (AcademicResource::where('category', $category->name)->exists()) {
            return back()->with('error', 'This category is already used by resources. Deactivate it instead of deleting it.');
        }
        $category->delete();
        return back()->with('success', 'Resource category deleted.');
    }

    private function uniqueDepartmentSlug(string $name, string $code, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name . '-' . $code);
        $query = AcademicDepartment::where('slug', $slug);
        if ($ignoreId) $query->where('id', '!=', $ignoreId);
        return $query->exists() ? $slug . '-' . Str::lower(Str::random(5)) : $slug;
    }

    private function uniqueCategorySlug(string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $query = AcademicResourceCategory::where('slug', $slug);
        if ($ignoreId) $query->where('id', '!=', $ignoreId);
        return $query->exists() ? $slug . '-' . Str::lower(Str::random(5)) : $slug;
    }
}
