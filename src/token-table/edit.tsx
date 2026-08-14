import {
	BlockControls,
	InspectorControls,
	useBlockProps,
} from '@wordpress/block-editor';
import {
	CheckboxControl,
	PanelBody,
	RangeControl,
	SelectControl,
	TextControl,
	ToggleControl,
	ToolbarButton,
	ToolbarDropdownMenu,
	ToolbarGroup,
} from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { __, sprintf } from '@wordpress/i18n';
import ServerSideRender from '@wordpress/server-side-render';
import { seen, table } from '@wordpress/icons';
import { getTokenType, tokenTypes } from '../shared/token-types';
import metadata from './block.json';

type Term = {
	id: number;
	name: string;
	slug: string;
};

type Attributes = {
	tokenType: string;
	categories: string[];
	heading: string;
	showHeading: boolean;
	headingLevel: number;
	showCopy: boolean;
	compact: boolean;
	displayedFields: string[];
	swatchSize: number;
	swatchBorderRadius: number;
	colorLayout: string;
};

type EditProps = {
	attributes: Attributes;
	setAttributes: ( attributes: Partial< Attributes > ) => void;
};

const colorFields = [
	{ value: 'token_name', label: __( 'Token name', 'rrze-designsystem' ) },
	{ value: 'value', label: __( 'Value', 'rrze-designsystem' ) },
	{ value: 'use_case', label: __( 'Use case', 'rrze-designsystem' ) },
	{ value: 'pantone', label: __( 'Pantone', 'rrze-designsystem' ) },
	{ value: 'cmyk', label: __( 'CMYK', 'rrze-designsystem' ) },
	{ value: 'rgb', label: __( 'RGB', 'rrze-designsystem' ) },
	{ value: 'ral', label: __( 'RAL', 'rrze-designsystem' ) },
];

