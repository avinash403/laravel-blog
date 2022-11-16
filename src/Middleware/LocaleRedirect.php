<?php

namespace BinshopsBlog\Middleware;

use BinshopsBlog\Models\BinshopsLanguage;
use Closure;
use Illuminate\Support\Str;

class LocaleRedirect
{
    public function handle($request, Closure $next)
    {
        $locale = $request->route('locale');

        $fullUrl = $request->fullUrl();

        if ((BinshopsLanguage::count() !== 1) && Str::contains($fullUrl, '/'.$locale.'/')){
            $newUrl = str_replace('/'.$locale.'/', '', $fullUrl);
            return redirect($newUrl);
        }

        return $next($request);
    }
}