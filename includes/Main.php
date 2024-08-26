<?php
namespace RRZE\Designsystem;

use const rrze\Designsystem\DESIGNSYSTEM_VERSION;

defined('ABSPATH') || exit;

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
        // add_action('wp_enqueue_scripts', [$this, 'enqueueScripts']);

        new Blocks();
        new Colorsystem_REST_API();
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

    private function init_hooks()
    {
        error_log('Initializing hooks...');
    
        // Initialize CPT
        add_action('init', function() {
            error_log('Registering CPT...');
            \RRZE\Designsystem\Colorsystem_CPT::register_cpt();
        });
    
        // Initialize Metaboxes
        add_action('cmb2_admin_init', function() {
            error_log('Registering Metaboxes...');
            \RRZE\Designsystem\Colorsystem_Metabox::register_metaboxes();
        });
    }
}
