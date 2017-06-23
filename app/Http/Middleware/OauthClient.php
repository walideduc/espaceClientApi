<?php

namespace App\Http\Middleware;

use Closure;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\TokenRepository;
use Lcobucci\JWT\Parser;

class OauthClient
{
    protected $clientRepository = null;
    protected $tokenRepository = null;

    public function __construct(ClientRepository $clientRepository , TokenRepository $tokenRepository)
    {
        $this->clientRepository = $clientRepository;
        $this->tokenRepository = $tokenRepository;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $jwt = (New Parser())->parse($request->bearerToken());

        $request->offsetSet('passportClient',$this->clientRepository->find($jwt->getClaim('aud')));
        $request->offsetSet('passportToken',$this->tokenRepository->find($jwt->getClaim('jti')));
        return $next($request);
    }
}
