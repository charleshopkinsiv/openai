<?php

namespace CharlesHopkinsIV\ChatGPT\Commands;

use Illuminate\Support\Facades\Http;

class ChatCompletion extends AbstractCommand {

    private const DEFAULT_MODEL = 'gpt-3.5-turbo-instruct';
    private const URL = 'https://api.openai.com/v1/completions';
    private const MAX_TOKENS = 200;
    private string $prompt;
    private string $model;

    public function prompt(string $prompt)
    {
        $this->model = self::DEFAULT_MODEL;
        $this->prompt = $prompt;
        return $this;
    }

    public function run()
    {

        $response = Http::withToken($this->chat->getKey())
        ->withHeaders([
            'Content-Type' => 'application/json'
        ])
        ->post(self::URL, [
            'model' => $this->model,
            'prompt' => $this->prompt,
            'max_tokens' => self::MAX_TOKENS,
            'temperature' => 1.5,
        ]);
        return $response->json();
    }
}