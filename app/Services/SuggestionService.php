<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Scalar\String_;

class SuggestionService
{

    /**
     * @throws ConnectionException
     */
    public function getSuggestions(Request $request, string $url) : JsonResponse
    {
        $query = $request->input('query');

        $response = Http::withOptions([
            'verify' => 'D:\installApp\cacert-2025-02-25.pem',
        ])->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => env('API_AUTHORIZATION_TOKEN'),
        ])->post($url, [
            'query' => $query,
            'count' => 6,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            return response()->json(['suggestions' => $data['suggestions']]);
        }

        return response()->json(['suggestions' => []], $response->status());

    }
}
