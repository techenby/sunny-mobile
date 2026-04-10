<?php

declare(strict_types=1);

namespace App\Integrations\Sunny\Requests;

use Illuminate\Support\Arr;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class Sync extends Request
{
    protected Method $method = Method::GET;

    public function __construct(public ?string $since = null) {}

    public function resolveEndpoint(): string
    {
        return '/sync';
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        $data = $response->json();

        return [
            'teams' => $this->transformTeams($data['teams']),
            // 'memberships' => $this->transformMemberships($data['teams']),
            'recipes' => $this->transformRecipes($data['recipes']),
            'items' => $this->transformItems($data['items']),
            'synced_at' => $data['synced_at'],
        ];
    }

    protected function defaultQuery(): array
    {
        return [
            'since' => $this->since,
        ];
    }

    private function transformItems(array $items): array
    {
        return collect($items)
            ->select(['id', 'team_id', 'parent_id', 'name', 'type', 'metadata', 'created_at', 'updated_at', 'deleted_at'])
            ->map(fn ($item): array => [...$item, 'metadata' => $item['metadata'] === null ? null : json_encode($item['metadata'])])
            ->all();
    }

    // private function transformMemberships(array $teams): array {}

    private function transformRecipes(array $recipes): array
    {
        return collect($recipes)
            ->select(['id', 'team_id', 'parent_id', 'name', 'slug', 'source', 'servings', 'prep_time', 'cook_time', 'total_time', 'description', 'ingredients', 'instructions', 'notes', 'nutrition', 'tags', 'created_at', 'updated_at', 'share_token', 'deleted_at'])
            ->map(fn ($recipe): array => [...$recipe, 'tags' => $recipe['tags'] === null ? null : json_encode($recipe['tags'])])
            ->all();
    }

    private function transformTeams(array $teams): array
    {
        return Arr::select($teams, ['id', 'name', 'is_personal', 'created_at', 'updated_at', 'deleted_at']);
    }
}
