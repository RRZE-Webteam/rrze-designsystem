<?php

class AccordionBlock {

    public function __construct() {
        add_action( 'init', array( $this, 'register_block' ) );
    }

    public function register_block() {
        wp_register_script(
            'rrze-designsystem-accordion-editor-script',
            RRZE_DESIGNSYSTEM_PLUGIN_URL . 'assets/js/accordion.js',
            array( 'wp-blocks', 'wp-element', 'wp-editor' ),
            filemtime( RRZE_DESIGNSYSTEM_PLUGIN_DIR . 'assets/js/accordion.js' )
        );

        wp_register_style(
            'rrze-designsystem-editor-styles',
            RRZE_DESIGNSYSTEM_PLUGIN_URL . 'assets/css/styles.css',
            array(),
            filemtime( RRZE_DESIGNSYSTEM_PLUGIN_DIR . 'assets/css/styles.css' )
        );

        wp_register_style(
            'rrze-designsystem-frontend-styles',
            RRZE_DESIGNSYSTEM_PLUGIN_URL . 'assets/css/styles.css',
            array(),
            filemtime( RRZE_DESIGNSYSTEM_PLUGIN_DIR . 'assets/css/styles.css' )
        );

        register_block_type( 'rrze-designsystem/accordion', array(
            'editor_script' => 'rrze-designsystem-accordion-editor-script',
            'editor_style'  => 'rrze-designsystem-editor-styles',
            'style'         => 'rrze-designsystem-frontend-styles',
        ) );
    }
}

new AccordionBlock();
