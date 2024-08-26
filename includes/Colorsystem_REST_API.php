<?php
namespace RRZE\Designsystem;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Colorsystem_REST_API {

    public static function init() {
        add_action( 'rest_api_init', array( __CLASS__, 'register_routes' ) );
    }

    public static function register_routes() {
        register_rest_route( 'colorsystem/v1', '/data', array(
            'methods'  => 'GET',
            'callback' => array( __CLASS__, 'get_colorsystem_data' ),
            'permission_callback' => '__return_true', // Adjust permissions as needed
        ));
    }

    public static function get_colorsystem_data( $data ) {
        $args = array(
            'post_type'      => 'colorsystem',
            'posts_per_page' => -1, // Fetch all posts
            'post_status'    => 'publish',
        );

        $query = new \WP_Query( $args );
        $colorsystem_data = array();

        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();

                // Get categories associated with this post
                $categories = wp_get_post_terms( get_the_ID(), 'color_category' ); // Use your custom taxonomy name if not default 'category'

                // Format categories as an array of objects
                $formatted_categories = array_map(function($term) {
                    return array(
                        'term_id' => $term->term_id,
                        'name' => $term->name,
                        'slug' => $term->slug,
                        'term_group' => $term->term_group,
                        'term_taxonomy_id' => $term->term_taxonomy_id,
                        'taxonomy' => $term->taxonomy,
                        'description' => $term->description,
                        'parent' => $term->parent,
                        'count' => $term->count,
                        'filter' => $term->filter,
                    );
                }, $categories);

                // Add the color system data including categories
                $colorsystem_data[] = array(
                    'id'        => get_the_ID(),
                    'title'     => get_the_title(),
                    'hex_value' => get_post_meta( get_the_ID(), 'colorsystem_hex_value', true ),
                    'color_name'=> get_post_meta( get_the_ID(), 'colorsystem_color_name', true ),
                    'color_type'=> get_post_meta( get_the_ID(), 'colorsystem_color_type', true ),
                    'category'  => $formatted_categories,
                );
            }
            wp_reset_postdata();
        }

        return rest_ensure_response( $colorsystem_data );
    }
}

Colorsystem_REST_API::init();
