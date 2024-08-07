( function( blocks, element, blockEditor ) {
    var el = element.createElement;
    var useBlockProps = blockEditor.useBlockProps;

    blocks.registerBlockType( 'rrze-designsystem/typography', {
        title: 'Typography',
        icon: 'editor-textcolor',
        category: 'design',
        edit: function( props ) {
            return el(
                'div',
                useBlockProps({ className: 'rrze-designsystem-typography-editor' }),
                el( 'h1', {}, 'Font Tokens' ),
                el( 'p', {}, 'Font tokens are used to apply font properties to the text in your designs. This includes the font family, size, weight, and line height.' ),
                el( 'h2', {}, 'Usage' ),
                el( 'p', {}, 'Use the following tokens in your CSS to apply the corresponding font styles:' ),
                el( 'pre', {},
                    el( 'code', {},
                        'font-family: var(--font-family-base);' + '\n' +
                        'font-size: var(--font-size-lg);' + '\n' +
                        'font-weight: var(--font-weight-bold);' + '\n' +
                        'line-height: var(--line-height-base);'
                    )
                )
            );
        },
        save: function( props ) {
            return el(
                'div',
                useBlockProps.save({ className: 'rrze-designsystem-typography' }),
                el( 'h1', {}, 'Font Tokens' ),
                el( 'p', {}, 'Font tokens are used to apply font properties to the text in your designs. This includes the font family, size, weight, and line height.' ),
                el( 'h2', {}, 'Usage' ),
                el( 'p', {}, 'Use the following tokens in your CSS to apply the corresponding font styles:' ),
                el( 'pre', {},
                    el( 'code', {},
                        'font-family: var(--font-family-base);' + '\n' +
                        'font-size: var(--font-size-lg);' + '\n' +
                        'font-weight: var(--font-weight-bold);' + '\n' +
                        'line-height: var(--line-height-base);'
                    )
                )
            );
        }
    });
} )( window.wp.blocks, window.wp.element, window.wp.blockEditor );
