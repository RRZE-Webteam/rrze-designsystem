<?php

namespace RRZE\Designsystem\Tokens\MediaQuery;
defined('ABSPATH') || exit;

use RRZE\Designsystem\Tokens\Base\Base_Shortcode;

class MediaQuery_Shortcode extends Base_Shortcode
{
    public function __construct()
    {
        $shortcode_tag = 'mediaquery_table'; // The shortcode tag [mediaquery_table]
        $post_type = 'mediaquery';
        $rest_namespace = 'mediaquery/v1';
        $rest_route = 'data';
        $fields = [
            ['name' => 'token_name', 'label' => 'Token name'],
            ['name' => 'value', 'label' => 'Value'],
            ['name' => 'use_case', 'label' => 'Use case'],
        ];
        $style_template = '';
        $extra_classes = ['rrze-designsystem-mediaquerys'];
        $samp_text = '';
        parent::__construct($shortcode_tag, $post_type, $rest_namespace, $rest_route, $fields, $style_template, $extra_classes, $samp_text);
    }
}
