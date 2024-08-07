<?php

class CodeStatusBlock {
    public function __construct() {
        add_action('init', array($this, 'register_block'));
    }

    public function register_block() {
        wp_register_script(
            'rrze-designsystem-codestatus-editor-script',
            RRZE_DESIGNSYSTEM_PLUGIN_URL . 'assets/js/codestatus.js',
            array('wp-blocks', 'wp-element', 'wp-editor'),
            filemtime(RRZE_DESIGNSYSTEM_PLUGIN_DIR . 'assets/js/codestatus.js')
        );

        wp_register_style(
            'rrze-designsystem-codestatus-styles',
            RRZE_DESIGNSYSTEM_PLUGIN_URL . 'assets/css/codestatus.css',
            array(),
            filemtime(RRZE_DESIGNSYSTEM_PLUGIN_DIR . 'assets/css/codestatus.css')
        );

        register_block_type('rrze-designsystem/codestatus', array(
            'editor_script' => 'rrze-designsystem-codestatus-editor-script',
            'style' => 'rrze-designsystem-codestatus-styles',
            'render_callback' => array($this, 'render_block')
        ));
    }

    public function render_block($attributes, $content) {
        return '<div class="rrze-designsystem-codestatus">' . $content . '</div>';
    }
}

new CodeStatusBlock();
