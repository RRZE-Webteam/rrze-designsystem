<?php
namespace RRZE\Designsystem\Tokens\Colorsystem;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
class Colorsystem_Metabox {
    public static function register_metaboxes() {

        // Log i'm running
        error_log('I am running COLORSYSTEM METABOX');
        $prefix = 'colorsystem_';

        $cmb = new_cmb2_box( array(
            'id'            => $prefix . 'metabox',
            'title'         => __( 'Color System Details', 'rrze-designsystem' ),
            'object_types'  => array( 'colorsystem' ), // Post type
        ));

        $cmb->add_field( array(
            'name' => __( 'Hex Value', 'rrze-designsystem' ),
            'desc' => __( 'Enter the hex color value', 'rrze-designsystem' ),
            'id'   => $prefix . 'hex_value',
            'type' => 'colorpicker',
            'mode' => 'hex',
        ));

        $cmb->add_field( array(
            'name' => __( 'Color Name', 'rrze-designsystem' ),
            'desc' => __( 'Enter a name for the color (e.g., 100, primary, variable name)', 'rrze-designsystem' ),
            'id'   => $prefix . 'color_name',
            'type' => 'text',
        ));

        $cmb->add_field( array(
            'name' => __( 'Color Type', 'rrze-designsystem' ),
            'desc' => __( 'Select if this is a primary, secondary, or another type of color', 'rrze-designsystem' ),
            'id'   => $prefix . 'color_type',
            'type' => 'select',
            'options' => array(
                'primary'   => __( 'Primary', 'rrze-designsystem' ),
                'secondary' => __( 'Secondary', 'rrze-designsystem' ),
                'other'     => __( 'Other', 'rrze-designsystem' ),
            ),
            'default' => 'primary',
        ));
    }
}
