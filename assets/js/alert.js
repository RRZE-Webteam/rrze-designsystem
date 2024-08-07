( function( blocks, element ) {
    var el = element.createElement;

    blocks.registerBlockType( 'rrze-designsystem/alert', {
        title: 'Alert',
        icon: 'warning',
        category: 'design',
        edit: function( props ) {
            return el(
                'div',
                { className: 'alert-editor' },
                el( 'p', {}, 'Alert Content' )
            );
        },
        save: function( props ) {
            return el(
                'div',
                { className: 'alert' },
                el( 'p', {}, 'Alert Content' )
            );
        }
    } );
} )( window.wp.blocks, window.wp.element );
