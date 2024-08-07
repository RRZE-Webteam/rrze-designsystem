<?php

class BlockLoader {

    public static function register_blocks() {
        self::register_block_type( 'accordion', 'class-accordion-block.php' );
        self::register_block_type( 'alert', 'class-alert-block.php' );
    }

    private static function register_block_type( $block_name, $class_file ) {
        require_once RRZE_DESIGNSYSTEM_PLUGIN_DIR . 'includes/' . $class_file;
        $class_name = ucfirst( $block_name ) . 'Block';
        if ( class_exists( $class_name ) ) {
            new $class_name();
        } else {
            throw new Exception( "Class $class_name not found." );
        }
    }
}
