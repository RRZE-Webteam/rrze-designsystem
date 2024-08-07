<?php
register_block_pattern(
    'rrze-designsystem/breakpoint-pattern',
    array(
        'title'       => __( 'Breakpoint Pattern', 'rrze-designsystem' ),
        'description' => _x( 'A pattern for breakpoint blocks', 'Block pattern description', 'rrze-designsystem' ),
        'content'     => '
            <!-- wp:rrze-designsystem/breakpoint -->
            <div class="rrze-designsystem-breakpoint">
                <h1>Breakpoint Tokens</h1>
                <p>Breakpoint tokens are used to define the responsive breakpoints in your designs. These tokens can be used in CSS media queries to create responsive layouts.</p>
                <h2>Usage</h2>
                <p>Use the following tokens in your CSS to apply the corresponding breakpoints:</p>
                <pre>
                    <code>
                        @media (min-width: var(--breakpoint-sm)) { ... }<br>
                        @media (min-width: var(--breakpoint-md)) { ... }<br>
                        @media (min-width: var(--breakpoint-lg)) { ... }<br>
                        @media (min-width: var(--breakpoint-xl)) { ... }
                    </code>
                </pre>
            </div>
            <!-- /wp:rrze-designsystem/breakpoint -->
        ',
        'categories'  => array( 'rrze-designsystem' ),
    )
);
