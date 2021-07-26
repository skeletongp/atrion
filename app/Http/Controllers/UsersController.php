<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Livewire\WithPagination;

class UsersController extends Controller
{
    use WithPagination;
    public function index()
    {
        $users=User::paginate(5);
       return view('users.index', compact('users'));
    }
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }
    public function company()
    {
        
        return view('users.company');
    }
}
