<?php

class FormBlock {
    public function __construct() {
        add_action('init', array($this, 'register_block'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
    }

    public function register_block() {
        wp_register_script(
            'rrze-designsystem-form-editor-script',
            RRZE_DESIGNSYSTEM_PLUGIN_DIR . 'assets/js/form.js',
            array('wp-blocks', 'wp-element', 'wp-editor'),
            filemtime(RRZE_DESIGNSYSTEM_PLUGIN_DIR . 'assets/js/form.js')
        );

        wp_register_style(
            'rrze-designsystem-form-styles',
            RRZE_DESIGNSYSTEM_PLUGIN_URL . 'assets/css/form.css',
            array(),
            filemtime(RRZE_DESIGNSYSTEM_PLUGIN_DIR . 'assets/css/form.css')
        );

        register_block_type('rrze-designsystem/form', array(
            'editor_script' => 'rrze-designsystem-form-editor-script',
            'style' => 'rrze-designsystem-form-styles',
            'render_callback' => array($this, 'render_block')
        ));
    }

    public function enqueue_scripts() {
        wp_enqueue_script('rrze-designsystem-form-editor-script');
        wp_enqueue_style('rrze-designsystem-form-styles');
    }

    public function render_block($attributes, $content) {
        return '<form class="rrze-designsystem-form">' . $content . '</form>';
    }
}

new FormBlock();
