<?php

/**
 * 🔌 A Wordpress plugin integrating my beloved "defer.js" library
 *    into your websites. Hope you guys like it.
 * (c) 2019 AppSeeds Team <hello@appseeds.net>
 *
 * @author    Mai Nhut Tan <shin@shin.company>
 * @copyright 2019 AppSeeds
 * @package   defer-wordpress
 * @see       https://code.shin.company/defer-wordpress/
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @author     MAI NHUT TAN <shin@shin.company>
 */
class Defer_Js_Public
{
    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @var string the ID of this plugin
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @var string the current version of this plugin
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param string $plugin_name the name of the plugin
     * @param string $version     the version of this plugin
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version     = $version;
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        /*
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Defer_Js_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Defer_Js_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        // wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/defer-js-public.css', [], $this->version, 'all');
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        /*
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Defer_Js_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Defer_Js_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        // wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/defer-js-public.js', ['jquery'], $this->version, false);
    }

    public function enable_defer_wordpress()
    {
        ob_start('shinsenter_deferjs_ob');
    }
}
