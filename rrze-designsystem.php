<?php
/**
 * Plugin Name: RRZE Designsystem
 * Description: A plugin to add design system components like Accordion and Alert using Gutenberg blocks and patterns.
 * Version: 0.1.4
 * Author: Your Name
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class RRZEDesignSystem {

    public function __construct() {
        $this->define_constants();
        $this->includes();
        $this->init_hooks();
    }

    private function define_constants() {
        define( 'RRZE_DESIGNSYSTEM_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
        define( 'RRZE_DESIGNSYSTEM_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
    }

    private function includes() {
        require_once RRZE_DESIGNSYSTEM_PLUGIN_DIR . 'includes/CPT.php';
        require_once RRZE_DESIGNSYSTEM_PLUGIN_DIR . 'includes/Shortcode.php';
        require_once RRZE_DESIGNSYSTEM_PLUGIN_DIR . 'includes/class-accordion-block.php';
        require_once RRZE_DESIGNSYSTEM_PLUGIN_DIR . 'includes/class-alert-block.php';
        require_once RRZE_DESIGNSYSTEM_PLUGIN_DIR . 'includes/class-breakpoint-block.php';
        require_once RRZE_DESIGNSYSTEM_PLUGIN_DIR . 'includes/class-codestatus-block.php';
        require_once RRZE_DESIGNSYSTEM_PLUGIN_DIR . 'includes/class-form-block.php';
        require_once RRZE_DESIGNSYSTEM_PLUGIN_DIR . 'includes/class-typography-block.php';
        require_once RRZE_DESIGNSYSTEM_PLUGIN_DIR . 'includes/class-block-loader.php';
    }

    private function init_hooks() {
        add_action( 'init', array( $this, 'register_blocks' ) );
        add_action( 'init', array( $this, 'register_patterns' ) );
        add_action( 'init', array( $this, 'register_pattern_categories' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_console_script' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_console_script' ) );
    }

    public function register_blocks() {
        BlockLoader::register_blocks();
    }

    public function register_patterns() {
        require_once RRZE_DESIGNSYSTEM_PLUGIN_DIR . 'patterns/accordion-pattern.php';
        require_once RRZE_DESIGNSYSTEM_PLUGIN_DIR . 'patterns/alert-pattern.php';
        require_once RRZE_DESIGNSYSTEM_PLUGIN_DIR . 'patterns/breakpoint-pattern.php';
        require_once RRZE_DESIGNSYSTEM_PLUGIN_DIR . 'patterns/codestatus-pattern.php';
        require_once RRZE_DESIGNSYSTEM_PLUGIN_DIR . 'patterns/form-pattern.php';
        require_once RRZE_DESIGNSYSTEM_PLUGIN_DIR . 'patterns/typography-pattern.php';
    }

    public function register_pattern_categories() {
        if ( function_exists( 'register_block_pattern_category' ) ) {
            register_block_pattern_category(
                'rrze-designsystem',
                array( 'label' => __( 'RRZE Designsystem', 'rrze-designsystem' ) )
            );
        }
    }

    public function enqueue_console_script() {
        ?>
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                <?php if ( is_block_registered( 'rrze-designsystem/accordion' ) ) : ?>
                    console.log('Der Block "rrze-designsystem/accordion" ist registriert.');
                <?php else : ?>
                    console.log('Der Block "rrze-designsystem/accordion" ist nicht registriert.');
                <?php endif; ?>
                
                <?php if ( is_block_registered( 'rrze-designsystem/alert' ) ) : ?>
                    console.log('Der Block "rrze-designsystem/alert" ist registriert.');
                <?php else : ?>
                    console.log('Der Block "rrze-designsystem/alert" ist nicht registriert.');
                <?php endif; ?>
            });
        </script>
        <?php
    }
}

new RRZEDesignSystem();

function is_block_registered( $block_name ) {
    if ( ! function_exists( 'register_block_type' ) ) {
        return false;
    }

    $registry = WP_Block_Type_Registry::get_instance();
    return $registry->is_registered( $block_name );
}
