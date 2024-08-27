<?php

namespace RRZE\Designsystem;

defined('ABSPATH') || exit;

use const rrze\Designsystem\DESIGNSYSTEM_VERSION;
use RRZE\Designsystem\Tokens\Colorsystem\Colorsystem_REST_API;
use RRZE\Designsystem\Tokens\Typography\Typography_REST_API;

use RRZE\Designsystem\Tokens\Opacity\Opacity_CPT;
use RRZE\Designsystem\Tokens\Opacity\Opacity_REST_API;

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
        // add_action('wp_enqueue_scripts', [$this, 'enqueueScripts']);

        new Blocks();
        new Colorsystem_REST_API();
        new Typography_REST_API();
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
        // wp_register_script(
        //     'rrze-gsap',
        //     plugins_url('assets/js/gsap/gsap.min.js', plugin_basename($this->pluginFile)),
        //     [],
        //     DESIGNSYSTEM_VERSION
        // );
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

    private function init_hooks()
    {
        error_log('Initializing hooks...');

        new Opacity_CPT();
        new Opacity_REST_API();

        // Initialize Color Token
        add_action('init', function () {
            error_log('Registering CPT...');
            \RRZE\Designsystem\Tokens\Colorsystem\Colorsystem_CPT::register_cpt();
        });
        // Initialize Typography Token
        add_action('init', function () {
            error_log('Registering CPT...');
            \RRZE\Designsystem\Tokens\Typography\Typography_CPT::register_cpt();
        });

        // Initialize Metaboxes
        add_action('cmb2_admin_init', function () {
            error_log('Registering Metaboxes...');
            \RRZE\Designsystem\Tokens\Colorsystem\Colorsystem_Metabox::register_metaboxes();
        });
        add_action('cmb2_admin_init', function () {
            error_log('Registering Metaboxes...');
            \RRZE\Designsystem\Tokens\Typography\Typography_Metabox::register_metaboxes();
        });
    }
}
