<?php

declare(strict_types=1);

namespace App\Integrations\Sunny\Requests\Recipes;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteRecipe extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(protected int $id) {}

    public function resolveEndpoint(): string
    {
        return '/recipes/' . $this->id;
    }
}
