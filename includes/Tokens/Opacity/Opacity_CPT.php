<?php
namespace RRZE\Designsystem\Tokens\Opacity;
defined('ABSPATH') || exit;
use RRZE\Designsystem\Tokens\Base\Base_CPT;

class Opacity_CPT extends Base_CPT
{
    public function __construct()
    {
        $labels = [
            'name'                  => _x('Opacity', 'Post Type General Name', 'rrze-designsystem'),
            'singular_name'         => _x('Opacity', 'Post Type Singular Name', 'rrze-designsystem'),
            'menu_name'             => __('Opacity', 'rrze-designsystem'),
            'name_admin_bar'        => __('Opacity', 'rrze-designsystem'),
            'archives'              => __('Opacity Archives', 'rrze-designsystem'),
            'attributes'            => __('Opacity Attributes', 'rrze-designsystem'),
            'all_items'             => __('All Opacity', 'rrze-designsystem'),
            'add_new_item'          => __('Add New Opacity', 'rrze-designsystem'),
            'add_new'               => __('Add New', 'rrze-designsystem'),
            'new_item'              => __('New Opacity', 'rrze-designsystem'),
            'edit_item'             => __('Edit Opacity', 'rrze-designsystem'),
            'update_item'           => __('Update Opacity', 'rrze-designsystem'),
            'view_item'             => __('View Opacity', 'rrze-designsystem'),
            'view_items'            => __('View Opacity', 'rrze-designsystem'),
            'search_items'          => __('Search Opacity', 'rrze-designsystem'),
            'not_found'             => __('Not found', 'rrze-designsystem'),
            'not_found_in_trash'    => __('Not found in Trash', 'rrze-designsystem'),
        ];

        $args = [
            'menu_icon'             => 'dashicons-art',
        ];

        $fields = [
            // Example usage to extend CMB2 Fields for the CPT
            // [
            //     'name' => __('Opacity Value', 'rrze-designsystem'),
            //     'desc' => __('Enter the opacity value', 'rrze-designsystem'),
            //     'id'   => 'opacity_value',
            //     'type' => 'text',
            // ],
            // [
            //     'name' => __('Opacity Name', 'rrze-designsystem'),
            //     'desc' => __('Enter a name for the opacity (e.g., 100, primary, variable name)', 'rrze-designsystem'),
            //     'id'   => 'opacity_name',
            //     'type' => 'text',
            // ],
            // [
            //     'name' => __('Opacity Type', 'rrze-designsystem'),
            //     'desc' => __('Select if this is a primary, secondary, or another type of opacity', 'rrze-designsystem'),
            //     'id'   => 'opacity_type',
            //     'type' => 'select',
            //     'options' => [
            //         'primary'   => __('Primary', 'rrze-designsystem'),
            //         'secondary' => __('Secondary', 'rrze-designsystem'),
            //         'other'     => __('Other', 'rrze-designsystem'),
            //     ],
            //     'default' => 'primary',
            // ],
        ];

        parent::__construct('opacity', $labels, $args, $fields);
    }
}