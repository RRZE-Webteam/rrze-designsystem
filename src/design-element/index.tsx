import { registerBlockType } from '@wordpress/blocks';
import { layout } from '@wordpress/icons';
import Edit from './edit';
import metadata from './block.json';
import './editor.scss';
import './style.scss';

registerBlockType(
	metadata.name as any,
	{
		icon: layout,
		edit: Edit,
		save: (): null => null,
	} as any
);
