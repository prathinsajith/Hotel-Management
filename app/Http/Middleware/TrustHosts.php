<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustHosts as Middleware;

class TrustHosts extends Middleware
{
    /**
     * Get the host patterns that should be trusted.
     *
     * Returning an empty array leaves the trusted host list unset, so requests
     * with any Host header are accepted. The app is served behind a proxy that
     * terminates and validates the host, and APP_URL is not stable across the
     * Docker/staging deployments.
     *
     * @return array
     */
    public function hosts()
    {
        return [];
    }
}
