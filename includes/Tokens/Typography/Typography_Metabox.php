<?php
namespace RRZE\Designsystem\Tokens\Typography;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Typography_Metabox {

    public static function register_metaboxes() {
        $prefix = 'typographysystem_';

        $cmb = new_cmb2_box( array(
            'id'            => $prefix . 'metabox',
            'title'         => __( 'Typography System Details', 'typographysystem' ),
            'object_types'  => array( 'typographysystem' ),
        ));

        $cmb->add_field( array(
            'name' => __( 'Font Family', 'typographysystem' ),
            'desc' => __( 'Enter the font-family (e.g., Arial, "Helvetica Neue", sans-serif)', 'typographysystem' ),
            'id'   => $prefix . 'font_family',
            'type' => 'text',
        ));

        $cmb->add_field( array(
            'name' => __( 'Font Size', 'typographysystem' ),
            'desc' => __( 'Enter the font-size (e.g., 16px, 1.5em, 100%)', 'typographysystem' ),
            'id'   => $prefix . 'font_size',
            'type' => 'text',
        ));

        $cmb->add_field( array(
            'name' => __( 'Font Weight', 'typographysystem' ),
            'desc' => __( 'Enter the font-weight (e.g., normal, bold, 400)', 'typographysystem' ),
            'id'   => $prefix . 'font_weight',
            'type' => 'text',
        ));

        $cmb->add_field( array(
            'name' => __( 'Line Height', 'typographysystem' ),
            'desc' => __( 'Enter the line-height (e.g., 1.5, 150%)', 'typographysystem' ),
            'id'   => $prefix . 'line_height',
            'type' => 'text',
        ));

        $cmb->add_field( array(
            'name' => __( 'Letter Spacing', 'typographysystem' ),
            'desc' => __( 'Enter the letter-spacing (e.g., 0.05em, 1px)', 'typographysystem' ),
            'id'   => $prefix . 'letter_spacing',
            'type' => 'text',
        ));
    }
}
