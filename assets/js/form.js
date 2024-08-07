( function( blocks, element, blockEditor ) {
    var el = element.createElement;
    var useBlockProps = blockEditor.useBlockProps;

    blocks.registerBlockType( 'rrze-designsystem/form', {
        title: 'Form',
        icon: 'feedback',
        category: 'design',
        edit: function( props ) {
            return el(
                'form',
                useBlockProps({ className: 'rrze-designsystem-form-editor' }),
                el( 'div', { className: 'rrze-designsystem-form-field' },
                    el( 'label', {}, 'Name' ),
                    el( 'input', { type: 'text', placeholder: 'Enter your name' } )
                ),
                el( 'div', { className: 'rrze-designsystem-form-field' },
                    el( 'label', {}, 'Email' ),
                    el( 'input', { type: 'email', placeholder: 'Enter your email' } )
                ),
                el( 'div', { className: 'rrze-designsystem-form-field' },
                    el( 'label', {}, 'Message' ),
                    el( 'textarea', { placeholder: 'Enter your message' } )
                ),
                el( 'div', { className: 'rrze-designsystem-form-field' },
                    el( 'button', { type: 'submit' }, 'Submit' )
                )
            );
        },
        save: function( props ) {
            return el(
                'form',
                useBlockProps.save({ className: 'rrze-designsystem-form' }),
                el( 'div', { className: 'rrze-designsystem-form-field' },
                    el( 'label', {}, 'Name' ),
                    el( 'input', { type: 'text', placeholder: 'Enter your name' } )
                ),
                el( 'div', { className: 'rrze-designsystem-form-field' },
                    el( 'label', {}, 'Email' ),
                    el( 'input', { type: 'email', placeholder: 'Enter your email' } )
                ),
                el( 'div', { className: 'rrze-designsystem-form-field' },
                    el( 'label', {}, 'Message' ),
                    el( 'textarea', { placeholder: 'Enter your message' } )
                ),
                el( 'div', { className: 'rrze-designsystem-form-field' },
                    el( 'button', { type: 'submit' }, 'Submit' )
                )
            );
        }
    });
} )( window.wp.blocks, window.wp.element, window.wp.blockEditor );
