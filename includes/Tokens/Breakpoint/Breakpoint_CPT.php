<?php
namespace RRZE\Designsystem\Tokens\Breakpoint;
defined('ABSPATH') || exit;
use RRZE\Designsystem\Tokens\Base\Base_CPT;

class Breakpoint_CPT extends Base_CPT
{
    public function __construct()
    {
        $labels = [
            'name'                  => _x('Breakpoint', 'Post Type General Name', 'rrze-designsystem'),
            'singular_name'         => _x('Breakpoint', 'Post Type Singular Name', 'rrze-designsystem'),
            'menu_name'             => __('Breakpoint', 'rrze-designsystem'),
            'name_admin_bar'        => __('Breakpoint', 'rrze-designsystem'),
            'archives'              => __('Breakpoint Archives', 'rrze-designsystem'),
            'attributes'            => __('Breakpoint Attributes', 'rrze-designsystem'),
            'all_items'             => __('All Breakpoints', 'rrze-designsystem'),
            'add_new_item'          => __('Add New Breakpoint', 'rrze-designsystem'),
            'add_new'               => __('Add New', 'rrze-designsystem'),
            'new_item'              => __('New Breakpoint', 'rrze-designsystem'),
            'edit_item'             => __('Edit Breakpoint', 'rrze-designsystem'),
            'update_item'           => __('Update Breakpoint', 'rrze-designsystem'),
            'view_item'             => __('View Breakpoint', 'rrze-designsystem'),
            'view_items'            => __('View Breakpoints', 'rrze-designsystem'),
            'search_items'          => __('Search Breakpoints', 'rrze-designsystem'),
            'not_found'             => __('Not found', 'rrze-designsystem'),
            'not_found_in_trash'    => __('Not found in Trash', 'rrze-designsystem'),
        ];

        $args = [
            'menu_breakpoint'             => 'dashbreakpoints-art',
        ];

        $fields = [
        ];

        parent::__construct('breakpoint', $labels, $args, $fields);
    }
}