<?php
register_block_pattern(
    'rrze-designsystem/form-pattern',
    array(
        'title'       => __( 'Form Pattern', 'rrze-designsystem' ),
        'description' => _x( 'A pattern for forms', 'Block pattern description', 'rrze-designsystem' ),
        'content'     => '
            <!-- wp:rrze-designsystem/form -->
            <form class="rrze-designsystem-form">
                <div class="rrze-designsystem-form-field">
                    <label>Name</label>
                    <input type="text" placeholder="Enter your name" />
                </div>
                <div class="rrze-designsystem-form-field">
                    <label>Email</label>
                    <input type="email" placeholder="Enter your email" />
                </div>
                <div class="rrze-designsystem-form-field">
                    <label>Message</label>
                    <textarea placeholder="Enter your message"></textarea>
                </div>
                <div class="rrze-designsystem-form-field">
                    <button type="submit">Submit</button>
                </div>
            </form>
            <!-- /wp:rrze-designsystem/form -->
        ',
        'categories'  => array( 'rrze-designsystem' ),
    )
);
