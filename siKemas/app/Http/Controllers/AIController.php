<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AIController extends Controller
{
    public function generate(Request $request)
    {
        try {

            $request->validate([
                'prompt' => 'required|string|max:1000'
            ]);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.openai.key'),
                'Content-Type' => 'application/json',
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4.1-mini',
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $request->prompt,
                    ]
                ],
                'max_tokens' => 300,
            ]);

            return response()->json([
                'status' => true,
                'openai_response' => $response->json(),
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);

        }
    }
}