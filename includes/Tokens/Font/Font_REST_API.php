<?php
namespace RRZE\Designsystem\Tokens\Font;
defined('ABSPATH') || exit;

use RRZE\Designsystem\Tokens\Base\Base_REST_API;

class Font_REST_API extends Base_REST_API
{
    public function __construct()
    {
        parent::__construct('font', 'font/v1', 'data');
    }

    protected function get_taxonomy()
    {
        return 'font_category';
    }
}