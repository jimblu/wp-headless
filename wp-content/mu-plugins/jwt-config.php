<?php
// jwt-config.php

// Récupère la clé secrète depuis l'environnement
$secret = getenv('JWT_AUTH_SECRET_KEY');

if ( ! $secret ) {
  // log et fallback silencieux si jamais
  error_log('⚠️ JWT_AUTH_SECRET_KEY missing');
} else {
  define('JWT_AUTH_SECRET_KEY', $secret);
  // active la gestion CORS côté JWT si tu veux
  define('JWT_AUTH_CORS_ENABLE', true);
}