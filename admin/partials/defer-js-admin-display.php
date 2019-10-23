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

        <?php if (isset($reset_settings)) {
    ?>
            <div id="message" class="updated fade">
                <p><strong>Settings have been set to default. Please empty all page caches.</strong></p>
            </div>
            <?php
} ?>

        <?php if (isset($save_settings)) {
        $msg = $save_settings === false ? 'Cannot save your settings.' : 'All changes have been saved. Please empty all page caches.';
        $err = $save_settings === false ? 'error' : 'updated'; ?>
            <div id="message" class="<?php echo $err; ?> fade">
                <p><strong><?php echo esc_html($msg); ?></strong></p>
            </div>
            <?php
    } ?>

        <?php if (!isset($reset_settings) && !isset($save_settings)) {
        ?>
            <div id="message" class="notice notice-info fade">
                <p>
                    <strong>💡 Tip:</strong> For better result, please <u>disable</u> lazyload and HTML-CSS-JS optimizations by other plugins.
                    Using with a <a href="plugin-install.php?s=caching&tab=search&type=tag">caching plugin</a> is strongly recommended.
                </p>
            </div>
            <?php
    } ?>

        <form method="post" action="<?php echo DEFER_JS_SETTINGS; ?>">
            <?php settings_fields(DEFER_JS_PLUGIN_NAME); ?>
            <?php do_settings_sections(DEFER_JS_PLUGIN_NAME); ?>

            <div class="postbox">
                <h2>Page optimiztions</h2>
                <div class="inside">
                    <table class="form-table">
                        <tbody>
                            <tr class="top">
                                <th>
                                    <label for="deferjs_enable_preloading">Enable preload</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_JS_PREFIX . 'enable_preloading'; ?>">
                                        <input type="checkbox" value="1"
                                        <?php echo $options['enable_preloading'] == true ? 'checked' : ''; ?>
                                        name="<?php echo DEFER_JS_PREFIX . 'enable_preloading'; ?>"
                                        id="deferjs_enable_preloading">
                                        <span class="description">Default: <?php echo $default['enable_preloading'] ? 'checked' : 'none'; ?>.</span>
                                        <p class="help">Preloading content with rel="preload". <a rel="nofollow" href="https://developer.mozilla.org/en-US/docs/Web/HTML/Preloading_content" target="_blank">This article</a> provides a basic guide to how preload works.</p>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr class="top">
                                <th>
                                    <label for="deferjs_enable_dns_prefetch">Enable DNS prefetch</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_JS_PREFIX . 'enable_dns_prefetch'; ?>">
                                        <input type="checkbox" value="1"
                                        <?php echo $options['enable_dns_prefetch'] == true ? 'checked' : ''; ?>
                                        name="<?php echo DEFER_JS_PREFIX . 'enable_dns_prefetch'; ?>"
                                        id="deferjs_enable_dns_prefetch">
                                        <span class="description">Default: <?php echo $default['enable_dns_prefetch'] ? 'checked' : 'none'; ?>.</span>
                                        <p class="help">DNS resolution time can lead to a significant amount of user perceived latency. Enabling DNS prefetch saves about 200 milliseconds in browser navigation. <a rel="nofollow" href="https://dev.chromium.org/developers/design-documents/dns-prefetching" target="_blank">This article</a> provides a basic guide to how DNS prefetch works.</p>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr class="top">
                                <th>
                                    <label for="deferjs_fix_render_blocking">Fix render-blocking</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_JS_PREFIX . 'fix_render_blocking'; ?>">
                                        <input type="checkbox" value="1"
                                        <?php echo $options['fix_render_blocking'] == true ? 'checked' : ''; ?>
                                        name="<?php echo DEFER_JS_PREFIX . 'fix_render_blocking'; ?>"
                                        id="deferjs_fix_render_blocking">
                                        <span class="description">Default: <?php echo $default['fix_render_blocking'] ? 'checked' : 'none'; ?>.</span>
                                        <p class="help">This moves all CSS blocks to the top to ensure the content loads with styles already applied, and puts your scripts at the very bottom of the page, so that as much as possible of the page gets loaded and rendered to the user, as fast as possible.</p>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr class="top">
                                <th>
                                    <label for="deferjs_minify_output_html">Minify HTML</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_JS_PREFIX . 'minify_output_html'; ?>">
                                        <input type="checkbox" value="1"
                                        <?php echo $options['minify_output_html'] == true ? 'checked' : ''; ?>
                                        name="<?php echo DEFER_JS_PREFIX . 'minify_output_html'; ?>"
                                        id="deferjs_minify_output_html">
                                        <span class="description">Default: <?php echo $default['minify_output_html'] ? 'checked' : 'none'; ?>.</span>
                                        <p class="help">Blazing fast HTML minification algorithm. You may not need any other plugin for minifying HTML.</p>
                                    </fieldset>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <p class="submit">
                        <?php submit_button(__('Update all'), 'primary', 'save-settings', false); ?>
                        <?php submit_button(__('Reset all to default'), 'secondary', 'reset-settings', false, array('reset-all' => true)); ?>
                    </p>
                </div>
            </div>

            <div class="postbox">
                <h2>Elements optimizations</h2>
                <div class="inside">
                    <table class="form-table">
                        <tbody>
                            <tr class="top">
                                <th>
                                    <label for="deferjs_enable_defer_css">Optimized CSS</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_JS_PREFIX . 'enable_defer_css'; ?>">
                                        <input type="checkbox" value="1"
                                        <?php echo $options['enable_defer_css'] == true ? 'checked' : ''; ?>
                                        name="<?php echo DEFER_JS_PREFIX . 'enable_defer_css'; ?>"
                                        id="deferjs_enable_defer_css">
                                        <span class="description">Default: <?php echo $default['enable_defer_css'] ? 'checked' : 'none'; ?>.</span>
                                        <!-- <p class="help">This is helper text</p> -->
                                    </fieldset>
                                </td>
                            </tr>
                            <tr class="top">
                                <th>
                                    <label for="deferjs_enable_defer_scripts">Optimized JavaScript</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_JS_PREFIX . 'enable_defer_scripts'; ?>">
                                        <input type="checkbox" value="1"
                                        <?php echo $options['enable_defer_scripts'] == true ? 'checked' : ''; ?>
                                        name="<?php echo DEFER_JS_PREFIX . 'enable_defer_scripts'; ?>"
                                        id="deferjs_enable_defer_scripts">
                                        <span class="description">Default: <?php echo $default['enable_defer_scripts'] ? 'checked' : 'none'; ?>.</span>
                                        <p class="help">The loading and execution of scripts that are not necessary for the initial page render will be deferred until after the initial render or other critical parts of the page have finished loading. Use with caution.</p>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr class="top">
                                <th>
                                    <label for="deferjs_enable_defer_images">Lazy load images</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_JS_PREFIX . 'enable_defer_images'; ?>">
                                        <input type="checkbox" value="1"
                                        <?php echo $options['enable_defer_images'] == true ? 'checked' : ''; ?>
                                        name="<?php echo DEFER_JS_PREFIX . 'enable_defer_images'; ?>"
                                        id="deferjs_enable_defer_images">
                                        <span class="description">Default: <?php echo $default['enable_defer_images'] ? 'checked' : 'none'; ?>.</span>
                                        <!-- <p class="help">This is helper text</p> -->
                                    </fieldset>
                                </td>
                            </tr>
                            <tr class="top">
                                <th>
                                    <label for="deferjs_enable_defer_iframes">Lazy load iframes</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_JS_PREFIX . 'enable_defer_iframes'; ?>">
                                        <input type="checkbox" value="1"
                                        <?php echo $options['enable_defer_iframes'] == true ? 'checked' : ''; ?>
                                        name="<?php echo DEFER_JS_PREFIX . 'enable_defer_iframes'; ?>"
                                        id="deferjs_enable_defer_iframes">
                                        <span class="description">Default: <?php echo $default['enable_defer_iframes'] ? 'checked' : 'none'; ?>.</span>
                                        <!-- <p class="help">This is helper text</p> -->
                                    </fieldset>
                                </td>
                            </tr>
                            <tr class="top">
                                <th>
                                    <label for="deferjs_enable_defer_background">Lazy load background</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_JS_PREFIX . 'enable_defer_background'; ?>">
                                        <input type="checkbox" value="1"
                                        <?php echo $options['enable_defer_background'] == true ? 'checked' : ''; ?>
                                        name="<?php echo DEFER_JS_PREFIX . 'enable_defer_background'; ?>"
                                        id="deferjs_enable_defer_background">
                                        <span class="description">Default: <?php echo $default['enable_defer_background'] ? 'checked' : 'none'; ?>.</span>
                                        <p class="help">Defer all inline background images inside style attribute.</p>
                                    </fieldset>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <p class="submit">
                        <?php submit_button(__('Update all'), 'primary', 'save-settings', false); ?>
                        <?php submit_button(__('Reset all to default'), 'secondary', 'reset-settings', false, array('reset-all' => true)); ?>
                    </p>
                </div>
            </div>

            <div class="postbox">
                <h2>Placeholders</h2>
                <div class="inside">
                    <table class="form-table">
                        <tbody>
                            <tr class="top">
                                <th>
                                    <label for="deferjs_use_css_fadein_effects">Fade-in effect</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_JS_PREFIX . 'use_css_fadein_effects'; ?>">
                                        <input type="checkbox" value="1"
                                        <?php echo $options['use_css_fadein_effects'] == true ? 'checked' : ''; ?>
                                        name="<?php echo DEFER_JS_PREFIX . 'use_css_fadein_effects'; ?>"
                                        id="deferjs_use_css_fadein_effects">
                                        <span class="description">Default: <?php echo $default['use_css_fadein_effects'] ? 'checked' : 'none'; ?>.</span>
                                        <p class="help">Add an fade-in effect for lazy images and iframes when they are fully loaded.</p>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr class="top">
                                <th>
                                    <label for="deferjs_use_color_placeholder">Color placeholder</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_JS_PREFIX . 'use_color_placeholder'; ?>">
                                        <input type="checkbox" value="1"
                                        <?php echo $options['use_color_placeholder'] == true ? 'checked' : ''; ?>
                                        name="<?php echo DEFER_JS_PREFIX . 'use_color_placeholder'; ?>"
                                        id="deferjs_use_color_placeholder">
                                        <span class="description">Default: <?php echo $default['use_color_placeholder'] ? 'checked' : 'none'; ?>.</span>
                                        <p class="help">Use a color placeholder for lazy images and iframes.</p>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr class="top">
                                <th>
                                    <label for="deferjs_empty_gif">Image placeholder</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="text"
                                        name="<?php echo DEFER_JS_PREFIX . 'empty_gif'; ?>"
                                        id="deferjs_empty_gif"
                                        value="<?php echo esc_html($options['empty_gif']); ?>">
                                        <p class="help">Leave it empty as default.</p>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr class="top">
                                <th>
                                    <label for="deferjs_empty_src">Iframe placeholder</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="text"
                                        name="<?php echo DEFER_JS_PREFIX . 'empty_src'; ?>"
                                        id="deferjs_empty_src"
                                        value="<?php echo esc_html($options['empty_src']); ?>">
                                        <p class="help">Leave it "about:blank" as default.</p>
                                    </fieldset>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <p class="submit">
                        <?php submit_button(__('Update all'), 'primary', 'save-settings', false); ?>
                        <?php submit_button(__('Reset all to default'), 'secondary', 'reset-settings', false, array('reset-all' => true)); ?>
                    </p>
                </div>
            </div>

            <div class="postbox">
                <h2>Web fonts</h2>
                <div class="inside">
                    <table class="form-table">
                        <tbody>
                            <tr class="top">
                                <th>
                                    <label for="deferjs_defer_web_fonts">Defer web fonts</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_JS_PREFIX . 'defer_web_fonts'; ?>">
                                        <input type="checkbox" value="1"
                                        <?php echo $options['defer_web_fonts'] == true ? 'checked' : ''; ?>
                                        name="<?php echo DEFER_JS_PREFIX . 'defer_web_fonts'; ?>"
                                        id="deferjs_defer_web_fonts">
                                        <span class="description">Default: <?php echo $default['defer_web_fonts'] ? 'checked' : 'none'; ?>.</span>
                                        <p class="help">All web font patterns in the list below will be deferred until the page have finished loading.</p>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr class="top">
                                <th>
                                    <label for="deferjs_web_fonts_patterns">Web font patterns</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <textarea rows="5"
                                        name="<?php echo DEFER_JS_PREFIX . 'web_fonts_patterns'; ?>"
                                        id="deferjs_web_fonts_patterns"><?php echo esc_html(implode("\n", (array) $options['web_fonts_patterns'])); ?></textarea>
                                        <p class="help">Use regular expression. Each expression in one line.</p>
                                    </fieldset>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <p class="submit">
                        <?php submit_button(__('Update all'), 'primary', 'save-settings', false); ?>
                        <?php submit_button(__('Reset all to default'), 'secondary', 'reset-settings', false, array('reset-all' => true)); ?>
                    </p>
                </div>
            </div>

            <div class="postbox">
                <h2>Other settings</h2>
                <div class="inside">
                    <table class="form-table">
                        <tbody>
                            <tr class="top">
                                <th>
                                    <label for="deferjs_loader_scripts">Loader scripts</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <textarea rows="5"
                                        name="<?php echo DEFER_JS_PREFIX . 'loader_scripts'; ?>"
                                        id="deferjs_loader_scripts"><?php echo esc_html(implode("\n", (array) $options['loader_scripts'])); ?></textarea>
                                        <p class="help">Extra javascript to load without deferring. Leave it empty as default.</p>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr class="top">
                                <th>
                                    <label for="deferjs_do_not_optimize">Do NOT optimize:</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <textarea rows="5"
                                        name="<?php echo DEFER_JS_PREFIX . 'do_not_optimize'; ?>"
                                        id="deferjs_do_not_optimize"><?php echo esc_html(implode("\n", (array) $options['do_not_optimize'])); ?></textarea>
                                        <p class="help">Use regular expression. Each expression in one line.</p>
                                    </fieldset>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <p class="submit">
                        <?php submit_button(__('Update all'), 'primary', 'save-settings', false); ?>
                        <?php submit_button(__('Reset all to default'), 'secondary', 'reset-settings', false, array('reset-all' => true)); ?>
                    </p>
                </div>
            </div>

            <div class="postbox">
                <h2>Add defer.js library</h2>
                <div class="inside">
                    <table class="form-table">
                        <tbody>
                            <tr class="top">
                                <th>
                                    <label for="deferjs_append_defer_js">Inline defer.js</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_JS_PREFIX . 'append_defer_js'; ?>">
                                        <input type="checkbox" value="1"
                                        <?php echo $options['append_defer_js'] == true ? 'checked' : ''; ?>
                                        name="<?php echo DEFER_JS_PREFIX . 'append_defer_js'; ?>"
                                        id="deferjs_append_defer_js">
                                        <span class="description">
                                            Default: <?php echo $default['append_defer_js'] ? 'checked' : 'none'; ?>.
                                            Current defer.js version: <?php echo DEFER_JS_VERSION; ?>.</span>
                                        <p class="help">Copy defer.js library and inline it in HTML document.</p>
                                    </fieldset>
                                </td>
                            </tr>
                            <!--
                            <tr class="top">
                                <th>
                                    <label for="deferjs_default_defer_time">Defer timeout</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="number"
                                        name="<?php echo DEFER_JS_PREFIX . 'default_defer_time'; ?>"
                                        id="deferjs_default_defer_time"
                                        value="<?php echo esc_html($options['default_defer_time']); ?>">
                                        <span class="description">Default: <?php echo $default['default_defer_time'] ?: '0'; ?>ms.</span>
                                        <p class="help">Deferred resources will be triggerred loading after a specified number of milliseconds. Tip: 1000ms = 1 second.</p>
                                    </fieldset>
                                </td>
                            </tr>
                            -->
                        </tbody>
                    </table>

                    <p class="submit">
                        <?php submit_button(__('Update all'), 'primary', 'save-settings', false); ?>
                        <?php submit_button(__('Reset all to default'), 'secondary', 'reset-settings', false, array('reset-all' => true)); ?>
                    </p>
                </div>
            </div>
        </form>
    </div>

    <div class="side">
        <div class="postbox">
            <h2><a href='<?php echo DEFER_JS_HOMEPAGE; ?>' target='_blank' class='url'>@shinsenter/defer.js</a></h2>
            <div class="inside">
                <p>🥇 A super tiny, native performance library for lazy-loading JS, CSS, images, iframes... Defer almost anything, easily speed up your website.</p>
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

                <div class="donate">
                    <a href='<?php echo DEFER_JS_PAYPAL; ?>' target="donate"><img width="150" src='<?php echo plugins_url('/donate.png', dirname(__FILE__)); ?>' alt='PayPal - The safer, easier way to pay online!' /></a>
                    <a href='<?php echo DEFER_JS_PATREON; ?>' target="donate"><img width="150" src='https://c5.patreon.com/external/logo/become_a_patron_button@2x.png' alt='Become a sponsor' referrerPolicy='no-referrer' /></a>
                </div>

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

        <?php if (defined('DEFER_JS_SPONSORS_HTML')) {
        echo DEFER_JS_SPONSORS_HTML;
    } ?>
    </div>
</div>