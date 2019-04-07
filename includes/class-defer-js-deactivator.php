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
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @author     MAI NHUT TAN <shin@shin.company>
 */
class Defer_Js_Deactivator
{
    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function deactivate()
    {
        delete_option(DEFER_JS_PREFIX . 'version');
    }
}
