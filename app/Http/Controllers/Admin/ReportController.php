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
    public function __construct(private $name = 'Report', private $userRole = [], private $access = [], private $create = 0, private $read = 0, private $update = 0, private $delete = 0, private $apply = 0)
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

                $projectAcc = \App\Models\Project::where('approved_by', auth()->user()->name)->first();

                    if(auth()->user()->group_id == 3){
                        $report = Report::where('created_by', auth()->user()->name)->get();
                    } else {
                        $report = Report::all();
                    }

                return view('admin.reports.index', [
                    'name' => $this->name,
                    'reports' => $report,
                    'access' => $this->access,
                    'projectAcc' => $projectAcc
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
                return view('admin.reports.create', [
                    'name' => $this->name,
                    'project' => \App\Models\Project::all(),
                    'task' => \App\Models\Task::all()
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
                $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
                    'message' => 'required|max:255',
                    'code' => 'required|string',
                    'status' => 'required|string',
                    'image' => 'image|mimes:jpeg,png,jpg|max:5012',
                ]);

                if (!$validator->fails()) {
                    $module = \App\Models\Module::where('module', $this->name)->first();
                    $currentDate = now()->format('Ymd');

                    Report::create([
                        'project_id' => $request->input('project_id'),
                        'task_id' => $request->input('task_id'),
                        'code' => $request->input('code'),
                        'doc_number' => $this->generateNumber($this->name, $module->code, date('m'), date('Y')),
                        'message' => $request->input('message'),
                        'status' => $request->input('status'),
                        'image' => $request->file('image') ? $request->file('image')->storeAs($this->name, 'image_' . $currentDate) : null,
                        'created_by' => auth()->user()->name,
                    ]);

                    return redirect()->to(route('report.index'))->with('success', 'Data Saved!');
                } else {
                    return redirect()->back()->withErrors($validator)->withInput();
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
    public function show(Report $report)
    {
        try {
            $this->get_access_page();
            if ($this->read == 1) {
                //
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
    public function edit(Report $report)
    {
        try {
            $this->get_access_page();
            if ($this->update == 1) {
                return view('admin.reports.edit', [
                    'name' => $this->name,
                    'report' => $report,
                    'project' => \App\Models\Project::all(),
                    'task' => \App\Models\Task::all()
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
    public function update(Request $request, Report $report)
    {
        try {
            $this->get_access_page();
            if ($this->update == 1) {
                $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
                    'message' => 'required|max:255',
                    'code' => 'required|string',
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
                        'code' => $request->input('code'),
                        'message' => $request->input('message'),
                        'status' => $request->input('status'),
                        'updated_by' => auth()->user()->name,
                        'image' => $request->file('image') ? $request->file('image')->storeAs($this->name, 'image_' . $currentDate) : $dataReport->image,
                    ]);

                    return redirect()->to(route('report.index'))->with('success', 'Data Updated!');
                } else {
                    return redirect()->back()->withErrors($validator)->withInput();
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
    public function updateApproval(Request $request, Report $report)
    {
        try {
            $this->get_access_page();
            $apply = \App\Models\Approval::where('project_id', $report->project->id)->first();
            if ($this->apply == 1 && $apply->user->name == auth()->user()->name) {
                $validated = \Illuminate\Support\Facades\Validator::make($request->all(), [
                    'status'   => 'required', 'string',
                    'price'   => 'required',
                ]);

                if (!$validated->fails()) {
                    $dataReport = $report->find(request()->segment(2));

                    if ($request->input('status') == 'Done') {
                        Report::where('id', $dataReport->id)->update([
                            'status' => $request->input('status'),
                            'price' => $request->input('price'),
                            'finish_by' => auth()->user()->name
                        ]);
                    } else {
                        Report::where('id', $dataReport->id)->update([
                            'status' => $request->input('status'),
                            'price' => $request->input('price'),
                            'updated_by' => auth()->user()->name
                        ]);
                    }


                    return redirect()->to(route('report.index'))->with('success', 'Data Updated!');
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
    public function destroy(Report $report)
    {
        try {
            $this->get_access_page();
            if ($this->delete == 1) {
                $dataReport = $report->find(request()->segment(2));
                Report::destroy($dataReport->id);

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
