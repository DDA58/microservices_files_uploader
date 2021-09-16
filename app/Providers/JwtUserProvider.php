<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Foundation\Application;
use Tymon\JWTAuth\Payload;

class JwtUserProvider implements UserProvider
{
    /** @var Application  */
    private Application $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function retrieveById($identifier)
    {
        /** @var Payload $payload */
        $payload = $this->app['tymon.jwt']->getPayload();

        $user = new class extends User {
            public function save(array $options = [])
            {

            }
        };

        $user->id = +$payload->get('sub');
        $user->email = $payload->get('email');

        return $user;
    }

    public function retrieveByToken($identifier, $token)
    {

    }

    public function updateRememberToken(Authenticatable $user, $token)
    {

    }

    public function retrieveByCredentials(array $credentials)
    {

    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {

    }
}
