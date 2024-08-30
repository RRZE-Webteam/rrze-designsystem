<?php
namespace RRZE\Designsystem\Tokens\MediaQuery;
defined('ABSPATH') || exit;
use RRZE\Designsystem\Tokens\Base\Base_CPT;

class MediaQuery_CPT extends Base_CPT
{
    public function __construct()
    {
        $labels = [
            'name'                  => _x('Media Query', 'Post Type General Name', 'rrze-designsystem'),
            'singular_name'         => _x('Media Query', 'Post Type Singular Name', 'rrze-designsystem'),
            'menu_name'             => __('Media Query', 'rrze-designsystem'),
            'name_admin_bar'        => __('Media Query', 'rrze-designsystem'),
            'archives'              => __('Media Query Archives', 'rrze-designsystem'),
            'attributes'            => __('Media Query Attributes', 'rrze-designsystem'),
            'all_items'             => __('All Media Queries', 'rrze-designsystem'),
            'add_new_item'          => __('Add New Media Query', 'rrze-designsystem'),
            'add_new'               => __('Add New', 'rrze-designsystem'),
            'new_item'              => __('New Media Query', 'rrze-designsystem'),
            'edit_item'             => __('Edit Media Query', 'rrze-designsystem'),
            'update_item'           => __('Update Media Query', 'rrze-designsystem'),
            'view_item'             => __('View Media Query', 'rrze-designsystem'),
            'view_items'            => __('View Media Queries', 'rrze-designsystem'),
            'search_items'          => __('Search Media Queries', 'rrze-designsystem'),
            'not_found'             => __('Not found', 'rrze-designsystem'),
            'not_found_in_trash'    => __('Not found in Trash', 'rrze-designsystem'),
        ];

        $args = [
            'menu_mediaquery'             => 'dashicons-art',
        ];

        $fields = [
        ];

        parent::__construct('mediaquery', $labels, $args, $fields);
    }
}