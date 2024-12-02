<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * Sets the root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @return string
     */
    public function rootView(Request $request)
    {
        if ($request->routeIs('admin.*')) {
            return 'admin._layouts.inertia';
        } else {
            return 'public._layouts.inertia';
        }
    }

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'flash' => [
                'warning'   => fn () => $request->session()->get('warning'),
                'success'   => fn () => $request->session()->get('success'),
                'error'     => fn () => $request->session()->get('error'),
            ],
        ]);
    }
}
