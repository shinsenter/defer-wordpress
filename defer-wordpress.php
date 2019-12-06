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
 * Currently plugin version.
 * Rename this for your plugin and update it as you release new versions.
 */
define('DEFER_WORDPRESS_PLUGIN_VERSION', '1.1.11+1');
define('DEFER_JS_PREFIX', 'shinsenter_deferjs_');

/*
 * @wordpress-plugin
 * Plugin Name:       An efficient lazy loader (defer.js)
 * Plugin URI:        https://wordpress.org/plugins/shins-pageload-magic/
 * Description:       ⚡️ A native, blazing fast lazy loader. ✅ Legacy browsers support (IE9+). 💯 SEO friendly. 🧩 Lazy load almost anything.
 * Version:           1.1.11+1
 * Author:            Mai Nhut Tan
 * Author URI:        https://code.shin.company/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       defer-wordpress
 * Domain Path:       /languages
 */

/*
 * defer.js library version
 */
// if (!defined('DEFER_JS_VERSION')) {
//     define('DEFER_JS_VERSION', '1.1.11');
// }

if (!defined('DEFER_JS_PLUGIN_NAME')) {
    require_once __DIR__ . '/vendor/autoload.php';
    define('DEFER_JS_PLUGIN_NAME', 'defer-wordpress');
}

if (!defined('DEFER_JS_PLUGIN_HOOK')) {
    define('DEFER_JS_PLUGIN_HOOK', 'plugin_action_links_' . plugin_basename(__FILE__));
    define('DEFER_JS_HOMEPAGE', 'https://github.com/shinsenter/defer.js');
    define('DEFER_JS_PAYPAL', 'https://www.paypal.me/shinsenter');
    define('DEFER_JS_PATREON', 'https://www.patreon.com/appseeds');
    define('DEFER_JS_RATING', 'https://wordpress.org/support/plugin/shins-pageload-magic/reviews/?filter=5#new-post');
    define('DEFER_JS_SETTINGS', admin_url('admin.php?page=' . DEFER_JS_PLUGIN_NAME));
    define('DEFER_JS_CACHE_DIR', __DIR__ . '/vendor/shinsenter/defer.php/cache');
    define('DEFER_JS_CACHE_EXP', 600);
}

if (!defined('DEFER_JS_CACHE_SUFFIX')) {
    define('DEFER_JS_CACHE_SUFFIX', '_' . DEFER_WORDPRESS_PLUGIN_VERSION);
}

/*
 * The main code
 */
if (!function_exists('shinsenter_deferjs_ob')) {
    function shinsenter_deferjs_ob($buffer)
    {
        $optimized = null;

        if (class_exists('shinsenter\Defer')) {
            try {
                $defer = new \shinsenter\Defer();

                foreach ($defer->options as $key => $value) {
                    $defer->{$key} = get_option(DEFER_JS_PREFIX . $key, $value);
                }

                /*
                 * 20191125 Fix security errors in accordance with WordPress guidelines
                 */
                $defer->manually_add_deferjs = true;
                $defer->append_defer_js      = true;

                // all files have been downloaded and served locally
                // https://github.com/shinsenter/defer.js/tree/master/dist
                $deferjs  = file_get_contents(__DIR__ . '/public/js/defer.js');
                $polyfill = '"IntersectionObserver"in window||deferscript("'
                    . plugin_dir_url(__FILE__)
                    . 'public/js/polyfill.js","polyfill-js",1);';
                $helpers  = file_get_contents(\shinsenter\Defer::HELPERS_URL);

                // Append polyfill.js and defer_plus.min.js
                \shinsenter\Defer::$helpers = $deferjs . $polyfill . $helpers;

                // Remove copyright (omit external requests)
                \shinsenter\Defer::$fingerprint = '
    ┌┬┐┌─┐┌─┐┌─┐┬─┐  ┬┌─┐
     ││├┤ ├┤ ├┤ ├┬┘  │└─┐
    ─┴┘└─┘└  └─┘┴└─o└┘└─┘
This page was optimized with defer.js
https://wordpress.org/plugins/shins-pageload-magic/
';

                $defer->debug_mode    = false;
                $defer->hide_warnings = true;

                $optimized = $defer->fromHtml($buffer)->toHtml();
            } catch (\Exception $e) {
                $optimized = false;
            }
        }

        return $optimized ?: $buffer;
    }
}

if (!function_exists('shinsenter_deferjs_update_note')) {
    function shinsenter_deferjs_update_note()
    {
        include plugin_dir_path(__FILE__) . 'admin/partials/update-note.php';

        // Update the version
        update_option(DEFER_JS_PREFIX . 'version', DEFER_WORDPRESS_PLUGIN_VERSION);
    }
}

$installed_version = get_option(DEFER_JS_PREFIX . 'version', '');

if ($installed_version !== DEFER_WORDPRESS_PLUGIN_VERSION) {
    add_action('admin_notices', 'shinsenter_deferjs_update_note');
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-defer-js-activator.php
 */
function activate_defer_wordpress()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-defer-js-activator.php';
    Defer_Js_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-defer-js-deactivator.php
 */
function deactivate_defer_wordpress()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-defer-js-deactivator.php';
    Defer_Js_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_defer_wordpress');
register_deactivation_hook(__FILE__, 'deactivate_defer_wordpress');

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
function run_defer_wordpress()
{
    $plugin = new Defer_Js();
    $plugin->run();
}

run_defer_wordpress();
