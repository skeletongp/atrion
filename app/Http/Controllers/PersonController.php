<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Models\User;

class PersonController extends Controller
{
    use WithPagination;
    public function index()
    {
        $users=User::where('is_active','=',1)->paginate(5);
       return view('users.index', compact('users'));
    }
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }
}
