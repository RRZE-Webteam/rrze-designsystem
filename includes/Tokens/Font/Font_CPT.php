<?php
namespace RRZE\Designsystem\Tokens\Font;
defined('ABSPATH') || exit;
use RRZE\Designsystem\Tokens\Base\Base_CPT;

class Font_CPT extends Base_CPT
{
    public function __construct()
    {
        $labels = [
            'name'                  => _x('Font', 'Post Type General Name', 'rrze-designsystem'),
            'singular_name'         => _x('Font', 'Post Type Singular Name', 'rrze-designsystem'),
            'menu_name'             => __('Font', 'rrze-designsystem'),
            'name_admin_bar'        => __('Font', 'rrze-designsystem'),
            'archives'              => __('Font Archives', 'rrze-designsystem'),
            'attributes'            => __('Font Attributes', 'rrze-designsystem'),
            'all_items'             => __('All Fonts', 'rrze-designsystem'),
            'add_new_item'          => __('Add New Font', 'rrze-designsystem'),
            'add_new'               => __('Add New', 'rrze-designsystem'),
            'new_item'              => __('New Font', 'rrze-designsystem'),
            'edit_item'             => __('Edit Font', 'rrze-designsystem'),
            'update_item'           => __('Update Font', 'rrze-designsystem'),
            'view_item'             => __('View Font', 'rrze-designsystem'),
            'view_items'            => __('View Fonts', 'rrze-designsystem'),
            'search_items'          => __('Search Fonts', 'rrze-designsystem'),
            'not_found'             => __('Not found', 'rrze-designsystem'),
            'not_found_in_trash'    => __('Not found in Trash', 'rrze-designsystem'),
        ];

        $args = [
            'menu_icon'             => 'dashicons-art',
        ];

        $fields = [
        ];

        parent::__construct('font', $labels, $args, $fields);
    }
}