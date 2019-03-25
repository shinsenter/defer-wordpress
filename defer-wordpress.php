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
define('DEFER_WORDPRESS_PLUGIN_VERSION', '1.1.1');
define('DEFER_JS_PREFIX', 'shinsenter_deferjs_');

/*
 * @wordpress-plugin
 * Plugin Name:       A performant lazy loader (defer.js)
 * Plugin URI:        https://wordpress.org/plugins/shins-pageload-magic/
 * Description:       ⚡️ A native, blazing fast lazy loader. ✅ Legacy browsers support (IE9+). 💯 SEO friendly. 🧩 Lazy load almost anything.
 * Version:           1.1.1
 * Author:            MAI NHUT TAN
 * Author URI:        https://code.shin.company/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       defer-wordpress
 * Domain Path:       /languages
 */

/*
 * defer.js library version
 */
if (!defined('DEFER_JS_VERSION')) {
    define('DEFER_JS_VERSION', '1.1.3');
}

if (!defined('DEFER_JS_PLUGIN_NAME')) {
    define('DEFER_JS_PLUGIN_NAME', 'defer-wordpress');
}

if (!defined('DEFER_JS_PLUGIN_HOOK')) {
    define('DEFER_JS_PLUGIN_HOOK', 'plugin_action_links_' . plugin_basename(__FILE__));
    define('DEFER_JS_HOMEPAGE', 'https://github.com/shinsenter/defer.js');
    define('DEFER_JS_SPONSORS', 'https://raw.githubusercontent.com/shinsenter/defer.php/footprint/sponsors.html');
    define('DEFER_JS_PAYPAL', 'https://www.paypal.me/shinsenter');
    define('DEFER_JS_PATREON', 'https://www.patreon.com/appseeds');
    define('DEFER_JS_RATING', 'https://wordpress.org/support/plugin/shins-pageload-magic/reviews/?filter=5#new-post');
    define('DEFER_JS_SETTINGS', admin_url('admin.php?page=' . DEFER_JS_PLUGIN_NAME));
    define('DEFER_JS_CACHE_DIR', __DIR__ . '/vendor/shinsenter/defer.php/cache/sponsors.php');
    define('DEFER_JS_CACHE_EXP', 86400);

    if (!file_exists(DEFER_JS_CACHE_DIR) || time() - filectime(DEFER_JS_CACHE_DIR) >= DEFER_JS_CACHE_EXP) {
        $source   = @file_get_contents(DEFER_JS_SPONSORS);
        $template = "<?php
if (!defined('DEFER_JS_SPONSORS_HTML')) {
    define('DEFER_JS_SPONSORS_HTML', base64_decode('%s'));
}
";
        @file_put_contents(
            DEFER_JS_CACHE_DIR,
            sprintf(
                $template,
                base64_encode($source)
            )
        );
    }

    @include_once DEFER_JS_CACHE_DIR;
}

if (!defined('DEFER_JS_CACHE_SUFFIX')) {
    define('DEFER_JS_CACHE_SUFFIX', '_' . DEFER_WORDPRESS_PLUGIN_VERSION);
}

/*
 * The main code
 */
if (!function_exists('ob_defer_wordpress')) {
    function ob_defer_wordpress($buffer)
    {
        $optimized = null;

        if (class_exists('shinsenter\Defer')) {
            try {
                $defer = new \shinsenter\Defer();

                foreach ($defer->options as $key => $value) {
                    $defer->{$key} = get_option(DEFER_JS_PREFIX . $key, $value);
                }

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

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-defer-js-activator.php
 */
function activate_defer_wordpress()
{
    require_once __DIR__ . '/vendor/autoload.php';
    require_once plugin_dir_path(__FILE__) . 'includes/class-defer-js-activator.php';
    Defer_Js_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-defer-js-deactivator.php
 */
function deactivate_defer_wordpress()
{
    require_once __DIR__ . '/vendor/autoload.php';
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
    require_once __DIR__ . '/vendor/autoload.php';

    $plugin = new Defer_Js();
    $plugin->run();
}

run_defer_wordpress();
