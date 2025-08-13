<?php

namespace App\Constants;

class OpenAIConfig
{
    public const API_URL = 'https://api.openai.com/v1/chat/completions';
    public const DEFAULT_MODEL = 'gpt-4';
    public const SYSTEM_PROMPT = 'You are an assistant who helps journalists generate content ideas.';
    public const USER_PROMPT = 'Give me 3 content ideas on: ';
    public const TEMPERATURE = 0.7;
    public const MAX_TOKENS = 300;

}
