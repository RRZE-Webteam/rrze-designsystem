<?php

namespace RRZE\Designsystem\Tokens\Base;

defined('ABSPATH') || exit;

abstract class Base_REST_API
{
    protected $post_type;
    protected $namespace;
    protected $route;

    public function __construct($post_type, $namespace, $route)
    {
        $this->post_type = $post_type;
        $this->namespace = $namespace;
        $this->route = $route;

        add_action('rest_api_init', [$this, 'register_routes']);
    }

    public function register_routes()
    {
        register_rest_route($this->namespace, '/' . $this->route, [
            'methods' => 'GET',
            'callback' => [$this, 'get_data'],
            'permission_callback' => '__return_true',
        ]);
    }

    public function get_data($data)
    {
        $args = [
            'post_type'      => $this->post_type,
            'posts_per_page' => -1,
            'post_status'    => 'publish',
        ];

        $query = new \WP_Query($args);
        $results = [];

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();

                $categories = wp_get_post_terms(get_the_ID(), $this->get_taxonomy());

                $formatted_categories = array_map(function ($term) {
                    return [
                        'term_id'       => $term->term_id,
                        'name'          => $term->name,
                        'slug'          => $term->slug,
                        'term_group'    => $term->term_group,
                        'term_taxonomy_id' => $term->term_taxonomy_id,
                        'taxonomy'      => $term->taxonomy,
                        'description'   => $term->description,
                        'parent'        => $term->parent,
                        'count'         => $term->count,
                        'filter'        => $term->filter,
                    ];
                }, $categories);

                $results[] = [
                    'id'          => get_the_ID(),
                    'title'       => get_the_title(),
                    'token_name'  => get_post_meta(get_the_ID(), $this->post_type . '_token_name', true),
                    'value'       => get_post_meta(get_the_ID(), $this->post_type . '_value', true),
                    'use_case'    => get_post_meta(get_the_ID(), $this->post_type . '_use_case', true),
                    'categories'  => $formatted_categories,
                ];
            }
            wp_reset_postdata();
        }

        return rest_ensure_response($results);
    }

    /**
     * Returns the taxonomy for the custom post type.
     *  
     * @return string
     *  
     * @since 1.0.0
     */
    protected function get_taxonomy()
    {
        return $this->post_type . '_category';
    }
}
