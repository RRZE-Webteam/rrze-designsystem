<?php

namespace RRZE\Designsystem\Tokens\Breakpoint;
defined('ABSPATH') || exit;

use RRZE\Designsystem\Tokens\Base\Base_Shortcode;

class Breakpoint_Shortcode extends Base_Shortcode
{
    public function __construct()
    {
        $shortcode_tag = 'breakpoint_table'; // The shortcode tag [breakpoint_table]
        $post_type = 'breakpoint';
        $rest_namespace = 'breakpoint/v1';
        $rest_route = 'data';
        $fields = [
            ['name' => 'token_name', 'label' => 'Token name'],
            ['name' => 'value', 'label' => 'Value'],
            ['name' => 'use_case', 'label' => 'Use case'],
        ];
        $style_template = '';
        $extra_classes = ['rrze-designsystem-breakpoints'];
        $samp_text = '';
        parent::__construct($shortcode_tag, $post_type, $rest_namespace, $rest_route, $fields, $style_template, $extra_classes, $samp_text);
    }
}
