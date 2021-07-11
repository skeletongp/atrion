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
    public function clients_index()
    {
        $users=User::where('is_active','=',1)->paginate(5);
       return view('persons.clients_index', compact('users'));
    }
    public function clients_show(User $user)
    {
        return view('persons.clients_show', compact('user'));
    }
}
