<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Constructor for Controller.
     */
    public function __construct(private $name = 'User', private $userRole = [], private $access = [], private $create = 0, private $read = 0, private $update = 0, private $delete = 0)
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
                if (auth()->user()->group_id == 1) {
                    $users = User::leftJoin('groups', 'users.group_id', '=', 'groups.group_id')->get();
                } else {
                    $users = User::leftJoin('groups', 'users.group_id', '=', 'groups.group_id')->where('users.id', auth()->user()->id)->get();
                }

                if (request()->ajax()) {
                    return DataTables::of($users)
                        ->addColumn('action', function ($user) {
                            $editButton = $this->update == 1 ? '<a href="' . route('user.edit', $user->id) . '" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>' : '';

                            $deleteButton = $this->delete == 1 && $user->id != 1 ? '<form action="' . route('user.destroy', $user->id) . '" method="post" class="d-inline">'
                                . csrf_field()
                                . method_field('delete')
                                . '<button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>'
                                . '</form>' : '';

                            return $editButton . $deleteButton;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                }

                $this->access = [
                    'create' => $this->create,
                    'read' => $this->read,
                    'update' => $this->update,
                    'delete' => $this->delete,
                ];

                return view('admin.setting.users.index', [
                    'name' => $this->name,
                    'users' => $users,
                    'access' => $this->access
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
                return view('admin.setting.users.create', [
                    'name' => $this->name,
                    'group' => \App\Models\Group::all()
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
                    'name'   => 'required', 'string', 'min:4', 'max:255',
                    'email'   => 'required', 'string', 'email', 'unique:users,email', 'regex:/(.*)@samaricode\.my.id/i',
                    'password' => 'required', 'string', 'min:4', 'max:8', 'confirmed',
                    // 'pob'   => 'required', 'string', 'max:255',
                    // 'dob'   => 'required',
                    'address'   => 'required', 'string', 'max:255',
                    'phone_number'   => 'required', 'string', 'max:255',
                ]);

                if (!$validated->fails()) {
                    User::create([
                        'name' => $request->input('name'),
                        'email' => $request->input('email'),
                        'password' => bcrypt($request->input('password')),
                        // 'pob' => $request->input('pob'),
                        // 'dob' => $request->input('dob'),
                        'address' => $request->input('address'),
                        'phone_number' => $request->input('phone_number'),
                        'nik' => $request->input('nik'),
                    ]);

                    return redirect()->to(route('user.index'))->with('success', 'Data Saved!');
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
    public function show(User $user)
    {
        try {
            $this->get_access_page();
            if ($this->read == 1) {
                return view('admin.setting.users.profile', [
                    'name' => $this->name,
                    'userName' => $user->name,
                    'user' => $user
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
    public function edit(User $user)
    {
        try {
            $this->get_access_page();
            if ($this->update == 1) {
                return view('admin.setting.users.edit', [
                    'name' => $this->name,
                    'group' => \App\Models\Group::all(),
                    'user' => $user->find(request()->segment(2))
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
    public function update(Request $request, User $user)
    {
        try {
            $this->get_access_page();
            if ($this->update == 1) {
                $validated = \Illuminate\Support\Facades\Validator::make($request->all(), [
                    'name'   => 'required', 'string', 'min:4', 'max:255',
                    'email'   => 'required', 'string', 'email', 'unique:users,email', 'regex:/(.*)@samaricode\.my.id/i',
                    'password' => 'required', 'string', 'min:4', 'max:8', 'confirmed',
                    // 'pob'   => 'required', 'string', 'max:255',
                    // 'dob'   => 'required',
                    'address'   => 'required', 'string', 'max:255',
                    'phone_number'   => 'required', 'string', 'max:255',
                ]);

                if (!$validated->fails()) {
                    $dataUser = $user->find(request()->segment(2));
                    User::where('id', $dataUser->id)->update([
                        'name' => $request->input('name'),
                        'email' => $request->input('email'),
                        'password' => bcrypt($request->input('password')),
                        // 'pob' => $request->input('pob'),
                        // 'dob' => $request->input('dob'),
                        'address' => $request->input('address'),
                        'phone_number' => $request->input('phone_number'),
                        'nik' => $request->input('nik'),
                    ]);

                    return redirect()->to(route('user.index'))->with('success', 'Data Updated!');
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
     * Show the form for editing the specified resource.
     */
    public function changePasswordForm(User $user)
    {
        return view('admin.setting.users.change_password', [
            'name' => $this->name,
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function changePassword(Request $request, User $user)
    {
        try {
            $validated = \Illuminate\Support\Facades\Validator::make($request->all(), [
                'password' => 'required', 'string', 'min:4', 'max:8', 'confirmed'
            ]);

            if (!$validated->fails()) {
                $dataUser = $user->find(request()->segment(2));
                User::where('id', $dataUser->id)->update([
                    'password' => bcrypt($request->input('password'))
                ]);

                return redirect()->to(route('user.index'))->with('success', 'Password Updated!');
            } else {
                \Illuminate\Support\Facades\Log::error($validated->getMessageBag());
                return redirect()->back()->withErrors($validated->getMessageBag())->withInput();
            }
        } catch (\Illuminate\Database\QueryException $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function changeImageForm(User $user)
    {
        return view('admin.setting.users.change_image', [
            'name' => $this->name,
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function changeImage(Request $request, User $user)
    {
        try {
            $validated = \Illuminate\Support\Facades\Validator::make($request->all(), [
                'image' => 'required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'
            ]);

            if (!$validated->fails()) {
                $dataUser = $user->find(request()->segment(2));
                if ($dataUser->image) {
                    \Illuminate\Support\Facades\Storage::delete($user->image);
                }

                User::where('id', $dataUser->id)->update([
                    'image' => $request->file('image') ? $request->file('image')->store('profile') : $dataUser->image
                ]);

                return redirect()->to(route('user.index'))->with('success', 'Data Updated!');
            } else {
                \Illuminate\Support\Facades\Log::error($validated->getMessageBag());
                return redirect()->back()->withErrors($validated->getMessageBag())->withInput();
            }
        } catch (\Illuminate\Database\QueryException $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $this->get_access_page();
            if ($this->delete == 1 && $user->id != 1) {
                $dataUser = $user->find(request()->segment(2));
                User::destroy($dataUser->id);

                return redirect()->to(route('user.index'))->with('success', 'Data Deleted');
            } else {
                return redirect()->back()->with('failed', 'You not Have Authority!');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }
}
