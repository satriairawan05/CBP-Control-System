<?php

namespace App\Http\Controllers\Admin;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    /**
     * Constructor for Controller.
     */
    public function __construct(private $name = 'Invoice', private $userRole = [], private $access = [], private $create = 0, private $read = 0, private $update = 0, private $delete = 0)
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
                $this->access = [
                    'create' => $this->create,
                    'read' => $this->read,
                    'update' => $this->update,
                    'delete' => $this->delete,
                ];

                return view('admin.invoices.index', [
                    'name' => $this->name,
                    'invoices' => Invoice::all(),
                    'access' => $this->access,
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
                return view('admin.invoices.create', [
                    'name' => $this->name,
                    'project' => \App\Models\Project::all(),
                    'first' => \App\Models\User::where('group_id',2)->get(),
                    'second' => \App\Models\User::where('group_id',3)->get(),
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
                ]);

                if (!$validated->fails()) {
                    $module = \App\Models\Module::where('module', $this->name)->first();
                    Invoice::create([
                        'project_id' => $request->input('project_id'),
                        'first' => $request->input('first'),
                        'second' => $request->input('second'),
                        'effective_date' => $request->input('effective_date'),
                        'expiration_date' => $request->input('expiration_date'),
                        'payment' => $request->input('payment'),
                        'account_number' => $request->input('account_number'),
                        'code' => $this->generateNumber($this->name, $module->code, date('m'), date('Y')),
                        'created_by' => auth()->user()->name
                    ]);

                    return redirect()->to(route('invoice.index'))->with('success', 'Data Saved!');
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
    public function show(Invoice $invoice)
    {
        try {
            $this->get_access_page();
            if ($this->read == 1) {
                return view('admin.invoices.show', [
                    'invoice' => $invoice
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
    public function edit(Invoice $invoice)
    {
        try {
            $this->get_access_page();
            if ($this->update == 1) {
                return view('admin.invoices.edit', [
                    'name' => $this->name,
                    'invoice' => $invoice,
                    'project' => \App\Models\Project::all(),
                    'first' => \App\Models\User::where('group_id',2)->get(),
                    'second' => \App\Models\User::where('group_id',3)->get(),
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
    public function update(Request $request, Invoice $invoice)
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
                ]);

                if (!$validated->fails()) {
                    Invoice::where('id', $invoice->id)->update([
                        'project_id' => $request->input('project_id'),
                        'first' => $request->input('first'),
                        'second' => $request->input('second'),
                        'effective_date' => $request->input('effective_date'),
                        'expiration_date' => $request->input('expiration_date'),
                        'payment' => $request->input('payment'),
                        'account_number' => $request->input('account_number'),
                        'updated_by' => auth()->user()->name
                    ]);

                    return redirect()->to(route('invoice.index'))->with('success', 'Data Saved!');
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
    public function destroy(Invoice $invoice)
    {
        try {
            $this->get_access_page();
            if ($this->delete == 1) {
                $dataInvoice = $invoice->find(request()->segment(2));
                Invoice::destroy($dataInvoice->id);

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
