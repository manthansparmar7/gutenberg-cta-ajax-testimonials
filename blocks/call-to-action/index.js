/**
 * WordPress dependencies
 */

import { registerBlockType } from '@wordpress/blocks';

/**
 * Internal dependencies
 */

import Edit from './edit';
import Save from './save';

/**
 * Register the block.
 */

registerBlockType('gutenberg-cta-ajax-testimonials/call-to-action', {
    title: 'Call to Action',
    icon: 'megaphone',
    category: 'widgets',
    attributes: {
        title: { type: 'string', default: 'Call to Action Title' },
        description: { type: 'string', default: 'This is a call to action description.' },
        buttonText: { type: 'string', default: 'Click Here' },
        buttonUrl: { type: 'string', default: '#' },
    },

    /**
     * The edit function responsible for rendering the block in the editor.
     * @see ./edit.js
     */

    edit: Edit,

    /**
     * The save function responsible for rendering the block on the front-end.
     * @see ./save.js
     */
    save: Save,
});