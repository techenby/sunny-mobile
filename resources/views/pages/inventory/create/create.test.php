<?php

declare(strict_types=1);

use App\Enums\ItemType;
use App\Jobs\PushItem;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\Queue;
use Livewire\Livewire;

it('renders successfully', function (): void {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test('pages::inventory.create')
        ->assertStatus(200);
})->group('smoke');

it('saves an item locally and dispatches PushItem', function (): void {
    Queue::fake();

    $user = User::factory()->create();
    $parent = Item::factory()->for($user->currentTeam)->location()->create();

    Livewire::actingAs($user)
        ->test('pages::inventory.create')
        ->set('name', 'Drill')
        ->set('type', ItemType::Item->value)
        ->set('parent_id', $parent->id)
        ->call('addMetadata')
        ->set('metadata.0.key', 'brand')
        ->set('metadata.0.value', 'DeWalt')
        ->call('save')
        ->assertRedirect();

    $item = Item::query()->where('name', 'Drill')->first();

    expect($item)->not->toBeNull()
        ->and($item->team_id)->toBe($user->current_team_id)
        ->and($item->type)->toBe(ItemType::Item)
        ->and($item->parent_id)->toBe($parent->id)
        ->and($item->metadata)->toBe(['brand' => 'DeWalt']);

    Queue::assertPushed(PushItem::class, fn (PushItem $job): bool => $job->item->is($item));
});

it('requires name and type', function (): void {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test('pages::inventory.create')
        ->call('save')
        ->assertHasErrors(['name' => 'required', 'type' => 'required']);
});
