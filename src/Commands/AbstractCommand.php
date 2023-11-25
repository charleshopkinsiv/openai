<?php

namespace CharlesHopkinsIV\ChatGPT\Commands;

use CharlesHopkinsIV\ChatGPT\ChatGPT;


abstract class AbstractCommand {

    protected ChatGpt $chat;

    public function __construct(ChatGpt $chat)
    {
        $this->chat = $chat;
    }

    public abstract function run();
}
