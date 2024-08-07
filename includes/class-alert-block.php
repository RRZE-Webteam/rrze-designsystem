<?php

class AlertBlock {

    public function __construct() {
        add_action( 'init', array( $this, 'register_block' ) );
    }

    public function register_block() {
        wp_register_script(
            'rrze-designsystem-alert-editor-script',
            RRZE_DESIGNSYSTEM_PLUGIN_URL . 'assets/js/alert.js',
            array( 'wp-blocks', 'wp-element', 'wp-editor' ),
            filemtime( RRZE_DESIGNSYSTEM_PLUGIN_DIR . 'assets/js/alert.js' )
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

        register_block_type( 'rrze-designsystem/alert', array(
            'editor_script' => 'rrze-designsystem-alert-editor-script',
            'editor_style'  => 'rrze-designsystem-editor-styles',
            'style'         => 'rrze-designsystem-frontend-styles',
        ) );
    }
}

new AlertBlock();
