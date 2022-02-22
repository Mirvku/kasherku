<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Menu;

use Illuminate\Support\Facades\Storage;

// use File;
use Illuminate\Support\Facades\File;

class EditController extends Controller
{
    public function index($id)
    {
        $menu = Menu::findOrFail($id);
        return view('menu.edit', compact('menu'));
    }

    public function edit(Request $request, $id)
    {
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


        // $menu = Menu::find($id);
        // $menu->name = $request->name;
        // $menu->deskripsi = $request->deskripsi;
        // $menu->quantity = $request->quantity;
        // $menu->price = $request->price;

        // if ($request->hasfile('image')) {
        //     $destination = 'storage/images/' . $menu->image;
        //     if (File::exists($destination)) {
        //         File::delete($destination);
        //     }
        //     $file = $request->file('image');
        //     $extention = $file->getClientOriginalExtension();
        //     $filename = time() . '.' . $extention;
        //     $file->move('storage/images/', $filename);
        //     $menu->image = $filename;
        // }

        // $menu->update();

    }

    public function delete($id)
    {
        $product = Menu::find($id);
        $destination = 'storage/images/' . $product->image;
        if (Storage::exists('/public/storage/images/' . $product->image)) {
            Storage::delete('/public/storage/images/' . $product->image);
        }
        $product->delete();
        return redirect()->back();
    }
}
