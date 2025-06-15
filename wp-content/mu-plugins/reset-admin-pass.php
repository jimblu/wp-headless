<?php
/**
 * Mu-plugin temporaire pour forcer la réinitialisation
 * du mot de passe de l’utilisateur 'admin' à 'NewP@ssw0rd123'
 */
add_action('init', function() {
  // Change 'admin' si ton login est différent
  $user = get_user_by('login', 'editeur_1');
  if ($user && !wp_check_password('editeur_1_loulou', $user->user_pass, $user->ID)) {
    wp_set_password('editeur_1_loulou', $user->ID);
  }
});