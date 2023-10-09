<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Twitch Access Token Scopes.
     *
     * @var array|string[]
     */
    protected array $scopes = [
        //'channel:read:editors',
        'moderation:read',
        //'user:read:blocked_users',
        'user:read:email',
    ];

    /**
     * Redirecting the user to the OAuth provider,
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function redirect(Request $request)
    {
        /* @var \SocialiteProviders\Twitch\Provider $socialite */
        $socialite = Socialite::driver('twitch');
        $socialite->stateless();
        $socialite->setScopes($this->scopes);

        $request->session()->put('AuthCurrent', $request->input('current'));
        $request->session()->put('AuthRemember', $request->input('remember'));

        $url = $socialite->redirect()->getTargetUrl();

        return Inertia::location($url);
    }

    /**
     * Receiving the callback from the provider after authentication.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function callback(Request $request)
    {
        /* @var \SocialiteProviders\Twitch\Provider|\SocialiteProviders\Manager\OAuth2\User $socialiteUser */
        $socialiteUser = Socialite::driver('twitch');
        $socialiteUser->stateless();
        $socialiteUser = $socialiteUser->user();

        // Todo: Users without email are unverified

        $user = User::updateOrCreate(
            ['twitch_id' => $socialiteUser->getId()],
            [
                'name' => data_get($socialiteUser->user, 'display_name', $socialiteUser->getNickname()),
                'login' => data_get($socialiteUser->user, 'login', Str::lower($socialiteUser->getName())),
                'email' => $socialiteUser->getEmail(),
                'token' => $socialiteUser->token,
                'refresh_token' => $socialiteUser->refreshToken,
                'scopes' => data_get($socialiteUser->accessTokenResponseBody, 'scope', []),
                'token_refreshed_at' => now(),
                'token_validated_at' => now(),
            ]
        );

        $url = $request->session()->get('AuthCurrent');
        Auth::login($user, (bool) $request->session()->get('AuthRemember', false));

        $request->session()->forget([
            'AuthCurrent',
            'AuthRemember',
        ]);

        return $url ? redirect($url) : redirect()->route('home');
    }

    /**
     * Log user out from the application.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
