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

            $default_options = array(
                'append_defer_js'       => false,
                'default_defer_time'    => 16,

                'enable_preloading'     => true,
                'enable_dns_prefetch'   => true,
                'fix_render_blocking'   => true,
                'minify_output_html'    => true,

                'enable_defer_css'      => true,
                'enable_defer_scripts'  => false,
                'enable_defer_images'   => true,
                'enable_defer_iframes'  => true,
                'defer_web_fonts'       => true,
                'use_color_placeholder' => true,
            );

            foreach ($default_options as $key => $value) {
                $defer->{$key} = get_option(DEFER_JS_PREFIX . $key, $value);
                update_option(DEFER_JS_PREFIX . $key, $defer->{$key});
            }

            // Create library cache
            $dummy = '<!DOCTYPE html><html><head></head><body></body></html>';
            $defer->fromHtml($dummy)->toHtml();
        }
    }
}
