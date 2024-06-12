<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $users = User::all();
        $notes = User::with('notes')->get();
        $likes = User::with('likes')->get();
        $markdowns = User::with('markdowns')->get();
        return view('admin.adminPages.dashboard',['users'=>$users,'notes'=>$notes,'likes'=>$likes,'markdowns'=>$markdowns]);
    }
}
