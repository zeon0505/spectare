<?php

namespace App\Livewire\Admin\Snacks;

use App\Models\Snack;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public Snack $snack;
    public $name;
    public $type;
    public $price;
    public $image;
    public $newImage;

    public function mount(Snack $snack)
    {
        $this->snack = $snack;
        $this->name = $snack->name;
        $this->type = $snack->type;
        $this->price = $snack->price;
        $this->image = $snack->image;
    }

    public function update()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'newImage' => 'nullable|image|max:1024', // 1MB Max
        ];

        $validatedData = $this->validate($rules);

        $data = [
            'name' => $this->name,
            'type' => $this->type,
            'price' => $this->price,
        ];

        if ($this->newImage) {
            $data['image'] = $this->newImage->store('snacks', 'public');
        }

        $this->snack->update($data);

        session()->flash('success', 'Snack updated successfully.');

        return redirect()->route('admin.snacks.index');
    }

    public function render()
    {
        return view('livewire.admin.snacks.edit');
    }
}
