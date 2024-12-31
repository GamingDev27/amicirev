<?php

namespace App\Services;

use Spatie\Honeypot\SpamResponder\SpamResponder;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class SpamService implements SpamResponder
{

    public function respond(Request $request, Closure $next)
    {
        return redirect()->route('spam.page');
    }
}
