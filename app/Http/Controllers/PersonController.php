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
    public function index(Request $request, $is_active=1)
    {
        $query="";
            $query=$request->search;
       $is_active==1?
       $users = User::search($query)->sortable(['name' => 'asc'])->where('id','!=',1)->paginate(12):
       $users = User::onlyTrashed()->search($query)->sortable(['name' => 'asc'])->where('id','!=',1)->paginate(12);
        return view('users.index', compact('users','query'));
    }
    public function users_show(User $user)
    {
        
        return view('users.show', compact('user'));
    }
    public function clients_index(Request $request, $is_active=1)
    {
        $query="";
            $query=$request->search;
       $is_active==1?
       $clients = Client::search($query)->sortable(['name' => 'asc'])->paginate(12):
       $clients = Client::onlyTrashed()->search($query)->sortable(['name' => 'asc'])->paginate(12);
        return view('persons.clients_index')->with(['clients'=>$clients, 'estado'=>$is_active, 'query'=>$query]);;
    }
    public function clients_show(Client $client)
    {
        return view('persons.clients_show', compact('client'));
    }
    public function clients_edit(Client $client)
    {
        return view('persons.clients_edit', compact('client'));
    }
    protected $rules = [
        'name' => 'required|string|max:50',
        'phone' => 'required|regex:/[0-9]{3}-[0-9]{3}-[0-9]{4}/',
    ];
    public function clients_update(Client $client, Request $request)
    {
        if (Auth::user()->can('Gestionar Usuarios')) {
            $this->validate($request, $this->rules);
            $client->name = $request->name;
            $client->slug = Str::slug($request->name);
            $client->phone = $request->phone;
            $client->save();
            return view('persons.clients_show', compact('client'));
        }
    }
    public function clients_destroy(Client $client)
    {

        if ($client->is_active == 1) {
            $client->is_active = 0;
            $client->save();
            return redirect()->route('clients_index');
        } else {
            $client->is_active = 1;
            $client->save();
            return redirect()->route('clients_index',0);
        }
     
    }
}
