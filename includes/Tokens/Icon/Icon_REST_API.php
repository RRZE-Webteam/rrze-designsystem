<?php
namespace RRZE\Designsystem\Tokens\Icon;
defined('ABSPATH') || exit;

use RRZE\Designsystem\Tokens\Base\Base_REST_API;

class Icon_REST_API extends Base_REST_API
{
    public function __construct()
    {
        parent::__construct('icon', 'icon/v1', 'data');
    }

    protected function get_taxonomy()
    {
        return 'icon_category';
    }
}