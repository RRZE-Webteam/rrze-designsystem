import { useBlockProps } from '@wordpress/block-editor';
import { createElement as el } from '@wordpress/element';
import { sanitizeHTML } from '@wordpress/escape';

const Save = (props) => {
    const { attributes: { content, alignment } } = props;

    // Sanitize and escape HTML content
    const sanitizedContent = sanitizeHTML(content);

    return el(
        'pre',
        { style: { textAlign: alignment } },
        el('code', { dangerouslySetInnerHTML: { __html: sanitizedContent } })
    );
};

export default Save;
