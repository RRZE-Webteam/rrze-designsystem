<?php

namespace RRZE\Designsystem\Config;

defined('ABSPATH') || exit;

/**
 * Gibt der Name der Option zurück.
 * @return string [description]
 */
function getOptionName()
{
    return 'rrze-designsystem';
}


/**
 * Gibt die Einstellungen des Menus zurück.
 * @return array [description]
 */
function getMenuSettings()
{
    return [
        'page_title' => __('RRZE Designsystem', 'rrze-designsystem'),
        'menu_title' => __('RRZE Designsystem', 'rrze-designsystem'),
        'capability' => 'manage_options',
        'menu_slug' => 'rrze-designsystem',
        'title' => __('RRZE Designsystem Settings', 'rrze-designsystem'),
    ];
}

/**
 * Gibt die Einstellungen der Inhaltshilfe zurück.
 * @return array [description]
 */
function getHelpTab()
{
    return [
        [
            'id' => 'rrze-designsystem-help',
            'content' => [
                '<p>' . __('Here comes the Context Help content.', 'rrze-designsystem') . '</p>'
            ],
            'title' => __('Overview', 'rrze-designsystem'),
            'sidebar' => sprintf('<p><strong>%1$s:</strong></p><p><a href="https://blogs.fau.de/webworking">RRZE Webworking</a></p><p><a href="https://github.com/RRZE Webteam">%2$s</a></p>', __('For more information', 'rrze-designsystem'), __('RRZE Webteam on Github', 'rrze-designsystem'))
        ]
    ];
}

/**
 * Gibt die Einstellungen der Optionsbereiche zurück.
 * @return array [description]
 */

function getSections()
{
    return [
        [
            'id' => 'designsystemlog',
            'title' => __('Logfile', 'rrze-designsystem')
        ]
    ];
}





