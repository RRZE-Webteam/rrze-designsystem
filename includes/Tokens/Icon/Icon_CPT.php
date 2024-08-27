<?php
namespace RRZE\Designsystem\Tokens\Icon;
defined('ABSPATH') || exit;
use RRZE\Designsystem\Tokens\Base\Base_CPT;

class Icon_CPT extends Base_CPT
{
    public function __construct()
    {
        $labels = [
            'name'                  => _x('Icon', 'Post Type General Name', 'rrze-designsystem'),
            'singular_name'         => _x('Icon', 'Post Type Singular Name', 'rrze-designsystem'),
            'menu_name'             => __('Icon', 'rrze-designsystem'),
            'name_admin_bar'        => __('Icon', 'rrze-designsystem'),
            'archives'              => __('Icon Archives', 'rrze-designsystem'),
            'attributes'            => __('Icon Attributes', 'rrze-designsystem'),
            'all_items'             => __('All Icons', 'rrze-designsystem'),
            'add_new_item'          => __('Add New Icon', 'rrze-designsystem'),
            'add_new'               => __('Add New', 'rrze-designsystem'),
            'new_item'              => __('New Icon', 'rrze-designsystem'),
            'edit_item'             => __('Edit Icon', 'rrze-designsystem'),
            'update_item'           => __('Update Icon', 'rrze-designsystem'),
            'view_item'             => __('View Icon', 'rrze-designsystem'),
            'view_items'            => __('View Icons', 'rrze-designsystem'),
            'search_items'          => __('Search Icons', 'rrze-designsystem'),
            'not_found'             => __('Not found', 'rrze-designsystem'),
            'not_found_in_trash'    => __('Not found in Trash', 'rrze-designsystem'),
        ];

        $args = [
            'menu_icon'             => 'dashicons-art',
        ];

        $fields = [
        ];

        parent::__construct('icon', $labels, $args, $fields);
    }
}