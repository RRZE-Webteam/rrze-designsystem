<?php

namespace RRZE\Designsystem\Tokens\Base;

defined('ABSPATH') || exit;

abstract class Base_CPT
{
    protected $post_type;
    protected $labels;
    protected $args;
    protected $fields;

    public function __construct($post_type, $labels, $args = [], $fields = [])
    {
        $this->post_type = $post_type;
        $this->labels = $labels;
        $this->args = $args;
        $this->fields = $fields;

        add_action('init', [$this, 'register_cpt']);
        add_action('cmb2_admin_init', [$this, 'register_metaboxes']);
        add_action('init', [$this, 'register_taxonomy']);
    }


    /**
     * Registers the custom post type with the provided labels, arguments, 
     * and default settings. This method merges default arguments with 
     * any custom arguments passed during class instantiation and then 
     * registers the post type using WordPress's `register_post_type` function.
     *
     * @return void
     */
    public function register_cpt()
    {
        $default_args = [
            'label'                 => $this->labels['name'],
            'description'           => $this->labels['name'] . ' Custom Post Type',
            'labels'                => $this->labels,
            'supports'              => ['title'],
            'hierarchical'          => false,
            'public'                => false,
            'show_ui'               => true,
            'show_in_menu'          => 'design-tokens',
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => false,
            'exclude_from_search'   => true,
            'publicly_queryable'    => true,
            'capability_type'       => 'post',
            'taxonomies'            => [],
            'show_in_rest'          => true,
        ];

        $args = array_merge($default_args, $this->args);
        register_post_type($this->post_type, $args);
    }

    /**
     * Registers the metaboxes for the custom post type using the CMB2 library. 
     * This method sets up common fields that are used across all instances 
     * of the post type and adds any additional fields specified during 
     * class instantiation.
     *
     * @return void
     */
    public function register_metaboxes()
    {
        $prefix = $this->post_type . '_';

        $cmb = new_cmb2_box(array(
            'id'            => $prefix . 'metabox',
            'title'         => __($this->labels['name'] . ' Details', 'rrze-designsystem'),
            'object_types'  => array($this->post_type),
        ));

        // Common Fields
        $cmb->add_field(array(
            'name' => __('Token Name', 'rrze-designsystem'),
            'desc' => __('Enter the token name', 'rrze-designsystem'),
            'id'   => $prefix . 'token_name',
            'type' => 'text',
            'sanitization_cb' => 'sanitize_text_field',
        ));

        $cmb->add_field(array(
            'name' => __('Value', 'rrze-designsystem'),
            'desc' => __('Enter the value', 'rrze-designsystem'),
            'id'   => $prefix . 'value',
            'type' => 'text',
            'sanitization_cb' => 'sanitize_css_value',
        ));

        $cmb->add_field(array(
            'name' => __('Use Case', 'rrze-designsystem'),
            'desc' => __('Enter the use case', 'rrze-designsystem'),
            'id'   => $prefix . 'use_case',
            'type' => 'text',
            'sanitization_cb' => 'sanitize_text_field',
        ));

        // Individual Fields
        foreach ($this->fields as $field) {
            $cmb->add_field($field);
        }
    }

    /**
     * Sanitizes the value of the CSS field to ensure that only valid CSS is matched
     * 
     * @param string $value The value to sanitize
     * @return string
     */
    public function sanitize_css_value($value)
    {
        $value = wp_strip_all_tags($value);

        if (preg_match('/^(\d+|\d*\.\d+)(px|em|rem|%)?|^rgba?\(\d{1,3},\d{1,3},\d{1,3}(,\d(\.\d+)?)?\)$/i', $value)) {
            return $value;
        }

        return '';
    }

    /**
     * Registers the custom taxonomy for the custom post type. This method 
     * uses the provided labels to create the taxonomy and then registers 
     * it using WordPress's `register_taxonomy` function.
     *
     * @return void
     */
    public function register_taxonomy()
    {
        $labels = [
            'name'              => _x($this->labels['name'] . ' Categories', 'taxonomy general name', 'rrze-designsystem'),
            'singular_name'     => _x($this->labels['name'] . ' Category', 'taxonomy singular name', 'rrze-designsystem'),
            'search_items'      => __('Search ' . $this->labels['name'] . ' Categories', 'rrze-designsystem'),
            'all_items'         => __('All ' . $this->labels['name'] . ' Categories', 'rrze-designsystem'),
            'parent_item'       => __('Parent ' . $this->labels['name'] . ' Category', 'rrze-designsystem'),
            'parent_item_colon' => __('Parent ' . $this->labels['name'] . ' Category:', 'rrze-designsystem'),
            'edit_item'         => __('Edit ' . $this->labels['name'] . ' Category', 'rrze-designsystem'),
            'update_item'       => __('Update ' . $this->labels['name'] . ' Category', 'rrze-designsystem'),
            'add_new_item'      => __('Add New ' . $this->labels['name'] . ' Category', 'rrze-designsystem'),
            'new_item_name'     => __('New ' . $this->labels['name'] . ' Category Name', 'rrze-designsystem'),
            'menu_name'         => __($this->labels['name'] . ' Categories', 'rrze-designsystem'),
        ];

        $args = [
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => ['slug' => strtolower($this->labels['name']) . '-category'],
        ];

        register_taxonomy(strtolower($this->labels['name']) . '_category', [$this->post_type], $args);
    }
}
