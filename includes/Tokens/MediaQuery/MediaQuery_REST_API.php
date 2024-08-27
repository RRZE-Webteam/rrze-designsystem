<?php
namespace RRZE\Designsystem\Tokens\MediaQuery;
defined('ABSPATH') || exit;

use RRZE\Designsystem\Tokens\Base\Base_REST_API;

class MediaQuery_REST_API extends Base_REST_API
{
    public function __construct()
    {
        parent::__construct('mediaquery', 'mediaquery/v1', 'data');
    }

    protected function get_taxonomy()
    {
        return 'mediaquery_category';
    }
}