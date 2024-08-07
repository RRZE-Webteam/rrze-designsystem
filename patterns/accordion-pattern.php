<?php
register_block_pattern(
    'rrze-designsystem/accordion-pattern',
    array(
        'title'       => __( 'Accordion Pattern', 'rrze-designsystem' ),
        'description' => _x( 'A pattern for accordion blocks', 'Block pattern description', 'rrze-designsystem' ),
        'content'     => "<!-- wp:rrze-designsystem/accordion -->
                            <div class='wp-block-rrze-designsystem-accordion accordion'>
                                <p>Accordion Content</p>
                            </div>
                          <!-- /wp:rrze-designsystem/accordion -->",
        'categories'  => array( 'rrze-designsystem' ),
    )
);
