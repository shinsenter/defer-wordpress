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
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @author     MAI NHUT TAN <shin@shin.company>
 */
class Defer_Js_Activator
{
    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function activate()
    {
        if (class_exists('shinsenter\Defer')) {
            // Reset all options when activate the plugin
            $defer = new \shinsenter\Defer();

            $defer->append_defer_js       = false;
            $defer->default_defer_time    = 50;

            $defer->enable_preloading     = true;
            $defer->enable_dns_prefetch   = true;
            $defer->fix_render_blocking   = true;
            $defer->minify_output_html    = true;

            $defer->enable_defer_css      = true;
            $defer->enable_defer_scripts  = false;
            $defer->enable_defer_images   = true;
            $defer->enable_defer_iframes  = true;

            $defer->defer_web_fonts       = true;
            $defer->use_color_placeholder = true;

            foreach ($defer->options as $key => $value) {
                update_option(DEFER_JS_PREFIX . $key, $value);
            }

            // Create library cache
            $dummy = '<!DOCTYPE html><html><head></head><body></body></html>';
            $defer->fromHtml($dummy)->toHtml();

            // Update the version
            update_option(DEFER_JS_PREFIX . 'version', DEFER_WORDPRESS_PLUGIN_VERSION);
        }
    }
}
