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
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @author     Mai Nhut Tan <shin@shin.company>
 */
class Defer_Wordpress_Admin
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
   * @param string $plugin_name the name of this plugin
   * @param string $version     the version of this plugin
   */
  public function __construct($plugin_name, $version)
  {
    $this->plugin_name = $plugin_name;
    $this->version     = $version;
  }

  /**
   * Register the stylesheets for the admin area.
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

    wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/defer-wordpress-admin.css', [], $this->version, 'all');
  }

  /**
   * Register the JavaScript for the admin area.
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

    wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/defer-wordpress-admin.js', ['jquery'], $this->version, false);
  }

  /*
  |--------------------------------------------------------------------------
  | Main functions
  |--------------------------------------------------------------------------
   */

  public function register_options()
  {
    if (class_exists('AppSeeds\Defer')) {
      $defer   = defer_wp_instance($this->default_settings());
      $options = $defer->optionArray();

      foreach (array_keys($options) as $key) {
        register_setting(DEFER_WP_PLUGIN_NAME, DEFER_WP_PLUGIN_PREFIX . $key);
      }
    }

    if (!get_option(DEFER_WP_PLUGIN_PREFIX . 'inline_deferjs', false)) {
      $this->reset_settings();
    }
  }

  public function register_menu()
  {
    // Remove old menu
    remove_menu_page(DEFER_WP_PLUGIN_NAME);

    // Create new top-level menu
    add_menu_page(
      __('Configure defer.js settings'),
      __('My defer.js'),
      'administrator',
      DEFER_WP_PLUGIN_NAME,
      [$this, 'options_page'],
      plugins_url('/icon.jpg', __FILE__),
      $this->get_menu_position()
    );
  }

  public function register_menu_plugin_options($links)
  {
    $links[] = '<a title="Configure defer.js settings" href="' . DEFER_WP_SETTINGS . '">' . __('Settings') . '</a>';
    $links[] = '<a title="Donate for defer.js" target="paypal" href="' . DEFER_WP_PAYPAL . '">' . __('Donate') . '</a>';
    $links[] = '<a title="Like defer.js" target="rating" href="' . DEFER_WP_RATING . '">' . __('Like') . '</a>';

    return $links;
  }

  public function options_page()
  {
    if (!empty($_REQUEST['reset-settings'])) {
      $reset_settings = $this->reset_settings();
    }

    if (!empty($_REQUEST['save-settings'])) {
      $save_settings = $this->save_settings();
    }

    $default = $this->default_settings();
    $options = $this->get_settings();

    include plugin_dir_path(__FILE__) . 'partials/defer-wordpress-admin-display.php';
  }

  public function reset_settings()
  {
    $default = $this->default_settings();

    if (class_exists('AppSeeds\Defer')) {
      // Get instance with default options
      $defer   = defer_wp_instance($default);
      $options = $defer->optionArray();

      // Update options
      foreach ($options as $key => $value) {
        update_option(DEFER_WP_PLUGIN_PREFIX . $key, $value);
      }

      // Test the plugin
      return $this->tryDeferOptions($defer) ? $options : false;
    }

    return $default;
  }

  public function get_settings()
  {
    $default = $this->default_settings();

    if (class_exists('AppSeeds\Defer')) {
      // Get instance with default options
      $defer    = defer_wp_instance($default);
      $options  = $defer->optionArray();
      $settings = [];

      foreach ($options as $key => $value) {
        $setting = get_option(DEFER_WP_PLUGIN_PREFIX . $key, $value);

        if (is_array($value) && is_string($setting)) {
          $settings[$key] = preg_split('/\s*[\r\n\t,]+\s*/u', $setting);
        } else {
          $settings[$key] = $setting;
        }
      }

      if ($this->tryDeferOptions($defer, $settings)) {
        return $defer->optionArray();
      }
    }

    return $default;
  }

  /*
  |--------------------------------------------------------------------------
  | Helper functions
  |--------------------------------------------------------------------------
   */

  protected function get_menu_position($target = 'switch_themes')
  {
    foreach ($GLOBALS['menu'] as $position => $item) {
      if ($item[1] == $target) {
        return $position;
      }
    }

    return 1;
  }

  protected function default_settings()
  {
    return [
      // Manually add deferjs
      'manually_add_deferjs' => false,

      // Asset sources
      'deferjs_src'  => DEFER_WP_SRC_DEFERJS_CDN,
      'polyfill_src' => DEFER_WP_SRC_POLYFILL_CDN,

      // Cache directory
      'offline_cache_path' => DEFER_WP_CACHE_DIR,
      'offline_cache_ttl'  => DEFER_WP_CACHE_EXP,

      // Copyright
      'long_copyright' => '' . PHP_EOL .
          '    ┌┬┐┌─┐┌─┐┌─┐┬─┐  ┬┌─┐' . PHP_EOL .
          '     ││├┤ ├┤ ├┤ ├┬┘  │└─┐' . PHP_EOL .
          '    ─┴┘└─┘└  └─┘┴└─o└┘└─┘' . PHP_EOL .
          'This page was optimized with defer.js' . PHP_EOL .
          DEFER_WP_PLUGIN_URL . PHP_EOL,

      // Console note
      'console_copyright' => 'Optimized by defer.php' . PHP_EOL . DEFER_WP_PLUGIN_URL,

      // Library injection
      'inline_deferjs'     => true,
      'default_defer_time' => 10,

      // Page optimizations
      'add_missing_meta_tags' => true,
      'enable_preloading'     => true,
      'enable_dns_prefetch'   => true,
      'enable_lazyloading'    => true,
      'minify_output_html'    => false,

      // Tag optimizations
      'fix_render_blocking' => true,
      'optimize_css'        => true,
      'optimize_scripts'    => true,
      'optimize_images'     => true,
      'optimize_iframes'    => true,
      'optimize_background' => true,
      'optimize_anchors'    => true,
      'optimize_fallback'   => false,

      // Third-party optimizations
      'defer_third_party' => true,

      // Content placeholders
      'use_css_fadein_effects' => false,
      'use_color_placeholder'  => false,

      // Lazyload placeholder
      'img_placeholder'    => '',
      'iframe_placeholder' => 'about:blank',

      // Splash screen
      'custom_splash_screen' => '',

      // Blacklists
      'ignore_lazyload_paths' => [],
      'ignore_lazyload_texts' => [],

      // Blacklists using CSS class names
      'ignore_lazyload_css_class'     => [],
      'ignore_lazyload_css_selectors' => [],
    ];
  }

  protected function save_settings()
  {
    $default = $this->default_settings();

    if (class_exists('AppSeeds\Defer')) {
      $defer    = defer_wp_instance($default);
      $options  = $defer->optionArray();
      $settings = [];

      foreach ($options as $key => $value) {
        if (isset($_REQUEST[DEFER_WP_PLUGIN_PREFIX . $key])) {
          $form_value = $_REQUEST[DEFER_WP_PLUGIN_PREFIX . $key];

          if (is_array($value) && !is_array($form_value)) {
            $settings[$key] = preg_split('/\s*[\r\n\t,]+\s*/u', $form_value, -1, PREG_SPLIT_NO_EMPTY);
          } else {
            $settings[$key] = $form_value;
          }
        }
      }

      if ($this->tryDeferOptions($defer, $settings)) {
        $options = $defer->optionArray();

        // Update options
        foreach ($options as $key => $value) {
          update_option(DEFER_WP_PLUGIN_PREFIX . $key, $value);
        }

        return $options;
      }
    }

    return false;
  }

  protected function tryDeferOptions($defer, $options = null)
  {
    // Set new options
    try {
      if (!empty($options)) {
        $defer->options()->setOption($options);
      }

      return true;
    } catch (\Exception $e) {
      return false;
    }
  }
}
