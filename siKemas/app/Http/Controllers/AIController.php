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
                'Authorization' => 'Bearer ' . config('services.groq.api_key'), // ← ganti
                'Content-Type' => 'application/json',
            ])->post('https://api.groq.com/openai/v1/chat/completions', [ // ← ganti
                'model' => 'llama-3.3-70b-versatile', // ← ganti
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
                'result' => $response->json()['choices'][0]['message']['content'], // ambil teksnya langsung
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);

        }
    }
}