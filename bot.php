<?php

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Drivers\Telegram\TelegramDriver;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Attachments\Video;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;

require_once "vendor/autoload.php";

$configs = [
    "telegram" => [
        "token" => file_get_contents("private/TOKEN.txt")
    ]
];

DriverManager::loadDriver(TelegramDriver::class);

$botman = BotManFactory::create($configs);

$botman->group(['recipient' => ['-1001307666764', '-1001184380882']], function(Botman $bot) {

    $bot->hears("/start", function (BotMan $bot) {
        $user = $bot->getUser();
        $firstname = $user->getFirstName();
        $bot->reply("Willkommen $firstname 😊");
    });

    $bot->hears("/kenal {nama}, {npm}", function (BotMan $bot, $nama, $npm) {
        $bot->reply("Halo! $nama, $npm");
    });

    $bot->hears("/help", function (BotMan $bot) {
        $bot->reply("bot ini mencatat frekuensi chat setiap user" . PHP_EOL . "/start - untuk mendapat sapaan");
    });
});

$botman->hears("/start", function (BotMan $bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $bot->reply("Willkommen $firstname 😊");
});

$botman->hears("/kenal {nama}, {npm}", function (BotMan $bot, $nama, $npm) {
    $bot->reply("Halo! $nama, $npm");
});

// $botman->hears("{coin}", function (BotMan $bot, $coin){
//     global $coin_idr_markets;
//     global $coin_btc_markets;
//     $many = strlen($coin);
//     $temp = substr($coin, 1, $many);

//     if(in_array($temp, $coin_idr_markets)) {
//         $coinIDR = new CoinIDR($temp);
//         $bot->reply($coinIDR->getResponses());
//     } else if(in_array($temp, $coin_btc_markets)) {
//         $coinBTC = new CoinBTC($temp);
//         $bot->reply($coinBTC->getResponses());
//     } else if ($coin === "/btc_markets"){

//     } else if ($coin === "/idr_markets"){

//     } else if ($coin === "/start"){

//     } else {
//         $bot->reply("Saya tidak kenal maksud anda");
//     }
// });;

$botman->listen();