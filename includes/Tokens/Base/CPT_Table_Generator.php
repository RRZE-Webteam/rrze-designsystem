<?php

namespace RRZE\Designsystem\Tokens\Base;

defined('ABSPATH') || exit;

class CPT_Table_Generator
{
    protected $post_type;
    protected $rest_namespace;
    protected $rest_route;
    protected $fields;

    public function __construct($post_type, $rest_namespace, $rest_route, $fields)
    {
        $this->post_type = $post_type;
        $this->rest_namespace = $rest_namespace;
        $this->rest_route = $rest_route;
        $this->fields = $fields;
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

        $table = '<table>';
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
        $head .= '<th scope="col" data-label="Example"><abbr title="Example">Ex.</abbr></th>'; // For the example color box
        foreach ($this->fields as $field) {
            $label = $field['label'];
            $abbr = $field['abbr'] ?? $label;
            $head .= "<th scope='col' data-label='{$label}'><abbr title='{$label}'>{$abbr}</abbr></th>";
        }
        $head .= '<th scope="col" data-label="Copy"></th>'; // For the Copy button
        $head .= '</tr></thead>';
        return $head;
    }

    /**
     * Generate the table body.
     *
     * @param array $data The data to populate the table with.
     * @return string The table body HTML.
     */
    protected function generate_table_body($data)
    {
        error_log(print_r($data, true));
        $body = '<tbody>';
        foreach ($data as $item) {
            $body .= '<tr id="rh-' . esc_attr($item['token_name']) . '" class="light color" style="--samp-color: ' . esc_attr($item['value']) . ';">';
            $body .= "<td class='example'><samp style='width: 50px; display:inline-block; height: 50px; background-color: var(--{$item['token_name']}, {$item['value']}); border: 1px solid black;'></samp></td>";

            foreach ($this->fields as $field) {
                $field_name = $field['name'];
                $value = isset($item[$field_name]) ? esc_html($item[$field_name]) : '';
                $body .= "<td data-label='{$field['label']}'><code>{$value}<code></td>";
            }
            $body .= $this->generate_copy_buttons($item);
            $body .= '</tr>';
        }
        $body .= '</tbody>';
        return $body;
    }

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
        $copy_var = "var(--{$token_name}, {$value})";
        $copy_url = esc_url("https://ux.redhat.com/tokens/{$this->post_type}/#{$token_name}");

        $copy_buttons = '<td data-label="Copy"><div>';
        $copy_buttons .= "<uxdot-copy-button copy='{$copy_var}'></uxdot-copy-button>";
        $copy_buttons .= "<uxdot-copy-button copy='{$copy_url}'>
            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 640 512'>
                <path d='M172.5 131.1C228.1 75.51 320.5 75.51 376.1 131.1C426.1 181.1 433.5 260.8 392.4 318.3L391.3 319.9C381 334.2 361 337.6 346.7 327.3C332.3 317 328.9 297 339.2 282.7L340.3 281.1C363.2 249 359.6 205.1 331.7 177.2C300.3 145.8 249.2 145.8 217.7 177.2L105.5 289.5C73.99 320.1 73.99 372 105.5 403.5C133.3 431.4 177.3 435 209.3 412.1L210.9 410.1C225.3 400.7 245.3 404 255.5 418.4C265.8 432.8 262.5 452.8 248.1 463.1L246.5 464.2C188.1 505.3 110.2 498.7 60.21 448.8C3.741 392.3 3.741 300.7 60.21 244.3L172.5 131.1zM467.5 380C411 436.5 319.5 436.5 263 380C213 330 206.5 251.2 247.6 193.7L248.7 192.1C258.1 177.8 278.1 174.4 293.3 184.7C307.7 194.1 311.1 214.1 300.8 229.3L299.7 230.9C276.8 262.1 280.4 306.9 308.3 334.8C339.7 366.2 390.8 366.2 422.3 334.8L534.5 222.5C566 191 566 139.1 534.5 108.5C506.7 80.63 462.7 76.99 430.7 99.9L429.1 101C414.7 111.3 394.7 107.1 384.5 93.58C374.2 79.2 377.5 59.21 391.9 48.94L393.5 47.82C451 6.731 529.8 13.25 579.8 63.24C636.3 119.7 636.3 211.3 579.8 267.7L467.5 380z'></path>
            </svg>
            </uxdot-copy-button>";
        $copy_buttons .= '</div></td>';
        return $copy_buttons;
    }

    /**
     * Fetch data from the REST API.
     *
     * @return array The fetched data.
     */
    protected function fetch_data()
    {
        $response = wp_remote_get(rest_url("{$this->rest_namespace}/{$this->rest_route}"));
        if (is_wp_error($response)) {
            return [];
        }

        $data = wp_remote_retrieve_body($response);
        return json_decode($data, true);
    }
}
