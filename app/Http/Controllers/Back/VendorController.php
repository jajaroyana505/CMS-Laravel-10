<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            // response ajax datatable server side
            $vendor = Vendor::get();
            return DataTables::of($vendor)
                // Custome column
                ->addIndexColumn()

                ->addColumn("button", function ($vendor) {
                    return '<div class="text-center">
                                <a href="' . url('vendors/' . $vendor->id) . '" class="btn btn-secondary btn-sm btn-round">Detail</a>
                                <a href="' . url('vendors/' . $vendor->id) . '/edit" class="btn btn-outline-primary btn-sm btn-round">Edit</a>
                                <a href="#" onClick="deletevendor(this)" data-id=" ' . $vendor->id . '" class="btn btn-outline-danger btn-sm btn-round">Delete</a>
                            </div>';
                })
                // Panggil costume column
                ->rawColumns(['button'])
                ->make();
        }
        return view('back.vendor.index', [
            'page' => 'vendor'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendor $vendor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vendor $vendor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        //
    }
}
