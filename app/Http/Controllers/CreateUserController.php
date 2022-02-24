<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\User;

use Illuminate\Support\Facades\Auth;


class CreateUserController extends Controller
{
    use RegistersUsers;

    public function index()
    {
        if (Auth::user()->role == 'owner') {
            $user = User::all();
            return view('create-user.index', compact('user'));
        } else {
            return redirect()->back();
        }
        
    }

    public function create()
    {
        if (Auth::user()->role == 'owner') {
            return view('create-user.create');
        } else {
            return redirect()->back();
        }
        
    }

    public function insert(Request $request)
    {
        if (Auth::user()->role == 'owner') {
            $request->validate(
                [
                    'name' => 'required|unique:users|max:100',
                    'email' => 'required',
                    'role' => 'required',
                    'password' => 'required|min:8|confirmed',
                ],
            );

            $data = $request->all();
            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => $data['role'],
            ]);

            return redirect()->route('create-user');
        } else {
            return redirect()->back();
        }
        
    }

    public function edit($id)
    {
        if (Auth::user()->role == 'owner') {
            $user = User::findOrFail($id);
            return view('create-user.edit', compact('user'));
        } else {
            return redirect()->back();
        }
      
    }


    public function update(Request $request, $id)
    {
        if (Auth::user()->role == 'owner') {
            $request->validate(
                [
                    'name' => 'required|max:100',
                    'email' => 'required',
                    'role' => 'required',
                ],
            );

            $data = $request->all();
            $item = User::findOrFail($id);

            $item->update($data);

            return redirect()->route('create-user');
        } else {
            return redirect()->back();
        }
  
    }

    public function delete($id)
    {
        if (Auth::user()->role == 'owner') {
            $item = User::findOrFail($id);
            $item->delete();

            return redirect()->route('create-user');
        } else {
            return redirect()->back();
        }
     
    }
}
