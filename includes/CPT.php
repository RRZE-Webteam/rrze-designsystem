<?php

namespace RRZE\Designsystem;

if (!defined('ABSPATH')) {
    exit; // Prevent direct access.
}

class CPT
{
    const TEXT_DOMAIN = 'rrze-designsystem';

    public function __construct()
    {
        add_action('init', [$this, 'register_post_types']);
        add_action('add_meta_boxes', [$this, 'register_meta_boxes']);
        add_action('save_post', [$this, 'save_meta_boxes']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_scripts']);
    }

    public function register_post_types()
    {
        try {
            $this->register_post_type_token();
            $this->register_post_type_component();
            $this->register_post_type_template();
        } catch (\Exception $e) {
            error_log('Error registering post types: ' . $e->getMessage());
        }
    }

    private function register_post_type_token()
    {
        $labels = [
            'name' => __('Tokens', self::TEXT_DOMAIN),
            'singular_name' => __('Token', self::TEXT_DOMAIN),
            'menu_name' => __('Tokens', self::TEXT_DOMAIN),
            'add_new_item' => __('Add New Token', self::TEXT_DOMAIN),
            'edit_item' => __('Edit Token', self::TEXT_DOMAIN),
            'view_item' => __('View Token', self::TEXT_DOMAIN),
            'all_items' => __('All Tokens', self::TEXT_DOMAIN),
        ];

        $args = [
            'labels' => $labels,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'supports' => ['title'],
        ];

        register_post_type('token', $args);
    }

    private function register_post_type_component()
    {
        $labels = [
            'name' => __('Components', self::TEXT_DOMAIN),
            'singular_name' => __('Component', self::TEXT_DOMAIN),
            'menu_name' => __('Components', self::TEXT_DOMAIN),
            'add_new_item' => __('Add New Component', self::TEXT_DOMAIN),
            'edit_item' => __('Edit Component', self::TEXT_DOMAIN),
            'view_item' => __('View Component', self::TEXT_DOMAIN),
            'all_items' => __('All Components', self::TEXT_DOMAIN),
        ];

        $args = [
            'labels' => $labels,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'supports' => ['title', 'editor'],
        ];

        register_post_type('component', $args);
    }

    private function register_post_type_template()
    {
        $labels = [
            'name' => __('Templates', self::TEXT_DOMAIN),
            'singular_name' => __('Template', self::TEXT_DOMAIN),
            'menu_name' => __('Templates', self::TEXT_DOMAIN),
            'add_new_item' => __('Add New Template', self::TEXT_DOMAIN),
            'edit_item' => __('Edit Template', self::TEXT_DOMAIN),
            'view_item' => __('View Template', self::TEXT_DOMAIN),
            'all_items' => __('All Templates', self::TEXT_DOMAIN),
        ];

        $args = [
            'labels' => $labels,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'supports' => ['title', 'editor'],
        ];

        register_post_type('template', $args);
    }

    public function register_meta_boxes()
    {
        try {
            add_meta_box(
                'token_meta_box',
                __('Token Details', self::TEXT_DOMAIN),
                [$this, 'render_token_meta_box'],
                'token',
                'normal',
                'high'
            );

            add_meta_box(
                'component_meta_box',
                __('Component Details', self::TEXT_DOMAIN),
                [$this, 'render_component_meta_box'],
                'component',
                'normal',
                'high'
            );

            add_meta_box(
                'template_meta_box',
                __('Template Details', self::TEXT_DOMAIN),
                [$this, 'render_template_meta_box'],
                'template',
                'normal',
                'high'
            );
        } catch (\Exception $e) {
            error_log('Error registering meta boxes: ' . $e->getMessage());
        }
    }

    public function render_token_meta_box($post)
    {
        wp_nonce_field(basename(__FILE__), 'token_meta_box_nonce');

        $token_type = get_post_meta($post->ID, '_token_type', true);
        $token_name = get_post_meta($post->ID, '_token_name', true);
        $token_value = get_post_meta($post->ID, '_token_value', true);
        $token_usecase = get_post_meta($post->ID, '_token_usecase', true);
        $token_image = get_post_meta($post->ID, '_token_image', true);

        ?>
        <p>
            <label for="token_type"><?php _e('Token Type', self::TEXT_DOMAIN); ?></label>
            <select name="token_type" id="token_type">
                <option value="Typography" <?php selected($token_type, 'Typography'); ?>>Typography</option>
                <option value="Border" <?php selected($token_type, 'Border'); ?>>Border</option>
                <option value="Opacity" <?php selected($token_type, 'Opacity'); ?>>Opacity</option>
                <option value="Space" <?php selected($token_type, 'Space'); ?>>Space</option>
                <option value="Farbe" <?php selected($token_type, 'Farbe'); ?>>Farbe</option>
            </select>
        </p>
        <p>
            <label for="token_name"><?php _e('Token Name', self::TEXT_DOMAIN); ?></label>
            <input type="text" name="token_name" id="token_name" value="<?php echo esc_attr($token_name); ?>" class="widefat" />
        </p>
        <p>
            <label for="token_value"><?php _e('Token Value', self::TEXT_DOMAIN); ?></label>
            <input type="text" name="token_value" id="token_value" value="<?php echo esc_attr($token_value); ?>"
                class="widefat" />
        </p>
        <p>
            <label for="token_usecase"><?php _e('Token Use Case', self::TEXT_DOMAIN); ?></label>
            <input type="text" name="token_usecase" id="token_usecase" value="<?php echo esc_attr($token_usecase); ?>"
                class="widefat" />
        </p>
        <p>
            <label for="token_image"><?php _e('Token Image', self::TEXT_DOMAIN); ?></label>
            <input type="hidden" name="token_image" id="token_image" value="<?php echo esc_attr($token_image); ?>" />
            <button type="button" class="button"
                id="token_image_button"><?php _e('Select Image', self::TEXT_DOMAIN); ?></button>
        <div id="token_image_preview">
            <?php if ($token_image): ?>
                <img src="<?php echo esc_url(wp_get_attachment_url($token_image)); ?>" style="max-width: 100%;" />
            <?php endif; ?>
        </div>
        </p>
        <?php
    }


    public function render_component_meta_box($post)
    {
        wp_nonce_field(basename(__FILE__), 'component_meta_box_nonce');

        $overview = get_post_meta($post->ID, '_component_overview', true);
        $example = get_post_meta($post->ID, '_component_example', true);
        $usecase = get_post_meta($post->ID, '_component_usecase', true);
        $related_elements = get_post_meta($post->ID, '_component_related_elements', true);
        $figma_link = get_post_meta($post->ID, '_component_figma_link', true);
        $html_code = get_post_meta($post->ID, '_component_html_code', true);
        $css_code = get_post_meta($post->ID, '_component_css_code', true);
        $css_type = get_post_meta($post->ID, '_component_css_type', true);
        $js_code = get_post_meta($post->ID, '_component_js_code', true);
        $codepen_link = get_post_meta($post->ID, '_component_codepen_link', true);
        $github_link = get_post_meta($post->ID, '_component_github_link', true);
        $demo_link = get_post_meta($post->ID, '_component_demo_link', true);
        $download_link = get_post_meta($post->ID, '_component_download_link', true);
        $other_link = get_post_meta($post->ID, '_component_other_link', true);
        $other_link_text = get_post_meta($post->ID, '_component_other_link_text', true);

        ?>
        <nav class="nav-tab-wrapper">
            <a href="#general" class="nav-tab nav-tab-active"><?php _e('General', self::TEXT_DOMAIN); ?></a>
            <a href="#style" class="nav-tab"><?php _e('Style', self::TEXT_DOMAIN); ?></a>
            <a href="#usage" class="nav-tab"><?php _e('Usage', self::TEXT_DOMAIN); ?></a>
            <a href="#code" class="nav-tab"><?php _e('Code', self::TEXT_DOMAIN); ?></a>
        </nav>

        <div id="general" class="tab-content">
            <p>
                <label for="component_overview"><?php _e('Overview', self::TEXT_DOMAIN); ?></label>
                <textarea name="component_overview" id="component_overview"
                    class="widefat"><?php echo esc_textarea($overview); ?></textarea>
            </p>
            <p>
                <label for="component_example"><?php _e('Example', self::TEXT_DOMAIN); ?></label>
                <textarea name="component_example" id="component_example"
                    class="widefat"><?php echo esc_textarea($example); ?></textarea>
            </p>
            <p>
                <label for="component_usecase"><?php _e('Use Case', self::TEXT_DOMAIN); ?></label>
                <textarea name="component_usecase" id="component_usecase"
                    class="widefat"><?php echo esc_textarea($usecase); ?></textarea>
            </p>
            <p>
                <label for="component_related_elements"><?php _e('Related Elements or Patterns', self::TEXT_DOMAIN); ?></label>
                <textarea name="component_related_elements" id="component_related_elements"
                    class="widefat"><?php echo esc_textarea($related_elements); ?></textarea>
            </p>
            <p>
                <label for="component_feedback"><?php _e('Feedback', self::TEXT_DOMAIN); ?></label>
            <div id="component_feedback_widget_area">
                <?php dynamic_sidebar('component_feedback_widget'); ?>
            </div>
            </p>
        </div>

        <div id="style" class="tab-content" style="display: none;">
            <p>
                <label for="component_figma_link"><?php _e('Figma Link', self::TEXT_DOMAIN); ?></label>
                <input type="text" name="component_figma_link" id="component_figma_link"
                    value="<?php echo esc_url($figma_link); ?>" class="widefat" />
            </p>
            <p>
                <?php wp_editor($figma_link, 'component_style', ['textarea_name' => 'component_style']); ?>
            </p>
        </div>

        <div id="usage" class="tab-content" style="display: none;">
            <p>
                <?php wp_editor($related_elements, 'component_usage', ['textarea_name' => 'component_usage']); ?>
            </p>
        </div>

        <div id="code" class="tab-content" style="display: none;">
            <p>
                <label for="component_html_code"><?php _e('HTML', self::TEXT_DOMAIN); ?></label>
                <textarea name="component_html_code" id="component_html_code"
                    class="widefat"><?php echo esc_textarea($html_code); ?></textarea>
            </p>
            <p>
                <label for="component_css_code"><?php _e('CSS/SASS', self::TEXT_DOMAIN); ?></label>
                <textarea name="component_css_code" id="component_css_code"
                    class="widefat"><?php echo esc_textarea($css_code); ?></textarea>
            </p>
            <p>
                <label for="component_css_type"><?php _e('CSS Type', self::TEXT_DOMAIN); ?></label>
                <select name="component_css_type" id="component_css_type">
                    <option value="CSS" <?php selected($css_type, 'CSS'); ?>>CSS</option>
                    <option value="SASS" <?php selected($css_type, 'SASS'); ?>>SASS</option>
                </select>
            </p>
            <p>
                <label for="component_js_code"><?php _e('JavaScript', self::TEXT_DOMAIN); ?></label>
                <textarea name="component_js_code" id="component_js_code"
                    class="widefat"><?php echo esc_textarea($js_code); ?></textarea>
            </p>
            <p>
                <label for="component_codepen_link"><?php _e('CodePen Link', self::TEXT_DOMAIN); ?></label>
                <input type="text" name="component_codepen_link" id="component_codepen_link"
                    value="<?php echo esc_url($codepen_link); ?>" class="widefat" />
            </p>
            <p>
                <label for="component_github_link"><?php _e('GitHub Link', self::TEXT_DOMAIN); ?></label>
                <input type="text" name="component_github_link" id="component_github_link"
                    value="<?php echo esc_url($github_link); ?>" class="widefat" />
            </p>
            <p>
                <label for="component_demo_link"><?php _e('Demo Link', self::TEXT_DOMAIN); ?></label>
                <input type="text" name="component_demo_link" id="component_demo_link"
                    value="<?php echo esc_url($demo_link); ?>" class="widefat" />
            </p>
            <p>
                <label for="component_download_link"><?php _e('Download Link', self::TEXT_DOMAIN); ?></label>
                <input type="text" name="component_download_link" id="component_download_link"
                    value="<?php echo esc_url($download_link); ?>" class="widefat" />
            </p>
            <p>
                <label for="component_other_link"><?php _e('Other Link', self::TEXT_DOMAIN); ?></label>
                <input type="text" name="component_other_link" id="component_other_link"
                    value="<?php echo esc_url($other_link); ?>" class="widefat" />
            </p>
            <p>
                <label for="component_other_link_text"><?php _e('Other Link Text', self::TEXT_DOMAIN); ?></label>
                <input type="text" name="component_other_link_text" id="component_other_link_text"
                    value="<?php echo esc_attr($other_link_text); ?>" class="widefat" />
            </p>
        </div>
        <?php
    }


    public function render_template_meta_box($post)
    {
        wp_nonce_field(basename(__FILE__), 'template_meta_box_nonce');

        $description = get_post_meta($post->ID, '_template_description', true);
        $code = get_post_meta($post->ID, '_template_code', true);
        $notes = get_post_meta($post->ID, '_template_notes', true);
        $assets = get_post_meta($post->ID, '_template_assets', true);
        $feedback = get_post_meta($post->ID, '_template_feedback', true);

        ?>
        <nav class="nav-tab-wrapper">
            <a href="#description" class="nav-tab nav-tab-active"><?php _e('Description', self::TEXT_DOMAIN); ?></a>
            <a href="#code" class="nav-tab"><?php _e('Code', self::TEXT_DOMAIN); ?></a>
            <a href="#notes" class="nav-tab"><?php _e('Notes', self::TEXT_DOMAIN); ?></a>
            <a href="#assets" class="nav-tab"><?php _e('Assets', self::TEXT_DOMAIN); ?></a>
            <a href="#feedback" class="nav-tab"><?php _e('Feedback', self::TEXT_DOMAIN); ?></a>
        </nav>

        <div id="description" class="tab-content">
            <p>
                <label for="template_description"><?php _e('Template Description', self::TEXT_DOMAIN); ?></label>
                <textarea name="template_description" id="template_description"
                    class="widefat"><?php echo esc_textarea($description); ?></textarea>
            </p>
        </div>

        <div id="code" class="tab-content" style="display: none;">
            <p>
                <label for="template_code"><?php _e('Template Code', self::TEXT_DOMAIN); ?></label>
                <textarea name="template_code" id="template_code" class="widefat"><?php echo esc_textarea($code); ?></textarea>
            </p>
        </div>

        <div id="notes" class="tab-content" style="display: none;">
            <p>
                <label for="template_notes"><?php _e('Template Notes', self::TEXT_DOMAIN); ?></label>
                <textarea name="template_notes" id="template_notes"
                    class="widefat"><?php echo esc_textarea($notes); ?></textarea>
            </p>
        </div>

        <div id="assets" class="tab-content" style="display: none;">
            <p>
                <label for="template_assets"><?php _e('Template Assets', self::TEXT_DOMAIN); ?></label>
                <textarea name="template_assets" id="template_assets"
                    class="widefat"><?php echo esc_textarea($assets); ?></textarea>
            </p>
        </div>

        <div id="feedback" class="tab-content" style="display: none;">
            <p>
                <label for="template_feedback"><?php _e('Template Feedback', self::TEXT_DOMAIN); ?></label>
            <div id="template_feedback_widget_area">
                <?php dynamic_sidebar('template_feedback_widget'); ?>
            </div>
            </p>
        </div>
        <?php
    }


    public function save_meta_boxes($post_id)
    {
        $post_type = get_post_type($post_id);

        switch ($post_type) {
            case 'token':
                $this->save_token_meta_boxes($post_id);
                break;
            case 'component':
                $this->save_component_meta_boxes($post_id);
                break;
            case 'template':
                $this->save_template_meta_boxes($post_id);
                break;
        }
    }

    private function save_token_meta_boxes($post_id)
    {
        if (!isset($_POST['token_meta_box_nonce']) || !wp_verify_nonce($_POST['token_meta_box_nonce'], basename(__FILE__))) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        $fields = [
            '_token_type' => sanitize_text_field($_POST['token_type'] ?? ''),
            '_token_name' => sanitize_text_field($_POST['token_name'] ?? ''),
            '_token_value' => sanitize_text_field($_POST['token_value'] ?? ''),
            '_token_usecase' => sanitize_text_field($_POST['token_usecase'] ?? ''),
            '_token_image' => sanitize_text_field($_POST['token_image'] ?? ''),
        ];

        foreach ($fields as $key => $value) {
            if (!empty($value)) {
                update_post_meta($post_id, $key, $value);
            } else {
                delete_post_meta($post_id, $key);
            }
        }
    }

    private function save_component_meta_boxes($post_id)
    {
        if (!isset($_POST['component_meta_box_nonce']) || !wp_verify_nonce($_POST['component_meta_box_nonce'], basename(__FILE__))) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        $fields = [
            '_component_overview' => sanitize_textarea_field($_POST['component_overview'] ?? ''),
            '_component_example' => sanitize_textarea_field($_POST['component_example'] ?? ''),
            '_component_usecase' => sanitize_textarea_field($_POST['component_usecase'] ?? ''),
            '_component_related_elements' => sanitize_textarea_field($_POST['component_related_elements'] ?? ''),
            '_component_figma_link' => esc_url_raw($_POST['component_figma_link'] ?? ''),
            '_component_html_code' => sanitize_textarea_field($_POST['component_html_code'] ?? ''),
            '_component_css_code' => sanitize_textarea_field($_POST['component_css_code'] ?? ''),
            '_component_css_type' => sanitize_text_field($_POST['component_css_type'] ?? 'CSS'),
            '_component_js_code' => sanitize_textarea_field($_POST['component_js_code'] ?? ''),
            '_component_codepen_link' => esc_url_raw($_POST['component_codepen_link'] ?? ''),
            '_component_github_link' => esc_url_raw($_POST['component_github_link'] ?? ''),
            '_component_demo_link' => esc_url_raw($_POST['component_demo_link'] ?? ''),
            '_component_download_link' => esc_url_raw($_POST['component_download_link'] ?? ''),
            '_component_other_link' => esc_url_raw($_POST['component_other_link'] ?? ''),
            '_component_other_link_text' => sanitize_text_field($_POST['component_other_link_text'] ?? ''),
        ];

        foreach ($fields as $key => $value) {
            if (!empty($value)) {
                update_post_meta($post_id, $key, $value);
            } else {
                delete_post_meta($post_id, $key);
            }
        }
    }

    private function save_template_meta_boxes($post_id)
    {
        if (!isset($_POST['template_meta_box_nonce']) || !wp_verify_nonce($_POST['template_meta_box_nonce'], basename(__FILE__))) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        $fields = [
            '_template_description' => sanitize_textarea_field($_POST['template_description'] ?? ''),
            '_template_code' => sanitize_textarea_field($_POST['template_code'] ?? ''),
            '_template_notes' => sanitize_textarea_field($_POST['template_notes'] ?? ''),
            '_template_assets' => sanitize_textarea_field($_POST['template_assets'] ?? ''),
            '_template_feedback' => sanitize_textarea_field($_POST['template_feedback'] ?? ''),
        ];

        foreach ($fields as $key => $value) {
            if (!empty($value)) {
                update_post_meta($post_id, $key, $value);
            } else {
                delete_post_meta($post_id, $key);
            }
        }
    }

    public function enqueue_admin_scripts($hook_suffix)
    {
        global $post_type;
        if (in_array($post_type, ['token', 'component', 'template'])) {
            wp_enqueue_media();
            wp_enqueue_script(
                'rrze-designsystem-admin',
                plugin_dir_url(__FILE__) . '../assets/js/admin.js',
                ['jquery'],
                null,
                true
            );
        }
    }
}

new CPT();
