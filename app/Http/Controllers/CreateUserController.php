<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\User;

class CreateUserController extends Controller
{
    use RegistersUsers;

    public function index()
    {
        $user = User::all();
        return view('create-user.index', compact('user'));
    }

    public function create()
    {
        return view('create-user.create');
    }

    public function insert(Request $request)
    {
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
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('create-user.edit', compact('user'));
    }


    public function update(Request $request, $id)
    {
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
    }

    public function delete($id)
    {
        $item = User::findOrFail($id);
        $item->delete();

        return redirect()->route('create-user');
    }
}