export default function Edit( { attributes, setAttributes }: EditProps ) {
	const blockProps = useBlockProps( {
		className: 'rrze-designsystem-token-table-editor',
	} );
	const currentType = getTokenType( attributes.tokenType );

	const terms = useSelect(
		( select: any ) =>
			select( 'core' ).getEntityRecords(
				'taxonomy',
				`${ currentType.value }_category`,
				{ per_page: -1, orderby: 'name', order: 'asc' }
			) as Term[] | null,
		[ currentType.value ]
	);

	const changeTokenType = ( tokenType: string ) => {
		const nextType = getTokenType( tokenType );
		setAttributes( {
			tokenType: nextType.value,
			categories: [],
			heading: nextType.heading,
		} );
	};

	const toggleCategory = ( slug: string, selected: boolean ) => {
		const categories = selected
			? [ ...attributes.categories, slug ]
			: attributes.categories.filter( ( category ) => category !== slug );
		setAttributes( { categories: Array.from( new Set( categories ) ) } );
	};

	const toggleDisplayedField = ( field: string, displayed: boolean ) => {
		const displayedFields = displayed
			? [ ...attributes.displayedFields, field ]
			: attributes.displayedFields.filter(
					( displayedField ) => displayedField !== field
			  );
		setAttributes( {
			displayedFields: Array.from( new Set( displayedFields ) ),
		} );
	};

	return (
		<div { ...blockProps }>
			<BlockControls>
				<ToolbarGroup>
					<ToolbarDropdownMenu
						icon={ table }
						label={ __( 'Choose token type', 'rrze-designsystem' ) }
						controls={ tokenTypes.map( ( tokenType ) => ( {
							title: tokenType.label,
							icon: tokenType.icon,
							isActive: tokenType.value === currentType.value,
							onClick: () => changeTokenType( tokenType.value ),
						} ) ) }
					/>
					<ToolbarButton
						icon={ seen }
						label={ __( 'Show heading', 'rrze-designsystem' ) }
						isPressed={ attributes.showHeading }
						onClick={ () =>
							setAttributes( {
								showHeading: ! attributes.showHeading,
							} )
						}
					/>
				</ToolbarGroup>
			</BlockControls>

			<InspectorControls>
				<PanelBody title={ __( 'Token table', 'rrze-designsystem' ) }>
					<SelectControl
						label={ __( 'Token type', 'rrze-designsystem' ) }
						value={ currentType.value }
						options={ tokenTypes.map( ( tokenType ) => ( {
							label: tokenType.label,
							value: tokenType.value,
						} ) ) }
						onChange={ changeTokenType }
					/>
					<ToggleControl
						label={ __( 'Show heading', 'rrze-designsystem' ) }
						checked={ attributes.showHeading }
						onChange={ ( showHeading ) =>
							setAttributes( { showHeading } )
						}
					/>
					{ attributes.showHeading && (
						<>
							<TextControl
								label={ __( 'Heading', 'rrze-designsystem' ) }
								value={ attributes.heading }
								onChange={ ( heading ) =>
									setAttributes( { heading } )
								}
							/>
							<SelectControl
								label={ __(
									'Heading level',
									'rrze-designsystem'
								) }
								value={ String( attributes.headingLevel ) }
								options={ [ 2, 3, 4, 5, 6 ].map(
									( level ) => ( {
										label: sprintf(
											/* translators: %d: heading level number. */
											__(
												'Heading %d',
												'rrze-designsystem'
											),
											level
										),
										value: String( level ),
									} )
								) }
								onChange={ ( headingLevel: string ) =>
									setAttributes( {
										headingLevel: Number( headingLevel ),
									} )
								}
							/>
						</>
					) }
					<ToggleControl
						label={ __( 'Show copy actions', 'rrze-designsystem' ) }
						checked={ attributes.showCopy }
						onChange={ ( showCopy ) =>
							setAttributes( { showCopy } )
						}
					/>
					<ToggleControl
						label={ __( 'Compact rows', 'rrze-designsystem' ) }
						checked={ attributes.compact }
						onChange={ ( compact ) => setAttributes( { compact } ) }
					/>
				</PanelBody>

				{ currentType.value === 'color' && (
					<PanelBody
						title={ __( 'Color display', 'rrze-designsystem' ) }
						initialOpen={ true }
					>
						<SelectControl
							label={ __( 'Layout', 'rrze-designsystem' ) }
							value={ attributes.colorLayout }
							options={ [
								{
									label: __( 'Table', 'rrze-designsystem' ),
									value: 'table',
								},
								{
									label: __(
										'Color tiles',
										'rrze-designsystem'
									),
									value: 'tiles',
								},
							] }
							onChange={ ( colorLayout ) =>
								setAttributes( { colorLayout } )
							}
						/>
						<p>
							{ __(
								'Select the information shown for each color.',
								'rrze-designsystem'
							) }
						</p>
						{ colorFields.map( ( field ) => (
							<CheckboxControl
								key={ field.value }
								label={ field.label }
								checked={ attributes.displayedFields.includes(
									field.value
								) }
								onChange={ ( displayed ) =>
									toggleDisplayedField(
										field.value,
										displayed
									)
								}
							/>
						) ) }
						<RangeControl
							label={ __( 'Swatch size', 'rrze-designsystem' ) }
							help={ __(
								'Size in pixels.',
								'rrze-designsystem'
							) }
							value={ attributes.swatchSize }
							min={ 8 }
							max={ 200 }
							onChange={ ( swatchSize ) =>
								setAttributes( { swatchSize } )
							}
						/>
						<RangeControl
							label={ __(
								'Swatch border radius',
								'rrze-designsystem'
							) }
							help={ __(
								'Radius in percent.',
								'rrze-designsystem'
							) }
							value={ attributes.swatchBorderRadius }
							min={ 0 }
							max={ 50 }
							onChange={ ( swatchBorderRadius ) =>
								setAttributes( { swatchBorderRadius } )
							}
						/>
					</PanelBody>
				) }

				<PanelBody
					title={ __( 'Categories', 'rrze-designsystem' ) }
					initialOpen={ false }
				>
					<p>
						{ __(
							'With no category selected, all published tokens are displayed.',
							'rrze-designsystem'
						) }
					</p>
					{ ( terms || [] ).map( ( term ) => (
						<CheckboxControl
							key={ term.id }
							label={ term.name }
							checked={ attributes.categories.includes(
								term.slug
							) }
							onChange={ ( selected ) =>
								toggleCategory( term.slug, selected )
							}
						/>
					) ) }
					{ terms && terms.length === 0 && (
						<p>
							{ __(
								'No categories found for this token type.',
								'rrze-designsystem'
							) }
						</p>
					) }
				</PanelBody>
			</InspectorControls>

			<ServerSideRender
				block={ metadata.name }
				attributes={ attributes }
			/>
		</div>
	);
}
