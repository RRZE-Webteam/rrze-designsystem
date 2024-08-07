( function( blocks, element ) {
    var el = element.createElement;

    blocks.registerBlockType( 'rrze-designsystem/accordion', {
        title: 'Accordion',
        icon: 'list-view',
        category: 'design',
        edit: function( props ) {
            return el(
                'div',
                { className: 'wp-block-rrze-designsystem-accordion accordion' },
                el( 'p', {}, 'Accordion Content' )
            );
        },
        save: function( props ) {
            return el(
                'div',
                { className: 'wp-block-rrze-designsystem-accordion accordion' },
                el( 'p', {}, 'Accordion Content' )
            );
        }
    } );
} )( window.wp.blocks, window.wp.element );
