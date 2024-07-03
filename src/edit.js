import { useBlockProps, RichText, BlockControls, AlignmentToolbar } from '@wordpress/block-editor';
import { createElement as el } from '@wordpress/element';

const Edit = (props) => {
    const { attributes: { content, alignment }, setAttributes, className } = props;

    const onChangeContent = (newContent) => {
        setAttributes({ content: newContent });
    };

    const onChangeAlignment = (newAlignment) => {
        setAttributes({ alignment: newAlignment === undefined ? 'none' : newAlignment });
    };

    return [
        el(
            BlockControls,
            { key: 'controls' },
            el(AlignmentToolbar, {
                value: alignment,
                onChange: onChangeAlignment,
            })
        ),
        el(
            'pre',
            { style: { textAlign: alignment } },
            el(RichText, {
                tagName: 'code',
                className,
                onChange: onChangeContent,
                value: content,
                placeholder: 'Geben Sie Ihren Code hier ein...',
            })
        )
    ];
};

export default Edit;
