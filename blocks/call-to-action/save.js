/**
 * WordPress dependencies
 */
import { useBlockProps } from '@wordpress/block-editor';

/**
 * The Save function defines how the block is rendered on the front-end.
 *
 * @param {Object} props          Component properties.
 * @param {Object} props.attributes Block attributes.
 * @returns {JSX.Element} The block's saved output.
 */
const Save = ({ attributes }) => {
    const { title, description, buttonText, buttonUrl } = attributes;

    // Ensure the URL is valid. If empty, default to "#".
    const validUrl = buttonUrl && (buttonUrl.startsWith('http://') || buttonUrl.startsWith('https://'))
        ? buttonUrl
        : buttonUrl
        ? `https://${buttonUrl}`
        : '#';

    return (
        <div { ...useBlockProps.save({ className: 'cta-block' }) }>
            <h2>{title}</h2>
            <p>{description}</p>
            <a href={validUrl} className="cta-button">
                {buttonText}
            </a>
        </div>
    );
};

export default Save;