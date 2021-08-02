<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;



class PersonController extends Controller
{
    use WithPagination;
    public function index()
    {
    
        return view('users.index');
    }
    public function users_show(User $user)
    {
        
        return view('users.show', compact('user'));
    }
    public function clients_index()
    {
      
        return view('persons.clients_index');
    }
    public function clients_show(Client $client)
    {
        return view('persons.clients_show', compact('client'));
    }
   
  
    
    public function company()
    {
        
        return view('users.company');
    }
}
