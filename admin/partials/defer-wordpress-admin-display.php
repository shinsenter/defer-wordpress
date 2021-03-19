<?php

/**
 * 🚀 A WordPress plugin that focuses on minimizing payload size of HTML document
 *    and optimizing processing on the browser when rendering the WordPress page.
 * (c) 2021 AppSeeds <hello@appseeds.net>
 *
 * PHP Version >=5.6
 *
 * @category  Web_Performance_Optimization
 * @author    Mai Nhut Tan <shin@shin.company>
 * @copyright 2021 AppSeeds
 * @license   https://code.shin.company/defer-wordpress/blob/master/LICENSE GNU
 * @see      https://code.shin.company/defer-wordpress
 * @see       https://code.shin.company/defer-wordpress/blob/master/README.md
 */
?>

<link rel="icon" type="image/jpg" href="<?php echo plugins_url('/icon.jpg', dirname(__FILE__)); ?>">

<div class="wrap">
    <div class="main">
        <h1>
            <img class="deferjs-icon" src="<?php echo plugins_url('/icon.jpg', dirname(__FILE__)); ?>" width="32" height="32" alt="defer.js">
            Customize defer.js
        </h1>

        <?php if (isset($reset_settings)) { ?>
            <div id="message" class="updated fade">
                <p><strong>Settings have been reset to default settings. Please clear Wordpress cache for these settings to take effect.</strong></p>
            </div>
        <?php } ?>

        <?php if (isset($save_settings)) {
    $msg = $save_settings === false ?
                'Cannot save the settings you selected.'
                : 'All changes have been saved. Please clear Wordpress cache for these changes to take effect.';
    $err = $save_settings === false ? 'error' : 'updated'; ?>
            <div id="message" class="<?php echo $err; ?> fade">
                <p><strong><?php echo esc_html($msg); ?></strong></p>
            </div>
        <?php
} ?>

        <?php if (!isset($reset_settings) && !isset($save_settings)) { ?>
            <div id="message" class="notice notice-info fade">
                <p><strong>💡 Tip:</strong> For this plugin to be most effective, please <u>turn OFF</u> optimization features for HTML, JS, CSS, images... by other plugins.</p>
                <p><strong>🧩 Tip:</strong> This plugin is recommended for use with another <a href="plugin-install.php?s=caching&tab=search&type=tag">caching plugin</a> for best results.</p>
            </div>
        <?php } ?>

        <form method="post" action="<?php echo DEFER_WP_SETTINGS; ?>">
            <?php settings_fields(DEFER_WP_PLUGIN_NAME); ?>
            <?php do_settings_sections(DEFER_WP_PLUGIN_NAME); ?>

            <div class="postbox">
                <h2>Basic optimizations</h2>
                <div class="inside">
                    <table class="form-table">
                        <tbody>
                            <tr class="top">
                                <th>
                                    <label for="deferjs_enable_preloading">Enable preloading</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'enable_preloading'; ?>">
                                        <input type="checkbox" value="1"
                                        <?php echo $options['enable_preloading'] == true ? 'checked' : ''; ?>
                                        name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'enable_preloading'; ?>"
                                        id="deferjs_enable_preloading">
                                        <span class="description">Default: <?php echo $default['enable_preloading'] ? 'checked' : 'none'; ?>.</span>
                                        <p class="help">
                                            Preload key requests such as stylesheets or external scripts.<br>
                                            Read <a rel="nofollow" href="https://web.dev/uses-rel-preload/" target="_blank">this article</a> for more details.
                                        </p>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr class="top">
                                <th>
                                    <label for="deferjs_enable_dns_prefetch">Enable preconnect</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'enable_dns_prefetch'; ?>">
                                        <input type="checkbox" value="1"
                                        <?php echo $options['enable_dns_prefetch'] == true ? 'checked' : ''; ?>
                                        name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'enable_dns_prefetch'; ?>"
                                        id="deferjs_enable_dns_prefetch">
                                        <span class="description">Default: <?php echo $default['enable_dns_prefetch'] ? 'checked' : 'none'; ?>.</span>
                                        <p class="help">
                                            DNS resolution time can lead to a significant amount of user perceived latency. Enabling DNS prefetch saves about 200 milliseconds in browser navigation.<br>
                                            Read <a rel="nofollow" href="https://web.dev/uses-rel-preconnect/" target="_blank">this article</a> for more details.
                                        </p>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr class="top">
                                <th>
                                    <label for="deferjs_fix_render_blocking">Fix render-blocking</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'fix_render_blocking'; ?>">
                                        <input type="checkbox" value="1"
                                        <?php echo $options['fix_render_blocking'] == true ? 'checked' : ''; ?>
                                        name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'fix_render_blocking'; ?>"
                                        id="deferjs_fix_render_blocking">
                                        <span class="description">Default: <?php echo $default['fix_render_blocking'] ? 'checked' : 'none'; ?>.</span>
                                        <p class="help">
                                            This option moves all stylesheets to bottom of the head tag, and moves script tags to bottom of the body tag.<br>
                                            Read <a rel="nofollow" href="https://web.dev/render-blocking-resources/" target="_blank">this article</a> for more details.
                                        </p>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr class="top">
                                <th>
                                    <label for="deferjs_minify_output_html">Minify HTML</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'minify_output_html'; ?>">
                                        <input type="checkbox" value="1"
                                        <?php echo $options['minify_output_html'] == true ? 'checked' : ''; ?>
                                        name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'minify_output_html'; ?>"
                                        id="deferjs_minify_output_html">
                                        <span class="description">Default: <?php echo $default['minify_output_html'] ? 'checked' : 'none'; ?>.</span>
                                        <p class="help">
                                            Minify HTML output.<br>
                                            This function is extremely fast and good. With this function enabled, you can turn off all HTML optimization features of other plugins.
                                        </p>
                                    </fieldset>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <p class="submit">
                        <?php submit_button(__('Update all'), 'primary', 'save-settings', false); ?>
                        <?php submit_button(__('Reset all to default'), 'secondary', 'reset-settings', false, ['reset-all' => true]); ?>
                    </p>
                </div>
            </div>

            <div class="postbox">
                <h2>Optimizations for elements on the page</h2>
                <div class="inside">
                    <table class="form-table">
                        <tbody>
                            <tr class="top">
                                <th>
                                    <label for="deferjs_optimize_css">Optimized CSS</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'optimize_css'; ?>">
                                        <input type="checkbox" value="1"
                                        <?php echo $options['optimize_css'] == true ? 'checked' : ''; ?>
                                        name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'optimize_css'; ?>"
                                        id="deferjs_optimize_css">
                                        <span class="description">Default: <?php echo $default['optimize_css'] ? 'checked' : 'none'; ?>.</span>
                                        <p class="help">
                                            Turn on optimization for stylesheets. This optimization applies to style and link[rel="stylesheet"] tags.<br>
                                            Read <a rel="nofollow" href="https://web.dev/extract-critical-css/" target="_blank">this article</a> for more details.
                                        </p>
                                    </fieldset>
                                </td>
                            </tr>

                            <tr class="top">
                                <th>
                                    <label for="deferjs_optimize_scripts">Optimized JavaScript</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'optimize_scripts'; ?>">
                                        <input type="checkbox" value="1"
                                        <?php echo $options['optimize_scripts'] == true ? 'checked' : ''; ?>
                                        name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'optimize_scripts'; ?>"
                                        id="deferjs_optimize_scripts">
                                        <span class="description">Default: <?php echo $default['optimize_scripts'] ? 'checked' : 'none'; ?>.</span>
                                        <p class="help">
                                            Optimize script tags (both inline and external scripts). Note: The library only minify for inline script tags.<br>
                                            Read <a rel="nofollow" href="https://web.dev/unminified-javascript/" target="_blank">this article</a> for more details.
                                        </p>
                                    </fieldset>
                                </td>
                            </tr>

                            <tr class="top">
                                <th>
                                    <label for="deferjs_optimize_images">Lazy load media</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'optimize_images'; ?>">
                                        <input type="checkbox" value="1"
                                        <?php echo $options['optimize_images'] == true ? 'checked' : ''; ?>
                                        name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'optimize_images'; ?>"
                                        id="deferjs_optimize_images">
                                        <span class="description">Default: <?php echo $default['optimize_images'] ? 'checked' : 'none'; ?>.</span>
                                        <p class="help">
                                            Optimize img, picture, video, audio and source tags.<br>
                                            Read <a rel="nofollow" href="https://web.dev/lazy-loading-images/" target="_blank">this article</a> and <a rel="nofollow" href="https://web.dev/browser-level-image-lazy-loading/" target="_blank">this article</a> for more details.</p>
                                        </p>
                                    </fieldset>
                                </td>
                            </tr>

                            <tr class="top">
                                <th>
                                    <label for="deferjs_optimize_iframes">Lazy load iframes</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'optimize_iframes'; ?>">
                                        <input type="checkbox" value="1"
                                        <?php echo $options['optimize_iframes'] == true ? 'checked' : ''; ?>
                                        name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'optimize_iframes'; ?>"
                                        id="deferjs_optimize_iframes">
                                        <span class="description">Default: <?php echo $default['optimize_iframes'] ? 'checked' : 'none'; ?>.</span>
                                        <p class="help">
                                            Optimize iframe, frame, embed tags.<br>
                                            Read <a rel="nofollow" href="https://web.dev/lazy-loading-video/" target="_blank">this article</a> for more details.
                                        </p>
                                    </fieldset>
                                </td>
                            </tr>

                            <tr class="top">
                                <th>
                                    <label for="deferjs_optimize_background">Lazy load background</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'optimize_background'; ?>">
                                        <input type="checkbox" value="1"
                                        <?php echo $options['optimize_background'] == true ? 'checked' : ''; ?>
                                        name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'optimize_background'; ?>"
                                        id="deferjs_optimize_background">
                                        <span class="description">Default: <?php echo $default['optimize_background'] ? 'checked' : 'none'; ?>.</span>
                                        <p class="help">
                                            Optimize tags that containing CSS for loading images from external sources.<br>
                                            For example, style properties contain <code>background-image:url()</code> etc.<br>
                                            Read <a rel="nofollow" href="https://web.dev/optimize-css-background-images-with-media-queries/" target="_blank">this article</a> for more details.</p>
                                        </p>
                                    </fieldset>
                                </td>
                            </tr>

                            <tr class="top">
                                <th>
                                    <label for="deferjs_optimize_fallback">Create fallback content when JavaScript is not available</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'optimize_fallback'; ?>">
                                        <input type="checkbox" value="1"
                                        <?php echo $options['optimize_fallback'] == true ? 'checked' : ''; ?>
                                        name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'optimize_fallback'; ?>"
                                        id="deferjs_optimize_fallback">
                                        <span class="description">Default: <?php echo $default['optimize_fallback'] ? 'checked' : 'none'; ?>.</span>
                                        <p class="help">
                                            Create <code>&lt;noscript&gt;</code> tags so lazy-loaded elements can still display even when the browser doesn't have javascript enabled.<br>
                                            This option applies to all tags that have been lazy-loaded.<br>
                                            Read <a rel="nofollow" href="https://web.dev/without-javascript/" target="_blank">this article</a> for more details.</p>
                                        </p>
                                    </fieldset>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <p class="submit">
                        <?php submit_button(__('Update all'), 'primary', 'save-settings', false); ?>
                        <?php submit_button(__('Reset all to default'), 'secondary', 'reset-settings', false, ['reset-all' => true]); ?>
                    </p>
                </div>
            </div>

            <div class="postbox">
                <h2>Other customizations</h2>
                <div class="inside">
                    <table class="form-table">
                        <tbody>
                            <tr class="top">
                                <th>
                                    <label for="deferjs_optimize_anchors">Fix unsafe anchor tags</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'optimize_anchors'; ?>">
                                        <input type="checkbox" value="1"
                                        <?php echo $options['optimize_anchors'] == true ? 'checked' : ''; ?>
                                        name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'optimize_anchors'; ?>"
                                        id="deferjs_optimize_anchors">
                                        <span class="description">Default: <?php echo $default['optimize_anchors'] ? 'checked' : 'none'; ?>.</span>
                                        <p class="help">
                                            Fix unsafe links to cross-origin destinations.<br>
                                            Read <a rel="nofollow" href="https://web.dev/external-anchors-use-rel-noopener/" target="_blank">this article</a> for more details.</p>
                                        </p>
                                    </fieldset>
                                </td>
                            </tr>

                            <tr class="top">
                                <th>
                                    <label for="deferjs_defer_third_party">Optimized third-party resources</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'defer_third_party'; ?>">
                                        <input type="checkbox" value="1"
                                        <?php echo $options['defer_third_party'] == true ? 'checked' : ''; ?>
                                        name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'defer_third_party'; ?>"
                                        id="deferjs_defer_third_party">
                                        <span class="description">Default: <?php echo $default['defer_third_party'] ? 'checked' : 'none'; ?>.</span>
                                        <p class="help">
                                            Turn on optimization for third-party resources such as web fonts.<br>
                                            If there are unexpected JavaScript or CSS related errors, please try disabling this feature.
                                        </p>
                                    </fieldset>
                                </td>
                            </tr>

                            <tr class="top">
                                <th>
                                    <label for="deferjs_use_css_fadein_effects">Fade-in effect</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'use_css_fadein_effects'; ?>">
                                        <input type="checkbox" value="1"
                                        <?php echo $options['use_css_fadein_effects'] == true ? 'checked' : ''; ?>
                                        name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'use_css_fadein_effects'; ?>"
                                        id="deferjs_use_css_fadein_effects">
                                        <span class="description">Default: <?php echo $default['use_css_fadein_effects'] ? 'checked' : 'none'; ?>.</span>
                                        <p class="help">Apply fade-in animation to tags after being lazy-loaded.</p>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr class="top">
                                <th>
                                    <label for="deferjs_use_color_placeholder">Color placeholder</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'use_color_placeholder'; ?>">
                                        <input type="checkbox" value="1"
                                        <?php echo $options['use_color_placeholder'] == true ? 'checked' : ''; ?>
                                        name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'use_color_placeholder'; ?>"
                                        id="deferjs_use_color_placeholder">
                                        <span class="description">Default: <?php echo $default['use_color_placeholder'] ? 'checked' : 'none'; ?>.</span>
                                        <p class="help">Use random background colors for images to be lazy-loaded.</p>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr class="top">
                                <th>
                                    <label for="deferjs_img_placeholder">Image placeholder</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="text"
                                        name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'img_placeholder'; ?>"
                                        id="deferjs_img_placeholder"
                                        value="<?php echo esc_html($options['img_placeholder']); ?>">
                                        <p><span class="description">Default: <?php echo $default['img_placeholder'] ?: 'empty string'; ?>.</span></p>
                                        <p class="help">Default placeholder for lazy-loaded IMG tags.</p>
                                    </fieldset>
                                </td>
                            </tr>

                            <tr class="top">
                                <th>
                                    <label for="deferjs_iframe_placeholder">Iframe placeholder</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="text"
                                        name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'iframe_placeholder'; ?>"
                                        id="deferjs_iframe_placeholder"
                                        value="<?php echo esc_html($options['iframe_placeholder']); ?>">
                                        <p><span class="description">Default: <?php echo $default['iframe_placeholder'] ?: 'empty string'; ?>.</span></p>
                                        <p class="help">Default placeholder for lazy-loaded IFRAME tags.</p>
                                    </fieldset>
                                </td>
                            </tr>

                            <tr class="top">
                                <th>
                                    <label for="defer_long_copyright">Credits</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <textarea rows="5" style="font-family: monospace;"
                                        name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'long_copyright'; ?>"
                                        id="defer_long_copyright"><?php echo esc_html($options['long_copyright']); ?></textarea>
                                        <p class="help">If you found this plugin useful, please help me share it with other people by appending a little information at the bottom of your HTML. This information does not affect your website at all.</p>
                                    </fieldset>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <p class="submit">
                        <?php submit_button(__('Update all'), 'primary', 'save-settings', false); ?>
                        <?php submit_button(__('Reset all to default'), 'secondary', 'reset-settings', false, ['reset-all' => true]); ?>
                    </p>
                </div>
            </div>

            <div class="postbox">
                <h2>Ignore lazy-loading for some elements</h2>
                <div class="inside">
                    <table class="form-table">
                        <tbody>
                            <tr class="top">
                                <th>
                                    <label for="defer_ignore_lazyload_css_class">Exclude by CSS class names</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <textarea rows="5"
                                        name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'ignore_lazyload_css_class'; ?>"
                                        id="defer_ignore_lazyload_css_class"><?php echo esc_html(implode("\n", $options['ignore_lazyload_css_class'])); ?></textarea>
                                        <p><span class="description">Default: leave it empty.</span></p>
                                        <p class="help">Skip lazy-loading for tags containing any of these CSS class names. Each class name is in one line.</p>
                                        <p class="help notice">Caution: checking many CSS class names for each element will significantly reduce the performance of this plugin.</p>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr class="top">
                                <th>
                                    <label for="defer_ignore_lazyload_css_selectors">Exclude by CSS selector</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <textarea rows="5"
                                        name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'ignore_lazyload_css_selectors'; ?>"
                                        id="defer_ignore_lazyload_css_selectors"><?php echo esc_html(implode("\n", $options['ignore_lazyload_css_selectors'])); ?></textarea>
                                        <p><span class="description">Default: leave it empty.</span></p>
                                        <p class="help">Skip lazy-loading for tags matching any of these CSS selectors. Each CSS selector is in one line.<br>
                                            Read <a rel="nofollow" href="https://www.w3schools.com/cssref/css_selectors.asp" target="_blank">this article</a> for more details.</p>
                                        <p class="help notice">Caution: handling too many CSS selectors will significantly reduce the performance of this plugin.</p>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr class="top">
                                <th><label for="defer_ignore_lazyload_css_selectors">Better solutions</label></th>
                                <td>
                                    <p class="help notice-info notice">You may add an <code>data-ignore</code> attribute to element that you don't want it to be optimized by the library. This attribute can be used for all HTML elements.</p>

                                    <pre><code><?php echo esc_html('<!-- Example for add data-ignore for an img tag -->
<img data-ignore src="my_photo.jpeg" alt="Awesome photo" />'); ?></code></pre>

                                    <p class="help notice-info notice">You may add an <code>data-nolazy</code> attribute to element that you don't want it to be lazy-loaded by the library. Other optimizations for that element will still be applied except lazy-load. This attribute can be used for all <code>&lt;img&gt;</code>, <code>&lt;picture&gt;</code>, <code>&lt;video&gt;</code>, <code>&lt;audio&gt;</code>, <code>&lt;iframe&gt;</code> and also <code>&lt;link rel="stylesheet"&gt;</code> elements.</p>

                                    <pre><code><?php echo esc_html('<!-- Example for add data-nolazy for an img tag -->
<img data-nolazy src="my_photo.jpeg" alt="Awesome photo" />'); ?></code></pre>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <p class="submit">
                        <?php submit_button(__('Update all'), 'primary', 'save-settings', false); ?>
                        <?php submit_button(__('Reset all to default'), 'secondary', 'reset-settings', false, ['reset-all' => true]); ?>
                    </p>
                </div>
            </div>

            <div class="postbox">
                <h2>Support for old browsers (IE9)</h2>
                <div class="inside">
                    <table class="form-table">
                        <tbody>
                            <tr class="top">
                                <th>
                                    <label for="defer_polyfill_src">JS polyfill URL</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="text"
                                        name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'polyfill_src'; ?>"
                                        id="defer_polyfill_src"
                                        value="<?php echo esc_html($options['polyfill_src']); ?>">
                                        <p><span class="description">Default: <code><?php echo $default['polyfill_src']; ?></code>.</span></p>
                                        <p class="help">This library polyfills the native <code>IntersectionObserver</code> API in unsupporting browsers.<br>See the <a rel="nofollow" href="https://developer.mozilla.org/en-US/docs/Web/API/Intersection_Observer_API" target="_blank">API documentation</a> for usage information.</p>
                                    </fieldset>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <p class="submit">
                        <?php submit_button(__('Update all'), 'primary', 'save-settings', false); ?>
                        <?php submit_button(__('Reset all to default'), 'secondary', 'reset-settings', false, ['reset-all' => true]); ?>
                    </p>
                </div>
            </div>
        </form>
    </div>

    <div class="side">
        <div class="postbox">
            <h2><a href='<?php echo DEFER_WP_HOMEPAGE; ?>' target='_blank' class='url'>@shinsenter/defer.js</a></h2>
            <div class="inside">
                <p>🥇 A super tiny, native performance library for lazy-loading JS, CSS, images, iframes... Defer almost anything, easily speed up your website.</p>
                <p><a href="<?php echo DEFER_WP_RATING; ?>" target="rating">Rate 5 stars (⭐️⭐️⭐️⭐️⭐️)</a> if you guys like it.</p>
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
                    <a href='<?php echo DEFER_WP_PAYPAL; ?>' target="donate"><img width="150" src='<?php echo plugins_url('/donate.png', dirname(__FILE__)); ?>' alt='PayPal - The safer, easier way to pay online!' /></a>
                    <a href='<?php echo DEFER_WP_PATREON; ?>' target="donate"><img width="150" src='https://c5.patreon.com/external/logo/become_a_patron_button@2x.png' alt='Become a sponsor' referrerPolicy='no-referrer' /></a>
                </div>

                <h3>Keep in touch</h3>
                <ul>
                    <li>■ Become a stargazer:
                        <a href='<?php echo DEFER_WP_HOMEPAGE; ?>/stargazers' target='_blank' class='url'><?php echo DEFER_WP_HOMEPAGE; ?>/stargazers</a></li>
                    <li>■ Report an issue:
                        <a href='<?php echo DEFER_WP_HOMEPAGE; ?>/issues' target='_blank' class='url'><?php echo DEFER_WP_HOMEPAGE; ?>/issues</a></li>
                    <li>■ Keep up-to-date with new releases:
                        <a href='<?php echo DEFER_WP_HOMEPAGE; ?>/releases' target='_blank' class='url'><?php echo DEFER_WP_HOMEPAGE; ?>/releases</a></li>
                </ul>
                <hr />
                <p>Released under the MIT license.
                    <a href='<?php echo DEFER_WP_HOMEPAGE; ?>/LICENSE' target='_blank' class='url'><?php echo DEFER_WP_HOMEPAGE; ?>/LICENSE</a></p>
                <p>Copyright (c) 2019 Mai Nhut Tan &lt;<a href='mailto:shin@shin.company'>shin@shin.company</a>&gt;.</p>
                <p>From Vietnam 🇻🇳 with love.</p>
            </div>
        </div>
    </div>
</div>
