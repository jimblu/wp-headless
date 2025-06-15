<?php
/**
 * Mu-plugin : redirige hors de /wp-admin
 * - tous les subscribers
 * - tous les authors
 * vers l’URL de ton front SvelteKit
 */

add_action('admin_init', function() {
  // Récupère l’utilisateur courant
  $user = wp_get_current_user();
  $roles = (array) $user->roles;

  // Liste des rôles à rediriger
  $restricted = [ 'subscriber', 'author' ];

  // Si l’un de ces rôles est présent, on redirige
  if ( array_intersect($restricted, $roles) ) {
    // Remplace par l’URL de ton front (ex. https://app.mon-site.com)
    $front_url = 'https://wp-front-xi.vercel.app/';

    wp_redirect($front_url);
    exit;
  }
});
