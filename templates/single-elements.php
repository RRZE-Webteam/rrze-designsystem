<?php
defined('ABSPATH') || exit;
global $is_sidebar_active;
get_header();

while (have_posts()) : the_post(); ?>
    <div id="content" class="subnav">
        <div class="content-container">
            <div class="content-row">
                <?php echo fau_get_page_subnav($post->ID); ?>
                <div class="entry-content">
                    <main<?php echo fau_get_page_langcode($post->ID); ?>>
                        <h1 id="maintop" class="screen-reader-text"><?php the_title(); ?></h1>
                        <?php
                        $headline = get_post_meta($post->ID, 'headline', true);
                        if (!fau_empty($headline)) {
                            echo '<p class="subtitle">' . $headline . '</p>';
                        } ?>
                        <div class="inline-box">
                            <?php get_template_part('template-parts/sidebar', 'inline'); ?>
                            <div class="content-inline<?php if ($is_sidebar_active) {
                                                            echo " with-sidebar";
                                                        } ?>">

                                <?php
                                the_content();
                                echo wp_link_pages($pagebreakargs);
                                ?>
                            </div>
                        </div>
                        </main>
                        <div class="elements-content">
                            <h1><?php the_title(); ?></h1>

                            <!-- Section Overview -->
                            <div class="section-overview">
                                <h2><?php _e('Overview', 'rrze-designsystem'); ?></h2>
                                <?php echo apply_filters('the_content', get_post_meta(get_the_ID(), 'elements_overview', true)); ?>

                                <h3><?php _e('Sample Element', 'rrze-designsystem'); ?></h3>
                                <?php echo apply_filters('the_content', get_post_meta(get_the_ID(), 'elements_sample_element', true)); ?>

                                <h3><?php _e('When to Use', 'rrze-designsystem'); ?></h3>
                                <?php echo apply_filters('the_content', get_post_meta(get_the_ID(), 'elements_when_to_use', true)); ?>

                                <h3><?php _e('Related Elements', 'rrze-designsystem'); ?></h3>
                                <?php
                                $related_elements = get_post_meta(get_the_ID(), 'elements_related_elements', true);
                                if (!empty($related_elements) && is_array($related_elements)) {
                                    foreach ($related_elements as $link) {
                                        echo '<a href="' . esc_url($link) . '" target="_blank">' . esc_html($link) . '</a><br>';
                                    }
                                }
                                ?>
                            </div>

                            <!-- Section Style -->
                            <div class="section-style">
                                <h2><?php _e('Style', 'rrze-designsystem'); ?></h2>
                                <h3><?php _e('Brief', 'rrze-designsystem'); ?></h3>
                                <?php echo apply_filters('the_content', get_post_meta(get_the_ID(), 'elements_brief', true)); ?>

                                <h3><?php _e('Anatomy', 'rrze-designsystem'); ?></h3>
                                <?php echo apply_filters('the_content', get_post_meta(get_the_ID(), 'elements_anatomy', true)); ?>

                                <h3><?php _e('Style Details', 'rrze-designsystem'); ?></h3>
                                <?php echo apply_filters('the_content', get_post_meta(get_the_ID(), 'elements_style', true)); ?>
                            </div>

                            <!-- Section Guidelines -->
                            <div class="section-guidelines">
                                <h2><?php _e('Guidelines', 'rrze-designsystem'); ?></h2>
                                <?php echo apply_filters('the_content', get_post_meta(get_the_ID(), 'elements_guidelines', true)); ?>
                            </div>

                            <!-- Section Code -->
                            <div class="section-code">
                                <h2><?php _e('Code', 'rrze-designsystem'); ?></h2>
                                <?php echo apply_filters('the_content', get_post_meta(get_the_ID(), 'elements_code', true)); ?>
                            </div>

                            <!-- Section Accessibility -->
                            <div class="section-accessibility">
                                <h2><?php _e('Accessibility', 'rrze-designsystem'); ?></h2>
                                <?php echo apply_filters('the_content', get_post_meta(get_the_ID(), 'elements_accessibility', true)); ?>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

<?php endwhile;

get_footer();
?>