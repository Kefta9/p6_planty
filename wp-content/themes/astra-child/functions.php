<?php
/**
 * Recommended way to include parent theme styles.
 * (Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)
 *
 */

add_action( 'wp_enqueue_scripts', 'astra_child_style' );
				function astra_child_style() {
					wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
					wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style') );
					wp_enqueue_script( 'custom-admin-js', get_stylesheet_directory_uri() . '/js/admin-link.js', array(), false, true );
				}

/**
 * Your code goes below.
 */

add_filter( 'wp_nav_menu_items', 'ajouter_lien_admin', 10, 2 );

function ajouter_lien_admin( $items, $args ) { // item = les éléments du menu, args = les arguments du menu (comme theme_location, l'id du menu, etc.)
    if ( $args->theme_location === 'primary' && is_user_logged_in() && current_user_can('administrator') ) {
        
        // Découpe les items à chaque </li> pour en faire un tableau
        $items_array = explode('</li>', $items);

        // Nettoie chaque élément + réajoute </li> car explode l'enlève
        foreach ( $items_array as &$item ) {
            $item = trim($item);
            if ( $item !== '' ) {
                $item .= '</li>';
            }
        }

        // Crée le lien Admin
        $admin_link = '<li class="menu-item menu-admin"><a href="/wp-admin/">Admin</a></li>';

        // Insère le lien en 2e position (0 car on ne retire rien)
        array_splice( $items_array, 1, 0, $admin_link );

        // Recolle tous les liens en une seule chaîne
        $items = implode('', $items_array);
    }

    return $items;
}