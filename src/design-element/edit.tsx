import {
	BlockControls,
	InspectorControls,
	useBlockProps,
} from '@wordpress/block-editor';
import {
	PanelBody,
	SelectControl,
	ToggleControl,
	ToolbarButton,
	ToolbarDropdownMenu,
	ToolbarGroup,
} from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { __, sprintf } from '@wordpress/i18n';
import { list, seen } from '@wordpress/icons';
import ServerSideRender from '@wordpress/server-side-render';
import metadata from './block.json';

type ElementRecord = {
	id: number;
	title: {
		rendered: string;
	};
};

type Attributes = {
	elementId: number;
	section: string;
	showTitle: boolean;
	headingLevel: number;
};

type EditProps = {
	attributes: Attributes;
	setAttributes: ( attributes: Partial< Attributes > ) => void;
};

const sections = [
	{ label: __( 'All sections', 'rrze-designsystem' ), value: '' },
	{ label: __( 'Overview', 'rrze-designsystem' ), value: 'overview' },
	{ label: __( 'Style', 'rrze-designsystem' ), value: 'style' },
	{ label: __( 'Guidelines', 'rrze-designsystem' ), value: 'guidelines' },
	{ label: __( 'Code', 'rrze-designsystem' ), value: 'code' },
	{
		label: __( 'Accessibility', 'rrze-designsystem' ),
		value: 'accessibility',
	},
];

export default function Edit( { attributes, setAttributes }: EditProps ) {
	const blockProps = useBlockProps( {
		className: 'rrze-designsystem-element-editor',
	} );
	const elements = useSelect(
		( select: any ) =>
			select( 'core' ).getEntityRecords( 'postType', 'elements', {
				per_page: -1,
				status: 'publish',
				orderby: 'title',
				order: 'asc',
			} ) as ElementRecord[] | null,
		[]
	);

	return (
		<div { ...blockProps }>
			<BlockControls>
				<ToolbarGroup>
					<ToolbarDropdownMenu
						icon={ list }
						label={ __( 'Choose section', 'rrze-designsystem' ) }
						controls={ sections.map( ( section ) => ( {
							title: section.label,
							isActive: attributes.section === section.value,
							onClick: () =>
								setAttributes( { section: section.value } ),
						} ) ) }
					/>
					<ToolbarButton
						icon={ seen }
						label={ __(
							'Show element title',
							'rrze-designsystem'
						) }
						isPressed={ attributes.showTitle }
						onClick={ () =>
							setAttributes( {
								showTitle: ! attributes.showTitle,
							} )
						}
					/>
				</ToolbarGroup>
			</BlockControls>

			<InspectorControls>
				<PanelBody
					title={ __( 'Design element', 'rrze-designsystem' ) }
				>
					<SelectControl
						label={ __( 'Element', 'rrze-designsystem' ) }
						value={ String( attributes.elementId ) }
						options={ [
							{
								label: __(
									'Choose an element',
									'rrze-designsystem'
								),
								value: '0',
							},
							...( elements || [] ).map( ( element ) => ( {
								label: element.title.rendered,
								value: String( element.id ),
							} ) ),
						] }
						onChange={ ( elementId: string ) =>
							setAttributes( { elementId: Number( elementId ) } )
						}
					/>
					<SelectControl
						label={ __( 'Section', 'rrze-designsystem' ) }
						value={ attributes.section }
						options={ sections }
						onChange={ ( section: string ) =>
							setAttributes( { section } )
						}
					/>
					<ToggleControl
						label={ __(
							'Show element title',
							'rrze-designsystem'
						) }
						checked={ attributes.showTitle }
						onChange={ ( showTitle ) =>
							setAttributes( { showTitle } )
						}
					/>
					{ attributes.showTitle && (
						<SelectControl
							label={ __( 'Title level', 'rrze-designsystem' ) }
							value={ String( attributes.headingLevel ) }
							options={ [ 2, 3, 4, 5, 6 ].map( ( level ) => ( {
								label: sprintf(
									/* translators: %d: heading level number. */
									__( 'Heading %d', 'rrze-designsystem' ),
									level
								),
								value: String( level ),
							} ) ) }
							onChange={ ( headingLevel: string ) =>
								setAttributes( {
									headingLevel: Number( headingLevel ),
								} )
							}
						/>
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
