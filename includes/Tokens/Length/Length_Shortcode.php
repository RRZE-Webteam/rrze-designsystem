<?php

namespace RRZE\Designsystem\Tokens\Length;
defined('ABSPATH') || exit;

use RRZE\Designsystem\Tokens\Base\Base_Shortcode;

class Length_Shortcode extends Base_Shortcode
{
    public function __construct()
    {
        $shortcode_tag = 'length_table'; // The shortcode tag [length_table]
        $post_type = 'length';
        $rest_namespace = 'length/v1';
        $rest_route = 'data';
        $fields = [
            ['name' => 'token_name', 'label' => 'Token name'],
            ['name' => 'value', 'label' => 'Value'],
            ['name' => 'use_case', 'label' => 'Use case'],
        ];
        $style_template = 'samp.{SELECTOR} { width: var({TOKEN_NAME}, {VALUE}); }';
        $extra_classes = ['rrze-designsystem-lengths'];
        $samp_text = '';
        parent::__construct($shortcode_tag, $post_type, $rest_namespace, $rest_route, $fields, $style_template, $extra_classes, $samp_text);
    }
}
