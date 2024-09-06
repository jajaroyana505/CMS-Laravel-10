<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            // response ajax datatable server side
            $user = User::latest()->get();
            return DataTables::of($user)
                // Custome column
                ->addIndexColumn()
                ->addColumn("button", function ($user) {
                    return '<div class="">
                                <a href="' . url('users/' . $user->id) . '" class="btn btn-secondary btn-sm btn-round">Detail</a>
                                <a href="' . url('users/' . $user->id) . '/edit" class="btn btn-outline-primary btn-sm btn-round">Edit</a>
                                <a href="#" onClick="deleteArticle(this)" data-id=" ' . $user->id . '" class="btn btn-outline-danger btn-sm btn-round">Delete</a>
                            </div>';
                })
                // Panggil costume column
                ->rawColumns(['button'])
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

        ]);
    }

    public function store(CreateUserRequest $request)
    {
        $data = $request->validated();
        User::create($data);
        return redirect('users')->with('success', 'user has been created !!');
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
        echo "ok";
    }
}
