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
    public function getSuggestions(Request $request, string $url, string $token) : JsonResponse
    {
        $query = $request->input('query');

        $response = Http::withOptions([
            'verify' => env('VERIFY'),
        ])->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => $token,
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

    /**
     * @throws ConnectionException
     */
    public function getAddress(Request $request, string $url, string $token) : JsonResponse
    {
        $query = $request->input('query');

        $response = Http::withOptions([
            'verify' => env('VERIFY'),
        ])->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Token ' . $token,
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
