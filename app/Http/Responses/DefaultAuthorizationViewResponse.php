<?php

namespace App\Http\Responses;

use Illuminate\Http\Request;
use Laravel\Passport\Contracts\AuthorizationViewResponse;

class DefaultAuthorizationViewResponse implements AuthorizationViewResponse
{
    protected ?Request $request = null;
    protected $client = null;
    protected $scopes = null;
    protected $user = null;

    public function withParameters(array $parameters = []): static
    {
        // Defensive checks to avoid errors
        $this->request = $parameters[0] ?? null;
        $this->client = $parameters[1] ?? null;
        $this->scopes = $parameters[2] ?? null;
        $this->user = $parameters[3] ?? null;

        return $this;
    }

    public function toResponse($request)
    {
        return response()->view('vendor.passport.authorize', [
            'request' => $this->request,
            'client' => $this->client,
            'scopes' => $this->scopes,
            'user' => $this->user,
        ]);
    }
}
