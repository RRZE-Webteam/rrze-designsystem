<?php

namespace RRZE\Designsystem\Tokens\Base;

defined('ABSPATH') || exit;

class CPT_Table_Generator
{
    protected $post_type;
    protected $rest_namespace;
    protected $rest_route;
    protected $fields;
    protected $extra_classes;
    protected $samp_text;
    protected $categories = [];

    public function __construct($post_type, $rest_namespace, $rest_route, $fields, $extra_classes = [], $samp_text = '')
    {
        $this->post_type = $post_type;
        $this->rest_namespace = $rest_namespace;
        $this->rest_route = $rest_route;
        $this->fields = $fields;
        $this->extra_classes = is_array($extra_classes) ? $extra_classes : [];
        $this->samp_text = is_string($samp_text) ? $samp_text : '';
    }

    /**
     * Setter for categories passed to the table generator.
     *
     * @param [type] $categories
     * @return void
     */
    public function set_categories($categories)
    {
        $this->categories = $categories;
    }

    /**
     * Generate the complete table HTML.
     *
     * @return string The complete table HTML.
     */
    public function generate_table()
    {
        $data = $this->fetch_data();
        if (empty($data)) {
            return '<p>No data found.</p>';
        }

        wp_enqueue_script('rrze-copy-to-clipboard');
        $extra_classes = !empty($this->extra_classes) ? ' ' . implode(' ', $this->extra_classes) : '';

        $table = '<table class="rrze-designsystem' . esc_attr($extra_classes) . '">';
        $table .= $this->generate_table_head();
        $table .= $this->generate_table_body($data);
        $table .= '</table>';

        return $table;
    }
    /**
     * Generate the table head.
     *
     * @return string The table head HTML.
     */
    protected function generate_table_head()
    {
        $head = '<thead><tr>';
        $head .= '<th scope="col" data-label="Example"><abbr title="Example">Ex.</abbr></th>';
        foreach ($this->fields as $field) {
            $label = $field['label'];
            $abbr = $field['abbr'] ?? $label;
            $head .= "<th scope='col' data-label='{$label}'><abbr title='{$label}'>{$abbr}</abbr></th>";
        }
        $head .= '<th scope="col" data-label="Copy"></th>';
        $head .= '</tr></thead>';
        return $head;
    }

    /**
     * Generate the table body.
     *
     * @param array $data The data to populate the table with.
     * @return string The table body HTML.
     */
    protected function generate_table_body($data, $extra_classes = [])
    {
        $body = '<tbody>';
        foreach ($data as $item) {
            $token_class = 'token-' . strtolower($item['token_name']);
            $additional_classes = isset($extra_classes[$item['token_name']]) ? $extra_classes[$item['token_name']] : '';
            $body .= '<tr id="rh-' . esc_attr($item['token_name']) . '" class="light color" style="--samp-color: ' . esc_attr($item['value']) . ';">';
            $body .= "<td class='example'><samp class='{$token_class} {$additional_classes}'>" . esc_html($this->samp_text) . "</samp></td>";

            foreach ($this->fields as $field) {
                $field_name = $field['name'];
                $value = isset($item[$field_name]) ? esc_html($item[$field_name]) : '';
                $body .= "<td data-label='{$field['label']}'><code>{$value}</code></td>";
            }
            $body .= $this->generate_copy_buttons($item);
            $body .= '</tr>';
        }
        $body .= '</tbody>';
        return $body;
    }

    // TODO: Add a method to make copy available
    /**
     * Generate copy buttons for each row.
     *
     * @param array $item The data item for the current row.
     * @return string The HTML for the copy buttons.
     */
    protected function generate_copy_buttons($item)
    {
        $token_name = esc_attr($item['token_name']);
        $value = esc_attr($item['value']);
        $copy_var = "var({$token_name}, {$value})";
        $copy_url = esc_url("https://www.wordpress.rrze.fau.de/tokens/{$this->post_type}/#{$token_name}");
    
        $copy_buttons = '<td data-label="Copy"><div class="copy-container">';
        $copy_buttons .= "<rrze-copy-button data-copy='{$copy_var}' data-tooltip='Copy'>";
        $copy_buttons .= "
            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512'><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d='M208 0L332.1 0c12.7 0 24.9 5.1 33.9 14.1l67.9 67.9c9 9 14.1 21.2 14.1 33.9L448 336c0 26.5-21.5 48-48 48l-192 0c-26.5 0-48-21.5-48-48l0-288c0-26.5 21.5-48 48-48zM48 128l80 0 0 64-64 0 0 256 192 0 0-32 64 0 0 48c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 176c0-26.5 21.5-48 48-48z'/></svg></rrze-copy-button>";
        $copy_buttons .= '</div></td>';
        return $copy_buttons;
    }

    /**
     * Generate the dynamic styles and inject them into the <head> section.
     *
     * @param array $data The data to generate styles from.
     */
    public function generate_dynamic_styles($data, $style_template)
    {
        // Example style template
        // $style_template = 'samp.{SELECTOR} { background-color: var({TOKEN_NAME}, {VALUE}); }';
        $styles = '<style>';

        foreach ($data as $item) {
            $selector = 'token-' . strtolower($item['token_name']);
            $styles .= str_replace(
                ['{SELECTOR}', '{TOKEN_NAME}', '{VALUE}'],
                [$selector, $item['token_name'], $item['value']],
                $style_template
            );
        }

        $styles .= '</style>';
        return $styles;
    }

    /**
     * Fetch data from the REST API.
     *
     * @return array The fetched data.
     */
    public function fetch_data()
    {
        // Prepare query args
        $query_args = [
            'post_type' => $this->post_type,
            'posts_per_page' => -1,
            'post_status' => 'publish',
        ];

        if (!empty($this->categories)) {
            $query_args['tax_query'] = [
                [
                    'taxonomy' => $this->post_type . '_category',
                    'field'    => 'slug',
                    'terms'    => $this->categories,
                ]
            ];
        }

        // Fetch posts using WP_Query
        $query = new \WP_Query($query_args);
        $results = [];

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();

                $results[] = [
                    'id'         => get_the_ID(),
                    'title'      => get_the_title(),
                    'token_name' => get_post_meta(get_the_ID(), $this->post_type . '_token_name', true),
                    'value'      => get_post_meta(get_the_ID(), $this->post_type . '_value', true),
                    'use_case'   => get_post_meta(get_the_ID(), $this->post_type . '_use_case', true),
                ];
            }
            wp_reset_postdata();
        }

        return $results;
    }
}
