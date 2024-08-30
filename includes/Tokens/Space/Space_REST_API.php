<?php
namespace RRZE\Designsystem\Tokens\Space;
defined('ABSPATH') || exit;

use RRZE\Designsystem\Tokens\Base\Base_REST_API;

class Space_REST_API extends Base_REST_API
{
    public function __construct()
    {
        parent::__construct('space', 'space/v1', 'data');
    }

    protected function get_taxonomy()
    {
        return 'space_category';
    }
}