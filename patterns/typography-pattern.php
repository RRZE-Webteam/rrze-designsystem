<?php
register_block_pattern(
    'rrze-designsystem/typography-pattern',
    array(
        'title'       => __( 'Typography Pattern', 'rrze-designsystem' ),
        'description' => _x( 'A pattern for typography blocks', 'Block pattern description', 'rrze-designsystem' ),
        'content'     => '
            <!-- wp:rrze-designsystem/typography -->
            <div class="rrze-designsystem-typography">
                <h1>Font Tokens</h1>
                <p>Font tokens are used to apply font properties to the text in your designs. This includes the font family, size, weight, and line height.</p>
                <h2>Usage</h2>
                <p>Use the following tokens in your CSS to apply the corresponding font styles:</p>
                <pre>
                    <code>
                        font-family: var(--font-family-base);<br>
                        font-size: var(--font-size-lg);<br>
                        font-weight: var(--font-weight-bold);<br>
                        line-height: var(--line-height-base);
                    </code>
                </pre>
            </div>
            <!-- /wp:rrze-designsystem/typography -->
        ',
        'categories'  => array( 'rrze-designsystem' ),
    )
);
