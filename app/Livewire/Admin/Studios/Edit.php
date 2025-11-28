<?php

namespace App\Livewire\Admin\Studios;

use App\Models\Studio;
use Livewire\Component;

class Edit extends Component
{
    public Studio $studio;

    public $name;
    public $capacity;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
        ];
    }

    public function mount(Studio $studio)
    {
        $this->studio = $studio;
        $this->name = $studio->name;
        $this->capacity = $studio->capacity;
    }

    public function update()
    {
        $this->validate();

        $this->studio->update([
            'name' => $this->name,
            'capacity' => $this->capacity,
        ]);

        session()->flash('success', 'Studio updated successfully.');

        return redirect()->route('admin.studios.index');
    }

    public function render()
    {
        return view('livewire.admin.studios.edit');
    }
}
