<?php

namespace RRZE\Designsystem\Tokens\Typography;

if (! defined('ABSPATH')) {
    exit;
}

class Typography_CPT
{

    public static function register_cpt()
    {
        $labels = array(
            'name'                  => _x('Typography', 'Post Type General Name', 'typographysystem'),
            'singular_name'         => _x('Font Style', 'Post Type Singular Name', 'typographysystem'),
            'menu_name'             => __('Typography', 'typographysystem'),
            'name_admin_bar'        => __('Typography', 'typographysystem'),
            'archives'              => __('Typography System Archives', 'typographysystem'),
            'attributes'            => __('Typography System Attributes', 'typographysystem'),
            'all_items'             => __('All Font Styles', 'typographysystem'),
            'add_new_item'          => __('Add New Font Style', 'typographysystem'),
            'add_new'               => __('Add New', 'typographysystem'),
            'new_item'              => __('New Font Style', 'typographysystem'),
            'edit_item'             => __('Edit Font Style', 'typographysystem'),
            'update_item'           => __('Update Font Style', 'typographysystem'),
            'view_item'             => __('View Font Style', 'typographysystem'),
            'view_items'            => __('View Font Styles', 'typographysystem'),
            'search_items'          => __('Search Font Styles', 'typographysystem'),
            'not_found'             => __('Not found', 'typographysystem'),
            'not_found_in_trash'    => __('Not found in Trash', 'typographysystem'),
        );

        $args = array(
            'label'                 => __('Typography System', 'typographysystem'),
            'description'           => __('Custom Post Type for Typography Systems', 'typographysystem'),
            'labels'                => $labels,
            'supports'              => array('title'),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => 'design-tokens',
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'post'
        );

        register_post_type('typographysystem', $args);

        // Register the taxonomy
        self::register_taxonomy();
    }

    public static function register_taxonomy()
    {
        $labels = array(
            'name'              => _x('Typography Categories', 'taxonomy general name', 'typographysystem'),
            'singular_name'     => _x('Typography Category', 'taxonomy singular name', 'typographysystem'),
            'search_items'      => __('Search Typography Categories', 'typographysystem'),
            'all_items'         => __('All Typography Categories', 'typographysystem'),
            'parent_item'       => __('Parent Typography Category', 'typographysystem'),
            'parent_item_colon' => __('Parent Typography Category:', 'typographysystem'),
            'edit_item'         => __('Edit Typography Category', 'typographysystem'),
            'update_item'       => __('Update Typography Category', 'typographysystem'),
            'add_new_item'      => __('Add New Typography Category', 'typographysystem'),
            'new_item_name'     => __('New Typography Category Name', 'typographysystem'),
            'menu_name'         => __('Typography Categories', 'typographysystem'),
        );

        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array('slug' => 'typography-category'),
        );

        register_taxonomy('typography_category', array('typographysystem'), $args);
    }
}
