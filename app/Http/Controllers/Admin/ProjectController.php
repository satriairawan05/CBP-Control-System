<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    /**
     * Constructor for Controller.
     */
    public function __construct(private $name = 'Project', private $userRole = [], private $access = [], private $access_menu = [], private $create = 0, private $read = 0, private $update = 0, private $delete = 0, private $apply = 0)
    {
        //
    }

    /**
     * Generate Access for Controller.
     */
    public function get_access_page()
    {
        $this->userRole = $this->get_access($this->name, auth()->user()->group_id);

        foreach ($this->userRole as $r) {
            if ($r->page_name == $this->name) {
                if ($r->action == 'Create') {
                    $this->create = $r->access;
                }

                if ($r->action == 'Read') {
                    $this->read = $r->access;
                }

                if ($r->action == 'Update') {
                    $this->update = $r->access;
                }

                if ($r->action == 'Delete') {
                    $this->delete = $r->access;
                }

                if ($r->action == 'Apply to Completed') {
                    $this->apply = $r->access;
                }
            }
        }
    }

    /**
     * Get the contract information for a specific project.
     *
     * @param  int $projectId
     * @return \App\Models\Contract|null
     */
    public function get_contract($projectId)
    {
        return \App\Models\Contract::where('project_id', $projectId)->first();
    }

    /**
     * Get the invoice information for a specific project.
     *
     * @param  int $projectId
     * @return \App\Models\Invoice|null
     */
    public function get_invoice($projectId)
    {
        return \App\Models\Invoice::where('project_id', $projectId)->first();
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $this->get_access_page();
            if ($this->read == 1) {
                $this->access = [
                    'create' => $this->create,
                    'read' => $this->read,
                    'update' => $this->update,
                    'delete' => $this->delete,
                    'apply' => $this->apply
                ];

                if (auth()->user()->group_id == 3) {
                    $projects = Project::where('created_by', auth()->user()->name)->get();
                } else {
                    $projects = Project::all();
                }

                if ($projects != null) {
                    foreach ($projects as $project) {
                        $contractProject = $this->get_contract($project->id);
                        $invoiceProject = $this->get_invoice($project->id);
                        break;
                    }
                }

                $this->access_menu = [
                    'contract' => $contractProject ?? null,
                    'invoice' => $invoiceProject ?? null
                ];

                \Illuminate\Support\Facades\Log::info(auth()->user()->name . ' mengakses halaman project');

                return view('admin.projects.index', [
                    'name' => $this->name,
                    'projects' => $projects,
                    'access' => $this->access,
                    'access_menu' => $this->access_menu
                ]);
            } else {
                return redirect()->back()->with('failed', 'You not Have Authority!');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $this->get_access_page();
            if ($this->create == 1) {
                \Illuminate\Support\Facades\Log::info(auth()->user()->name . ' mengakses halaman tambah project');
                return view('admin.projects.create', [
                    'name' => $this->name,
                ]);
            } else {
                return redirect()->back()->with('failed', 'You not Have Authority!');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $this->get_access_page();
            if ($this->create == 1) {
                $validated = \Illuminate\Support\Facades\Validator::make($request->all(), [
                    'title'   => 'required', 'max:255',
                    // 'summary'   => 'required', 'max:255',
                    'description'   => 'required', 'max:255',
                    'deadline'   => 'required', 'date',
                    'type'   => 'required', 'string',
                    'size'   => 'required', 'string',
                    'status'   => 'required', 'string',
                    'flowchart' => 'mimes:zip,rar', 'max:5120',
                    'diagram' => 'mimes:zip,rar', 'max:5120',
                    'mockup' => 'mimes:zip,rar', 'max:10240',
                ]);

                if (!$validated->fails()) {
                    $module = \App\Models\Module::where('module', $this->name)->first();
                    $currentDate = now()->format('Ymd');
                    Project::create([
                        'title'   => $request->input('title'),
                        // 'summary'   => $request->input('summary'),
                        'description'   => $request->input('description'),
                        'deadline'   => $request->input('deadline'),
                        'type'   => $request->input('type'),
                        'size'   => $request->input('size'),
                        'code' => $this->generateNumber($this->name, $module->code, date('m'), date('Y')),
                        'created_by' => auth()->user()->name,
                        'status' => $request->input('status'),
                        'flowchart' => $request->file('flowchart') ? $request->file('flowchart')->storeAs($this->name, 'flowchart_' . $currentDate) : null,
                        'diagram' => $request->file('diagram') ? $request->file('diagram')->storeAs($this->name, 'diagram_' . $currentDate) : null,
                        'mockup' => $request->file('mockup') ? $request->file('mockup')->storeAs($this->name, 'mockup_' . $currentDate) : null,
                    ]);

                    \Illuminate\Support\Facades\Log::info(auth()->user()->name . ' menambah project baru');

                    return redirect()->to(route('project.index'))->with('success', 'Data Saved!');
                } else {
                    \Illuminate\Support\Facades\Log::error($validated->getMessageBag());
                    return redirect()->back()->withErrors($validated->getMessageBag())->withInput();
                }
            } else {
                return redirect()->back()->with('failed', 'You not Have Authority!');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        try {
            $this->get_access_page();
            if ($this->read == 1) {
                $dataProject = $project->find(request()->segment(2));
                \Illuminate\Support\Facades\Log::info(auth()->user()->name . ' mengakses halaman project dengan id ' . $project->id);
                return view('admin.projects.show', [
                    'name' => $this->name,
                    'project' => $dataProject,
                    'taskCount' => $dataProject->tasks()->done()->count(),
                    'reportCount' => $dataProject->reports()->done()->count()
                ]);
            } else {
                return redirect()->back()->with('failed', 'You not Have Authority!');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        try {
            $this->get_access_page();
            if ($this->update == 1) {
                \Illuminate\Support\Facades\Log::info(auth()->user()->name . ' mengakses halaman edit project dengan id ' . $project->id);
                return view('admin.projects.edit', [
                    'name' => $this->name,
                    'project' => $project->find(request()->segment(2))
                ]);
            } else {
                return redirect()->back()->with('failed', 'You not Have Authority!');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        try {
            $this->get_access_page();
            if ($this->update == 1 && $project->status != 'Done') {
                $validated = \Illuminate\Support\Facades\Validator::make($request->all(), [
                    'title'   => 'required', 'max:255',
                    // 'summary'   => 'required', 'max:255',
                    'description'   => 'required', 'max:255',
                    'deadline'   => 'required', 'date',
                    'type'   => 'required', 'string',
                    'size'   => 'required', 'string',
                    'status'   => 'required', 'string',
                    'flowchart' => 'mimes:zip,rar', 'max:5120',
                    'diagram' => 'mimes:zip,rar', 'max:5120',
                    'mockup' => 'mimes:zip,rar', 'max:10240',
                ]);

                if (!$validated->fails()) {
                    $dataProject = $project->find(request()->segment(2));

                    if ($request->file('flowchart') != $dataProject->flowchat) {
                        \Illuminate\Support\Facades\Storage::delete($dataProject->flowchart);
                    }

                    if ($request->file('mockup') != $dataProject->mockup) {
                        \Illuminate\Support\Facades\Storage::delete($dataProject->mockup);
                    }

                    if ($request->file('diagram') != $dataProject->diagram) {
                        \Illuminate\Support\Facades\Storage::delete($dataProject->diagram);
                    }

                    $currentDate = now()->format('Ymd');
                    Project::where('id', $dataProject->id)->update([
                        'title'   => $request->input('title'),
                        // 'summary'   => $request->input('summary'),
                        'description'   => $request->input('description'),
                        'deadline'   => $request->input('deadline'),
                        'type'   => $request->input('type'),
                        'size'   => $request->input('size'),
                        'status' => $request->input('status'),
                        'flowchart' => $request->file('flowchart') ? $request->file('flowchart')->storeAs($this->name, 'flowchart_' . $currentDate) : $dataProject->flowchart,
                        'diagram' => $request->file('diagram') ? $request->file('diagram')->storeAs($this->name, 'diagram_' . $currentDate) : $dataProject->diagram,
                        'mockup' => $request->file('mockup') ? $request->file('mockup')->storeAs($this->name, 'mockup_' . $currentDate) : $dataProject->mockup,
                    ]);

                    \Illuminate\Support\Facades\Log::info(auth()->user()->name . ' mengubah project dengan id ' . $project->id);

                    return redirect()->to(route('project.index'))->with('success', 'Data Updated!');
                } else {
                    \Illuminate\Support\Facades\Log::error($validated->getMessageBag());
                    return redirect()->back()->withErrors($validated->getMessageBag())->withInput();
                }
            } else {
                return redirect()->back()->with('failed', 'You not Have Authority!');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateApproval(Request $request, Project $project)
    {
        try {
            $this->get_access_page();
            $apply = \App\Models\Approval::where('project_id', $project->id)->first();
            if ($this->apply == 1 && $apply?->user()->name == auth()->user()->name) {
                $validated = \Illuminate\Support\Facades\Validator::make($request->all(), [
                    'status'   => 'required', 'string',
                ]);

                if (!$validated->fails()) {
                    $dataProject = $project->find(request()->segment(2));

                    if ($request->input('status') == 'Done') {
                        Project::where('id', $dataProject->id)->update([
                            'status' => $request->input('status'),
                            'finish_by' => auth()->user()->name
                        ]);
                    } else {
                        Project::where('id', $dataProject->id)->update([
                            'status' => $request->input('status'),
                            'approved_by' => auth()->user()->name
                        ]);

                        \App\Models\Approval::where('project_id', $dataProject->id)->update([
                            'app_date' => now()->format('Y-m-d')
                        ]);
                    }

                    \Illuminate\Support\Facades\Log::info(auth()->user()->name . ' mengupdate status ' . $request->input('status') . ' project dengan id ' . $project->id);

                    return redirect()->to(route('project.index'))->with('success', 'Data Updated!');
                } else {
                    \Illuminate\Support\Facades\Log::error($validated->getMessageBag());
                    return redirect()->back()->withErrors($validated->getMessageBag())->withInput();
                }
            } else {
                return redirect()->back()->with('failed', 'You not Have Authority!');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Display the specified project resource from Contract.
     */
    public function getContract(Project $project)
    {
        try {
            $this->get_access_page();
            if ($this->read == 1) {
                $contractProject = $this->get_contract($project->id);

                return view('admin.projects.contract', [
                    'contract' => $contractProject
                ]);
            } else {
                return redirect()->back()->with('failed', 'You not Have Authority!');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Display the specified project resource from Invoice.
     */
    public function getInvoice(Project $project)
    {
        try {
            $this->get_access_page();
            if ($this->read == 1) {
                $invoiceProject = $this->get_invoice($project->id);

                return view('admin.projects.invoice', [
                    'invoice' => $invoiceProject
                ]);
            } else {
                return redirect()->back()->with('failed', 'You not Have Authority!');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        try {
            $this->get_access_page();
            if ($this->delete == 1 && $project->status != 'Done') {
                $dataProject = $project->find(request()->segment(2));
                Project::destroy($dataProject->id);
                \Illuminate\Support\Facades\Log::info(auth()->user()->name . ' menghapus project dengan id ' . $project->id);

                return redirect()->back()->with('success', 'Data Deleted');
            } else {
                return redirect()->back()->with('failed', 'You not Have Authority!');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }
}
