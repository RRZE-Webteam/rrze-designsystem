<?php
namespace RRZE\Designsystem\Tokens\Border;
defined('ABSPATH') || exit;

use RRZE\Designsystem\Tokens\Base\Base_REST_API;

class Border_REST_API extends Base_REST_API
{
    public function __construct()
    {
        parent::__construct('border', 'border/v1', 'data');
    }

    protected function get_taxonomy()
    {
        return 'border_category';
    }
}