<?php
/**
 * Gives access to the WordPress plugin API
 */
if (!function_exists('get_plugins')) {
    require_once ABSPATH . 'wp-admin/includes/plugin.php';
}

/**
 * Detects the user's current active plugins that Shirshu supports
 *
 * Class PluginDetector
 */
class PluginDetector {
    /**
     * A list of Shirshu supported plugins
     *
     * @var array of strings
     */
    private $supportedPlugins = null;

    /**
     * PluginDetector constructor.
     * @param $supportedPlugins
     */
    public function __construct($supportedPlugins) {
        $this->supportedPlugins = $supportedPlugins;
    }

    /**
     * Determines the user's current active plugins that Shirshu supports
     *
     * @return array of strings
     */
    public function getActivePlugins() {
        $plugins = get_plugins();
        $plugin_keys = array_keys($plugins);
        $activePlugins = array();

        foreach ($plugin_keys as $plugin_key) {
            $potentialPluginName = $plugins[$plugin_key]['Name'];
            if (in_array($potentialPluginName, $this->supportedPlugins) && is_plugin_active( $plugin_key)) {
                array_push($activePlugins, $potentialPluginName);
            }
        }

        return $activePlugins;
    }
}
