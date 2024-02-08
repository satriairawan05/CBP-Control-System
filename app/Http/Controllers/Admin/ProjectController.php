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
    public function __construct(private $name = 'Project', private $userRole = [], private $access = [], private $create = 0, private $read = 0, private $update = 0, private $delete = 0, private $apply = 0)
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

                return view('admin.projects.index', [
                    'name' => $this->name,
                    'projects' => Project::all(),
                    'access'=> $this->access
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
                    'summary'   => 'required', 'max:255',
                    'description'   => 'required', 'max:255',
                    'deadline'   => 'required', 'date',
                    'type'   => 'required', 'string',
                    'size'   => 'required', 'string',
                    'status'   => 'required', 'string',
                ]);

                if (!$validated->fails()) {
                    $module = \App\Models\Module::where('module', $this->name)->first();
                    $currentDate = now()->format('Ymd');
                    Project::create([
                        'title'   => $request->input('title'),
                        'summary'   => $request->input('summary'),
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
                    'summary'   => 'required', 'max:255',
                    'description'   => 'required', 'max:255',
                    'deadline'   => 'required', 'date',
                    'type'   => 'required', 'string',
                    'size'   => 'required', 'string',
                    'status'   => 'required', 'string',
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
                        'summary'   => $request->input('summary'),
                        'description'   => $request->input('description'),
                        'deadline'   => $request->input('deadline'),
                        'type'   => $request->input('type'),
                        'size'   => $request->input('size'),
                        'status' => $request->input('status'),
                        'flowchart' => $request->file('flowchart') ? $request->file('flowchart')->storeAs($this->name, 'flowchart_' . $currentDate) : $dataProject->flowchart,
                        'diagram' => $request->file('diagram') ? $request->file('diagram')->storeAs($this->name, 'diagram_' . $currentDate) : $dataProject->diagram,
                        'mockup' => $request->file('mockup') ? $request->file('mockup')->storeAs($this->name, 'mockup_' . $currentDate) : $dataProject->mockup,
                    ]);

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
            if ($this->apply == 1) {
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
                    }

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
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        try {
            $this->get_access_page();
            if ($this->delete == 1 && $project->status != 'Done') {
                $dataProject = $project->find(request()->segment(2));
                Project::destroy($dataProject->id);

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
