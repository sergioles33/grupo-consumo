<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use app\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $pendingUsers = User::where('is_active', false)->get();
        return view('admin.dashboard', compact('pendingUsers'));
    }
    
    public function approve(User $user){
        $user->update(['is_active' => true]);
        return redirect()->route('admin.dashboard')->with('status','¡Usuario aprobado correctamente!');
    }
}
