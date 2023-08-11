<?php

namespace CommunityHive\App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Jose\Component\Core\AlgorithmManager;
use Jose\Component\Core\JWK;
use Jose\Component\Signature\Algorithm\HS256;
use Jose\Component\Signature\JWSVerifier;
use Jose\Component\Signature\Serializer\CompactSerializer;

class Authenticate
{
    /**
     * @return JsonResponse|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (! $token = $request->bearerToken()) {
            return response()->json([
                'error' => 'Missing JWT',
            ]);
        }

        $key = new JWK([
            'kty' => 'oct',
            'k' => base64_encode(get_option('community_hive_key', Str::random(40))),
        ]);

        $verifier = new JWSVerifier(new AlgorithmManager([new HS256()]));
        $serializer = new CompactSerializer();

        $data = $serializer->unserialize($token);
        if (! $verifier->verifyWithKey($data, $key, 0)) {
            return response()->json([
                'error' => 'Invalid JWT',
            ]);
        }

        return $next($request);
    }
}
