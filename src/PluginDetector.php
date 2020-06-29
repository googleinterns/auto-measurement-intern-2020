<?php
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
        $plugin_keys = array_keys($this->supportedPlugins);
        $activePlugins = array();

        foreach ($plugin_keys as $key) {
            if (defined($this->supportedPlugins[$key]) || function_exists($this->supportedPlugins[$key])) {
                array_push($activePlugins, $key);
            }
        }

        return $activePlugins;
    }
}
