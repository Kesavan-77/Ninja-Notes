<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $userList = User::all();
        $noteList = User::with('notes')->get();
        $likeList = User::with('likes')->get();
        $markdownList = User::with('markdowns')->get();
        return view('admin.adminPages.dashboard',['users'=>$userList,'notes'=>$noteList,'likes'=>$likeList,'markdowns'=>$markdownList]);
    }
}
