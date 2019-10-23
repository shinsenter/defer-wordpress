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
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @author     MAI NHUT TAN <shin@shin.company>
 */
class Defer_Js_Admin
{
    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @var string the ID of this plugin
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @var string the current version of this plugin
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param string $plugin_name the name of this plugin
     * @param string $version     the version of this plugin
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version     = $version;
    }

    public function register_options()
    {
        if (class_exists('shinsenter\Defer')) {
            $defer = new \shinsenter\Defer();

            foreach ($defer->options as $key => $value) {
                register_setting(DEFER_JS_PLUGIN_NAME, DEFER_JS_PREFIX . $key);
            }
        }

        if (!get_option(DEFER_JS_PREFIX . 'default_defer_time', false)) {
            $this->reset_settings();
        }
    }

    public function register_menu()
    {
        // Remove old menu
        remove_menu_page(DEFER_JS_PLUGIN_NAME);

        // Create new top-level menu
        add_menu_page(
            __('Configure defer.js settings'),
            __('My defer.js'),
            'administrator',
            DEFER_JS_PLUGIN_NAME,
            array($this, 'options_page'),
            plugins_url('/icon.jpg', __FILE__),
            $this->get_menu_position()
        );
    }

    public function register_menu_plugin_options($links)
    {
        $links[] = '<a title="Configure defer.js settings" href="' . DEFER_JS_SETTINGS . '">' . __('Settings') . '</a>';
        $links[] = '<a title="Donate for defer.js" target="paypal" href="' . DEFER_JS_PAYPAL . '">' . __('Donate') . '</a>';
        $links[] = '<a title="Like defer.js" target="rating" href="' . DEFER_JS_RATING . '">' . __('Like') . '</a>';

        return $links;
    }

    public function options_page()
    {
        if (!defined('DEFER_JS_SPONSORS_HTML')) {
            if (class_exists('shinsenter\DeferCache')) {
                $cache = new \shinsenter\DeferCache(DEFER_JS_CACHE_DIR, 1);
                $html  = $cache->get('sponsors' . DEFER_JS_CACHE_SUFFIX);

                if (empty($html)) {
                    $html = @file_get_contents(DEFER_JS_SPONSORS . '?t=' . time());
                    $cache->put('sponsors' . DEFER_JS_CACHE_SUFFIX, $html, DEFER_JS_CACHE_EXP);
                }

                define('DEFER_JS_SPONSORS_HTML', $html);
            } else {
                if (!file_exists(DEFER_JS_CACHE_DIR) || time() - filectime(DEFER_JS_CACHE_DIR) >= DEFER_JS_CACHE_EXP) {
                    $source   = @file_get_contents(DEFER_JS_SPONSORS . '?t=' . time());
                    $template = "<?php define('DEFER_JS_SPONSORS_HTML', base64_decode('%s'));";
                    @file_put_contents(DEFER_JS_CACHE_DIR . '/sponsors.php', sprintf($template, base64_encode($source)));
                }

                @include_once DEFER_JS_CACHE_DIR . '/sponsors.php';
            }
        }

        if (!empty($_REQUEST['reset-settings'])) {
            $reset_settings = $this->reset_settings();
        }

        if (!empty($_REQUEST['save-settings'])) {
            $save_settings = $this->save_settings();
        }

        $default = $this->default_settings();
        $options = $this->get_settings();

        include plugin_dir_path(__FILE__) . 'partials/defer-js-admin-display.php';
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        /*
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Defer_Js_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Defer_Js_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/defer-js-admin.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        /*
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Defer_Js_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Defer_Js_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script('defer.js', 'https://cdn.jsdelivr.net/npm/@shinsenter/defer.js/dist/defer.min.js', array(), $this->version, false);
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/defer-js-admin.js', array(), $this->version, false);
    }

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
        $result = false;

        if (class_exists('shinsenter\Defer')) {
            $defer = new \shinsenter\Defer();

            // Set test options
            $defer->debug_mode         = false;
            $defer->hide_warnings      = true;
            $defer->append_defer_js    = false;
            $defer->default_defer_time = 10;

            $defer->enable_preloading   = true;
            $defer->enable_dns_prefetch = true;
            $defer->fix_render_blocking = true;
            $defer->minify_output_html  = true;

            $defer->enable_defer_css        = true;
            $defer->enable_defer_scripts    = true;
            $defer->enable_defer_images     = true;
            $defer->enable_defer_iframes    = true;
            $defer->enable_defer_background = true;

            $defer->defer_web_fonts        = true;
            $defer->use_css_fadein_effects = true;
            $defer->use_color_placeholder  = false;

            $result = $defer->options;
        }

        return $result;
    }

    protected function reset_settings()
    {
        @unlink(DEFER_JS_CACHE_DIR);

        if (class_exists('shinsenter\Defer')) {
            $default = $this->default_settings();
            $defer   = new \shinsenter\Defer(null, $default);

            $defer->clearCache();

            foreach ($defer->options as $key => $value) {
                update_option(DEFER_JS_PREFIX . $key, $value);
            }

            // Create library cache
            $dummy = '<!DOCTYPE html><html><head></head><body></body></html>';
            $defer->fromHtml($dummy)->toHtml();

            return $default;
        }

        return false;
    }

    protected function save_settings()
    {
        $result = false;

        $_REQUEST = array_map('stripslashes_deep', $_REQUEST);

        if (isset($_REQUEST[DEFER_JS_PREFIX . 'web_fonts_patterns'])) {
            $values                                           = explode("\n", $_REQUEST[DEFER_JS_PREFIX . 'web_fonts_patterns']);
            $_REQUEST[DEFER_JS_PREFIX . 'web_fonts_patterns'] = array_filter($values);
        }

        if (isset($_REQUEST[DEFER_JS_PREFIX . 'do_not_optimize'])) {
            $values                                        = explode("\n", $_REQUEST[DEFER_JS_PREFIX . 'do_not_optimize']);
            $_REQUEST[DEFER_JS_PREFIX . 'do_not_optimize'] = array_filter($values);
        }

        if (!empty($_REQUEST[DEFER_JS_PREFIX . 'loader_scripts'])) {
            $values                                        = array(trim($_REQUEST[DEFER_JS_PREFIX . 'loader_scripts']));
            $_REQUEST[DEFER_JS_PREFIX . 'loader_scripts']  = array_filter($values);
        }

        if (!empty($_REQUEST[DEFER_JS_PREFIX . 'empty_gif'])) {
            $_REQUEST[DEFER_JS_PREFIX . 'empty_gif'] = trim($_REQUEST[DEFER_JS_PREFIX . 'empty_gif']);
        }

        if (!empty($_REQUEST[DEFER_JS_PREFIX . 'empty_src'])) {
            $_REQUEST[DEFER_JS_PREFIX . 'empty_src'] = trim($_REQUEST[DEFER_JS_PREFIX . 'empty_src']);
        }

        if (class_exists('shinsenter\Defer')) {
            $defer   = new \shinsenter\Defer();
            $success = false;

            try {
                // Test the configuration
                $dummy = '<!DOCTYPE html><html><head></head><body></body></html>';
                $defer->fromHtml($dummy)->toHtml();
                $success = true;
            } catch (\Exception $e) {
                // This is error
                unset($e);
            }

            if ($success) {
                foreach ($defer->options as $key => $value) {
                    if (isset($_REQUEST[DEFER_JS_PREFIX . $key]) && !in_array($key, array('debug_mode', 'hide_warnings'))) {
                        $defer->{$key} = $_REQUEST[DEFER_JS_PREFIX . $key];
                        update_option(DEFER_JS_PREFIX . $key, $defer->{$key});
                    } else {
                        update_option(DEFER_JS_PREFIX . $key, $value);
                    }
                }

                $result = $defer->options;
            }
        }

        return $result;
    }

    protected function get_settings()
    {
        $result = false;

        if (class_exists('shinsenter\Defer')) {
            $defer = new \shinsenter\Defer();

            foreach ($defer->options as $key => $value) {
                $defer->{$key} = get_option(DEFER_JS_PREFIX . $key, $value);
            }

            $defer->debug_mode    = false;
            $defer->hide_warnings = true;

            $result = $defer->options;
        }

        return $result;
    }
}
