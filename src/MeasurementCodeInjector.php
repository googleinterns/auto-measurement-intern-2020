<?php
include 'PluginDetector.php';
include 'ContactFormInjector.php';
include 'FormidableFormInjector.php';
include 'NinjaFormInjector.php';
include 'WoocommerceInjector.php';
include 'WPFormInjector.php';

/**
 * Injects Javascript based on the current active plugins
 *
 * Class Injector
 */
class MeasurementCodeInjector {
    /**
     * A list of user's current active plugins that Shirshu supports
     *
     * @var array of string
     */
    private $activePlugins = null;

    /**
     * Plugin PluginDetector
     *
     * @var PluginDetector
     */
    private $pluginDetector = null;

    /**
     * Map of the plugin name to the measurement code injector object customized to each plugin
     *
     * @var array
     */
    private $codeInjectorMap = null;

    /**
     * List of code injector of active plugins
     *
     * @var array
     */
    private $codeInjectorList = null;


    /**
     * Injector constructor.
     * @param $supportedPlugins
     * @param $codeInjectorMap
     */
    public function __construct($supportedPlugins, $codeInjectorMap) {
        $this->pluginDetector = new PluginDetector($supportedPlugins);

        $this->codeInjectorMap = $codeInjectorMap;

        add_action('plugins_loaded', array($this, 'injectMeasurementCode'));
    }

    /**
     * Determines active plugins once WordPress loads plugins and injects measurement code to the web page
     */
    public function injectMeasurementCode() {
        $this->activePlugins = $this->pluginDetector->getActivePlugins();

        $this->codeInjectorList = $this->createCodeInjectorList($this->activePlugins);

        add_action('wp_footer', array($this, 'injectCodeList'));
        add_action('wp_footer', array($this, 'woocommerce_ajax_review_cart'), 999);
    }

    /**
     * Injects code for review cart button of WooCommerce
     */
    public function woocommerce_ajax_review_cart() {
        echo '
        <script>
            jQuery(function($) {
                $(document.body).on("added_to_cart", function() {
                    if (document.querySelector("a.added_to_cart.wc-forward") != null) {

                        document.querySelector("a.added_to_cart.wc-forward").addEventListener("click", function() {
                            alert("Woocommerce: Review Cart");
                        });
                    }
                });
            });
        </script>
        ';
    }

    public function printActivePlugins() {
        foreach($this->activePlugins as $activePlugin){
            echo $activePlugin . '<br>';
        }
    }

    /**
     * Returns a list of code injectors for the active plugins
     *
     * @param $activePlugins
     * @return array
     */
    public function createCodeInjectorList($activePlugins) {
        $injectorList = array();
        foreach ($activePlugins as $activePlugin) {
            $currentInjector = clone $this->codeInjectorMap[$activePlugin];
            array_push($injectorList, $currentInjector);
        }
        return $injectorList;
    }

    /**
     * Injects the code in the code injector list
     */
    public function injectCodeList() {
        foreach ($this->codeInjectorList as $codeInjector) {
            $codeInjector->injectCode();
        }
    }

}
