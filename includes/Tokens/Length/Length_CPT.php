<?php
namespace RRZE\Designsystem\Tokens\Length;
defined('ABSPATH') || exit;
use RRZE\Designsystem\Tokens\Base\Base_CPT;

class Length_CPT extends Base_CPT
{
    public function __construct()
    {
        $labels = [
            'name'                  => _x('Length', 'Post Type General Name', 'rrze-designsystem'),
            'singular_name'         => _x('Length', 'Post Type Singular Name', 'rrze-designsystem'),
            'menu_name'             => __('Length', 'rrze-designsystem'),
            'name_admin_bar'        => __('Length', 'rrze-designsystem'),
            'archives'              => __('Length Archives', 'rrze-designsystem'),
            'attributes'            => __('Length Attributes', 'rrze-designsystem'),
            'all_items'             => __('All Lengths', 'rrze-designsystem'),
            'add_new_item'          => __('Add New Length', 'rrze-designsystem'),
            'add_new'               => __('Add New', 'rrze-designsystem'),
            'new_item'              => __('New Length', 'rrze-designsystem'),
            'edit_item'             => __('Edit Length', 'rrze-designsystem'),
            'update_item'           => __('Update Length', 'rrze-designsystem'),
            'view_item'             => __('View Length', 'rrze-designsystem'),
            'view_items'            => __('View Lengths', 'rrze-designsystem'),
            'search_items'          => __('Search Lengths', 'rrze-designsystem'),
            'not_found'             => __('Not found', 'rrze-designsystem'),
            'not_found_in_trash'    => __('Not found in Trash', 'rrze-designsystem'),
        ];

        $args = [
            'menu_icon'             => 'dashicons-art',
        ];

        $fields = [
        ];

        parent::__construct('length', $labels, $args, $fields);
    }
}