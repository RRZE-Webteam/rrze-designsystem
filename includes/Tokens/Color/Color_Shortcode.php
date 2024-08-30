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
        $style_template = 'samp.{SELECTOR} { background-color: var({TOKEN_NAME}, {VALUE}); }';
        $extra_classes = ['rrze-designsystem-colors'];
        $samp_text = '';
        parent::__construct($shortcode_tag, $post_type, $rest_namespace, $rest_route, $fields, $style_template, $extra_classes, $samp_text);
    }
}
