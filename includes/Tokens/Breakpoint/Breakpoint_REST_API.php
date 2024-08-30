<?php
namespace RRZE\Designsystem\Tokens\Breakpoint;
defined('ABSPATH') || exit;

use RRZE\Designsystem\Tokens\Base\Base_REST_API;

class Breakpoint_REST_API extends Base_REST_API
{
    public function __construct()
    {
        parent::__construct('breakpoint', 'breakpoint/v1', 'data');
    }

    protected function get_taxonomy()
    {
        return 'breakpoint_category';
    }
}