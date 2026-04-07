<?php

declare(strict_types=1);

namespace App\Integrations\Sunny\Requests\Recipes;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class StoreRecipe extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /** @param array{name: string, source: string, servings: string, prep_time: string|string, cook_time: string|null, total_time: string|null, description: string|null, ingredients: string|null, instructions: string|null, notes: string|null, nutrition: string|null, parent_id: int|null} $payload */
    public function __construct(protected int $id, protected array $payload) {}

    public function resolveEndpoint(): string
    {
        return '/recipes/' . $this->id;
    }

    /** @return array<string, int|string|null> */
    protected function defaultBody(): array
    {
        return $this->payload;
    }
}
