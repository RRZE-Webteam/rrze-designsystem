<?php
namespace RRZE\Designsystem\Tokens\Color;
defined('ABSPATH') || exit;
use RRZE\Designsystem\Tokens\Base\Base_CPT;

class Color_CPT extends Base_CPT
{
    public function __construct()
    {
        $labels = [
            'name'                  => _x('Color', 'Post Type General Name', 'rrze-designsystem'),
            'singular_name'         => _x('Color', 'Post Type Singular Name', 'rrze-designsystem'),
            'menu_name'             => __('Color', 'rrze-designsystem'),
            'name_admin_bar'        => __('Color', 'rrze-designsystem'),
            'archives'              => __('Color Archives', 'rrze-designsystem'),
            'attributes'            => __('Color Attributes', 'rrze-designsystem'),
            'all_items'             => __('All Colors', 'rrze-designsystem'),
            'add_new_item'          => __('Add New Color', 'rrze-designsystem'),
            'add_new'               => __('Add New', 'rrze-designsystem'),
            'new_item'              => __('New Color', 'rrze-designsystem'),
            'edit_item'             => __('Edit Color', 'rrze-designsystem'),
            'update_item'           => __('Update Color', 'rrze-designsystem'),
            'view_item'             => __('View Color', 'rrze-designsystem'),
            'view_items'            => __('View Colors', 'rrze-designsystem'),
            'search_items'          => __('Search Colors', 'rrze-designsystem'),
            'not_found'             => __('Not found', 'rrze-designsystem'),
            'not_found_in_trash'    => __('Not found in Trash', 'rrze-designsystem'),
        ];

        $args = [
            'menu_icon'             => 'dashicons-art',
        ];

        $fields = [
        ];

        parent::__construct('color', $labels, $args, $fields);
    }
}