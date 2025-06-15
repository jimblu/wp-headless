<?php
/**
 * Mu-plugin: expose POST /wp-json/custom/v1/register
 * pour créer un nouvel utilisateur WordPress.
 */

add_action('rest_api_init', function() {
  register_rest_route('custom/v1', '/register', [
    'methods'             => 'POST',
    'callback'            => 'wp_api_register_user',
    'permission_callback' => '__return_true',  // ouvert à tous
    'args'                => [
      'username' => [ 'required' => true ],
      'email'    => [ 'required' => true ],
      'password' => [ 'required' => true ],
    ]
  ]);
});

/**
 * Callback pour /register
 */
function wp_api_register_user(\WP_REST_Request $req) {
  $u = sanitize_user( $req->get_param('username') );
  $e = sanitize_email( $req->get_param('email') );
  $p = $req->get_param('password');

  if ( username_exists($u) ) {
    return new WP_Error('username_exists','Ce nom d’utilisateur existe déjà', ['status'=>400]);
  }
  if ( email_exists($e) ) {
    return new WP_Error('email_exists','Cette adresse e-mail est déjà utilisée', ['status'=>400]);
  }

  // Rôle par défaut (défini dans Réglages → Général “Rôle par défaut des nouveaux utilisateurs”)
  $user_id = wp_create_user($u, $p, $e);
  if ( is_wp_error($user_id) ) {
    return $user_id;
  }

  return [
    'id'       => $user_id,
    'username' => $u,
    'email'    => $e
  ];
}
