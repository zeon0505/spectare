<?php

namespace App\Livewire\Admin\Snacks;

use App\Models\Snack;
use Livewire\Component;
use Livewire\WithFileUploads;

class Upsert extends Component
{
    use WithFileUploads;

    public ?Snack $snack = null;
    public $name;
    public $type;
    public $price;
    public $image;
    public $newImage;

    public function mount(Snack $snack = null)
    {
        $this->snack = $snack;
        if ($this->snack->exists) {
            $this->name = $this->snack->name;
            $this->type = $this->snack->type;
            $this->price = $this->snack->price;
            $this->image = $this->snack->image;
        }
    }

    public function save()
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

        if ($this->snack->exists) {
            $this->snack->update($data);
            session()->flash('success', 'Snack updated successfully.');
        } else {
            Snack::create($data);
            session()->flash('success', 'Snack created successfully.');
        }

        return redirect()->route('admin.snacks.index');
    }

    public function render()
    {
        return view('livewire.admin.snacks.upsert');
    }
}
