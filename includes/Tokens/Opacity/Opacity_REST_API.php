<?php
namespace RRZE\Designsystem\Tokens\Opacity;
defined('ABSPATH') || exit;

use RRZE\Designsystem\Tokens\Base\Base_REST_API;

class Opacity_REST_API extends Base_REST_API
{
    public function __construct()
    {
        parent::__construct('opacity', 'opacity/v1', 'data');
    }

    protected function get_taxonomy()
    {
        return 'opacity_category';
    }
}