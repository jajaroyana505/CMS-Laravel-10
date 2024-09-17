<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Role as ModelsRole;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        $currenUserId = Auth::user()->id;
        if (request()->ajax()) {
            // response ajax datatable server side
            $user = User::with('roles')->latest()->get();
            return DataTables::of($user)
                // Custome column
                ->addIndexColumn()
                ->addColumn("role", function ($user) {
                    return $user->getRoleNames()->implode(', ');
                })
                ->addColumn("button", function ($user) {
                    if (Auth::user()->id !== $user->id) {
                        return '<div class="">
                                    <a href="' . url('users/' . $user->id) . '/edit" class="btn btn-outline-primary btn-sm btn-round">Edit</a>
                                    <a href="' . url('users/' . $user->id) . '" class="btn btn-secondary btn-sm btn-round ">Detail</a>
                                    <a href="#" onClick="deleteUser (this)" data-id=" ' . $user->id . '" class="btn btn-outline-danger btn-sm btn-round">Delete</a>
                                    </div>';
                    } else {
                        return '<div class="">
                                    <a href="' . url('users/' . $user->id) . '/edit" class="btn btn-outline-primary btn-sm btn-round">Edit</a>
                                    <button disabled class="btn btn-secondary btn-sm btn-round disable disable">Detail</button>
                                    <button disabled class="btn btn-outline-danger btn-sm btn-round" >Delete</button>
                                </div>';
                    }
                })
                // Panggil costume column
                ->rawColumns(['button', 'role'])
                ->make();
        }
        return view("back.user.index", [
            "page" => "user",
            "users" => User::get()
        ]);
    }
    public function create()
    {
        return view("back.user.create", [
            "page" => "user",
            "roles" => ModelsRole::all()
        ]);
    }

    public function store(CreateUserRequest $request)
    {
        $data = $request->validated();
        DB::beginTransaction();

        try {
            $newUser = User::create($data);

            // Tambahkan role yang dipilih
            $newUser->syncRoles($data['roles']);

            // Commit transaction jika tidak ada error
            DB::commit();

            return redirect('users')->with('success', 'user has been created !!');
        } catch (\Exception $e) {
            // Rollback jika ada error
            DB::rollback();

            // Optionally, log the error or show a custom error message
            return redirect()->back()->with('error', 'There was a problem creating the user or assigning roles.');
        }
    }

    public function show(String $id)
    {
        return view("back.user.detail", [
            "page" => "user",
            "user" => User::find($id)
        ]);
    }


    public function edit(String $id)
    {
        $user = User::find($id);
        return view("back.user.edit", [
            "page" => "user",
            "user" => $user,
            "roles" => ModelsRole::all(),
            "userRole" => $user->getRoleNames()

        ]);
    }

    public function update(Request $request,  string $id)
    {
        $roleValidation = [
            "name" => "required",
            "username" => "required",
            "email" => "required|email",
            'roles' => 'required|array|min:1',
            'roles.*' => 'exists:roles,name',
        ];
        if ($request->email !== $request->oldEmail) {
            $roleValidation["email"] = "required|email|unique:users,email";
            echo "email dirubah";
        }
        $data = $request->validate(
            $roleValidation
        );

        // dd($data['roles']);
        DB::beginTransaction();

        try {
            User::find($id)->update($data);

            // Tambahkan role yang dipilih
            User::find($id)->syncRoles($data['roles']);
            // Commit transaction jika tidak ada error
            DB::commit();

            return redirect('users')->with('success', 'user has been updated !!');
        } catch (\Exception $e) {
            // Rollback jika ada error
            DB::rollback();

            // Optionally, log the error or show a custom error message
            return redirect()->back()->with('error', 'There was a problem creating the user or assigning roles.');
        }
    }


    public function destroy(string $id)
    {
        $data = User::find($id);
        $data->delete();

        return response()->json([
            "message" => "data has been deleted"
        ]);

        DB::beginTransaction();

        try {
            $data->delete();
            $data->syncRoles([]);
            DB::commit();
            return response()->json([
                "message" => "data has been deleted"
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            // Optionally, log the error or show a custom error message
            return response()->json([
                "error" => "$e"
            ]);
        }
    }
}
