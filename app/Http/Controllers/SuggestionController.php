<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Constants\OpenAIConfig;


class SuggestionController extends Controller
{
    /**
     * Generate contextual suggestions based on prompt.
     *
     * @param Request $request
     * @return JsonResponse
     */

    public function generate(Request $request) : JsonResponse
    {
        $valdiate = $request->validate([
            'prompt'=>'required|string|max:255'
        ]);

        $prompt = strtolower($valdiate['prompt']);
        
        $suggestions = $this->getSuggestions($prompt);
        return response()->json(['suggestions' => $suggestions]);
    }

    /**
     * Sends a prompt to the OpenAI API and returns a cleaned array of suggestions.
     *
     * @param string $prompt The topic or input for which suggestions are requested.
     * @return array An array of cleaned suggestion strings returned by OpenAI.
     * @throws \Exception If the API call fails or the API key is missing.
     */
    private function getSuggestions(string $prompt): array 
    {
        $openAiKey = env('OPENAI_API_KEY');

        if (!$openAiKey) {
            throw new \Exception('OpenAI API key not configured');
        }

        $response = Http::withToken(env('OPENAI_API_KEY'))
            ->post(OpenAIConfig::API_URL, [
                'model' => OpenAIConfig::DEFAULT_MODEL,
                'messages' => [
                    ['role' => 'system', 'content' => OpenAIConfig::SYSTEM_PROMPT],
                    ['role' => 'user', 'content' => OpenAIConfig::USER_PROMPT.$prompt],
                ],
                'temperature' => OpenAIConfig::TEMPERATURE,
                'max_tokens' => OpenAIConfig::MAX_TOKENS,
            ]);

        $text = $response->json('choices.0.message.content') ?? '' ;
        $suggestions = preg_split('/\r\n|\r|\n/', $text);
        $suggestions = array_filter($suggestions);
        
        return array_values($suggestions);
    }

}
