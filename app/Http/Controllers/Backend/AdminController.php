<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\CreateRequest;
use App\Http\Requests\Admins\UpdateRequest;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $admins = Admin::query();
            return DataTables::of($admins)
                ->editColumn('updated_at', function ($admin) {
                    return Carbon::parse($admin->updated_at)->format('Y-m-d');
                })

                ->editColumn('profile_img', function($admin){
                    return '<img src="storage/'. $admin->profile_img.'" class="profile-img">';
                })

                ->addColumn('action', function ($admin) {
                    $editIcon = '<a href="' . route('admins-management.edit', $admin->id) . '" class="text-warning p-2" style="font-size: 20px"><i class="far fa-edit"></i></a>';

                    $deleteIcon = '<a href="#" class="text-danger delete-btn" id="delete" data-id="' . $admin->id . '" style="font-size: 20px"><i class="fas fa-trash-alt"></i></a>';

                    return '<div class="action-icon">' . $editIcon . $deleteIcon . '</div>';
                })
                ->rawColumns(['action', 'profile_img'])
                ->make(true);
        }
        return view('backend.admins.index');
    }

    //create and store
    public function create(){
        return view('backend.admins.create');
    }

    public function store(CreateRequest $request){
        $data = $request->validated();
        $data['profile_img'] = $request->file('profile_img')->store('admin');
        $data['password'] = Hash::make($request->password);

        Admin::create($data);

        return redirect()->route('admins-management.index')->with('created', 'Admin info successfully created');
    }

    //edit and update
    public function edit(Admin $admins_management){
        return view('backend.admins.edit', compact('admins_management'));
    }

    public function update(UpdateRequest $request, Admin $admins_management){
        $data = $request->validated();
        if (request()->hasFile('profile_img')) {
            Storage::delete('storage/' . $admins_management->profile_img);
            $data['profile_img'] = $request->file('profile_img')->store('admin');
        }
        $data['password'] = $request->password ? Hash::make($request->password) : $admins_management->password;

        $admins_management->update($data);

        return redirect()->route('admins-management.index')->with('updated', 'Admin info successfully updated!');
    }

    //delete
    public function destroy(Admin $admins_management)
    {
        $admins_management->delete();
        return 'success';
    }
}
