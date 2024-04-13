<?php

namespace App\Http\Middleware;

use App\Models\AnalyticEvent;
use Closure;
use App\Classes\Analytic\Enums\AnalyticEventType;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Jenssegers\Agent\Agent;

class AnalyticMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (!config('analytics.enabled', true)) {
            return $response;
        }

        if (in_array($request->method(), config('analytics.ignoreMethods', []))) {
            return $response;
        }

        if (in_array($request->ip(), config('analytics.ignoredIPs', []))) {
            return $response;
        }

        $agent = new Agent();
        $agent->setUserAgent($request->headers->get('user-agent'));
        $agent->setHttpHeaders($request->headers);

        if (config('analytics.ignoreRobots', false) && $agent->isRobot()) {
            return $response;
        }

        $uri = str_replace($request->root(), '', $request->url()) ?: '/';

        if (str_contains($uri, 'api')) {
            return $response;
        }

        foreach (config('analytics.mask', []) as $mask) {
            $mask = trim($mask, '/');

            if ($request->fullUrlIs($mask) || $request->is($mask)) {
                $uri = '/' . str_replace('*', '∗︎', $mask);
                break;
            }
        }

        foreach (config('analytics.exclude', ['/livewire/*']) as $except) {
            if ($except !== '/') {
                $except = trim($except, '/');
            }

            if ($request->fullUrlIs($except) || $request->is($except)) {
                return $response;
            }
        }

        $utm = array_map(
            fn ($item) => substr($item, 0, 255),
            $request->only([
                'utm_source',
                'utm_medium',
                'utm_campaign',
                'utm_term',
                'utm_content',
            ])
        );

        AnalyticEvent::create(array_merge([
            'type' => AnalyticEventType::PageView->value,
            'session' => $request->session()->getId(),
            'uri' => $uri,
            'source' => $request->headers->get('referer'),
            'country' => $agent->languages()[0] ?? 'en-en',
            'browser' => $agent->browser() ?? null,
            'device' => $agent->deviceType(),
            'host' => $request->getHost(),
        ], $utm));

        return $response;
    }
}
