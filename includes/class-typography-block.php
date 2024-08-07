<?php

class TypographyBlock {
    public function __construct() {
        add_action('init', array($this, 'register_block'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
    }

    public function register_block() {
        wp_register_script(
            'rrze-designsystem-typography-editor-script',
            RRZE_DESIGNSYSTEM_PLUGIN_URL . 'assets/js/typography.js',
            array('wp-blocks', 'wp-element', 'wp-editor'),
            filemtime(RRZE_DESIGNSYSTEM_PLUGIN_DIR . 'assets/js/typography.js')
        );

        wp_register_style(
            'rrze-designsystem-typography-styles',
            RRZE_DESIGNSYSTEM_PLUGIN_URL . 'assets/css/typography.css',
            array(),
            filemtime(RRZE_DESIGNSYSTEM_PLUGIN_DIR . 'assets/css/typography.css')
        );

        register_block_type('rrze-designsystem/typography', array(
            'editor_script' => 'rrze-designsystem-typography-editor-script',
            'style' => 'rrze-designsystem-typography-styles',
            'render_callback' => array($this, 'render_block')
        ));
    }

    public function enqueue_scripts() {
        wp_enqueue_script('rrze-designsystem-typography-editor-script');
        wp_enqueue_style('rrze-designsystem-typography-styles');
    }

    public function render_block($attributes, $content) {
        return '<div class="rrze-designsystem-typography">' . $content . '</div>';
    }
}

new TypographyBlock();
