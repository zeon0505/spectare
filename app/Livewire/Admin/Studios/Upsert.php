<?php

namespace App\Livewire\Admin\Studios;

use App\Models\Studio;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Upsert extends Component
{
    use WithFileUploads;

    public ?Studio $studio = null;
    public string $name = '';
    public string $location = '';
    public int $capacity = 0;
    public $image;
    public ?string $existingImage = null;

    public function mount(Studio $studio = null)
    {
        if ($studio?->exists) {
            $this->studio = $studio;
            $this->name = $studio->name ?? '';
            $this->location = $studio->location ?? '';
            $this->capacity = $studio->capacity ?? 0;
            $this->existingImage = $studio->image;
        }
    }

    public function save()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'image' => 'nullable|image|max:2048', // Max 2MB
        ];

        $this->validate($rules);

        $data = [
            'name' => $this->name,
            'location' => $this->location,
            'capacity' => $this->capacity,
        ];

        if ($this->image) {
            if ($this->studio && $this->studio->image) {
                Storage::disk('public')->delete($this->studio->image);
            }
            $data['image'] = $this->image->store('studios', 'public');
        }

        Studio::updateOrCreate(
            ['id' => $this->studio?->id],
            $data
        );

        session()->flash('success', 'Studio saved successfully.');

        return redirect()->route('admin.studios.index');
    }

    public function render()
    {
        return view('livewire.admin.studios.upsert');
    }
}
