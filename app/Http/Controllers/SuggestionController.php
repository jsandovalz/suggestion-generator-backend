<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
     * Map prompt to predefined suggestions
     * 
     * @param string $prompt
     * @return array
     */
    private function getSuggestions(string $prompt): array 
    {
        $map = [
            'local election' => [
                'Candidate profiles',
                'Impact on local economy',
                'Voter turnout trends',
            ],
            'sports news' => [
                'Match highlights',
                'Coach interviews',
                'Championship predictions',
            ],
        ];
        return $map[$prompt] ?? [
            "Suggestion 1 for $prompt",
            "Suggestion 2 for $prompt",
            "Suggestion 3 for $prompt"

        ];
    }

}
