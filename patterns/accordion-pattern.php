<?php
register_block_pattern(
    'rrze-designsystem/accordion-pattern',
    array(
        'title'       => __( 'Accordion Pattern', 'rrze-designsystem' ),
        'description' => _x( 'A pattern for accordion blocks', 'Block pattern description', 'rrze-designsystem' ),
        'content'     => '
            <!-- wp:rrze-elements/accordion {"allowedBlocks":["core/paragraph","core/heading","core/list"],"collapsible":true,"multiple":false} -->
            <div class="wp-block-rrze-elements-accordion">
                <!-- wp:rrze-elements/accordion-item {"title":"Accordion 1"} -->
                <div class="wp-block-rrze-elements-accordion-item">
                    <button class="accordion-trigger" aria-expanded="false">
                        <span class="accordion-title">Accordion 1</span>
                        <span class="accordion-icon"></span>
                    </button>
                    <div class="accordion-panel">
                        <!-- wp:paragraph -->
                        <p>Content for Accordion 1.</p>
                        <!-- /wp:paragraph -->
                    </div>
                </div>
                <!-- /wp:rrze-elements/accordion-item -->

                <!-- wp:rrze-elements/accordion-item {"title":"Accordion 2"} -->
                <div class="wp-block-rrze-elements-accordion-item">
                    <button class="accordion-trigger" aria-expanded="false">
                        <span class="accordion-title">Accordion 2</span>
                        <span class="accordion-icon"></span>
                    </button>
                    <div class="accordion-panel">
                        <!-- wp:paragraph -->
                        <p>Content for Accordion 2.</p>
                        <!-- /wp:paragraph -->
                    </div>
                </div>
                <!-- /wp:rrze-elements/accordion-item -->

                <!-- wp:rrze-elements/accordion-item {"title":"Accordion 3"} -->
                <div class="wp-block-rrze-elements-accordion-item">
                    <button class="accordion-trigger" aria-expanded="false">
                        <span class="accordion-title">Accordion 3</span>
                        <span class="accordion-icon"></span>
                    </button>
                    <div class="accordion-panel">
                        <!-- wp:paragraph -->
                        <p>Content for Accordion 3.</p>
                        <!-- /wp:paragraph -->
                    </div>
                </div>
                <!-- /wp:rrze-elements/accordion-item -->
            </div>
            <!-- /wp:rrze-elements/accordion -->
        ',
        'categories'  => array( 'rrze-designsystem' ),
    )
);
