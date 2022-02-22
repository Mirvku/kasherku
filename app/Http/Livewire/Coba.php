<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Coba extends Component
{
    public function render()
    {
        return view('livewire.coba')
            ->extends('layouts.admin')
            ->section('content');
    }
}
