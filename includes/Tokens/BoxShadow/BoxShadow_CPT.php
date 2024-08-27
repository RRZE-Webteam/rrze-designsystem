<?php
namespace RRZE\Designsystem\Tokens\BoxShadow;
defined('ABSPATH') || exit;
use RRZE\Designsystem\Tokens\Base\Base_CPT;

class BoxShadow_CPT extends Base_CPT
{
    public function __construct()
    {
        $labels = [
            'name'                  => _x('Box Shadow', 'Post Type General Name', 'rrze-designsystem'),
            'singular_name'         => _x('Box Shadow', 'Post Type Singular Name', 'rrze-designsystem'),
            'menu_name'             => __('Box Shadow', 'rrze-designsystem'),
            'name_admin_bar'        => __('Box Shadow', 'rrze-designsystem'),
            'archives'              => __('Box Shadow Archives', 'rrze-designsystem'),
            'attributes'            => __('Box Shadow Attributes', 'rrze-designsystem'),
            'all_items'             => __('All Box Shadows', 'rrze-designsystem'),
            'add_new_item'          => __('Add New Box Shadow', 'rrze-designsystem'),
            'add_new'               => __('Add New', 'rrze-designsystem'),
            'new_item'              => __('New Box Shadow', 'rrze-designsystem'),
            'edit_item'             => __('Edit Box Shadow', 'rrze-designsystem'),
            'update_item'           => __('Update Box Shadow', 'rrze-designsystem'),
            'view_item'             => __('View Box Shadow', 'rrze-designsystem'),
            'view_items'            => __('View Box Shadows', 'rrze-designsystem'),
            'search_items'          => __('Search Box Shadows', 'rrze-designsystem'),
            'not_found'             => __('Not found', 'rrze-designsystem'),
            'not_found_in_trash'    => __('Not found in Trash', 'rrze-designsystem'),
        ];

        $args = [
            'menu_icon'             => 'dashicons-art',
        ];

        $fields = [
        ];

        parent::__construct('boxshadow', $labels, $args, $fields);
    }
}