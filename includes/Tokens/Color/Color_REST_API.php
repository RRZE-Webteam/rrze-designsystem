<?php
namespace RRZE\Designsystem\Tokens\Color;
defined('ABSPATH') || exit;

use RRZE\Designsystem\Tokens\Base\Base_REST_API;

class Color_REST_API extends Base_REST_API
{
    public function __construct()
    {
        parent::__construct('color', 'color/v1', 'data');
    }

    protected function get_taxonomy()
    {
        return 'color_category';
    }
}