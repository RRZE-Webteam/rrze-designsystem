<?php
namespace RRZE\Designsystem\Tokens\Space;
defined('ABSPATH') || exit;
use RRZE\Designsystem\Tokens\Base\Base_CPT;

class Space_CPT extends Base_CPT
{
    public function __construct()
    {
        $labels = [
            'name'                  => _x('Space', 'Post Type General Name', 'rrze-designsystem'),
            'singular_name'         => _x('Space', 'Post Type Singular Name', 'rrze-designsystem'),
            'menu_name'             => __('Space', 'rrze-designsystem'),
            'name_admin_bar'        => __('Space', 'rrze-designsystem'),
            'archives'              => __('Space Archives', 'rrze-designsystem'),
            'attributes'            => __('Space Attributes', 'rrze-designsystem'),
            'all_items'             => __('All Spacing', 'rrze-designsystem'),
            'add_new_item'          => __('Add New Space', 'rrze-designsystem'),
            'add_new'               => __('Add New', 'rrze-designsystem'),
            'new_item'              => __('New Space', 'rrze-designsystem'),
            'edit_item'             => __('Edit Space', 'rrze-designsystem'),
            'update_item'           => __('Update Space', 'rrze-designsystem'),
            'view_item'             => __('View Space', 'rrze-designsystem'),
            'view_items'            => __('View Spacing', 'rrze-designsystem'),
            'search_items'          => __('Search Spacing', 'rrze-designsystem'),
            'not_found'             => __('Not found', 'rrze-designsystem'),
            'not_found_in_trash'    => __('Not found in Trash', 'rrze-designsystem'),
        ];

        $args = [
            'menu_icon'             => 'dashicons-art',
        ];

        $fields = [
        ];

        parent::__construct('space', $labels, $args, $fields);
    }
}