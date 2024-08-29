<?php

/*
Plugin Name:     rrze-designsystem
Plugin URI:      https://github.com/RRZE-Webteam/rrze-designsystem
Description:     Plugin Description
Version:         1.0.0
Author:          RRZE Webteam
Author URI:      https://blogs.fau.de/webworking/
License:         GNU General Public License v3
License URI:     http://www.gnu.org/licenses/gpl-3.0.html
Domain Path:     /languages
Text Domain:     rrze-designsystem
*/

namespace RRZE\Designsystem;

defined('ABSPATH') || exit('No direct script access allowed');


require_once __DIR__ . '/vendor/autoload.php';
// Define plugin version requirements.
const RRZE_PHP_VERSION = '8.0';
const RRZE_WP_VERSION = '6.0';
const DESIGNSYSTEM_VERSION = '1.0.0';
define('COLORSYSTEM_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('COLORSYSTEM_PLUGIN_URL', plugin_dir_url(__FILE__));

// Register activation and deactivation hooks.
register_activation_hook(__FILE__, __NAMESPACE__ . '\activation');

add_action('plugins_loaded', __NAMESPACE__ . '\loaded');

/**
 * Loads the plugin text domain for translation.
 * @return void
 */
function loadTextdomain()
{
    load_plugin_textdomain('rrze-designsystem', false, sprintf('%s/languages/', dirname(plugin_basename(__FILE__))));
}

/**
 * Checks system requirements like PHP and WordPress version.
 * 
 * @return string Error message if requirements are not met.
 */
function systemRequirements()
{
    $error = '';

    if (version_compare(PHP_VERSION, RRZE_PHP_VERSION, '<')) {
        $error = sprintf(__('The server is running PHP version %1$s. The Plugin requires at least PHP version %2$s.', 'rrze-designsystem'), PHP_VERSION, RRZE_PHP_VERSION);
    } elseif (version_compare($GLOBALS['wp_version'], RRZE_WP_VERSION, '<')) {
        $error = sprintf(__('The server is running WordPress version %1$s. The Plugin requires at least WordPress version %2$s.', 'rrze-designsystem'), $GLOBALS['wp_version'], RRZE_WP_VERSION);
    }

    return $error;
}

/**
 * Plugin activation callback
 */
function activation()
{
    loadTextdomain();

    if ($error = systemRequirements()) {
        deactivate_plugins(plugin_basename(__FILE__), false, true);
        wp_die($error);
    }
}

/**
 * Plugin loaded actions including system requirement checks and initialization.
 * @return void
 */
function loaded()
{
    loadTextdomain();

    if ($error = systemRequirements()) {
        if (!function_exists('get_plugin_data')) {
            require_once(ABSPATH . 'wp-admin/includes/plugin.php');
        }
        $plugin_data = get_plugin_data(__FILE__);
        $plugin_name = $plugin_data['Name'];
        $tag = is_network_admin() ? 'network_admin_notices' : 'admin_notices';
        add_action($tag, function () use ($plugin_name, $error) {
            printf('<div class="notice notice-error"><p>%1$s: %2$s</p></div>', esc_html($plugin_name), esc_html($error));
        });
    } else {
        // Manually include CMB2 bootstrap file if it's not automatically loaded
        if (!class_exists('CMB2')) {
            require_once __DIR__ . '/vendor/cmb2/cmb2/init.php';
        }

        new Main(__FILE__);

        add_filter('template_include', function ($template) {
            if (is_singular('elements')) {
                $plugin_template = plugin_dir_path(__FILE__) . 'templates/single-elements.php';
    
                if (file_exists($plugin_template)) {
                    return $plugin_template;
                }
            }
            return $template;
        });
        
    }
}
