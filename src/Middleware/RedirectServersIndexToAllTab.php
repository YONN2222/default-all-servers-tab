<?php

namespace Yonn\DefaultAllServersTab\Middleware;

use App\Filament\App\Resources\Servers\Pages\ListServers;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectServersIndexToAllTab
{
    public function handle(Request $request, Closure $next): Response
    {
        if (
            !$request->user()
            || !$request->isMethod('GET')
            || $request->query->has('tab')
            || $request->expectsJson()
            || $request->ajax()
            || $request->header('X-Livewire')
            || str_contains((string) $request->header('Accept'), 'application/json')
        ) {
            return $next($request);
        }

        if ($request->route()?->getActionName() !== ListServers::class) {
            return $next($request);
        }

        return redirect()->to($request->fullUrlWithQuery(['tab' => 'all']));
    }
}
