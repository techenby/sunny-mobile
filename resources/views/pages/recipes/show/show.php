<?php

use App\Models\Recipe;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('View Recipe')] class extends Component
{
    public Recipe $recipe;
};
