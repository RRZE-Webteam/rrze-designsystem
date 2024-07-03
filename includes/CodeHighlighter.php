<?php

namespace RRZE\Designsystem;

defined('ABSPATH') || exit;

class CodeHighlighter
{

    public function __construct()
    {
        add_action('init', [$this, 'code_highlighter_init']);
        add_action('wp_enqueue_scripts', 'code_highlighter_frontend_assets');

    }

    public function code_highlighter_init()
    {
        $dir = dirname(__FILE__);

        $block_json = file_get_contents($dir . '/src/block.json');
        $block = json_decode($block_json, true);

        wp_register_script(
            'code-highlighter-block',
            plugins_url('build/index.js', __FILE__),
            array('wp-blocks', 'wp-element', 'wp-editor'),
            filemtime(plugin_dir_path(__FILE__) . 'build/index.js')
        );

        wp_register_style(
            'highlightjs-style',
            plugins_url('build/style-index.css', __FILE__),
            array(),
            filemtime(plugin_dir_path(__FILE__) . 'build/style-index.css')
        );

        register_block_type($block['name'], array(
            'editor_script' => 'code-highlighter-block',
            'script' => 'highlightjs-style',
        ));
    }

    function code_highlighter_frontend_assets()
    {
        wp_enqueue_script(
            'highlightjs-init',
            plugins_url('build/frontend.js', __FILE__),
            array(),
            filemtime(plugin_dir_path(__FILE__) . 'build/frontend.js'),
            true
        );
    }

}
