<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contract;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContractController extends Controller
{
    /**
     * Constructor for Controller.
     */
    public function __construct(private $name = 'Contract', private $userRole = [], private $create = 0, private $read = 0, private $update = 0, private $delete = 0)
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
                return view('admin.contracts.index', [
                    'name' => $this->name,
                    'contracts' => Contract::all(),
                    'create' => $this->create,
                    'read' => $this->read,
                    'update' => $this->update,
                    'delete' => $this->delete

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
                return view('admin.contracts.create', [
                    'name' => $this->name,
                    'project' => \App\Models\Project::all(),
                    'first' => \App\Models\User::all(),
                    'second' => \App\Models\User::all(),
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
                    'project_id' => 'required',
                    'first' => 'required',
                    'second' => 'required',
                    'effective_date' => 'required|date',
                    'expiration_date' => 'required|date',
                    'pasal' => 'required',
                    'title' => 'required',
                    'description' => 'required',
                ]);

                if (!$validated->fails()) {
                    $module = \App\Models\Module::where('module', $this->name)->first();

                    $contract = Contract::create([
                        'project_id' => $request->project_id,
                        'first' => $request->first,
                        'second' => $request->second,
                        'effective_date' => $request->effective_date,
                        'expiration_date' => $request->expiration_date,
                        'code' => $this->generateNumber($this->name, $module->code, date('m'), date('Y')),
                        'created_by' => auth()->user()->name
                    ]);

                    for ($i = 0; $i < count($request->pasal); $i++) {
                        if ($request->pasal[$i] != null && $request->title[$i] != null && $request->description[$i] != null) {
                            \App\Models\ContractDetail::create([
                                'contract_id' => $contract->id,
                                'pasal' => $request->pasal[$i],
                                'title' => $request->title[$i],
                                'description' => $request->description[$i],
                            ]);
                        }
                    }

                    return redirect()->to(route('contract.index'))->with('success', 'Data Saved!');
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
    public function show(Contract $contract)
    {
        try {
            $this->get_access_page();
            if ($this->read == 1) {
                $dataContract = $contract->find(request()->segment(2));
                return view('admin.contracts.show', [
                    'name' => $this->name,
                    'contract' => $dataContract,
                    'details' => $dataContract->contractDetails(),
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
    public function edit(Contract $contract)
    {
        try {
            $this->get_access_page();
            if ($this->update == 1) {
                $dataContract = $contract->find(request()->segment(2));
                return view('admin.contracts.edit', [
                    'name' => $this->name,
                    'project' => \App\Models\Project::all(),
                    'contract' => $dataContract,
                    'first' => \App\Models\User::all(),
                    'second' => \App\Models\User::all(),
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
    public function update(Request $request, Contract $contract)
    {
        try {
            $this->get_access_page();
            if ($this->update == 1) {
                $validated = \Illuminate\Support\Facades\Validator::make($request->all(), [
                    'project_id' => 'required',
                    'first' => 'required',
                    'second' => 'required',
                    'effective_date' => 'required|date',
                    'expiration_date' => 'required|date',
                    'pasal' => 'required',
                    'title' => 'required',
                    'description' => 'required',
                ]);

                if (!$validated->fails()) {

                    $contract->update([
                        'project_id' => $request->project_id,
                        'first' => $request->first,
                        'second' => $request->second,
                        'effective_date' => $request->effective_date,
                        'expiration_date' => $request->expiration_date,
                        'updated_by' => auth()->user()->name
                    ]);

                    $contract->contractDetails()->delete();

                    for ($i = 0; $i < count($request->pasal); $i++) {
                        if ($request->pasal[$i] != null && $request->title[$i] != null && $request->description[$i] != null) {
                            \App\Models\ContractDetail::create([
                                'contract_id' => $contract->id,
                                'pasal' => $request->pasal[$i],
                                'title' => $request->title[$i],
                                'description' => $request->description[$i],
                            ]);
                        }
                    }

                    return redirect()->to(route('contract.index'))->with('success', 'Data Updated!');
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
     * Show data for form editing the specified resource.
     */
    public function getDetail(Contract $contract)
    {
        try {
            $this->get_access_page();
            if ($this->update == 1) {
                $dataContract = \App\Models\ContractDetail::where('contract_id', $contract->id)->select('pasal', 'title', 'description', 'contract_id')->get();

                return \Illuminate\Support\Facades\Response::json([
                    'data' => $dataContract
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
    public function destroy(Contract $contract)
    {
        try {
            $this->get_access_page();
            if ($this->delete == 1) {
                $dataContract = $contract->find(request()->segment(2));
                $dataContract->contractDetails()->delete();
                $dataContract->delete();

                return redirect()->back()->with('success', 'Data Deleted!');
            } else {
                return redirect()->back()->with('failed', 'You not Have Authority!');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }
}
