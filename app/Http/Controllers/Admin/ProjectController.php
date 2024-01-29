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
    public function __construct(private $name = 'Project', private $create = 0, private $read = 0, private $update = 0, private $delete = 0)
    {
        //
    }

    /**
     * Generate Access for Controller.
     */
    public function get_access_page()
    {
        $userRole = $this->get_access($this->name, auth()->user()->group_id);

        foreach ($userRole as $r) {
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
            }
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->get_access_page();
        if ($this->read == 1) {
            try {
                return view('admin.projects.index', [
                    'name' => $this->name,
                    'projects' => Project::all(),
                    'create' => $this->create,
                    'read' => $this->read,
                    'update' => $this->update,
                    'delete' => $this->delete
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                \Illuminate\Support\Facades\Log::error($e->getMessage());
                return redirect()->back()->with('failed', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('failed', 'You not Have Authority!');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->get_access_page();
        if ($this->create == 1) {
            try {
                return view('admin.projects.create', [
                    'name' => $this->name,
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                \Illuminate\Support\Facades\Log::error($e->getMessage());
                return redirect()->back()->with('failed', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('failed', 'You not Have Authority!');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->get_access_page();
        if ($this->create == 1) {
            try {
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
                    $module = \App\Models\Form::where('module', $this->name)->first();
                    $currentDate = now()->format('Ymd');
                    Project::create([
                        'title'   => $request->input('title'),
                        'summary'   => $request->input('summary'),
                        'description'   => $request->input('description'),
                        'deadline'   => $request->input('deadline'),
                        'type'   => $request->input('type'),
                        'size'   => $request->input('size'),
                        'code' => $this->generateNumber($this->name, $module->code, "SMR", date('m'), date('Y')),
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
            } catch (\Illuminate\Database\QueryException $e) {
                \Illuminate\Support\Facades\Log::error($e->getMessage());
                return redirect()->back()->with('failed', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('failed', 'You not Have Authority!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $this->get_access_page();
        if ($this->read == 1) {
            try {
                return view('admin.projects.show', [
                    'name' => $this->name,
                    'project' => $project->find(request()->segment(2))
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                \Illuminate\Support\Facades\Log::error($e->getMessage());
                return redirect()->back()->with('failed', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('failed', 'You not Have Authority!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $this->get_access_page();
        if ($this->update == 1) {
            try {
                return view('admin.projects.edit', [
                    'name' => $this->name,
                    'project' => $project->find(request()->segment(2))
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                \Illuminate\Support\Facades\Log::error($e->getMessage());
                return redirect()->back()->with('failed', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('failed', 'You not Have Authority!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $this->get_access_page();
        if ($this->update == 1) {
            try {
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

                    if($request->input('status') == 'Done'){
                        Project::where('id', $dataProject->id)->update([
                            'finish_by' => auth()->user()->name,
                        ]);
                    } else if($request->input('status') == 'Approved') {
                        Project::where('id', $dataProject->id)->update([
                            'approved_by' => auth()->user()->name,
                        ]);
                    } else {
                        Project::where('id', $dataProject->id)->update([
                            'updated_by' => auth()->user()->name,
                        ]);
                    }

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
            } catch (\Illuminate\Database\QueryException $e) {
                \Illuminate\Support\Facades\Log::error($e->getMessage());
                return redirect()->back()->with('failed', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('failed', 'You not Have Authority!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $this->get_access_page();
        if ($this->delete == 1) {
            try {
                $dataProject = $project->find(request()->segment(2));
                Project::destroy($dataProject->id);

                return redirect()->back()->with('success', 'Data Deleted');
            } catch (\Illuminate\Database\QueryException $e) {
                \Illuminate\Support\Facades\Log::error($e->getMessage());
                return redirect()->back()->with('failed', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('failed', 'You not Have Authority!');
        }
    }
}
