<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Release;
use Illuminate\Http\Request;

class GitHubWebhookController extends Controller
{
    /**
     * Handle GitHub Release Webhook requests.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return true
     */
    public function release(Request $request)
    {
        $payload = $request->input('payload');

        if (data_get($payload, 'action') != 'published') {
            return true;
        }

        $release = $payload['release'];
        updateOrCreateRelease($release);

        return true;
    }
}
