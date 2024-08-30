<?php

namespace RRZE\Designsystem\Elements;

defined('ABSPATH') || exit;

class Elements_Shortcode
{
    public function __construct()
    {
        add_shortcode('Designelement', [$this, 'render_shortcode']);
    }

    /**
     * Renders the shortcode output for the given "Element".
     *
     * @param array $atts Shortcode attributes.
     * @return string The HTML output of the shortcode.
     */
    public function render_shortcode($atts)
    {
        $atts = shortcode_atts(
            [
                'element' => '',
                'section' => '',
            ],
            $atts,
            'Designelement'
        );

        $element_post = get_post($atts['element']);
        if (!$element_post || $element_post->post_type !== 'elements') {
            return __('Element not found.', 'rrze-designsystem');
        }

        // Render content based on section attribute
        $output = '<div class="elements-content">';
        
        switch ($atts['section']) {
            case 'overview':
                $output .= $this->render_overview($element_post);
                break;

            case 'style':
                $output .= $this->render_section(__('Style', 'rrze-designsystem'), 'elements_style', $element_post);
                break;

            case 'guidelines':
                $output .= $this->render_section(__('Guidelines', 'rrze-designsystem'), 'elements_guidelines', $element_post);
                break;

            case 'code':
                $output .= $this->render_section(__('Code', 'rrze-designsystem'), 'elements_code', $element_post);
                break;

            case 'accessibility':
                $output .= $this->render_section(__('Accessibility', 'rrze-designsystem'), 'elements_accessibility', $element_post);
                break;

            default:
                // Render all sections if no specific section is provided
                $output .= $this->render_overview($element_post);
                $output .= $this->render_style($element_post);
                $output .= $this->render_section(__('Guidelines', 'rrze-designsystem'), 'elements_guidelines', $element_post);
                $output .= $this->render_section(__('Code', 'rrze-designsystem'), 'elements_code', $element_post);
                $output .= $this->render_section(__('Accessibility', 'rrze-designsystem'), 'elements_accessibility', $element_post);
                break;
        }

        // Always render related elements at the end
        $output .= $this->render_related_elements($element_post);

        $output .= '</div>';

        return $output;
    }

    /**
     * Renders the overview section including specific sub-sections.
     *
     * @param WP_Post $element_post The post object.
     * @return string The HTML output for the overview section.
     */
    private function render_overview($element_post)
    {
        $output = $this->render_section(__('Overview', 'rrze-designsystem'), 'elements_overview', $element_post);
        $output .= $this->render_section(__('Sample Element', 'rrze-designsystem'), 'elements_sample_element', $element_post);
        $output .= $this->render_section(__('When to Use', 'rrze-designsystem'), 'elements_when_to_use', $element_post);
        return $output;
    }

    private function render_style($element_post)
    {
        $output = $this->render_section(__('Style', 'rrze-designsystem'), 'elements_style', $element_post);
        $output .= $this->render_section(__('Brief', 'rrze-designsystem'), 'elements_brief', $element_post);
        $output .= $this->render_section(__('Anatomy', 'rrze-designsystem'), 'elements_anatomy', $element_post);
        return $output;
    }

    /**
     * Renders the related elements section with links, texts, and tooltips.
     *
     * @param WP_Post $element_post The post object.
     * @return string The HTML output for the related elements.
     */
    private function render_related_elements($element_post)
    {
        $output = '<h3>' . __('Related Elements', 'rrze-designsystem') . '</h3>';
        $related_elements = get_post_meta($element_post->ID, 'elements_related_elements', true);

        if (!empty($related_elements) && is_array($related_elements)) {
            $output .= '<ul class="related-elements">';
            foreach ($related_elements as $element) {
                $link_text = isset($element['link_text']) ? esc_html($element['link_text']) : '';
                $link_url = isset($element['link_url']) ? esc_url($element['link_url']) : '#';
                $link_tooltip = isset($element['link_tooltip']) ? esc_attr($element['link_tooltip']) : '';

                // Render each related element as a list item with a link and tooltip
                $output .= '<li><a href="' . $link_url . '" target="_blank" title="' . $link_tooltip . '">' . $link_text . '</a></li>';
            }
            $output .= '</ul>';
        } else {
            $output .= '<p>' . __('No related elements found.', 'rrze-designsystem') . '</p>';
        }

        return $output;
    }

    /**
     * Helper function to render a section.
     *
     * @param string $section_title The title of the section.
     * @param string $meta_key The meta key of the field.
     * @param WP_Post $element_post The post object.
     * @return string The HTML output for the section.
     */
    private function render_section($section_title, $meta_key, $element_post)
    {
        $content = get_post_meta($element_post->ID, $meta_key, true);
        if (empty($content)) {
            return '';
        }

        $output = '<div class="section-' . esc_attr($meta_key) . '">';
        $output .= '<h3>' . esc_html($section_title) . '</h3>';
        $output .= apply_filters('the_content', $content);
        $output .= '</div>';

        return $output;
    }
}

new Elements_Shortcode();
