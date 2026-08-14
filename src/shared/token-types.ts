import { __ } from '@wordpress/i18n';
import {
	arrowRight,
	code,
	color,
	columns,
	cover,
	grid,
	seen,
	starEmpty,
	starFilled,
	table,
	title,
} from '@wordpress/icons';

export type TokenType = {
	value: string;
	label: string;
	heading: string;
	description: string;
	icon: JSX.Element;
};

export const tokenTypes: TokenType[] = [
	{
		value: 'color',
		label: __( 'Color Tokens', 'rrze-designsystem' ),
		heading: __( 'Colors', 'rrze-designsystem' ),
		description: __(
			'Display color tokens and their visual swatches.',
			'rrze-designsystem'
		),
		icon: color,
	},
	{
		value: 'font',
		label: __( 'Font Tokens', 'rrze-designsystem' ),
		heading: __( 'Typography', 'rrze-designsystem' ),
		description: __(
			'Display font and typography tokens.',
			'rrze-designsystem'
		),
		icon: title,
	},
	{
		value: 'space',
		label: __( 'Space Tokens', 'rrze-designsystem' ),
		heading: __( 'Spacing', 'rrze-designsystem' ),
		description: __(
			'Display spacing tokens with size previews.',
			'rrze-designsystem'
		),
		icon: grid,
	},
	{
		value: 'boxshadow',
		label: __( 'Box Shadow Tokens', 'rrze-designsystem' ),
		heading: __( 'Box Shadows', 'rrze-designsystem' ),
		description: __(
			'Display box-shadow tokens and previews.',
			'rrze-designsystem'
		),
		icon: starFilled,
	},
	{
		value: 'opacity',
		label: __( 'Opacity Tokens', 'rrze-designsystem' ),
		heading: __( 'Opacity', 'rrze-designsystem' ),
		description: __(
			'Display opacity tokens and previews.',
			'rrze-designsystem'
		),
		icon: seen,
	},
	{
		value: 'length',
		label: __( 'Length Tokens', 'rrze-designsystem' ),
		heading: __( 'Lengths', 'rrze-designsystem' ),
		description: __(
			'Display length tokens with scale previews.',
			'rrze-designsystem'
		),
		icon: arrowRight,
	},
	{
		value: 'breakpoint',
		label: __( 'Breakpoint Tokens', 'rrze-designsystem' ),
		heading: __( 'Breakpoints', 'rrze-designsystem' ),
		description: __(
			'Display responsive breakpoint tokens.',
			'rrze-designsystem'
		),
		icon: columns,
	},
	{
		value: 'mediaquery',
		label: __( 'Media Query Tokens', 'rrze-designsystem' ),
		heading: __( 'Media Queries', 'rrze-designsystem' ),
		description: __(
			'Display reusable media-query tokens.',
			'rrze-designsystem'
		),
		icon: code,
	},
	{
		value: 'border',
		label: __( 'Border Tokens', 'rrze-designsystem' ),
		heading: __( 'Borders', 'rrze-designsystem' ),
		description: __(
			'Display border tokens and previews.',
			'rrze-designsystem'
		),
		icon: cover,
	},
	{
		value: 'icon',
		label: __( 'Icon Tokens', 'rrze-designsystem' ),
		heading: __( 'Icons', 'rrze-designsystem' ),
		description: __(
			'Display icon tokens in a reference table.',
			'rrze-designsystem'
		),
		icon: starEmpty,
	},
];

export const tokenTableIcon = table;

export const getTokenType = ( value: string ): TokenType =>
	tokenTypes.find( ( type ) => type.value === value ) || tokenTypes[ 0 ];
