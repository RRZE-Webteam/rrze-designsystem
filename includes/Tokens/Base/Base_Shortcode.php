<?php

namespace RRZE\Designsystem\Tokens\Base;

defined('ABSPATH') || exit;

abstract class Base_Shortcode
{
    protected $post_type;
    protected $rest_namespace;
    protected $rest_route;
    protected $fields;
    protected $shortcode_tag;

    public function __construct($shortcode_tag, $post_type, $rest_namespace, $rest_route, $fields)
    {
        $this->shortcode_tag = $shortcode_tag;
        $this->post_type = $post_type;
        $this->rest_namespace = $rest_namespace;
        $this->rest_route = $rest_route;
        $this->fields = $fields;

        add_shortcode($this->shortcode_tag, [$this, 'render_shortcode']);
    }

    /**
     * Renders the shortcode output.
     *
     * @param array $atts Shortcode attributes.
     * @return string The HTML output of the shortcode.
     */
    public function render_shortcode($atts)
    {
        // Optionally process the shortcode attributes here if needed
        $atts = shortcode_atts([], $atts, $this->shortcode_tag);

        // Create an instance of the CPT_Table_Generator and generate the table
        $table_generator = new \RRZE\Designsystem\Tokens\Base\CPT_Table_Generator(
            $this->post_type,
            $this->rest_namespace,
            $this->rest_route,
            $this->fields
        );

        return $table_generator->generate_table();
    }
}
