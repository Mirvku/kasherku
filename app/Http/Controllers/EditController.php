<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Models\Menu;

use Illuminate\Support\Facades\Storage;

// use File;
use Illuminate\Support\Facades\File;

class EditController extends Controller
{
    public function index($id)
    {

        if (Auth::user()->role == 'administrator') {
        } else {
            return redirect()->back();
        }
        $menu = Menu::findOrFail($id);
        return view('menu.edit', compact('menu'));
    }

    public function edit(Request $request, $id)
    {
        if (Auth::user()->role == 'administrator') {
            $request->validate(
                [
                    'name' => 'required|max:100',
                    'image' => 'required',
                    'quantity' => 'required',
                    'price' => 'required',
                ],
            );

            $data = $request->all();
            $data['image'] = $request->file('image')->store(
                'assets/public',
                'public'
            );

            $item = Menu::findOrFail($id);

            $item->update($data);

            return redirect()->route('menu');
        } else {
            return redirect()->back();
        }

    }

    public function delete($id)
    {
        if (Auth::user()->role == 'administrator') {
            $product = Menu::find($id);
            // $destination = 'storage/images/' . $product->image;
            if (Storage::exists('/public/storage/images/' . $product->image)) {
                Storage::delete('/public/storage/images/' . $product->image);
            }
            $product->delete();
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
}
