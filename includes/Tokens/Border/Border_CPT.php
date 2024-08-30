<?php
namespace RRZE\Designsystem\Tokens\Border;
defined('ABSPATH') || exit;
use RRZE\Designsystem\Tokens\Base\Base_CPT;

class Border_CPT extends Base_CPT
{
    public function __construct()
    {
        $labels = [
            'name'                  => _x('Border', 'Post Type General Name', 'rrze-designsystem'),
            'singular_name'         => _x('Border', 'Post Type Singular Name', 'rrze-designsystem'),
            'menu_name'             => __('Border', 'rrze-designsystem'),
            'name_admin_bar'        => __('Border', 'rrze-designsystem'),
            'archives'              => __('Border Archives', 'rrze-designsystem'),
            'attributes'            => __('Border Attributes', 'rrze-designsystem'),
            'all_items'             => __('All Borders', 'rrze-designsystem'),
            'add_new_item'          => __('Add New Border', 'rrze-designsystem'),
            'add_new'               => __('Add New', 'rrze-designsystem'),
            'new_item'              => __('New Border', 'rrze-designsystem'),
            'edit_item'             => __('Edit Border', 'rrze-designsystem'),
            'update_item'           => __('Update Border', 'rrze-designsystem'),
            'view_item'             => __('View Border', 'rrze-designsystem'),
            'view_items'            => __('View Borders', 'rrze-designsystem'),
            'search_items'          => __('Search Borders', 'rrze-designsystem'),
            'not_found'             => __('Not found', 'rrze-designsystem'),
            'not_found_in_trash'    => __('Not found in Trash', 'rrze-designsystem'),
        ];

        $args = [
            'menu_icon'             => 'dashicons-art',
        ];

        $fields = [
        ];

        parent::__construct('border', $labels, $args, $fields);
    }
}