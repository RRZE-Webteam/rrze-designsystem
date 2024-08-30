<?php

namespace RRZE\Designsystem\Tokens\Border;
defined('ABSPATH') || exit;

use RRZE\Designsystem\Tokens\Base\Base_Shortcode;

class Border_Shortcode extends Base_Shortcode
{
    public function __construct()
    {
        $shortcode_tag = 'border_table'; // The shortcode tag [border_table]
        $post_type = 'border';
        $rest_namespace = 'border/v1';
        $rest_route = 'data';
        $fields = [
            ['name' => 'token_name', 'label' => 'Token name'],
            ['name' => 'value', 'label' => 'Value'],
            ['name' => 'use_case', 'label' => 'Use case'],
        ];
        $style_template = 'samp.{SELECTOR} { border: var({TOKEN_NAME}, {VALUE}) solid #000; }';
        $extra_classes = ['rrze-designsystem-borders'];
        $samp_text = '';
        parent::__construct($shortcode_tag, $post_type, $rest_namespace, $rest_route, $fields, $style_template, $extra_classes, $samp_text);
    }
}
