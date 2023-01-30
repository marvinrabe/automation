<?php

namespace App\Http\Livewire;

use App\Models\Automation;
use Illuminate\View\View;
use Livewire\Component;

class RenameAutomation extends Component
{
    public Automation $automation;

    protected array $rules = [
        'automation.name' => ['required', 'string']
    ];

    public function render(): View
    {
        return view('livewire.rename-automation');
    }

    public function save(): void
    {
        $this->validate();
        $this->automation->save();
    }
}
