<?php

/**
 * Configuration KkiaPay
 * Les valeurs sont lues depuis le fichier .env
 * pour ne jamais exposer les clés dans le code source.
 */
return [
    'public_key'  => env('KKIAPAY_PUBLIC_KEY'),
    'private_key' => env('KKIAPAY_PRIVATE_KEY'),
    'secret'      => env('KKIAPAY_SECRET'),
    'sandbox'     => env('KKIAPAY_SANDBOX', true),
];