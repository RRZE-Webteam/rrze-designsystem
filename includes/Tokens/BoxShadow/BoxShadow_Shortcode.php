<?php

namespace RRZE\Designsystem\Tokens\BoxShadow;
defined('ABSPATH') || exit;

use RRZE\Designsystem\Tokens\Base\Base_Shortcode;

class BoxShadow_Shortcode extends Base_Shortcode
{
    public function __construct()
    {
        $shortcode_tag = 'boxshadow_table'; // The shortcode tag [boxshadow_table]
        $post_type = 'boxshadow';
        $rest_namespace = 'boxshadow/v1';
        $rest_route = 'data';
        $fields = [
            ['name' => 'token_name', 'label' => 'Token name'],
            ['name' => 'value', 'label' => 'Value'],
            ['name' => 'use_case', 'label' => 'Use case'],
        ];
        $style_template = 'samp.{SELECTOR} { box-shadow: var({TOKEN_NAME}, {VALUE});; }';
        $extra_classes = ['rrze-designsystem-boxshadows'];
        $samp_text = '';
        parent::__construct($shortcode_tag, $post_type, $rest_namespace, $rest_route, $fields, $style_template, $extra_classes, $samp_text);
    }
}
