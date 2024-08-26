<?php
namespace RRZE\Designsystem;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Typography_REST_API {

    public static function init() {
        add_action( 'rest_api_init', array( __CLASS__, 'register_routes' ) );
    }

    public static function register_routes() {
        register_rest_route( 'typographysystem/v1', '/data', array(
            'methods'  => 'GET',
            'callback' => array( __CLASS__, 'get_typographysystem_data' ),
            'permission_callback' => '__return_true', // Adjust permissions as needed
        ));
    }

    public static function get_typographysystem_data( $data ) {
        $args = array(
            'post_type'      => 'typographysystem',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
        );

        $query = new \WP_Query( $args );
        $typographysystem_data = array();

        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();

                // Get categories associated with this post
                $categories = wp_get_post_terms( get_the_ID(), 'typography_category' );

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

                // Add the typography system data including categories
                $typographysystem_data[] = array(
                    'id'             => get_the_ID(),
                    'title'          => get_the_title(),
                    'font_family'    => get_post_meta( get_the_ID(), 'typographysystem_font_family', true ),
                    'font_size'      => get_post_meta( get_the_ID(), 'typographysystem_font_size', true ),
                    'font_weight'    => get_post_meta( get_the_ID(), 'typographysystem_font_weight', true ),
                    'line_height'    => get_post_meta( get_the_ID(), 'typographysystem_line_height', true ),
                    'letter_spacing' => get_post_meta( get_the_ID(), 'typographysystem_letter_spacing', true ),
                    'color'          => get_post_meta( get_the_ID(), 'typographysystem_color', true ),
                    'category'       => $formatted_categories,
                );
            }
            wp_reset_postdata();
        }

        return rest_ensure_response( $typographysystem_data );
    }
}

Typography_REST_API::init();
