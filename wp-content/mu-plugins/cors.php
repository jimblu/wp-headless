<?php
// cors.php

add_action('rest_api_init', function() {
  // récupère l'origine autorisée depuis l'environnement
  $allowed = getenv('CORS_ALLOWED_ORIGIN');

  if ( $allowed ) {
    remove_filter('rest_pre_serve_request','rest_send_cors_headers');
    add_filter('rest_pre_serve_request', function($value) use ($allowed) {
      header("Access-Control-Allow-Origin: $allowed");
      header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
      header('Access-Control-Allow-Credentials: true');
      header('Access-Control-Allow-Headers: Authorization, Content-Type');
      return $value;
    }, 15);
  } else {
    error_log('⚠️ CORS_ALLOWED_ORIGIN missing');
  }
});
