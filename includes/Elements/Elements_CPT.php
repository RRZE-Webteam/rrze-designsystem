<?php

namespace RRZE\Designsystem\Elements;

defined('ABSPATH') || exit;

use RRZE\Designsystem\Tokens\Base\Base_CPT;

class Elements_CPT extends Base_CPT
{
    public function __construct()
    {
        $post_type = 'elements';
        $labels = [
            'name'               => __('Elements', 'rrze-designsystem'),
            'singular_name'      => __('Element', 'rrze-designsystem'),
            'menu_name'          => __('Elements', 'rrze-designsystem'),
            'name_admin_bar'     => __('Element', 'rrze-designsystem'),
            'add_new'            => __('Add New', 'rrze-designsystem'),
            'add_new_item'       => __('Add New Element', 'rrze-designsystem'),
            'new_item'           => __('New Element', 'rrze-designsystem'),
            'edit_item'          => __('Edit Element', 'rrze-designsystem'),
            'view_item'          => __('View Element', 'rrze-designsystem'),
            'all_items'          => __('All Elements', 'rrze-designsystem'),
            'search_items'       => __('Search Elements', 'rrze-designsystem'),
            'parent_item_colon'  => __('Parent Element:', 'rrze-designsystem'),
            'not_found'          => __('No elements found.', 'rrze-designsystem'),
            'not_found_in_trash' => __('No elements found in Trash.', 'rrze-designsystem'),
        ];

        $args = [
            'supports'              => ['title', 'editor', 'page-attributes'],
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 6,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'rewrite'               => ['slug' => 'elements'],
            'hierarchical'          => true, // Allows for nested pages
            'show_in_rest'          => true,
        ];

        $fields = $this->define_fields();

        parent::__construct($post_type, $labels, $args, $fields);
    }

    /**
     * Defines the fields for the Elements CPT.
     *
     * @return array The array of fields.
     */
    protected function define_fields()
    {
        $prefix = 'elements_';

        return [
            // Section Overview Fields
            [
                'name' => __('Overview', 'rrze-designsystem'),
                'id'   => $prefix . 'overview',
                'type' => 'wysiwyg',
            ],
            [
                'name' => __('Sample Element', 'rrze-designsystem'),
                'id'   => $prefix . 'sample_element',
                'type' => 'wysiwyg',
            ],
            [
                'name' => __('When to Use', 'rrze-designsystem'),
                'id'   => $prefix . 'when_to_use',
                'type' => 'wysiwyg',
            ],
            [
                'name' => __('Related Elements', 'rrze-designsystem'),
                'id'   => $prefix . 'related_elements',
                'type' => 'text_url',
                'repeatable' => true, // Allows up to 3 link fields
                'limit' => 3,
            ],
            // Section Style Fields
            [
                'name' => __('Brief', 'rrze-designsystem'),
                'id'   => $prefix . 'brief',
                'type' => 'wysiwyg',
            ],
            [
                'name' => __('Anatomy', 'rrze-designsystem'),
                'id'   => $prefix . 'anatomy',
                'type' => 'wysiwyg',
            ],
            [
                'name' => __('Style', 'rrze-designsystem'),
                'id'   => $prefix . 'style',
                'type' => 'wysiwyg',
            ],
            // Section Guidelines Field
            [
                'name' => __('Guidelines', 'rrze-designsystem'),
                'id'   => $prefix . 'guidelines',
                'type' => 'wysiwyg',
            ],
            // Section Code Field
            [
                'name' => __('Code', 'rrze-designsystem'),
                'id'   => $prefix . 'code',
                'type' => 'wysiwyg',
            ],
            // Section Accessibility Field
            [
                'name' => __('Accessibility', 'rrze-designsystem'),
                'id'   => $prefix . 'accessibility',
                'type' => 'wysiwyg',
            ],
        ];
    }
}

new Elements_CPT();
