import { registerBlockType, registerBlockVariation } from '@wordpress/blocks';
import {
	getTokenType,
	tokenTableIcon,
	tokenTypes,
} from '../shared/token-types';
import Edit from './edit';
import metadata from './block.json';
import './editor.scss';
import './style.scss';

registerBlockType(
	metadata.name as any,
	{
		icon: tokenTableIcon,
		edit: Edit,
		save: (): null => null,
	} as any
);

tokenTypes.forEach( ( tokenType, index ) => {
	registerBlockVariation( metadata.name, {
		name: tokenType.value,
		title: tokenType.label,
		description: tokenType.description,
		icon: tokenType.icon,
		attributes: {
			tokenType: tokenType.value,
			heading: tokenType.heading,
		},
		isDefault: index === 0,
		isActive: ( attributes: { tokenType?: string } ) =>
			getTokenType( attributes.tokenType || 'color' ).value ===
			tokenType.value,
		scope: [ 'inserter', 'transform' ],
	} );
} );
