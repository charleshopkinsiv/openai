<?php

namespace CharlesHopkinsIV\ChatGPT;

use CharlesHopkinsIV\ChatGPT\Exceptions\InvalidCommandException;
use CharlesHopkinsIV\ChatGPT\Commands\ChatCompletion;

class ChatGPT {

    private string $api_key;

    public const COMMANDS = [
        'chat-completion'  => 'CharlesHopkinsIV\\ChatGPT\\Commands\\ChatCompletion',
        'edit'              => 'Edit',
    ];

    public function __construct(string $key)
    {
        $this->api_key = $key;
    }

    public function getKey() { return $this->api_key; }

    public function loadCommand(string $command)
    {
        if(!array_key_exists($command, self::COMMANDS)) {
            throw new InvalidCommandException('Invalid command ' . $command);
        }
        if(!class_exists(self::COMMANDS[$command])) {
            throw new InvalidCommandException('Command not found ' . self::COMMANDS[$command]);
        }

        $command_class = self::COMMANDS[$command];
        return new $command_class($this);
    }
}