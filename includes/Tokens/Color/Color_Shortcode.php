<?php

namespace RRZE\Designsystem\Tokens\Color;
defined('ABSPATH') || exit;

use RRZE\Designsystem\Tokens\Base\Base_Shortcode;

class Color_Shortcode extends Base_Shortcode
{
    public function __construct()
    {
        $shortcode_tag = 'color_table'; // The shortcode tag [color_table]
        $post_type = 'color';
        $rest_namespace = 'color/v1';
        $rest_route = 'data';
        $fields = [
            ['name' => 'token_name', 'label' => 'Token name'],
            ['name' => 'value', 'label' => 'Value'],
            ['name' => 'use_case', 'label' => 'Use case'],
        ];

        parent::__construct($shortcode_tag, $post_type, $rest_namespace, $rest_route, $fields);
    }
}
