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
        $activePlugins = array();

        foreach ($this->supportedPlugins as $key => $functionName) {
            if (defined($functionName) || function_exists($functionName)) {
                array_push($activePlugins, $key);
            }
        }

        return $activePlugins;
    }
}
