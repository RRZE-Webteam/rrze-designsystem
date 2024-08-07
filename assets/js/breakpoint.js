( function( blocks, element, blockEditor ) {
    var el = element.createElement;
    var useBlockProps = blockEditor.useBlockProps;

    blocks.registerBlockType( 'rrze-designsystem/breakpoint', {
        title: 'Breakpoint',
        icon: 'admin-site-alt3',
        category: 'design',
        edit: function( props ) {
            return el(
                'div',
                useBlockProps({ className: 'rrze-designsystem-breakpoint-editor' }),
                el( 'h1', {}, 'Breakpoint Tokens' ),
                el( 'p', {}, 'Breakpoint tokens are used to define the responsive breakpoints in your designs. These tokens can be used in CSS media queries to create responsive layouts.' ),
                el( 'h2', {}, 'Usage' ),
                el( 'p', {}, 'Use the following tokens in your CSS to apply the corresponding breakpoints:' ),
                el( 'pre', {},
                    el( 'code', {},
                        '@media (min-width: var(--breakpoint-sm)) { ... }' + '\n' +
                        '@media (min-width: var(--breakpoint-md)) { ... }' + '\n' +
                        '@media (min-width: var(--breakpoint-lg)) { ... }' + '\n' +
                        '@media (min-width: var(--breakpoint-xl)) { ... }'
                    )
                )
            );
        },
        save: function( props ) {
            return el(
                'div',
                useBlockProps.save({ className: 'rrze-designsystem-breakpoint' }),
                el( 'h1', {}, 'Breakpoint Tokens' ),
                el( 'p', {}, 'Breakpoint tokens are used to define the responsive breakpoints in your designs. These tokens can be used in CSS media queries to create responsive layouts.' ),
                el( 'h2', {}, 'Usage' ),
                el( 'p', {}, 'Use the following tokens in your CSS to apply the corresponding breakpoints:' ),
                el( 'pre', {},
                    el( 'code', {},
                        '@media (min-width: var(--breakpoint-sm)) { ... }' + '\n' +
                        '@media (min-width: var(--breakpoint-md)) { ... }' + '\n' +
                        '@media (min-width: var(--breakpoint-lg)) { ... }' + '\n' +
                        '@media (min-width: var(--breakpoint-xl)) { ... }'
                    )
                )
            );
        }
    });
} )( window.wp.blocks, window.wp.element, window.wp.blockEditor );
