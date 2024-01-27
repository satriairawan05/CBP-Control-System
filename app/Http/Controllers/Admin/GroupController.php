<?php

namespace App\Http\Controllers\Admin;

use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    /**
     * Constructor for Controller.
     */
    public function __construct(private $name = 'Role Permission')
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->group_id == 1) {
            try {
                return view('admin.setting.roles.index', [
                    'name' => $this->name,
                    'group' => Group::all()
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                \Illuminate\Support\Facades\Log::error($e->getMessage());
                return redirect()->back()->with('failed', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('failed', "You not Have Authority");
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->group_id == 1) {
            try {
                return view('admin.setting.roles.create', [
                    'name' => $this->name,
                    'page_distincts' => \App\Models\Page::distinct('page_name')->get('page_name'),
                    'pages' => \App\Models\Page::all(),
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                \Illuminate\Support\Facades\Log::error($e->getMessage());
                return redirect()->back()->with('failed', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('failed', "You not Have Authority");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->user()->group_id == 1) {
            try {
                $validate = \Illuminate\Support\Facades\Validator::make($request->all(), [
                    'group_name' => 'required',
                ]);

                if (!$validate->fails()) {
                    $group = new Group();
                    $group->group_name = str_replace('_', ' ', $request->group_name);
                    $group->save();

                    $pages = \App\Models\Page::all();
                    foreach ($pages as $page) {
                        $groupPage = new \App\Models\GroupPage();
                        $groupPage->page_id = $page->page_id;
                        $groupPage->group_id = $group->group_id;
                        $groupPage->access = $request->input($page->page_id) == 'on' ? 1 : 0;
                        $groupPage->save();
                    }

                    return redirect()->to(route('role.index'))->with('success', 'Data Created!');
                } else {
                    return redirect()->back()->with($validate->getMessageBag()->toArray())->withInput();
                }
            } catch (\Illuminate\Database\QueryException $e) {
                \Illuminate\Support\Facades\Log::error($e->getMessage());
                return redirect()->back()->with($e->getMessage())->withInput();
            }
        } else {
            return redirect()->back()->with('failed', "You not Have Authority");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        if (auth()->user()->group_id == 1) {
            try {
                $role = $group->find(request()->segment(2));
                return view('admin.setting.roles.edit', [
                    'name' => $this->name,
                    'group' => $role,
                    'page_distincts' => \App\Models\Page::distinct('page_name')->get('page_name'),
                    'pages' => \App\Models\GroupPage::leftJoin('pages', 'pages.page_id', '=', 'group_pages.page_id')->where('group_id', '=', $role->group_id)->get(),
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                \Illuminate\Support\Facades\Log::error($e->getMessage());
                return redirect()->back()->with($e->getMessage())->withInput();
            }
        } else {
            return redirect()->back()->with('failed', "You not Have Authority");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Group $group, \App\Models\Page $page, \App\Models\GroupPage $groupPage)
    {
        if (auth()->user()->group_id == 1) {
            try {
                $validate = \Illuminate\Support\Facades\Validator::make($request->all(), [
                    'group_name' => 'required',
                ]);

                if (!$validate->fails()) {
                    $role = $group->find(request()->segment(2));
                    Group::where('group_id', $role->group_id)->update(['group_name' => $request->input('group_name')]);

                    $pages = \App\Models\Page::all();
                    foreach ($pages as $page) {
                        $groupPage->where('group_id', $role->group_id)
                            ->where('page_id', $page->page_id)
                            ->update(['access' => $request->input($page->page_id) == 'on' ? 1 : 0]);
                    }

                    return redirect()->to(route('role.index'))->with('success', 'Data Updated!');
                } else {
                    return redirect()->back()->with($validate->getMessageBag())->withInput();
                }
            } catch (\Illuminate\Database\QueryException $e) {
                \Illuminate\Support\Facades\Log::error($e->getMessage());
                return redirect()->back()->with('failed', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('failed', "You not Have Authority");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        if (auth()->user()->group_id == 1 && $group->group_id != 1) {
            try {
                $data = $group->find(request()->segment(2));
                Group::destroy($data->group_id);

                $pages = \App\Models\Page::all();
                foreach ($pages as $page) {
                    $groupPage = \App\Models\GroupPage::where([
                        'group_id' => $data->group_id,
                        'page_id' => $page->page_id,
                    ])->first();
                    if ($groupPage) {
                        $groupPage->delete();
                    }
                }

                return redirect()->to(route('role.index'))->with('success', 'Data Deleted!');
            } catch (\Illuminate\Database\QueryException $e) {
                \Illuminate\Support\Facades\Log::error($e->getMessage());
                return redirect()->back()->with($e->getMessage())->withInput();
            }
        } else {
            return redirect()->back()->with('failed', "You not Have Authority");
        }
    }
}
