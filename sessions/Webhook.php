<?php

use Stripe\Webhook;
use Stripe\StripeClient;


define('WEBHOOK_SECRET', 'pk_test_51REuSmFpgFe46RRfRIIirFzCgRNT0Dt3SYK6sJ1u1cfRAP3JhGbituXnP92nVA0jLB4nxmKfQBPBzNIInyzweHyW00hgbanp7m'); // <-- définis ta clé ici
define('STRIPE_SECRET', 'sk_test_51REuSmFpgFe46RRfSscQjtZrkhkz7L5cwdGvpYRnhpzOgRlg2yD8jZQLtBcUeAwKWHiEcgbDeMnqqEHTjibTEiOn00dTEYXfd4');


$signature = $request->getHeaderLine('stripe-signature');
$body = (string)$request->getBody();
$event = Webhook::constructEvent(
  $body,
  $signature,
  WEBHOOK_SECRET
);

if ($event->type !== 'checkout.session.completed') {
    return;
}
// On récupère la Session Stripe
$data = $event->data['object']; 
// On peut utiliser l'API pour récupérer 
// des informations supplémentaires si nécessaire
$client = new StripeClient(STRIPE_SECRET);
$items = $client->checkout->sessions->allLineItems($data['id']);
