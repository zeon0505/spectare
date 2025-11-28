<?php

namespace App\Livewire\Admin\Studios;

use App\Models\Studio;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $capacity;

    protected $rules = [
        'name' => 'required|string|max:255',
        'capacity' => 'required|integer|min:1',
    ];

    public function save()
    {
        $this->validate();

        Studio::create([
            'name' => $this->name,
            'capacity' => $this->capacity,
            // 'layout' will be handled separately or have a default
        ]);

        session()->flash('success', 'Studio created successfully.');

        return redirect()->route('admin.studios.index');
    }

    public function render()
    {
        return view('livewire.admin.studios.create');
    }
}
