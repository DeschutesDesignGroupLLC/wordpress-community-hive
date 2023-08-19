<?php

namespace CommunityHive\App\Services;

use CommunityHive\App\Contracts\CommunityHiveApiServiceContract;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Jose\Component\Core\AlgorithmManager;
use Jose\Component\Core\JWK;
use Jose\Component\Signature\Algorithm\HS256;
use Jose\Component\Signature\JWSBuilder;
use Jose\Component\Signature\JWSVerifier;
use Jose\Component\Signature\Serializer\CompactSerializer;

class CommunityHiveApiService implements CommunityHiveApiServiceContract
{
    public function callApi(string $endpoint, array $data = []): mixed
    {
        $data = array_merge($data, [
            'hive_system_version' => COMMUNITY_HIVE_PLUGIN_VERSION,
        ]);

        if ($siteId = get_option('community_hive_site_id')) {
            $data['hive_site_id'] = $siteId;
        }

        $request = Http::baseUrl(COMMUNITY_HIVE_BASE_URL);

        if ($endpoint !== 'activate') {
            $request->withBody($token = $this->buildJwt($data), 'text/plain');
        } else {
            $request->withBody(json_encode($data), 'application/json');
        }

        $response = $request->put($endpoint);

        Log::debug('community_hive_api_call_request', [
            'endpoint' => $endpoint,
            'body' => $data,
            'token' => $token ?? null,
        ]);

        if (! $response->successful()) {
            Log::error('community_hive_api_call_error', [
                'endpoint' => $endpoint,
                'status' => $response->status(),
                'response_body' => $response->json(),
            ]);
        }

        Log::debug('community_hive_api_call_response', [
            'status' => $response->status(),
            'body' => $response->json(),
        ]);

        return $response->json();
    }

    protected function buildJwt(array $payload = []): string
    {
        $jwk = new JWK([
            'kty' => 'oct',
            'k' => base64_encode(get_option('community_hive_site_key', 'jT6qeP6fMDXyUnkk447kYaREyToxfSLE')),
        ]);

        $jwsCompactSerializer = new CompactSerializer();
        $jwsBuilder = new JWSBuilder(new AlgorithmManager([new HS256()]));

        $defaultPayload = [
            'sub' => get_option('community_hive_site_id', 'community_id_not_available'),
            'iss' => site_url(),
            'iat' => time(),
            'nbf' => time(),
            'exp' => time() + 60,
            'aud' => 'communityhive',
        ];

        $jws = $jwsBuilder
            ->create()
            ->withPayload(json_encode(array_merge($defaultPayload, $payload)))
            ->addSignature($jwk, [
                'typ' => 'JWT',
                'alg' => 'HS256',
            ])
            ->build();

        return $jwsCompactSerializer->serialize($jws, 0);
    }

    public function decodeJwt(string $token): array|false
    {
        $key = new JWK([
            'kty' => 'oct',
            'k' => base64_encode(get_option('community_hive_key', 'jT6qeP6fMDXyUnkk447kYaREyToxfSLE')),
        ]);

        $verifier = new JWSVerifier(new AlgorithmManager([new HS256()]));
        $serializer = new CompactSerializer();

        $data = $serializer->unserialize($token);
        if (! $verifier->verifyWithKey($data, $key, 0)) {
            return false;
        }

        return json_decode($data->getPayload() ?? [], true);
    }
}
