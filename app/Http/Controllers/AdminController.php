<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('layouts.app', [
            'user' => $user,
        ]);
    }
}
