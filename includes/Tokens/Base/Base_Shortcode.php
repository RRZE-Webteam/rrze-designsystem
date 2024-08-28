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
    protected $style_template;
    protected $extra_classes;
    protected $samp_text;

    public function __construct($shortcode_tag, $post_type, $rest_namespace, $rest_route, $fields, $style_template = '', $extra_classes = [], $samp_text = '')
    {
        $this->shortcode_tag = $shortcode_tag;
        $this->post_type = $post_type;
        $this->rest_namespace = $rest_namespace;
        $this->rest_route = $rest_route;
        $this->fields = $fields;
        $this->style_template = $style_template;
        $this->extra_classes = $extra_classes;
        $this->samp_text = $samp_text;

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
        $atts = shortcode_atts(
            [
                'category' => '',
            ],
            $atts,
            $this->shortcode_tag
        );

        // Create an instance of the CPT_Table_Generator and generate the table
        $table_generator = new \RRZE\Designsystem\Tokens\Base\CPT_Table_Generator(
            $this->post_type,
            $this->rest_namespace,
            $this->rest_route,
            $this->fields,
            $this->extra_classes,
            $this->samp_text
        );

        // Pass categories to the table generator if provided
        if (!empty($atts['category'])) {
            $table_generator->set_categories(explode(',', $atts['category']));
        }

        // Use the style template if provided
        if (!empty($this->style_template)) {
            $data = $table_generator->fetch_data();
            if (!empty($data)) {
                $styles = $table_generator->generate_dynamic_styles($data, $this->style_template);

                // Add the styles to the wp_footer action
                add_action('wp_footer', function () use ($styles) {
                    echo $styles;
                }, 99);
            }
        }


        return $table_generator->generate_table();
    }
}
