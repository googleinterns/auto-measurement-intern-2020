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
 * Class Detector
 */
class Detector {
    /**
     * A list of Shirshu supported plugins
     *
     * @var array of strings
     */
    private $supportedPlugins = null;

    /**
     * Detector constructor.
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

        for ($i = 0; $i < count($plugin_keys); $i++) {
            $potentialPluginName = $plugins[$plugin_keys[$i]]['Name'];
            if (in_array($potentialPluginName, $this->supportedPlugins) && is_plugin_active( $plugin_keys[$i])) {
                array_push($activePlugins, $potentialPluginName);
            }
        }

        return $activePlugins;
    }
}
