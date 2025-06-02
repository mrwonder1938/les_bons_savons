<?php

require "vendor/autoload.php";
use Mailjet\Resources;

// Utilisation de tes identifiants sauvegardés
$mj = new \Mailjet\Client(getenv('MJ_APIKEY_PUBLIC'), getenv('MJ_APIKEY_PRIVATE'), true);

// Définition du corps de la requête
$body = [
    'Messages' => [
        [
            'From' => [
                'Email' => getenv('SENDER_EMAIL'),
                'Name'  => "me"
            ],
            'To' => [
                [
                    'Email' => getenv('RECEPIENT_EMAIL'),
                    'Name'  => "you"
                ]
            ],
            'Subject' => "My first Mailjet email",
            'TextPart' => "Greeting from Mailjet",
            'HTMLPart' => "<h3>Dear passenger 1, may the force be with you</h3>"
        ]
    ]
];

// Toutes les ressources sont dans la classe Resources
$response = $mj->post(Resources::$Email, ['body' => $body]);

// Lecture de la réponse
if ($response->success()) {
    var_dump($response->getData());
}
?>
