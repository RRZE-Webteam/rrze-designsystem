<?php

namespace RRZE\Designsystem\Tokens\Space;
defined('ABSPATH') || exit;

use RRZE\Designsystem\Tokens\Base\Base_Shortcode;

class Space_Shortcode extends Base_Shortcode
{
    public function __construct()
    {
        $shortcode_tag = 'space_table'; // The shortcode tag [space_table]
        $post_type = 'space';
        $rest_namespace = 'space/v1';
        $rest_route = 'data';
        $fields = [
            ['name' => 'token_name', 'label' => 'Token name'],
            ['name' => 'value', 'label' => 'Value'],
            ['name' => 'use_case', 'label' => 'Use case'],
        ];
        $style_template = 'samp.{SELECTOR} { width: var({TOKEN_NAME}, {VALUE}); height: var({TOKEN_NAME}, {VALUE});; }';
        $extra_classes = ['rrze-designsystem-spaces'];
        $samp_text = '';
        parent::__construct($shortcode_tag, $post_type, $rest_namespace, $rest_route, $fields, $style_template, $extra_classes, $samp_text);
    }
}
