<?php

class CodeStatusBlock {
    public function __construct() {
        add_action('init', array($this, 'register_block'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
    }

    public function register_block() {
        wp_register_script(
            'myds-code-status-script',
            MYDS_PLUGIN_URL . 'assets/js/code-status.js',
            array(),
            filemtime(MYDS_PLUGIN_DIR . 'assets/js/code-status.js'),
            true
        );

        wp_register_style(
            'myds-code-status-styles',
            MYDS_PLUGIN_URL . 'assets/css/code-status.css',
            array(),
            filemtime(MYDS_PLUGIN_DIR . 'assets/css/code-status.css')
        );
    }

    public function enqueue_scripts() {
        wp_enqueue_script('myds-code-status-script');
        wp_enqueue_style('myds-code-status-styles');
    }
}

new CodeStatusBlock();
