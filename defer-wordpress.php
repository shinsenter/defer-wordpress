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

// If this file is called directly, abort.
if (!defined('WPINC')) {
    exit;
}

/*
 * The plugin bootstrap file
 *
 * @wordpress-plugin
 * Plugin Name:       A faster website (with defer.js)!
 * Plugin URI:        https://wordpress.org/plugins/shins-pageload-magic/
 * Description:       🚀 A native, blazing fast lazy loader. ✅ Legacy browsers support (IE9+). 💯 SEO friendly. 🧩 Lazy-load everything.
 * Version:           2.0.0
 * Author:            Mai Nhut Tan
 * Author URI:        https://code.shin.company/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       defer-wordpress
 * Domain Path:       /languages
 */

/*
 * Defines currently plugin version.
 * Includes defer.php library
 */
if (!defined('DEFER_WP_PLUGIN_VERSION')) {
    define('DEFER_WP_PLUGIN_BASE', plugin_basename(__FILE__));
    define('DEFER_WP_PLUGIN_NAME', 'defer-wordpress');
    define('DEFER_WP_PLUGIN_VERSION', '2.0.0');
    define('DEFER_WP_PLUGIN_PREFIX', DEFER_WP_PLUGIN_NAME . '_');

    define('DEFER_WP_PLUGIN_HOOK', 'plugin_action_links_' . DEFER_WP_PLUGIN_BASE);
    define('DEFER_WP_PLUGIN_DESC_HOOK', 'network_admin_plugin_action_links_' . DEFER_WP_PLUGIN_BASE);

    define('DEFER_WP_SETTINGS', admin_url('admin.php?page=' . DEFER_WP_PLUGIN_NAME));

    define('DEFER_WP_CACHE_DIR', __DIR__ . '/cache');
    define('DEFER_WP_CACHE_EXP', 600);

    $has_deferjs = file_exists(__DIR__ . '/public/lib/defer_plus.min.js');
    define('DEFER_WP_SRC_DEFERJS_CDN', $has_deferjs
        ? __DIR__ . '/public/lib/defer_plus.min.js'
        : 'https://cdn.jsdelivr.net/npm/@shinsenter/defer.js@2.1.0/dist/defer_plus.min.js');

    $has_polyfill = file_exists(__DIR__ . '/public/lib/polyfill.min.js');
    define('DEFER_WP_SRC_POLYFILL_CDN', $has_polyfill
        ? plugin_dir_url(__FILE__) . 'public/lib/polyfill.min.js'
        : 'https://polyfill.io/v3/polyfill.min.js?features=IntersectionObserver');

    define('DEFER_WP_HOMEPAGE', 'https://github.com/shinsenter/defer.js');
    define('DEFER_WP_PLUGIN_URL', 'https://wordpress.org/plugins/shins-pageload-magic/');
    define('DEFER_WP_PAYPAL', 'https://www.paypal.me/shinsenter');
    define('DEFER_WP_PATREON', 'https://www.patreon.com/appseeds');
    define('DEFER_WP_RATING', 'https://wordpress.org/support/plugin/shins-pageload-magic/reviews/?filter=5#new-post');

    require_once __DIR__ . '/vendor/autoload.php';
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-defer-wordpress-activator.php
 */
function activate_defer_wordpress()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-defer-wordpress-activator.php';
    Defer_Wordpress_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-defer-wordpress-deactivator.php
 */
function deactivate_defer_wordpress()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-defer-wordpress-deactivator.php';
    Defer_Wordpress_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_defer_wordpress');
register_deactivation_hook(__FILE__, 'deactivate_defer_wordpress');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-defer-wordpress.php';

// Version check
if (!function_exists('defer_wp_update_note')) {
    function defer_wp_update_note()
    {
        include plugin_dir_path(__FILE__) . 'admin/partials/update-note.php';

        // Update the version
        update_option(DEFER_WP_PLUGIN_NAME . 'version', DEFER_WP_PLUGIN_VERSION);
    }
}

if (!function_exists('defer_wp_instance')) {
    function defer_wp_instance($options)
    {
        static $defer;

        if (!isset($defer) && class_exists('AppSeeds\Defer')) {
            $defer = new \AppSeeds\Defer();
        }

        if ($defer instanceof \AppSeeds\Defer && !empty($options)) {
            try {
                $defer->options()->setOption($options)->backup();
            } catch (\Exception $e) {
                if (defined('WP_DEBUG') && WP_DEBUG == true) {
                    throw $e;
                }
            }
        }

        return $defer;
    }
}

if (!function_exists('defer_wp_ob')) {
    function defer_wp_ob($buffer)
    {
        $output = false;

        try {
            $admin  = new Defer_Wordpress_Admin(DEFER_WP_PLUGIN_NAME, DEFER_WP_PLUGIN_VERSION);
            $defer  = defer_wp_instance($admin->get_settings());
            $output = $defer->fromHtml($buffer)->toHtml();
        } catch (\Exception $e) {
            $output = false;
        }

        return $output ?: $buffer;
    }
}

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since 2.0.0
 */
function run_defer_wordpress()
{
    $plugin = new Defer_Wordpress();
    $plugin->run();

    add_filter('wp_lazy_loading_enabled', '__return_false');

    if (get_option(DEFER_WP_PLUGIN_NAME . 'version', '') !== DEFER_WP_PLUGIN_VERSION) {
        add_action('admin_notices', 'defer_wp_update_note');
    }
}

run_defer_wordpress();
