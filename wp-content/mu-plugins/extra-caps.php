<?php
// wp-content/mu-plugins/extra-caps.php
add_action('init', function() {
  if ( $role = get_role('subscriber') ) {
    // capacités "singulier"
    $role->add_cap('read_school');
    $role->add_cap('edit_school');
    $role->add_cap('delete_school');
    // capacités "pluriel"
    $caps = [
      'edit_schools',
      'edit_others_schools',
      'publish_schools',
      'read_private_schools',
      'delete_schools',
      'delete_private_schools',
      'delete_published_schools',
      'edit_private_schools',
      'edit_published_schools'
    ];
    foreach ( $caps as $cap ) {
      $role->add_cap($cap);
    }
  }
}, 11);
