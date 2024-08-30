<?php
namespace RRZE\Designsystem\Tokens\BoxShadow;
defined('ABSPATH') || exit;

use RRZE\Designsystem\Tokens\Base\Base_REST_API;

class BoxShadow_REST_API extends Base_REST_API
{
    public function __construct()
    {
        parent::__construct('boxshadow', 'boxshadow/v1', 'data');
    }

    protected function get_taxonomy()
    {
        return 'boxshadow_category';
    }
}