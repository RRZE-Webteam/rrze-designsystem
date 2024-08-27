<?php
namespace RRZE\Designsystem\Tokens\Length;
defined('ABSPATH') || exit;

use RRZE\Designsystem\Tokens\Base\Base_REST_API;

class Length_REST_API extends Base_REST_API
{
    public function __construct()
    {
        parent::__construct('length', 'length/v1', 'data');
    }

    protected function get_taxonomy()
    {
        return 'length_category';
    }
}