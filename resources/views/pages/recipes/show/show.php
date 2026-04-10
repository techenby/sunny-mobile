<?php

use App\Models\Recipe;
use Livewire\Component;

new class extends Component
{
    public Recipe $recipe;

    public function render()
    {
        return $this->view()
            ->title($this->recipe->name);
    }
};
