<?php
register_block_pattern(
    'rrze-designsystem/alert-pattern',
    array(
        'title'       => __( 'Alert Pattern', 'rrze-designsystem' ),
        'description' => _x( 'A pattern for alert blocks', 'Block pattern description', 'rrze-designsystem' ),
        'content'     => "<!-- wp:rrze-designsystem/alert -->
                            <div class='wp-block-rrze-designsystem-alert alert'>
                                <p>Alert Content</p>
                            </div>
                          <!-- /wp:rrze-designsystem/alert -->",
        'categories'  => array( 'rrze-designsystem' ),
    )
);
