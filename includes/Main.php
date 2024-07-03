<?php

namespace RRZE\Designsystem;

defined('ABSPATH') || exit;


/**
 * Hauptklasse (Main)
 */
class Main
{
    /**
     * Der vollständige Pfad- und Dateiname der Plugin-Datei.
     * @var string
     */
    protected $pluginFile;

    protected $settings;


    /**
     * Variablen Werte zuweisen.
     * @param string $pluginFile Pfad- und Dateiname der Plugin-Datei
     */
    public function __construct($pluginFile)
    {
        $this->pluginFile = $pluginFile;

    }

    /**
     * Es wird ausgeführt, sobald die Klasse instanziiert wird.
     */
    public function onLoaded()
    {
        add_action('enqueue_block_editor_assets', [$this, 'enqueueScripts']);
        add_action('wp_enqueue_scripts', [$this, 'enqueueScripts']);
        add_action('admin_enqueue_scripts', [$this, 'enqueueScripts']);

        $this->settings = new Settings();
    }


    /**
     * Enqueue der globale Skripte.
     */
    public function enqueueScripts()
    {
        wp_enqueue_script('wp-i18n');
        wp_enqueue_script('rrze-designsystem', plugins_url('src/rrze-designsystem.js', plugin_basename($this->pluginFile)), array('jquery'), null, true);
        wp_enqueue_style('rrze-designsystem-css', plugins_url('src/rrze-designsystem.css', plugin_basename($this->pluginFile)));
    }



}
