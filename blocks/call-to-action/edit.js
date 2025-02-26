/**
 * WordPress dependencies
 */

import { useBlockProps, RichText, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';

/**
 * The Edit function renders the block inside the Gutenberg editor.
 *
 * @param {Object}   props                Component properties.
 * @param {Object}   props.attributes     Block attributes.
 * @param {Function} props.setAttributes  Function to update block attributes.
 * @returns {JSX.Element} The block's edit UI.
 */

const Edit = ({ attributes, setAttributes }) => {
    const { title, description, buttonText, buttonUrl } = attributes;

    return (
        <>
            <InspectorControls>
                <PanelBody title="Button Settings">
                    <TextControl
                        label="Button Text"
                        value={buttonText}
                        onChange={(value) => setAttributes({ buttonText: value })}
                    />
                    <TextControl
                        label="Button URL"
                        value={buttonUrl}
                        onChange={(value) => setAttributes({ buttonUrl: value })}
                    />
                </PanelBody>
            </InspectorControls>
            <div { ...useBlockProps({ className: 'cta-block' }) }>
                <RichText
                    tagName="h2"
                    value={title}
                    onChange={(value) => setAttributes({ title: value })}
                    placeholder="Enter title..."
                />
                <RichText
                    tagName="p"
                    value={description}
                    onChange={(value) => setAttributes({ description: value })}
                    placeholder="Enter description..."
                />
                <a 
                    href={buttonUrl.startsWith('http') ? buttonUrl : `https://${buttonUrl}`} 
                    className="cta-button"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    {buttonText}
                </a>
            </div>
        </>
    );
};

export default Edit;