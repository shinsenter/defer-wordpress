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

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/*
 * @wordpress-plugin
 * Plugin Name:       A performant lazy loader (defer.js)
 * Plugin URI:        https://github.com/shinsenter/defer-wordpress
 * Description:       🔌 A Wordpress plugin integrating my beloved "defer.js" library into your websites. Hope you guys like it.
 * Version:           1.0.5
 * Author:            MAI NHUT TAN
 * Author URI:        https://code.shin.company/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       defer-wordpress
 * Domain Path:       /languages
 */

/*
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('DEFER_JS_VERSION', '1.0.0');
define('DEFER_JS_PREFIX', 'shinsenter_deferjs_');

if (!function_exists('ob_defer_js')) {
    function ob_defer_js($buffer)
    {
        $optimized = null;

        if (class_exists('shinsenter\Defer')) {
            try {
                $defer = new \shinsenter\Defer();

                $defer->debug_mode            = get_option(DEFER_JS_PREFIX . 'debug_mode', false);
                $defer->hide_warnings         = get_option(DEFER_JS_PREFIX . 'hide_warnings', true);

                $defer->append_defer_js       = get_option(DEFER_JS_PREFIX . 'append_defer_js', false);
                $defer->default_defer_time    = get_option(DEFER_JS_PREFIX . 'default_defer_time', 100);

                $defer->enable_preloading     = get_option(DEFER_JS_PREFIX . 'enable_preloading', true);
                $defer->enable_dns_prefetch   = get_option(DEFER_JS_PREFIX . 'enable_dns_prefetch', true);
                $defer->fix_render_blocking   = get_option(DEFER_JS_PREFIX . 'fix_render_blocking', true);
                $defer->minify_output_html    = get_option(DEFER_JS_PREFIX . 'minify_output_html', true);

                $defer->enable_defer_css      = get_option(DEFER_JS_PREFIX . 'enable_defer_css', true);
                $defer->enable_defer_scripts  = get_option(DEFER_JS_PREFIX . 'enable_defer_scripts', false);
                $defer->enable_defer_images   = get_option(DEFER_JS_PREFIX . 'enable_defer_images', true);
                $defer->enable_defer_iframes  = get_option(DEFER_JS_PREFIX . 'enable_defer_iframes', true);
                $defer->defer_web_fonts       = get_option(DEFER_JS_PREFIX . 'defer_web_fonts', true);

                // $defer->empty_gif             = get_option(DEFER_JS_PREFIX . 'empty_gif', 'data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==');
                // $defer->empty_src             = get_option(DEFER_JS_PREFIX . 'empty_src', 'about:blank');
                $defer->use_color_placeholder = get_option(DEFER_JS_PREFIX . 'use_color_placeholder', true);

                $optimized = $defer->fromHtml($buffer)->toHtml();
            } catch (\Exception $e) {
                $optimized = false;
            }
        }

        return $optimized ?: $buffer;
    }
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-defer-js-activator.php
 */
function activate_defer_js()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-defer-js-activator.php';
    Defer_Js_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-defer-js-deactivator.php
 */
function deactivate_defer_js()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-defer-js-deactivator.php';
    Defer_Js_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_defer_js');
register_deactivation_hook(__FILE__, 'deactivate_defer_js');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-defer-js.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_defer_js()
{
    require_once __DIR__ . '/vendor/autoload.php';

    $plugin = new Defer_Js();
    $plugin->run();
}

run_defer_js();
