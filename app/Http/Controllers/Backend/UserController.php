<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UpdateRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index(Request $request){
        if($request->ajax()){
            $users = User::query();
            return DataTables::of($users)
                ->editColumn('updated_at', function ($user) {
                    return Carbon::parse($user->updated_at)->format('Y-m-d');
                })

                ->addColumn('action', function ($user) {
                    $deleteIcon = '<a href="#" class="text-danger delete-btn" id="delete" data-id="' . $user->id . '" style="font-size: 20px"><i class="fas fa-trash-alt"></i></a>';

                    return '<div class="action-icon">' . $deleteIcon .'</div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.users.index');
    }

    //delete
    public function destroy(User $users_management)
    {
        $users_management->delete();
        return 'success';
    }
}
