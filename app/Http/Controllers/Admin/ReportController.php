<?php

namespace App\Http\Controllers\Admin;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    /**
     * Constructor for Controller.
     */
    public function __construct(private $name = 'Report', private $create = 0, private $read = 0, private $update = 0, private $delete = 0)
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
                return view('admin.reports.index', [
                    'name' => $this->name,
                    'reports' => Report::all(),
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
                return view('admin.reports.create', [
                    'name' => $this->name,
                    'project' => \App\Models\Project::all(),
                    'task' => \App\Models\Task::all()
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
                $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
                    'message' => 'required|max:255',
                    'status' => 'required|string',
                    'image' => 'image|mimes:jpeg,png,jpg|max:5012',
                ]);

                if (!$validator->fails()) {
                    $module = \App\Models\Form::where('module', $this->name)->first();
                    $currentDate = now()->format('Ymd');

                    Report::create([
                        'project_id' => $request->input('project_id'),
                        'task_id' => $request->input('task_id'),
                        'code' => $this->generateNumber($this->name, $module->code, "SMR", date('m'), date('Y')),
                        'message' => $request->input('message'),
                        'status' => $request->input('status'),
                        'image' => $request->file('image') ? $request->file('image')->storeAs($this->name, 'image_' . $currentDate) : null,
                        'created_by' => auth()->user()->name,
                    ]);

                    return redirect()->to(route('report.index'))->with('success','Data Saved!');
                } else {
                    return redirect()->back()->withErrors($validator)->withInput();
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
    public function show(Report $report)
    {
        $this->get_access_page();
        if ($this->read == 1) {
            try {
                //
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
    public function edit(Report $report)
    {
        $this->get_access_page();
        if ($this->update == 1) {
            try {
                return view('admin.reports.edit', [
                    'name' => $this->name,
                    'report' => $report,
                    'project' => \App\Models\Project::all(),
                    'task' => \App\Models\Task::all()
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
    public function update(Request $request, Report $report)
    {
        $this->get_access_page();
        if ($this->update == 1) {
            try {
                $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
                    'message' => 'required|max:255',
                    'status' => 'required|string',
                    'image' => 'image|mimes:jpeg,png,jpg|max:5012',
                ]);

                if (!$validator->fails()) {
                    $dataReport = $report->find($request->segment(2));

                    if ($request->file('image') != $dataReport->image) {
                        \Illuminate\Support\Facades\Storage::delete($dataReport->image);
                    }

                    $currentDate = now()->format('Ymd');

                    Report::where('id', $dataReport->id)->update([
                        'project_id' => $request->input('project_id'),
                        'task_id' => $request->input('task_id'),
                        'message' => $request->input('message'),
                        'status' => $request->input('status'),
                        'image' => $request->file('image') ? $request->file('image')->storeAs($this->name, 'image_' . $currentDate) : $dataReport->flowchart,
                        'created_by' => auth()->user()->name,
                    ]);

                    return redirect()->to(route('report.index'))->with('success', 'Data Updated!');
                } else {
                    return redirect()->back()->withErrors($validator)->withInput();
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
    public function destroy(Report $report)
    {
        $this->get_access_page();
        if ($this->delete == 1) {
            try {
                $dataReport = $report->find(request()->segment(2));
                Report::destroy($dataReport->id);

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
