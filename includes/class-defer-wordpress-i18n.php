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
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 *
 * @author     Mai Nhut Tan <shin@shin.company>
 */
class Defer_Wordpress_i18n
{
  /**
   * Load the plugin text domain for translation.
   *
   * @since 2.0
   */
  public function load_plugin_textdomain()
  {
    load_plugin_textdomain(
      'defer-wordpress',
      false,
      dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
    );
  }
}
