<?php

/**
 * 🚀 A WordPress plugin that focuses on minimizing payload size of HTML document
 *    and optimizing processing on the browser when rendering the WordPress page.
 * (c) 2021 AppSeeds <hello@appseeds.net>
 *
 * PHP Version >=5.6
 *
 * @category  Web_Performance_Optimization
 * @package   defer-wordpress
 * @author    Mai Nhut Tan <shin@shin.company>
 * @copyright 2021 AppSeeds
 * @license   https://code.shin.company/defer-wordpress/blob/master/LICENSE GPL-2.0
 * @link      https://code.shin.company/defer-wordpress
 * @see       https://code.shin.company/defer-wordpress/blob/master/README.md
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @author     Mai Nhut Tan <shin@shin.company>
 */
class Defer_Wordpress_Deactivator
{
    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since 2.0.0
     */
    public static function deactivate()
    {
        delete_option(DEFER_WP_PLUGIN_NAME . 'version');
    }

    public static function resetOptions()
    {
        if (class_exists('AppSeeds\Defer')) {
            $defer   = defer_wp_instance([]);
            $options = $defer->optionArray();

            foreach ($options as $key => $value) {
                delete_option(DEFER_WP_PLUGIN_PREFIX . $key);
            }
        }
    }
}
