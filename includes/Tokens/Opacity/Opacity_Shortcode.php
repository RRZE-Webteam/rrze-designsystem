<?php

namespace RRZE\Designsystem\Tokens\Opacity;
defined('ABSPATH') || exit;

use RRZE\Designsystem\Tokens\Base\Base_Shortcode;

class Opacity_Shortcode extends Base_Shortcode
{
    public function __construct()
    {
        $shortcode_tag = 'opacity_table'; // The shortcode tag [opacity_table]
        $post_type = 'opacity';
        $rest_namespace = 'opacity/v1';
        $rest_route = 'data';
        $fields = [
            ['name' => 'token_name', 'label' => 'Token name'],
            ['name' => 'value', 'label' => 'Value'],
            ['name' => 'use_case', 'label' => 'Use case'],
        ];
        $style_template = 'samp.{SELECTOR} { opacity: var({TOKEN_NAME}, {VALUE}); }';
        $extra_classes = ['rrze-designsystem-opacitys'];
        $samp_text = '';
        parent::__construct($shortcode_tag, $post_type, $rest_namespace, $rest_route, $fields, $style_template, $extra_classes, $samp_text);
    }
}
