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
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 *
 * @author     Mai Nhut Tan <shin@shin.company>
 */
class Defer_Wordpress
{
  /**
   * The loader that's responsible for maintaining and registering all hooks that power
   * the plugin.
   *
   * @since 2.0
   *
   * @var Defer_Wordpress_Loader maintains and registers all hooks for the plugin
   */
  protected $loader;

  /**
   * The unique identifier of this plugin.
   *
   * @since 2.0
   *
   * @var string the string used to uniquely identify this plugin
   */
  protected $plugin_name;

  /**
   * The current version of the plugin.
   *
   * @since 2.0
   *
   * @var string the current version of the plugin
   */
  protected $version;

  /**
   * Define the core functionality of the plugin.
   *
   * Set the plugin name and the plugin version that can be used throughout the plugin.
   * Load the dependencies, define the locale, and set the hooks for the admin area and
   * the public-facing side of the site.
   *
   * @since 2.0
   */
  public function __construct()
  {
    $this->plugin_name = DEFER_WP_PLUGIN_NAME;
    $this->version     = DEFER_WP_PLUGIN_VERSION;

    $this->load_dependencies();
    $this->set_locale();
    $this->define_admin_hooks();
    $this->define_public_hooks();
  }

  /**
   * Run the loader to execute all of the hooks with WordPress.
   *
   * @since 2.0
   */
  public function run()
  {
    $this->loader->run();
  }

  /**
   * The name of the plugin used to uniquely identify it within the context of
   * WordPress and to define internationalization functionality.
   *
   * @since     1.0.0
   *
   * @return string the name of the plugin
   */
  public function get_plugin_name()
  {
    return $this->plugin_name;
  }

  /**
   * The reference to the class that orchestrates the hooks with the plugin.
   *
   * @since     1.0.0
   *
   * @return Defer_Wordpress_Loader orchestrates the hooks of the plugin
   */
  public function get_loader()
  {
    return $this->loader;
  }

  /**
   * Retrieve the version number of the plugin.
   *
   * @since     1.0.0
   *
   * @return string the version number of the plugin
   */
  public function get_version()
  {
    return $this->version;
  }

  /*
  |--------------------------------------------------------------------------
  | Wordpress functions
  |--------------------------------------------------------------------------
   */

  /**
   * Load the required dependencies for this plugin.
   *
   * Include the following files that make up the plugin:
   *
   * - Defer_Wordpress_Loader. Orchestrates the hooks of the plugin.
   * - Defer_Wordpress_i18n. Defines internationalization functionality.
   * - Defer_Wordpress_Admin. Defines all hooks for the admin area.
   * - Defer_Wordpress_Public. Defines all hooks for the public side of the site.
   *
   * Create an instance of the loader which will be used to register the hooks
   * with WordPress.
   *
   * @since 2.0
   */
  private function load_dependencies()
  {
    /**
     * The class responsible for orchestrating the actions and filters of the
     * core plugin.
     */
    require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-defer-wordpress-loader.php';

    /**
     * The class responsible for defining internationalization functionality
     * of the plugin.
     */
    require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-defer-wordpress-i18n.php';

    /**
     * The class responsible for defining all actions that occur in the admin area.
     */
    require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-defer-wordpress-admin.php';

    /**
     * The class responsible for defining all actions that occur in the public-facing
     * side of the site.
     */
    require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-defer-wordpress-public.php';

    $this->loader = new Defer_Wordpress_Loader();
  }

  /**
   * Define the locale for this plugin for internationalization.
   *
   * Uses the Defer_Wordpress_i18n class in order to set the domain and to register the hook
   * with WordPress.
   *
   * @since 2.0
   */
  private function set_locale()
  {
    $plugin_i18n = new Defer_Wordpress_i18n();

    $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
  }

  /**
   * Register all of the hooks related to the admin area functionality
   * of the plugin.
   *
   * @since 2.0
   */
  private function define_admin_hooks()
  {
    $plugin_admin = new Defer_Wordpress_Admin($this->get_plugin_name(), $this->get_version());

    $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
    $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
    $this->loader->add_action('admin_menu', $plugin_admin, 'register_menu');
    $this->loader->add_action('admin_init', $plugin_admin, 'register_options');
    $this->loader->add_filter(DEFER_WP_PLUGIN_HOOK, $plugin_admin, 'register_menu_plugin_options');
    $this->loader->add_filter(DEFER_WP_PLUGIN_DESC_HOOK, $plugin_admin, 'register_menu_plugin_options');
  }

  /**
   * Register all of the hooks related to the public-facing functionality
   * of the plugin.
   *
   * @since 2.0
   */
  private function define_public_hooks()
  {
    $plugin_public = new Defer_Wordpress_Public($this->get_plugin_name(), $this->get_version());

    if (!(defined('WP_CLI') && WP_CLI) && !$this->is_ajax() && !is_admin() && !$this->is_wplogin()) {
      $this->loader->add_action('init', $plugin_public, 'init', -1);
      $this->loader->add_action('shutdown', $plugin_public, 'shutdown', 100000);
    }
  }

  /**
   * Detect login page.
   *
   * @since 2.0
   */
  private function is_wplogin()
  {
    $incl_path = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, ABSPATH);

    return (in_array($incl_path . 'wp-login.php', get_included_files())
      || in_array($incl_path . 'wp-register.php', get_included_files()))
      || (isset($_GLOBALS['pagenow']) && 'wp-login.php' === $GLOBALS['pagenow'])
      || '/wp-login.php' == $_SERVER['PHP_SELF'];
  }

  private function is_ajax()
  {
    if (
      !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
      && 'xmlhttprequest' == strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])
    ) {
      return true;
    }

    if (
      empty($_SERVER['HTTP_ACCEPT'])
      || false === strstr(strtolower($_SERVER['HTTP_ACCEPT']), 'html')
    ) {
      return true;
    }

    return false;
  }
}
