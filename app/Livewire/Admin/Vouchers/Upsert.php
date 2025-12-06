<?php

namespace App\Livewire\Admin\Vouchers;

use App\Models\Voucher;
use Livewire\Component;
use Illuminate\Validation\Rule;

class Upsert extends Component
{
    public $voucherId;
    public $code;
    public $type = 'fixed';
    public $amount;
    public $description;
    public $min_purchase = 0;
    public $max_discount;
    public $quota = 100;
    public $start_date;
    public $end_date;
    public $is_active = true;

    public function mount($id = null)
    {
        if ($id) {
            $voucher = Voucher::findOrFail($id);
            $this->voucherId = $voucher->id;
            $this->code = $voucher->code;
            $this->type = $voucher->type;
            $this->amount = $voucher->amount;
            $this->description = $voucher->description;
            $this->min_purchase = $voucher->min_purchase;
            $this->max_discount = $voucher->max_discount;
            $this->quota = $voucher->quota;
            $this->start_date = $voucher->start_date ? $voucher->start_date->format('Y-m-d\TH:i') : null;
            $this->end_date = $voucher->end_date ? $voucher->end_date->format('Y-m-d\TH:i') : null;
            $this->is_active = (bool) $voucher->is_active;
        }
    }

    public function rules()
    {
        return [
            'code' => ['required', 'string', 'max:50', Rule::unique('vouchers', 'code')->ignore($this->voucherId)],
            'type' => 'required|in:fixed,percent',
            'amount' => 'required|numeric|min:1',
            'min_purchase' => 'required|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'quota' => 'required|integer|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_active' => 'boolean',
            'description' => 'nullable|string|max:500',
        ];
    }

    public function save()
    {
        $this->validate();

        $data = [
            'code' => strtoupper($this->code),
            'type' => $this->type,
            'amount' => $this->amount,
            'description' => $this->description,
            'min_purchase' => $this->min_purchase,
            'max_discount' => $this->max_discount,
            'quota' => $this->quota,
            'start_date' => $this->start_date ?: null,
            'end_date' => $this->end_date ?: null,
            'is_active' => $this->is_active,
        ];

        if ($this->voucherId) {
            Voucher::find($this->voucherId)->update($data);
            $message = 'Voucher berhasil diperbarui.';
        } else {
            Voucher::create($data);
            $message = 'Voucher berhasil dibuat.';
        }

        session()->flash('success', $message);
        return $this->redirect(route('admin.vouchers.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.vouchers.upsert')->layout('components.layouts.app');
    }
}
