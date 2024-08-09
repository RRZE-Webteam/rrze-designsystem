<?php

namespace RRZE\Designsystem;

if (!defined('ABSPATH')) {
    exit; // Verhindere direkten Aufruf.
}

class CPT
{
    const POST_TYPE = 'token';
    const TEXT_DOMAIN = 'rrze-designsystem';

    public function __construct()
    {
        add_action('init', [$this, 'register_post_type']);
        add_action('add_meta_boxes', [$this, 'register_meta_boxes']);
        add_action('save_post', [$this, 'save_meta_boxes']);
    }

    public function register_post_type()
    {
        try {
            $labels = [
                'name'                  => __('Tokens', self::TEXT_DOMAIN),
                'singular_name'         => __('Token', self::TEXT_DOMAIN),
                'menu_name'             => __('Tokens', self::TEXT_DOMAIN),
                'name_admin_bar'        => __('Token', self::TEXT_DOMAIN),
                'add_new'               => __('Add New', self::TEXT_DOMAIN),
                'add_new_item'          => __('Add New Token', self::TEXT_DOMAIN),
                'new_item'              => __('New Token', self::TEXT_DOMAIN),
                'edit_item'             => __('Edit Token', self::TEXT_DOMAIN),
                'view_item'             => __('View Token', self::TEXT_DOMAIN),
                'all_items'             => __('All Tokens', self::TEXT_DOMAIN),
                'search_items'          => __('Search Tokens', self::TEXT_DOMAIN),
                'parent_item_colon'     => __('Parent Tokens:', self::TEXT_DOMAIN),
                'not_found'             => __('No Tokens found.', self::TEXT_DOMAIN),
                'not_found_in_trash'    => __('No Tokens found in Trash.', self::TEXT_DOMAIN),
            ];

            $args = [
                'labels'                => $labels,
                'public'                => true,
                'publicly_queryable'    => true,
                'show_ui'               => true,
                'show_in_menu'          => true,
                'query_var'             => true,
                'rewrite'               => ['slug' => 'token'],
                'capability_type'       => 'post',
                'has_archive'           => true,
                'hierarchical'          => false,
                'menu_position'         => null,
                'supports'              => ['title', 'editor', 'thumbnail'],
            ];

            register_post_type(self::POST_TYPE, $args);
        } catch (\Exception $e) {
            error_log('Error registering post type: ' . $e->getMessage());
        }
    }

    public function register_meta_boxes()
    {
        try {
            add_meta_box(
                'token_meta_box',
                __('Token Details', self::TEXT_DOMAIN),
                [$this, 'render_meta_box'],
                self::POST_TYPE,
                'normal',
                'high'
            );
        } catch (\Exception $e) {
            error_log('Error registering meta boxes: ' . $e->getMessage());
        }
    }

    public function render_meta_box($post)
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
            <input type="text" name="token_value" id="token_value" value="<?php echo esc_attr($token_value); ?>" class="widefat" />
        </p>
        <p>
            <label for="token_usecase"><?php _e('Token Use Case', self::TEXT_DOMAIN); ?></label>
            <input type="text" name="token_usecase" id="token_usecase" value="<?php echo esc_attr($token_usecase); ?>" class="widefat" />
        </p>
        <p>
            <label for="token_image"><?php _e('Token Image', self::TEXT_DOMAIN); ?></label>
            <input type="hidden" name="token_image" id="token_image" value="<?php echo esc_attr($token_image); ?>" />
            <button type="button" class="button" id="token_image_button"><?php _e('Select Image', self::TEXT_DOMAIN); ?></button>
            <div id="token_image_preview">
                <?php if ($token_image) : ?>
                    <img src="<?php echo esc_url(wp_get_attachment_url($token_image)); ?>" style="max-width: 100%;" />
                <?php endif; ?>
            </div>
        </p>
        <script>
            jQuery(document).ready(function($) {
                var mediaUploader;

                $('#token_image_button').click(function(e) {
                    e.preventDefault();
                    if (mediaUploader) {
                        mediaUploader.open();
                        return;
                    }
                    mediaUploader = wp.media.frames.file_frame = wp.media({
                        title: '<?php _e("Choose Image", self::TEXT_DOMAIN); ?>',
                        button: {
                            text: '<?php _e("Choose Image", self::TEXT_DOMAIN); ?>'
                        }, multiple: false });
                    mediaUploader.on('select', function() {
                        var attachment = mediaUploader.state().get('selection').first().toJSON();
                        $('#token_image').val(attachment.id);
                        $('#token_image_preview').html('<img src="' + attachment.url + '" style="max-width: 100%;" />');
                    });
                    mediaUploader.open();
                });
            });
        </script>
        <?php
    }

    public function save_meta_boxes($post_id)
    {
        try {
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
        } catch (\Exception $e) {
            error_log('Error saving meta boxes: ' . $e->getMessage());
        }
    }
}

new CPT();

