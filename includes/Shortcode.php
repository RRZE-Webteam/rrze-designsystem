<?php

namespace RRZE\Designsystem;

if (!defined('ABSPATH')) {
    exit; // Verhindere direkten Aufruf.
}

class Shortcode
{
    public function __construct()
    {
        add_shortcode('rrze-designsystem-token', [$this, 'render_token_shortcode']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
    }

    public function enqueue_scripts()
    {
        wp_enqueue_script(
            'rrze-designsystem-frontend',
            plugin_dir_url(__FILE__) . '../assets/js/frontend.js',
            ['jquery'],
            null,
            true
        );
    }
    public function render_token_shortcode($atts)
    {
        $atts = shortcode_atts(['name' => ''], $atts, 'rrze-designsystem-token');

        if (empty($atts['name'])) {
            return '<p>' . __('Token name is required.', 'rrze-designsystem') . '</p>';
        }

        $token_query = new \WP_Query([
            'post_type' => 'token',
            'meta_key' => '_token_name',
            'meta_value' => $atts['name'],
            'posts_per_page' => 1
        ]);

        if (!$token_query->have_posts()) {
            return '<p>' . __('Token not found.', 'rrze-designsystem') . '</p>';
        }

        $output = '<table class="rrze-designsystem-token-table">';
        $output .= '<thead><tr>';
        $output .= '<th>' . __('Example Image', 'rrze-designsystem') . '</th>';
        $output .= '<th>' . __('Token Name', 'rrze-designsystem') . '</th>';
        $output .= '<th>' . __('Value', 'rrze-designsystem') . '</th>';
        $output .= '<th>' . __('Usecase', 'rrze-designsystem') . '</th>';
        $output .= '<th></th>'; // Spalte für Kopieren, ohne Überschrift
        $output .= '</tr></thead><tbody>';

        while ($token_query->have_posts()) {
            $token_query->the_post();
            $token_image = get_post_meta(get_the_ID(), '_token_image', true);
            $token_name = get_post_meta(get_the_ID(), '_token_name', true);
            $token_value = get_post_meta(get_the_ID(), '_token_value', true);
            $token_usecase = get_post_meta(get_the_ID(), '_token_usecase', true);

            $output .= '<tr>';
            $output .= '<td>' . wp_get_attachment_image($token_image, 'thumbnail') . '</td>';
            $output .= '<td>' . esc_html($token_name) . '</td>';
            $output .= '<td>' . esc_html($token_value) . '</td>';
            $output .= '<td>' . esc_html($token_usecase) . '</td>';
            $output .= '<td><button class="copy-token" data-token="var(' . esc_js($token_name) . ', ' . esc_js($token_value) . ')">📋</button></td>';
            $output .= '</tr>';
        }

        $output .= '</tbody></table>';

        wp_reset_postdata();

        return $output;
    }
}

new Shortcode();
