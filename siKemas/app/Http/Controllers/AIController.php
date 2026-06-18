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

            $promptEngineerResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.openai.api_key'),
                'Content-Type'  => 'application/json',
            ])->post(
                'https://api.openai.com/v1/responses',
                [
                    'model' => config('services.openai.model'),
                    'input' => "
                    You are an expert packaging design prompt engineer.

                    Convert the following user idea into a highly detailed
                    English image generation prompt.

                    Focus on:
                    - packaging design
                    - branding
                    - typography
                    - premium materials
                    - lighting
                    - composition
                    - photorealistic product mockup

                    Return ONLY the prompt.

                    User Idea:
                    {$request->prompt}
                    "
                ]
            );

            if ($promptEngineerResponse->failed()) {
                throw new \Exception(
                    'OpenAI Prompt Error: ' .
                    $promptEngineerResponse->body()
                );
            }

            $enhancedPrompt = data_get(
                $promptEngineerResponse->json(),
                'output.0.content.0.text'
            );

            if (!$enhancedPrompt) {
                throw new \Exception(
                    'Prompt AI gagal dibuat.'
                );
            }

            $imageResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.openai.api_key'),
                'Content-Type'  => 'application/json',
            ])->timeout(180)
            ->post(
                'https://api.openai.com/v1/images/generations',
                [
                    'model'  => 'gpt-image-1',
                    'prompt' => $enhancedPrompt,
                    'size'   => '1024x1024'
                ]
            );

            if ($imageResponse->failed()) {
                throw new \Exception(
                    'OpenAI Image Error: ' .
                    $imageResponse->body()
                );
            }

            $base64Image = data_get(
                $imageResponse->json(),
                'data.0.b64_json'
            );

            if (!$base64Image) {
                throw new \Exception(
                    'Gambar gagal dibuat.'
                );
            }

            return response()->json([
                'status' => true,
                'prompt' => $enhancedPrompt,
                'image_url' => 'data:image/png;base64,' . $base64Image
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);

        }
    }
}