<?php
register_block_pattern(
    'rrze-designsystem/code-status-pattern',
    array(
        'title'       => __( 'Code Status Pattern', 'rrze-designsystem' ),
        'description' => _x( 'A pattern for design code status blocks', 'Block pattern description', 'rrze-designsystem' ),
        'content'     => '
            <!-- wp:group {"className":"code-status"} -->
            <div class="wp-block-group code-status">
                <!-- wp:heading {"level":2} -->
                <h2>Design & Code Status</h2>
                <!-- /wp:heading -->
                
                <!-- wp:columns -->
                <div class="wp-block-columns">
                    <!-- wp:column -->
                    <div class="wp-block-column">
                        <!-- wp:heading {"level":3} -->
                        <h3>In Development</h3>
                        <!-- /wp:heading -->
                        <!-- wp:list -->
                        <ul>
                            <li>Component 1</li>
                            <li>Component 2</li>
                            <li>Component 3</li>
                        </ul>
                        <!-- /wp:list -->
                    </div>
                    <!-- /wp:column -->
                    
                    <!-- wp:column -->
                    <div class="wp-block-column">
                        <!-- wp:heading {"level":3} -->
                        <h3>In Review</h3>
                        <!-- /wp:heading -->
                        <!-- wp:list -->
                        <ul>
                            <li>Component 4</li>
                            <li>Component 5</li>
                            <li>Component 6</li>
                        </ul>
                        <!-- /wp:list -->
                    </div>
                    <!-- /wp:column -->
                    
                    <!-- wp:column -->
                    <div class="wp-block-column">
                        <!-- wp:heading {"level":3} -->
                        <h3>In Testing</h3>
                        <!-- /wp:heading -->
                        <!-- wp:list -->
                        <ul>
                            <li>Component 7</li>
                            <li>Component 8</li>
                            <li>Component 9</li>
                        </ul>
                        <!-- /wp:list -->
                    </div>
                    <!-- /wp:column -->
                </div>
                <!-- /wp:columns -->
                
                <!-- wp:columns -->
                <div class="wp-block-columns">
                    <!-- wp:column -->
                    <div class="wp-block-column">
                        <!-- wp:heading {"level":3} -->
                        <h3>Ready for Production</h3>
                        <!-- /wp:heading -->
                        <!-- wp:list -->
                        <ul>
                            <li>Component 10</li>
                            <li>Component 11</li>
                            <li>Component 12</li>
                        </ul>
                        <!-- /wp:list -->
                    </div>
                    <!-- /wp:column -->
                    
                    <!-- wp:column -->
                    <div class="wp-block-column">
                        <!-- wp:heading {"level":3} -->
                        <h3>Deprecated</h3>
                        <!-- /wp:heading -->
                        <!-- wp:list -->
                        <ul>
                            <li>Component 13</li>
                            <li>Component 14</li>
                            <li>Component 15</li>
                        </ul>
                        <!-- /wp:list -->
                    </div>
                    <!-- /wp:column -->
                </div>
                <!-- /wp:columns -->
            </div>
            <!-- /wp:group -->
        ',
        'categories'  => array( 'rrze-designsystem' ),
    )
);
