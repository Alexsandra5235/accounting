<?php

namespace App\Http\Controllers;

use App\Services\SuggestionService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SuggestionController extends Controller
{
    private SuggestionService $suggestionService;
    public function __construct(SuggestionService $suggestionService)
    {
        $this->suggestionService = $suggestionService;
        $this->middleware('auth');
    }


    /**
     * @throws ConnectionException
     */
    public function diagnosis(Request $request) : JsonResponse
    {
        return $this->suggestionService->getSuggestions($request, env('API_URL_MKD'));
    }
    /**
     * @throws ConnectionException
     */
    public function country(Request $request) : JsonResponse
    {
        return $this->suggestionService->getSuggestions($request, env('API_URL_COUNTRY'));
    }



}
