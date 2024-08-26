<?php
namespace RRZE\Designsystem;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Colorsystem_CPT {

    public static function register_cpt() {
        $labels = array(
            'name'                  => _x( 'Color Systems', 'Post Type General Name', 'colorsystem' ),
            'singular_name'         => _x( 'Color System', 'Post Type Singular Name', 'colorsystem' ),
            'menu_name'             => __( 'Color Systems', 'colorsystem' ),
            'name_admin_bar'        => __( 'Color System', 'colorsystem' ),
            'archives'              => __( 'Color System Archives', 'colorsystem' ),
            'attributes'            => __( 'Color System Attributes', 'colorsystem' ),
            'all_items'             => __( 'All Color Systems', 'colorsystem' ),
            'add_new_item'          => __( 'Add New Color System', 'colorsystem' ),
            'add_new'               => __( 'Add New', 'colorsystem' ),
            'new_item'              => __( 'New Color System', 'colorsystem' ),
            'edit_item'             => __( 'Edit Color System', 'colorsystem' ),
            'update_item'           => __( 'Update Color System', 'colorsystem' ),
            'view_item'             => __( 'View Color System', 'colorsystem' ),
            'view_items'            => __( 'View Color Systems', 'colorsystem' ),
            'search_items'          => __( 'Search Color System', 'colorsystem' ),
            'not_found'             => __( 'Not found', 'colorsystem' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'colorsystem' ),
        );
        $args = array(
            'label'                 => __( 'Color System', 'colorsystem' ),
            'description'           => __( 'Custom Post Type for Color Systems', 'colorsystem' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'post',
            // Add taxonomies support
            'taxonomies'            => array( 'category' ), // Adding default category taxonomy
        );
        register_post_type( 'colorsystem', $args );

        // Register the taxonomy (optional, if you want to create a custom taxonomy)
        self::register_taxonomy();
    }

    public static function register_taxonomy() {
        $labels = array(
            'name'              => _x( 'Color Categories', 'taxonomy general name', 'colorsystem' ),
            'singular_name'     => _x( 'Color Category', 'taxonomy singular name', 'colorsystem' ),
            'search_items'      => __( 'Search Color Categories', 'colorsystem' ),
            'all_items'         => __( 'All Color Categories', 'colorsystem' ),
            'parent_item'       => __( 'Parent Color Category', 'colorsystem' ),
            'parent_item_colon' => __( 'Parent Color Category:', 'colorsystem' ),
            'edit_item'         => __( 'Edit Color Category', 'colorsystem' ),
            'update_item'       => __( 'Update Color Category', 'colorsystem' ),
            'add_new_item'      => __( 'Add New Color Category', 'colorsystem' ),
            'new_item_name'     => __( 'New Color Category Name', 'colorsystem' ),
            'menu_name'         => __( 'Color Categories', 'colorsystem' ),
        );

        $args = array(
            'hierarchical'      => true, // True for category-like taxonomy, false for tag-like
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'color-category' ),
        );

        register_taxonomy( 'color_category', array( 'colorsystem' ), $args );
    }
}
