<?php

namespace App\Http\Controllers\Admin;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    /**
     * Constructor for Controller.
     */
    public function __construct(private $name = 'Task', private $create = 0, private $read = 0, private $update = 0, private $delete = 0)
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
                return view('admin.tasks.index', [
                    'name' => $this->name,
                    'tasks' => Task::all(),
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
                return view('admin.tasks.create', [
                    'name' => $this->name,
                    'project' => \App\Models\Project::all()
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
                    'feature'   => 'required', 'max:255',
                    'summary'   => 'required', 'max:255',
                    // 'description'   => 'required', 'max:255',
                    'budget'   => 'required',
                    'project_id'   => 'required',
                ]);
                if (!$validated->fails()) {
                    $module = \App\Models\Form::where('module',$this->name)->first();
                    Task::create([
                        'feature' => $request->input('feature'),
                        'summary' => $request->input('summary'),
                        // 'description' => $request->input('description'),
                        'budget' => $request->input('budget'),
                        'project_id' => $request->input('project_id'),
                        'code' => $this->generateNumber($this->name,$module->code,"SMR",date('m'), date('Y')),
                        'created_by' => auth()->user()->name,
                    ]);

                    return redirect()->to(route('task.index'))->with('success', 'Data Saved!');
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
    public function show(Task $task)
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
    public function edit(Task $task)
    {
        $this->get_access_page();
        if ($this->update == 1) {
            try {
                return view('admin.tasks.edit', [
                    'name' => $this->name,
                    'project' => \App\Models\Project::all(),
                    'task' => $task
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
    public function update(Request $request, Task $task)
    {
        $this->get_access_page();
        if ($this->update == 1) {
            try {
                $validated = \Illuminate\Support\Facades\Validator::make($request->all(), [
                    'feature'   => 'required', 'max:255',
                    'summary'   => 'required', 'max:255',
                    'status'   => 'required', 'max:255',
                    'budget'   => 'required',
                    'project_id'   => 'required',
                ]);
                if (!$validated->fails()) {

                    if($request->input('status') != 'Done'){
                        Task::where('id',$task->id)->update([
                            'updated_by' => auth()->user()->name,
                        ]);
                    } else {
                        Task::where('id',$task->id)->update([
                            'finish_by' => auth()->user()->name,
                        ]);
                    }

                    Task::where('id',$task->id)->update([
                        'feature' => $request->input('feature'),
                        'summary' => $request->input('summary'),
                        'status' => $request->input('status'),
                        'budget' => $request->input('budget'),
                        'project_id' => $request->input('project_id'),
                    ]);

                    return redirect()->to(route('task.index'))->with('success', 'Data Updated!');
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
    public function destroy(Task $task)
    {
        $this->get_access_page();
        if ($this->delete == 1) {
            try {
                $dataTask = $task->find(request()->segment(2));
                Task::destroy($dataTask->id);

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
