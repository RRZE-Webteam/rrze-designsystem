<?php

namespace RRZE\Designsystem\Tokens\Font;
defined('ABSPATH') || exit;

use RRZE\Designsystem\Tokens\Base\Base_Shortcode;

class Font_Shortcode extends Base_Shortcode
{
    public function __construct()
    {
        $shortcode_tag = 'font_table'; // The shortcode tag [font_table]
        $post_type = 'font';
        $rest_namespace = 'font/v1';
        $rest_route = 'data';
        $fields = [
            ['name' => 'token_name', 'label' => 'Token name'],
            ['name' => 'value', 'label' => 'Value'],
            ['name' => 'use_case', 'label' => 'Use case'],
        ];
        $style_template = 'samp.{SELECTOR} { font-size: var({TOKEN_NAME}, {VALUE}); }';
        $extra_classes = ['rrze-designsystem-fonts'];
        $samp_text = 'Aa';
        parent::__construct($shortcode_tag, $post_type, $rest_namespace, $rest_route, $fields, $style_template, $extra_classes, $samp_text);
    }
}
