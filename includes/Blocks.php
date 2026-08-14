<?php

namespace RRZE\Designsystem;

defined('ABSPATH') || exit;

use RRZE\Designsystem\Tokens\Base\CPT_Table_Generator;

/**
 * Registers the native editor blocks supplied by the plugin.
 */
class Blocks
{
    /**
     * Columns available for Color token tables.
     *
     * @var array<string, string>
     */
    private const COLOR_FIELDS = [
        'token_name' => 'Token name',
        'value' => 'Value',
        'use_case' => 'Use case',
        'pantone' => 'Pantone',
        'cmyk' => 'CMYK',
        'rgb' => 'RGB',
        'ral' => 'RAL',
    ];

    private const DEFAULT_COLOR_FIELDS = ['token_name', 'value', 'use_case'];

    /**
     * Token types that can be rendered by the token table block.
     *
     * @var array<string, array<string, mixed>>
     */
    private const TOKEN_TYPES = [
        'color' => [
            'class' => 'rrze-designsystem-colors',
            'sample' => '',
        ],
        'font' => [
            'class' => 'rrze-designsystem-fonts',
            'sample' => 'Aa',
        ],
        'space' => [
            'class' => 'rrze-designsystem-spaces',
            'sample' => '',
        ],
        'boxshadow' => [
            'class' => 'rrze-designsystem-boxshadows',
            'sample' => '',
        ],
        'opacity' => [
            'class' => 'rrze-designsystem-opacitys',
            'sample' => '',
        ],
        'length' => [
            'class' => 'rrze-designsystem-lengths',
            'sample' => '',
        ],
        'breakpoint' => [
            'class' => 'rrze-designsystem-breakpoints',
            'sample' => '',
        ],
        'mediaquery' => [
            'class' => 'rrze-designsystem-mediaqueries',
            'sample' => '',
        ],
        'border' => [
            'class' => 'rrze-designsystem-borders',
            'sample' => '',
        ],
        'icon' => [
            'class' => 'rrze-designsystem-icons',
            'sample' => '',
        ],
    ];

    public function __construct()
    {
        add_action('init', [$this, 'register_blocks']);
        add_filter('block_categories_all', [$this, 'register_block_category']);
    }

    /**
     * Adds an RRZE-specific group to the block inserter.
     *
     * @param array<int, array<string, string>> $categories Existing categories.
     * @return array<int, array<string, string>>
     */
    public function register_block_category(array $categories): array
    {
        foreach ($categories as $category) {
            if (($category['slug'] ?? '') === 'rrze-designsystem') {
                return $categories;
            }
        }

        array_unshift($categories, [
            'slug' => 'rrze-designsystem',
            'title' => __('RRZE Design System', 'rrze-designsystem'),
            'icon' => null,
        ]);

        return $categories;
    }

    /**
     * Registers all built block metadata and their server-side renderers.
     */
    public function register_blocks(): void
    {
        $blocks = [
            'token-table' => [$this, 'render_token_table'],
            'design-element' => [$this, 'render_design_element'],
        ];

        foreach ($blocks as $directory => $render_callback) {
            $path = dirname(__DIR__) . '/build/' . $directory;

            if (!file_exists($path . '/block.json')) {
                continue;
            }

            register_block_type($path, [
                'render_callback' => $render_callback,
            ]);

            $script_handle = generate_block_asset_handle(
                'rrze-designsystem/' . $directory,
                'editorScript'
            );
            wp_set_script_translations(
                $script_handle,
                'rrze-designsystem',
                dirname(__DIR__) . '/languages'
            );
        }
    }

