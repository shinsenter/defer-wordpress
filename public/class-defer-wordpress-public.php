<?php

/**
 * 🚀 A WordPress plugin that focuses on minimizing payload size of HTML document
 *    and optimizing processing on the browser when rendering the WordPress page.
 * (c) 2021-2024 SHIN Company <service@shin.company>
 *
 * PHP Version >=7.2
 *
 * @category  Web_Performance_Optimization
 * @package   defer-wordpress
 * @author    Mai Nhut Tan <shin@shin.company>
 * @copyright 2021-2024 SHIN Company
 * @license   https://code.shin.company/defer-wordpress/blob/master/LICENSE GPL-2.0
 * @link      https://code.shin.company/defer-wordpress
 * @see       https://code.shin.company/defer-wordpress/blob/master/README.md
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @author     Mai Nhut Tan <shin@shin.company>
 */
class Defer_Wordpress_Public
{
  /**
   * The ID of this plugin.
   *
   * @since 2.0
   *
   * @var string the ID of this plugin
   */
  private $plugin_name;

  /**
   * The version of this plugin.
   *
   * @since 2.0
   *
   * @var string the current version of this plugin
   */
  private $version;

  /**
   * Initialize the class and set its properties.
   *
   * @since 2.0
   *
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
   * @since 2.0
   */
  public function enqueue_styles()
  {
    /*
     * This function is provided for demonstration purposes only.
     *
     * An instance of this class should be passed to the run() function
     * defined in Defer_Wordpress_Loader as all of the hooks are defined
     * in that particular class.
     *
     * The Defer_Wordpress_Loader will then create the relationship
     * between the defined hooks and the functions defined in this
     * class.
     */

    wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/defer-wordpress-public.css', [], $this->version, 'all');
  }

  /**
   * Register the JavaScript for the public-facing side of the site.
   *
   * @since 2.0
   */
  public function enqueue_scripts()
  {
    /*
     * This function is provided for demonstration purposes only.
     *
     * An instance of this class should be passed to the run() function
     * defined in Defer_Wordpress_Loader as all of the hooks are defined
     * in that particular class.
     *
     * The Defer_Wordpress_Loader will then create the relationship
     * between the defined hooks and the functions defined in this
     * class.
     */

    wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/defer-wordpress-public.js', ['jquery'], $this->version, false);
  }

  public function init()
  {
    ob_start('defer_wp_ob');
  }

  public function shutdown()
  {
    $final  = '';
    $levels = ob_get_level();

    for ($i = 0; $i < $levels; $i++) {
      $final .= ob_get_clean();
    }

    echo $final;
  }
}
