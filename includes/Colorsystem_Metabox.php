<?php
namespace RRZE\Designsystem;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
class Colorsystem_Metabox {

    public static function register_metaboxes() {

        // Log i'm running
        error_log('I am running');
        $prefix = 'colorsystem_';

        $cmb = new_cmb2_box( array(
            'id'            => $prefix . 'metabox',
            'title'         => __( 'Color System Details', 'colorsystem' ),
            'object_types'  => array( 'colorsystem' ), // Post type
        ));

        $cmb->add_field( array(
            'name' => __( 'Hex Value', 'colorsystem' ),
            'desc' => __( 'Enter the hex color value', 'colorsystem' ),
            'id'   => $prefix . 'hex_value',
            'type' => 'colorpicker',
            'mode' => 'hex',
        ));

        $cmb->add_field( array(
            'name' => __( 'Color Name', 'colorsystem' ),
            'desc' => __( 'Enter a name for the color (e.g., 100, primary, variable name)', 'colorsystem' ),
            'id'   => $prefix . 'color_name',
            'type' => 'text',
        ));

        $cmb->add_field( array(
            'name' => __( 'Color Type', 'colorsystem' ),
            'desc' => __( 'Select if this is a primary, secondary, or another type of color', 'colorsystem' ),
            'id'   => $prefix . 'color_type',
            'type' => 'select',
            'options' => array(
                'primary'   => __( 'Primary', 'colorsystem' ),
                'secondary' => __( 'Secondary', 'colorsystem' ),
                'other'     => __( 'Other', 'colorsystem' ),
            ),
            'default' => 'primary',
        ));
    }
}
