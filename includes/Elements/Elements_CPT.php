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
            'supports'              => ['title'],
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 6,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => false,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'rewrite'               => ['slug' => 'elements'],
            'hierarchical'          => false,
            'show_in_rest'          => true,
        ];

        $fields = $this->define_fields();
        $hide_default_fields = true;

        parent::__construct($post_type, $labels, $args, $fields, $hide_default_fields);
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
                'desc' => __('Provide a brief overview of the element. For example a screenshot of what to expect.', 'rrze-designsystem'),
            ],
            [
                'name' => __('Sample Element', 'rrze-designsystem'),
                'id'   => $prefix . 'sample_element',
                'type' => 'wysiwyg',
                'desc' => __('Provide a live-demo of the element via a shortcode if it exists.', 'rrze-designsystem'),
            ],
            [
                'name' => __('When to Use', 'rrze-designsystem'),
                'id'   => $prefix . 'when_to_use',
                'type' => 'wysiwyg',
                'desc' => __('Describe when to use this element. Using list elements is recommended.', 'rrze-designsystem'),
            ],
            [
                'name'       => __('Related Elements', 'rrze-designsystem'),
                'id'         => $prefix . 'related_elements',
                'type'       => 'group',
                'repeatable' => true,
                'options'    => [
                    'group_title'   => __('Related Element {#}', 'rrze-designsystem'),
                    'add_button'    => __('Add Related Element', 'rrze-designsystem'),
                    'remove_button' => __('Remove Related Element', 'rrze-designsystem'),
                    'sortable'      => true,
                ],
                'fields'     => [
                    [
                        'name' => __('Link Text', 'rrze-designsystem'),
                        'id'   => 'link_text',
                        'type' => 'text',
                        'desc' => __('Enter the display text for the link.', 'rrze-designsystem'),
                    ],
                    [
                        'name' => __('URL', 'rrze-designsystem'),
                        'id'   => 'link_url',
                        'type' => 'text_url',
                        'desc' => __('Enter the URL for the link.', 'rrze-designsystem'),
                    ],
                ],
                'desc'       => __('Add related elements or patterns that are connected to this element. You can add multiple links.', 'rrze-designsystem'),
            ],
            // Section Style Fields
            [
                'name' => __('Design Brief overview', 'rrze-designsystem'),
                'id'   => $prefix . 'brief',
                'type' => 'wysiwyg',
                'desc' => __('Provide a design brief of the element.', 'rrze-designsystem'),
            ],
            [
                'name' => __('Anatomy', 'rrze-designsystem'),
                'id'   => $prefix . 'anatomy',
                'type' => 'wysiwyg',
                'desc' => __('Provide a visual representation of the element with annotations. Follow technical documentation best practices.', 'rrze-designsystem'),
            ],
            [
                'name' => __('Style', 'rrze-designsystem'),
                'id'   => $prefix . 'style',
                'type' => 'wysiwyg',
                'desc' => __('Provide the style guide for the element. Include typography, color, and spacing.', 'rrze-designsystem'),
            ],
            // Section Guidelines Field
            [
                'name' => __('Guidelines – Usage', 'rrze-designsystem'),
                'id'   => $prefix . 'guidelines',
                'type' => 'wysiwyg',
                'desc' => __('Provide guidelines for using the element. Include best practices and examples.', 'rrze-designsystem'),
            ],
            // Section Code Field
            [
                'name' => __('Code', 'rrze-designsystem'),
                'id'   => $prefix . 'code',
                'type' => 'wysiwyg',
                'desc' => __('Provide the code snippet for the element. Include HTML, SCSS, and JavaScript.', 'rrze-designsystem'),
            ],
            // Section Accessibility Field
            [
                'name' => __('Accessibility', 'rrze-designsystem'),
                'id'   => $prefix . 'accessibility',
                'type' => 'wysiwyg',
                'desc' => __('Provide accessibility information for the element. Include ARIA roles, keyboard navigation, and screen reader support.', 'rrze-designsystem'),
            ],
        ];
    }
}

new Elements_CPT();
