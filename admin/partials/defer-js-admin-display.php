<?php

/**
 * 🔌 A Wordpress plugin integrating my beloved "defer.js" library
 *    into your websites. Hope you guys like it.
 * (c) 2019 AppSeeds Team <hello@appseeds.net>
 *
 * @author    Mai Nhut Tan <shin@shin.company>
 * @copyright 2019 AppSeeds
 * @see       https://code.shin.company/defer-wordpress/
 */
?>

<div class="wrap">
    <div class="main">
        <h1><img class="deferjs-icon" src="<?php echo plugins_url('/icon.jpg', dirname(__FILE__)); ?>" width="32" height="32" alt="defer.js"> Edit defer.js settings</h1>

        <form method="post" action="options.php" class="box">
            <?php settings_fields(DEFER_JS_PLUGIN_NAME); ?>
            <?php do_settings_sections(DEFER_JS_PLUGIN_NAME); ?>

            <table class="form-table">
                <tr class="top">
                    <th>append_defer_js</th>
                    <td><input type="checkbox"
                        value="1"
                        name="<?php echo DEFER_JS_PREFIX . 'append_defer_js'; ?>"
                        id="deferjs_append_defer_js"></td>
                </tr>
                <tr class="top">
                    <th>enable_preloading</th>
                    <td><input type="checkbox"
                        value="1"
                        name="<?php echo DEFER_JS_PREFIX . 'enable_preloading'; ?>"
                        id="deferjs_enable_preloading"></td>
                </tr>
                <tr class="top">
                    <th>enable_defer_css</th>
                    <td><input type="checkbox"
                        value="1"
                        name="<?php echo DEFER_JS_PREFIX . 'enable_defer_css'; ?>"
                        id="deferjs_enable_defer_css"></td>
                </tr>
                <tr class="top">
                    <th>defer_web_fonts</th>
                    <td><input type="checkbox"
                        value="1"
                        name="<?php echo DEFER_JS_PREFIX . 'defer_web_fonts'; ?>"
                        id="deferjs_defer_web_fonts"></td>
                </tr>
                <tr class="top">
                    <th>web_fonts_patterns</th>
                    <td><input type="checkbox"
                        value="1"
                        name="<?php echo DEFER_JS_PREFIX . 'web_fonts_patterns'; ?>"
                        id="deferjs_web_fonts_patterns"></td>
                </tr>
                <tr class="top">
                    <th>loader_scripts</th>
                    <td><input type="checkbox"
                        value="1"
                        name="<?php echo DEFER_JS_PREFIX . 'loader_scripts'; ?>"
                        id="deferjs_loader_scripts"></td>
                </tr>
                <tr class="top">
                    <th>do_not_optimize</th>
                    <td><input type="checkbox"
                        value="1"
                        name="<?php echo DEFER_JS_PREFIX . 'do_not_optimize'; ?>"
                        id="deferjs_do_not_optimize"></td>
                </tr>
                <tr class="top">
                    <th>use_color_placeholder</th>
                    <td><input type="checkbox"
                        value="1"
                        name="<?php echo DEFER_JS_PREFIX . 'use_color_placeholder'; ?>"
                        id="deferjs_use_color_placeholder"></td>
                </tr>
                <tr class="top">
                    <th>empty_gif</th>
                    <td><input type="checkbox"
                        value="1"
                        name="<?php echo DEFER_JS_PREFIX . 'empty_gif'; ?>"
                        id="deferjs_empty_gif"></td>
                </tr>
                <tr class="top">
                    <th>empty_src</th>
                    <td><input type="checkbox"
                        value="1"
                        name="<?php echo DEFER_JS_PREFIX . 'empty_src'; ?>"
                        id="deferjs_empty_src"></td>
                </tr>
            </table>

            <?php submit_button(); ?>
        </form>
    </div>

    <div class="side box">
        <h2><a href='<?php echo DEFER_JS_HOMEPAGE; ?>' target='_blank' class='url'>@shinsenter/defer.js</a></h2>
        <p>🥇 A super tiny, native performant library for lazy-loading JS, CSS, images, iframes... Defer almost anything, easily speed up your website.</p>
        <p><a href="<?php echo DEFER_JS_RATING; ?>" target="rating">Rate 5 stars (⭐️⭐️⭐️⭐️⭐️)</a> if you guys like it.</p>
        <p>
            <img src='https://img.shields.io/github/license/shinsenter/defer.js.svg' alt='GitHub' referrerPolicy='no-referrer' />
            <a href='https://www.codefactor.io/repository/github/shinsenter/defer.js'><img src='https://www.codefactor.io/repository/github/shinsenter/defer.js/badge' alt='CodeFactor' referrerPolicy='no-referrer' /></a></p>
        <p><img src='https://img.shields.io/github/release-date/shinsenter/defer.js.svg' alt='GitHub Release Date' referrerPolicy='no-referrer' />
            <img src='https://img.shields.io/npm/v/@shinsenter/defer.js.svg' alt='npm' referrerPolicy='no-referrer' />
            <img src='https://img.shields.io/bundlephobia/minzip/@shinsenter/defer.js.svg' alt='npm bundle size' referrerPolicy='no-referrer' />
            <a href='https://www.jsdelivr.com/package/npm/@shinsenter/defer.js'><img src='https://data.jsdelivr.com/v1/package/npm/@shinsenter/defer.js/badge?style=rounded' alt='jsDelivr hits (GitHub)' referrerPolicy='no-referrer' /></a></p>

        <h3 class="section-heading">Support my work</h3>
        <p class="section-description">
            <strong>If you love it, you can make a donation or buy me a beer.</strong>
        </p>

        <p>
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank" style="text-align: center;">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----">
                <input width="200" type="image" src="<?php echo plugins_url('/donate.png', dirname(__FILE__)); ?>" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                <img alt="Tracking code" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
            </form>
        </p>

        <p style="text-align: center;"><a href='<?php echo DEFER_JS_PATREON; ?>' target="donate"><img width="200" height="47" src='https://c5.patreon.com/external/logo/become_a_patron_button@2x.png' alt='Become a sponsor' referrerPolicy='no-referrer' /></a></p>

        <h3>Keep in touch</h3>
        <ul>
            <li>■ Become a stargazer:
                <a href='<?php echo DEFER_JS_HOMEPAGE; ?>/stargazers' target='_blank' class='url'><?php echo DEFER_JS_HOMEPAGE; ?>/stargazers</a></li>
            <li>■ Report an issue:
                <a href='<?php echo DEFER_JS_HOMEPAGE; ?>/issues' target='_blank' class='url'><?php echo DEFER_JS_HOMEPAGE; ?>/issues</a></li>
            <li>■ Keep up-to-date with new releases:
                <a href='<?php echo DEFER_JS_HOMEPAGE; ?>/releases' target='_blank' class='url'><?php echo DEFER_JS_HOMEPAGE; ?>/releases</a></li>
        </ul>
        <hr />
        <p>Released under the MIT license.
            <a href='<?php echo DEFER_JS_HOMEPAGE; ?>/LICENSE' target='_blank' class='url'><?php echo DEFER_JS_HOMEPAGE; ?>/LICENSE</a></p>
        <p>Copyright (c) 2019 Mai Nhut Tan &lt;<a href='mailto:shin@shin.company'>shin@shin.company</a>&gt;.</p>
        <p>From Vietnam 🇻🇳 with love.</p>
    </div>
</div>