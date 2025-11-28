<?php

namespace App\Livewire\Admin\Snacks;

use App\Models\Snack;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $type;
    public $price;
    public $image;

    public function save()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|max:1024', // 1MB Max
        ];

        $validatedData = $this->validate($rules);

        $validatedData['image'] = $this->image->store('snacks', 'public');

        Snack::create($validatedData);

        session()->flash('success', 'Snack created successfully.');

        return redirect()->route('admin.snacks.index');
    }

    public function render()
    {
        return view('livewire.admin.snacks.create');
    }
}
