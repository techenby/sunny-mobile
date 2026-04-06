<?php

declare(strict_types=1);

namespace App\Integrations\Sunny;

use App\Integrations\Sunny\Requests\CreateAccessToken;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;
use Saloon\Http\PendingRequest;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

class SunnyConnector extends Connector
{
    use AcceptsJson;
    use AlwaysThrowOnErrors;

    public function __construct(protected ?string $token = null) {}

    public function resolveBaseUrl(): string
    {
        return config()->string('services.sunny.url') . '/api';
    }

    public function boot(PendingRequest $pendingRequest): void
    {
        if ($pendingRequest->getRequest() instanceof CreateAccessToken || $this->token === null) {
            return;
        }

        $pendingRequest->authenticate(new TokenAuthenticator($this->token));
    }
}
