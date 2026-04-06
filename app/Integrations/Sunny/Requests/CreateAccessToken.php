<?php

declare(strict_types=1);

namespace App\Integrations\Sunny\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class CreateAccessToken extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /** @param array{email: string, password: string, device_name: string} $payload */
    public function __construct(protected array $payload) {}

    public function resolveEndpoint(): string
    {
        return '/sanctum/token';
    }

    /** @return array<string, string> */
    protected function defaultBody(): array
    {
        return $this->payload;
    }
}
