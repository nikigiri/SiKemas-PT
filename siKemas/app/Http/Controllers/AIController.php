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

            // 1. Hit Gemini
            $geminiInstruction = "You are an expert prompt engineer. Convert this user idea into a highly detailed, descriptive, and visually rich English prompt for generating a product packaging design. Only return the prompt text. User idea: " . $request->prompt;

            $geminiResponse = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=' . config('services.gemini.api_key'), [
                'contents' => [['parts' => [['text' => $geminiInstruction]]]]
            ]);

            if ($geminiResponse->failed()) throw new \Exception('Gemini API Error');

            $enhancedPrompt = trim(str_replace(["\n", "\r", "*"], " ", $geminiResponse->json('candidates.0.content.parts.0.text')));

            // 2. Hit Flux
            $fluxResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.huggingface.api_key'),
            ])->timeout(120)->post('https://api-inference.huggingface.co/models/black-forest-labs/FLUX.1-dev', [
                'inputs' => $enhancedPrompt
            ]);

            if ($fluxResponse->failed()) throw new \Exception('Flux API Error');

            // 3. Return Base64 Image
            return response()->json([
                'status' => true,
                'image_url' => 'data:image/png;base64,' . base64_encode($fluxResponse->body())
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}