    /**
     * Renders a token table from the current token CPT records.
     *
     * @param array<string, mixed> $attributes Block attributes.
     */
    public function render_token_table(array $attributes): string
    {
        $token_type = sanitize_key($attributes['tokenType'] ?? 'color');

        if (!isset(self::TOKEN_TYPES[$token_type])) {
            $token_type = 'color';
        }

        $config = self::TOKEN_TYPES[$token_type];
        $fields = [
            ['name' => 'token_name', 'label' => __('Token name', 'rrze-designsystem')],
            ['name' => 'value', 'label' => __('Value', 'rrze-designsystem')],
            ['name' => 'use_case', 'label' => __('Use case', 'rrze-designsystem')],
        ];

        if ($token_type === 'color') {
            $requested_fields = is_array($attributes['displayedFields'] ?? null)
                ? $attributes['displayedFields']
                : self::DEFAULT_COLOR_FIELDS;
            $requested_fields = array_map('sanitize_key', $requested_fields);
            $fields = [];

            foreach (self::COLOR_FIELDS as $field_name => $field_label) {
                if (in_array($field_name, $requested_fields, true)) {
                    $fields[] = [
                        'name' => $field_name,
                        'label' => __($field_label, 'rrze-designsystem'),
                    ];
                }
            }
        }

        $table_generator = new CPT_Table_Generator(
            $token_type,
            $token_type . '/v1',
            'data',
            $fields,
            [$config['class']],
            $config['sample']
        );

        $categories = array_filter(array_map(
            'sanitize_title',
            is_array($attributes['categories'] ?? null) ? $attributes['categories'] : []
        ));

        if ($categories) {
            $table_generator->set_categories($categories);
        }

        $table_generator->set_show_copy(!empty($attributes['showCopy']));

        $heading = '';
        if (!empty($attributes['showHeading']) && !empty($attributes['heading'])) {
            $heading_level = min(6, max(2, absint($attributes['headingLevel'] ?? 2)));
            $heading = sprintf(
                '<h%1$d>%2$s</h%1$d>',
                $heading_level,
                esc_html($attributes['heading'])
            );
        }

        $wrapper_options = [
            'class' => 'rrze-designsystem-token-table' . (!empty($attributes['compact']) ? ' is-compact' : ''),
            'data-token-type' => $token_type,
        ];

        if ($token_type === 'color') {
            $color_layout = sanitize_key($attributes['colorLayout'] ?? 'table');
            if ($color_layout === 'tiles') {
                $wrapper_options['class'] .= ' is-color-tiles';
            }

            $swatch_size = min(200, max(8, absint($attributes['swatchSize'] ?? 32)));
            $swatch_radius = min(50, max(0, absint($attributes['swatchBorderRadius'] ?? 50)));
            $wrapper_options['style'] = sprintf(
                '--rrze-color-swatch-size:%dpx;--rrze-color-swatch-radius:%d%%;',
                $swatch_size,
                $swatch_radius
            );
        }

        $wrapper_attributes = get_block_wrapper_attributes($wrapper_options);

        return sprintf(
            '<div %1$s>%2$s%3$s</div>',
            $wrapper_attributes,
            $heading,
            $table_generator->generate_table()
        );
    }

    /**
     * Renders one of the sections stored on a design element record.
     *
     * @param array<string, mixed> $attributes Block attributes.
     */
    public function render_design_element(array $attributes): string
    {
        $element_id = absint($attributes['elementId'] ?? 0);
        $element = $element_id ? get_post($element_id) : null;

        if (!$element || $element->post_type !== 'elements') {
            return sprintf(
                '<div %1$s><p>%2$s</p></div>',
                get_block_wrapper_attributes(['class' => 'rrze-designsystem-element is-empty']),
                esc_html__('Choose a design element in the block settings.', 'rrze-designsystem')
            );
        }

        $allowed_sections = ['', 'overview', 'style', 'guidelines', 'code', 'accessibility'];
        $section = sanitize_key($attributes['section'] ?? '');
        if (!in_array($section, $allowed_sections, true)) {
            $section = '';
        }

        $heading = '';
        if (!empty($attributes['showTitle'])) {
            $heading_level = min(6, max(2, absint($attributes['headingLevel'] ?? 2)));
            $heading = sprintf(
                '<h%1$d class="rrze-designsystem-element__title">%2$s</h%1$d>',
                $heading_level,
                esc_html(get_the_title($element))
            );
        }

        $shortcode = sprintf(
            '[Designelement element="%d" section="%s"]',
            $element_id,
            esc_attr($section)
        );

        return sprintf(
            '<article %1$s>%2$s%3$s</article>',
            get_block_wrapper_attributes(['class' => 'rrze-designsystem-element']),
            $heading,
            do_shortcode($shortcode)
        );
    }
}
