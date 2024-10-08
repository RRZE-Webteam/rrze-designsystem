<?php

namespace RRZE\Designsystem;

defined('ABSPATH') || exit;
use const RRZE\Designsystem\DESIGNSYSTEM_VERSION;

// CPT Design Token Namespaces

use RRZE\Designsystem\Elements\Elements_CPT;
use RRZE\Designsystem\Tokens\Opacity\Opacity_CPT;
use RRZE\Designsystem\Tokens\BoxShadow\BoxShadow_CPT;
use RRZE\Designsystem\Tokens\Border\Border_CPT;
use RRZE\Designsystem\Tokens\Color\Color_CPT;
use RRZE\Designsystem\Tokens\Font\Font_CPT;
use RRZE\Designsystem\Tokens\Icon\Icon_CPT;
use RRZE\Designsystem\Tokens\Length\Length_CPT;
use RRZE\Designsystem\Tokens\Space\Space_CPT;
use RRZE\Designsystem\Tokens\MediaQuery\MediaQuery_CPT;
use RRZE\Designsystem\Tokens\Breakpoint\Breakpoint_CPT;

// REST API Design Token Namespaces
use RRZE\Designsystem\Tokens\BoxShadow\BoxShadow_REST_API;
use RRZE\Designsystem\Tokens\Opacity\Opacity_REST_API;
use RRZE\Designsystem\Tokens\Border\Border_REST_API;
use RRZE\Designsystem\Tokens\Breakpoint\Breakpoint_REST_API;
use RRZE\Designsystem\Tokens\Color\Color_REST_API;
use RRZE\Designsystem\Tokens\Font\Font_REST_API;
use RRZE\Designsystem\Tokens\Icon\Icon_REST_API;
use RRZE\Designsystem\Tokens\Length\Length_REST_API;
use RRZE\Designsystem\Tokens\MediaQuery\MediaQuery_REST_API;
use RRZE\Designsystem\Tokens\Space\Space_REST_API;

/**
 * The Brain of the Plugin – Main Class
 */
class Main
{
    protected $pluginFile;

    public function __construct($pluginFile)
    {
        $this->pluginFile = $pluginFile;
        $this->init_hooks();
        $this->registerMenuPages();
        add_action('wp_enqueue_scripts', [$this, 'registerScripts']);

        new Blocks();
        add_action('init', [$this, 'register_rrze_shortcodes']);
        add_action('wp_enqueue_scripts', [$this, 'embedFrontendStyles']);
    }

    /**
     * This method is used to register scripts and styles for the frontend.
     * The Block.json is used to enqueue the set scripts and styles if a block is in use.
     * @return void
     */
    public function registerScripts()
    {
        // USE THE SECTION FOR EMBEDDING FRONTEND SCRIPTS
        // Example Embed:
        wp_register_script(
            'rrze-copy-to-clipboard',
            plugins_url('assets/js/copy.js', plugin_basename($this->pluginFile)),
            [],
            DESIGNSYSTEM_VERSION
        );
    }

    public function embedFrontendStyles()
    {
        wp_register_style(
            'rrze-designsystem-styles',
            plugins_url('assets/css/styles.css', plugin_basename($this->pluginFile)),
            [],
            DESIGNSYSTEM_VERSION
        );

        wp_enqueue_style('rrze-designsystem-styles');
    }

    public function registerMenuPages()
    {
        add_action('admin_menu', function() {
            add_menu_page(
                __( 'Design Tokens', 'textdomain' ),  // Page title
                __( 'Design Tokens', 'textdomain' ),  // Menu title
                'manage_options',                     // Capability
                'design-tokens',                      // Menu slug
                '',                                   // Function to output content, can be empty
                'dashicons-admin-generic',            // Icon URL or dashicon class
                5                                     // Position in the menu
            );
        });
    }

    public function register_rrze_shortcodes()
    {
        new \RRZE\Designsystem\Tokens\Color\Color_Shortcode();
        new \RRZE\Designsystem\Tokens\Font\Font_Shortcode();
        new \RRZE\Designsystem\Tokens\Space\Space_Shortcode();
        new \RRZE\Designsystem\Tokens\BoxShadow\BoxShadow_Shortcode();
        new \RRZE\Designsystem\Tokens\Opacity\Opacity_Shortcode();
        new \RRZE\Designsystem\Tokens\Length\Length_Shortcode();
        new \RRZE\Designsystem\Tokens\Breakpoint\Breakpoint_Shortcode();
        new \RRZE\Designsystem\Tokens\MediaQuery\MediaQuery_Shortcode();
        new \RRZE\Designsystem\Tokens\Border\Border_Shortcode();
        new \RRZE\Designsystem\Tokens\Icon\Icon_Shortcode();
        new \RRZE\Designsystem\Elements\Elements_Shortcode();
    }

    private function init_hooks()
    {
        new Elements_CPT();
        new Opacity_CPT();
        new Opacity_REST_API();
        new BoxShadow_CPT();
        new BoxShadow_REST_API();
        new Border_CPT();
        new Border_REST_API();
        new Length_CPT();
        new Length_REST_API();
        new Space_CPT();
        new Space_REST_API();
        new MediaQuery_CPT();
        new MediaQuery_REST_API();
        new Font_CPT();
        new Font_REST_API();
        new Breakpoint_CPT();
        new Breakpoint_REST_API();
        new Color_CPT();
        new Color_REST_API();
        new Icon_CPT();
        new Icon_REST_API();
    }
}
