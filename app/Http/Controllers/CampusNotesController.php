<?php
namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\ResourceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CampusNotesController extends Controller
{
    private function role(): string { return session('demo_role', 'Student'); }

    public function home() {
        $departments = Department::where('is_active', true)->withCount('resources')->orderBy('name')->get();
        $latest = ResourceItem::with('department')->where('status','approved')->latest()->take(6)->get();
        $stats = [
            'resources'=>ResourceItem::where('status','approved')->count(),
            'departments'=>Department::where('is_active',true)->count(),
            'downloads'=>(int) ResourceItem::sum('downloads'),
            'pending'=>ResourceItem::where('status','pending')->count()
        ];
        return view('campusnotes.home', compact('departments','latest','stats'));
    }

    public function resources(Request $request) {
        $q = ResourceItem::with('department')->where('status','approved');
        if ($request->filled('q')) {
            $term = $request->q;
            $q->where(fn($x) => $x->where('title','like',"%$term%")->orWhere('subject','like',"%$term%")->orWhere('subject_code','like',"%$term%"));
        }
        if ($request->filled('department')) $q->where('department_id',$request->department);
        if ($request->filled('category')) $q->where('category',$request->category);
        $resources = $q->latest()->paginate(9)->withQueryString();
        $departments = Department::where('is_active',true)->orderBy('name')->get();
        $categories = ResourceItem::where('status','approved')->distinct()->orderBy('category')->pluck('category');
        return view('campusnotes.resources.index',compact('resources','departments','categories'));
    }

    public function show(ResourceItem $resource) {
        abort_unless($resource->status === 'approved' || in_array($this->role(),['Admin','Super Admin','Moderator']),404);
        $resource->load('department');
        return view('campusnotes.resources.show',compact('resource'));
    }

    public function create() {
        abort_unless(in_array($this->role(),['Student','Teacher','Admin','Super Admin']),403);
        $departments = Department::where('is_active',true)->orderBy('name')->get();
        return view('campusnotes.resources.create',compact('departments'));
    }

    public function store(Request $request) {
        abort_unless(in_array($this->role(),['Student','Teacher','Admin','Super Admin']),403);
        $data = $request->validate([
            'title'=>'required|string|max:180','description'=>'required|string|max:3000',
            'category'=>'required|string|max:80','subject'=>'required|string|max:150',
            'subject_code'=>'nullable|string|max:40','semester'=>'required|string|max:40',
            'academic_year'=>'nullable|string|max:20','department_id'=>'required|exists:departments,id',
            'file'=>'required|file|mimes:pdf|max:10240'
        ]);
        $file = $request->file('file');
        $path = $file->store('resources','public');
        unset($data['file']);
        ResourceItem::create($data + [
            'uploader_name'=>$this->role().' Demo User','file_path'=>$path,
            'original_filename'=>$file->getClientOriginalName(),'file_size'=>$file->getSize(),'status'=>'pending'
        ]);
        return redirect()->route('resources.index')->with('success','Resource uploaded and sent for moderation.');
    }

    public function download(ResourceItem $resource) {
        abort_unless($resource->status === 'approved' && $resource->file_path && Storage::disk('public')->exists($resource->file_path),404);
        $resource->increment('downloads');
        return Storage::disk('public')->download($resource->file_path,$resource->original_filename);
    }

    public function dashboard() {
        $role=$this->role();
        $pending=ResourceItem::with('department')->where('status','pending')->latest()->take(10)->get();
        $latest=ResourceItem::with('department')->where('status','approved')->latest()->take(8)->get();
        $counts=[
            'all'=>ResourceItem::count(),'approved'=>ResourceItem::where('status','approved')->count(),
            'pending'=>ResourceItem::where('status','pending')->count(),'rejected'=>ResourceItem::where('status','rejected')->count(),
            'departments'=>Department::count(),'downloads'=>(int)ResourceItem::sum('downloads')
        ];
        return view('campusnotes.dashboard',compact('role','pending','latest','counts'));
    }

    public function switchRole(Request $request) {
        $request->validate(['role'=>['required',Rule::in(['Student','Teacher','Moderator','Admin','Super Admin'])]]);
        session(['demo_role'=>$request->role]);
        return back()->with('success','Demo view switched to '.$request->role.'.');
    }

    public function moderate(Request $request, ResourceItem $resource) {
        abort_unless(in_array($this->role(),['Moderator','Admin','Super Admin']),403);
        $request->validate(['status'=>['required',Rule::in(['approved','rejected'])]]);
        $resource->update(['status'=>$request->status]);
        return back()->with('success','Resource status updated.');
    }

    public function departments() {
        $departments=Department::where('is_active',true)->withCount('resources')->orderBy('name')->get();
        return view('campusnotes.departments',compact('departments'));
    }

    public function storeDepartment(Request $request) {
        abort_unless(in_array($this->role(),['Admin','Super Admin']),403);
        $data=$request->validate(['name'=>'required|string|max:120','code'=>'required|string|max:20|unique:departments,code','description'=>'nullable|string|max:1000']);
        Department::create($data+['is_active'=>true]);
        return back()->with('success','Department added.');
    }
}
