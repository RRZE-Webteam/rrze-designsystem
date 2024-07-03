<?php

namespace RRZE\Designsystem;

use RRZE\ShortURL\CustomException;

class Settings
{
    public function __construct()
    {
        add_action('admin_menu', [$this, 'add_options_page']);
        add_action('admin_init', [$this, 'register_settings']);

    }

    // Add a menu item to the Settings menu
    public function add_options_page()
    {
        add_options_page(
            'RRZE Designsystem',
            'RRZE Designsystem',
            'manage_options',
            'rrze-designsystem',
            [$this, 'render_options_page']
        );
    }


    // Register settings sections and fields
    public function register_settings()
    {
        // General tab settings
        add_settings_section(
            'rrze_designsystem_general_section',
            '&nbsp;',
            [$this, 'render_general_section'],
            'rrze_designsystem_general'
        );

        register_setting('rrze_designsystem_general', 'rrze_designsystem_general');
    }



    // Render the options page
    public function render_options_page()
    {
        $_GET['tab'] = (empty($_GET['tab']) ? 'general' : $_GET['tab']);

        ?>
        <div class="wrap">
            <h1>RRZE Designsystem Settings</h1>
            <?php settings_errors(); ?>

            <h2 class="nav-tab-wrapper">
                <a href="?page=rrze-designsystem&tab=general"
                    class="nav-tab <?php echo isset($_GET['tab']) && $_GET['tab'] === 'general' ? 'nav-tab-active' : ''; ?>"><?php echo __('General', 'rrze-designsystem'); ?></a>
            </h2>

            <div class="tab-content">
                <?php
                $current_tab = isset($_GET['tab']) ? $_GET['tab'] : 'services';
                switch ($current_tab) {
                    case 'general':
                        settings_fields('rrze_designsystem_general');
                        do_settings_sections('rrze_designsystem_general');
                        break;
                    default:
                        settings_fields('rrze_designsystem_services');
                        do_settings_sections('rrze_designsystem_services');
                }
                ?>
            </div>
        </div>
        <?php
    }


    // Render the General tab section
    public function render_general_section()
    {
        ?>

        <div class="wrap">
            This div is empty.
        </div>
        <?php
    }

}

