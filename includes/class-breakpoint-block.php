<?php

class BreakpointBlock {
    public function __construct() {
        add_action('init', array($this, 'register_block'));
    }

    public function register_block() {
        wp_register_script(
            'rrze-designsystem-breakpoint-editor-script',
            RRZE_DESIGNSYSTEM_PLUGIN_URL . 'assets/js/breakpoint.js',
            array('wp-blocks', 'wp-element', 'wp-editor'),
            filemtime(RRZE_DESIGNSYSTEM_PLUGIN_DIR . 'assets/js/breakpoint.js')
        );

        wp_register_style(
            'rrze-designsystem-breakpoint-styles',
            RRZE_DESIGNSYSTEM_PLUGIN_URL . 'assets/css/breakpoint.css',
            array(),
            filemtime(RRZE_DESIGNSYSTEM_PLUGIN_DIR . 'assets/css/breakpoint.css')
        );

        register_block_type('rrze-designsystem/breakpoint', array(
            'editor_script' => 'rrze-designsystem-breakpoint-editor-script',
            'style' => 'rrze-designsystem-breakpoint-styles',
            'render_callback' => array($this, 'render_block')
        ));
    }

    public function render_block($attributes, $content) {
        return '<div class="rrze-designsystem-breakpoint">' . $content . '</div>';
    }
}

// new BreakpointBlock();
