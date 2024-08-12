<?php

/**
 * 🚀 A WordPress plugin that focuses on minimizing payload size of HTML document
 *    and optimizing processing on the browser when rendering the WordPress page.
 * (c) 2021-2024 SHIN Company <service@shin.company>.
 *
 * PHP Version >=5.6
 *
 * @category  Web_Performance_Optimization
 *
 * @author    Mai Nhut Tan <shin@shin.company>
 * @copyright 2021-2024 SHIN Company
 * @license   https://code.shin.company/defer-wordpress/blob/master/LICENSE GNU
 *
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
  $msg = false === $save_settings ?
                'Cannot save the settings you selected.'
                : 'All changes have been saved. Please clear Wordpress cache for these changes to take effect.';
  $err = false === $save_settings ? 'error' : 'updated'; ?>
            <div id="message" class="<?php echo $err; ?> fade">
                <p><strong><?php echo esc_html($msg); ?></strong></p>
            </div>
        <?php
} ?>

        <?php if (!isset($reset_settings) && !isset($save_settings)) { ?>
            <div id="message" class="notice notice-info fade">
                <p>💯 Feel free to leave all the options at their default settings. The plugin will take care of optimizing your website.</p>
            </div>

            <div id="message" class="notice notice-warning fade">
                <p><strong>💡 Tip:</strong> For this plugin to work most effectively, please <u>disable</u> HTML, JavaScript, CSS, and image optimization features from other plugins.</p>

                <p><strong>🧩 Tip:</strong> It's recommended to use this plugin together with another <a href="plugin-install.php?s=caching&tab=search&type=tag">caching plugin</a> for best results.</p>
            </div>
        <?php } ?>

        <form method="post" action="<?php echo DEFER_WP_SETTINGS; ?>">
            <?php settings_fields(DEFER_WP_PLUGIN_NAME); ?>
            <?php do_settings_sections(DEFER_WP_PLUGIN_NAME); ?>

            <div class="postbox">
                <h2>Basic Optimizations</h2>
                <div class="inside">
                    <table class="form-table">
                        <tbody>
                            <tr class="top">
                                <th>
                                    <label for="deferjs_enable_preloading">Enable Preloading</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'enable_preloading'; ?>">
                                        <input type="checkbox" value="1" <?php echo true == $options['enable_preloading'] ? 'checked' : ''; ?> name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'enable_preloading'; ?>" id="deferjs_enable_preloading">
                                        <span class="description">Default: <?php echo $default['enable_preloading'] ? 'Checked' : 'None'; ?>.</span>
                                        <p class="help">
                                            Preload key requests like stylesheets or external scripts to improve page load times.<br>
                                            Read <a rel="nofollow" href="https://web.dev/uses-rel-preload/" target="_blank">this article</a> for more details.
                                        </p>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr class="top">
                                <th>
                                    <label for="deferjs_enable_dns_prefetch">Enable Preconnect</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'enable_dns_prefetch'; ?>">
                                        <input type="checkbox" value="1" <?php echo true == $options['enable_dns_prefetch'] ? 'checked' : ''; ?> name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'enable_dns_prefetch'; ?>" id="deferjs_enable_dns_prefetch">
                                        <span class="description">Default: <?php echo $default['enable_dns_prefetch'] ? 'Checked' : 'None'; ?>.</span>
                                        <p class="help">
                                            DNS resolution can cause significant perceived delay. Enabling DNS prefetching can save around 200 milliseconds in browser navigation time.<br>
                                            Read <a rel="nofollow" href="https://web.dev/uses-rel-preconnect/" target="_blank">this article</a> for more details.
                                        </p>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr class="top">
                                <th>
                                    <label for="deferjs_fix_render_blocking">Fix Render-Blocking</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'fix_render_blocking'; ?>">
                                        <input type="checkbox" value="1" <?php echo true == $options['fix_render_blocking'] ? 'checked' : ''; ?> name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'fix_render_blocking'; ?>" id="deferjs_fix_render_blocking">
                                        <span class="description">Default: <?php echo $default['fix_render_blocking'] ? 'Checked' : 'None'; ?>.</span>
                                        <p class="help">
                                            This moves all stylesheets to the bottom of the

                                            <head> tag and script tags to the bottom of the

                                            <body> tag to prevent render-blocking.<br>
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
                                        <input type="checkbox" value="1" <?php echo true == $options['minify_output_html'] ? 'checked' : ''; ?> name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'minify_output_html'; ?>" id="deferjs_minify_output_html">
                                        <span class="description">Default: <?php echo $default['minify_output_html'] ? 'Checked' : 'None'; ?>.</span>
                                        <p class="help">
                                            Minify the HTML output to reduce file size.<br>
                                            This function is extremely fast and effective. With it enabled, you can disable HTML optimization in other plugins.
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
                <h2>Optimizations for Page Elements</h2>
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
                                        <input type="checkbox" value="1" <?php echo true == $options['optimize_css'] ? 'checked' : ''; ?> name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'optimize_css'; ?>" id="deferjs_optimize_css">
                                        <span class="description">Default: <?php echo $default['optimize_css'] ? 'Checked' : 'None'; ?>.</span>
                                        <p class="help">
                                            Enable optimization for stylesheets. This applies to &lt;style&gt; and &lt;link rel="stylesheet"&gt; tags.<br>
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
                                        <input type="checkbox" value="1" <?php echo true == $options['optimize_scripts'] ? 'checked' : ''; ?> name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'optimize_scripts'; ?>" id="deferjs_optimize_scripts">
                                        <span class="description">Default: <?php echo $default['optimize_scripts'] ? 'Checked' : 'None'; ?>.</span>
                                        <p class="help">
                                            Optimize &lt;script&gt; tags (both inline and external). Note: The plugin only minifies inline script tags.<br>
                                            Read <a rel="nofollow" href="https://web.dev/unminified-javascript/" target="_blank">this article</a> for more details.
                                        </p>
                                    </fieldset>
                                </td>
                            </tr>

                            <tr class="top">
                                <th>
                                    <label for="deferjs_optimize_images">Lazy Load Media</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'optimize_images'; ?>">
                                        <input type="checkbox" value="1" <?php echo true == $options['optimize_images'] ? 'checked' : ''; ?> name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'optimize_images'; ?>" id="deferjs_optimize_images">
                                        <span class="description">Default: <?php echo $default['optimize_images'] ? 'Checked' : 'None'; ?>.</span>
                                        <p class="help">
                                            Optimize &lt;img&gt;, &lt;picture&gt;, &lt;video&gt;, &lt;audio&gt;, and &lt;source&gt; tags for lazy loading.<br>
                                            Read <a rel="nofollow" href="https://web.dev/lazy-loading-images/" target="_blank">this article</a> and <a rel="nofollow" href="https://web.dev/browser-level-image-lazy-loading/" target="_blank">this article</a> for more details.</p>
                                        </p>
                                    </fieldset>
                                </td>
                            </tr>

                            <tr class="top">
                                <th>
                                    <label for="deferjs_optimize_iframes">Lazy Load Iframes</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'optimize_iframes'; ?>">
                                        <input type="checkbox" value="1" <?php echo true == $options['optimize_iframes'] ? 'checked' : ''; ?> name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'optimize_iframes'; ?>" id="deferjs_optimize_iframes">
                                        <span class="description">Default: <?php echo $default['optimize_iframes'] ? 'Checked' : 'None'; ?>.</span>
                                        <p class="help">
                                            Optimize &lt;iframe&gt;, &lt;frame&gt;, and &lt;embed&gt; tags for lazy loading.<br>
                                            Read <a rel="nofollow" href="https://web.dev/lazy-loading-video/" target="_blank">this article</a> for more details.
                                        </p>
                                    </fieldset>
                                </td>
                            </tr>

                            <tr class="top">
                                <th>
                                    <label for="deferjs_optimize_background">Lazy Load Backgrounds</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'optimize_background'; ?>">
                                        <input type="checkbox" value="1" <?php echo true == $options['optimize_background'] ? 'checked' : ''; ?> name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'optimize_background'; ?>" id="deferjs_optimize_background">
                                        <span class="description">Default: <?php echo $default['optimize_background'] ? 'Checked' : 'None'; ?>.</span>
                                        <p class="help">
                                            Optimize tags with CSS background-image properties that load images from external sources.<br>
                                            For example, style properties contain <code>background-image:url()</code> etc.<br>
                                            Read <a rel="nofollow" href="https://web.dev/optimize-css-background-images-with-media-queries/" target="_blank">this article</a> for more details.</p>
                                        </p>
                                    </fieldset>
                                </td>
                            </tr>

                            <tr class="top">
                                <th>
                                    <label for="deferjs_optimize_fallback">Create Fallback for No JavaScript</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'optimize_fallback'; ?>">
                                        <input type="checkbox" value="1" <?php echo true == $options['optimize_fallback'] ? 'checked' : ''; ?> name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'optimize_fallback'; ?>" id="deferjs_optimize_fallback">
                                        <span class="description">Default: <?php echo $default['optimize_fallback'] ? 'Checked' : 'None'; ?>.</span>
                                        <p class="help">
                                            Create &lt;noscript&gt; tags so lazy-loaded elements still display when JavaScript is disabled.<br>
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
                                    <label for="deferjs_optimize_anchors">Fix Unsafe Anchor Links</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'optimize_anchors'; ?>">
                                        <input type="checkbox" value="1" <?php echo true == $options['optimize_anchors'] ? 'checked' : ''; ?> name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'optimize_anchors'; ?>" id="deferjs_optimize_anchors">
                                        <span class="description">Default: <?php echo $default['optimize_anchors'] ? 'Checked' : 'None'; ?>.</span>
                                        <p class="help">
                                            Fix unsafe links pointing to cross-origin destinations.<br>
                                            Read <a rel="nofollow" href="https://web.dev/external-anchors-use-rel-noopener/" target="_blank">this article</a> for more details.</p>
                                        </p>
                                    </fieldset>
                                </td>
                            </tr>

                            <tr class="top">
                                <th>
                                    <label for="deferjs_defer_third_party">Optimize Third-Party Resources</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'defer_third_party'; ?>">
                                        <input type="checkbox" value="1" <?php echo true == $options['defer_third_party'] ? 'checked' : ''; ?> name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'defer_third_party'; ?>" id="deferjs_defer_third_party">
                                        <span class="description">Default: <?php echo $default['defer_third_party'] ? 'Checked' : 'None'; ?>.</span>
                                        <p class="help">
                                            Enable optimization for third-party resources like web fonts.<br>
                                            Disable if you encounter JavaScript or CSS issues.
                                        </p>
                                    </fieldset>
                                </td>
                            </tr>

                            <tr class="top">
                                <th>
                                    <label for="deferjs_use_css_fadein_effects">Fade-in Effect</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'use_css_fadein_effects'; ?>">
                                        <input type="checkbox" value="1" <?php echo true == $options['use_css_fadein_effects'] ? 'checked' : ''; ?> name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'use_css_fadein_effects'; ?>" id="deferjs_use_css_fadein_effects">
                                        <span class="description">Default: <?php echo $default['use_css_fadein_effects'] ? 'Checked' : 'None'; ?>.</span>
                                        <p class="help">Apply a fade-in animation to elements after lazy-loading.</p>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr class="top">
                                <th>
                                    <label for="deferjs_use_color_placeholder">Color Placeholder</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="hidden" value="0" name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'use_color_placeholder'; ?>">
                                        <input type="checkbox" value="1" <?php echo true == $options['use_color_placeholder'] ? 'checked' : ''; ?> name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'use_color_placeholder'; ?>" id="deferjs_use_color_placeholder">
                                        <span class="description">Default: <?php echo $default['use_color_placeholder'] ? 'Checked' : 'None'; ?>.</span>
                                        <p class="help">Use random background colors as placeholders for lazy-loaded images.</p>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr class="top">
                                <th>
                                    <label for="deferjs_img_placeholder">Image Placeholder</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="text" name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'img_placeholder'; ?>" id="deferjs_img_placeholder" value="<?php echo esc_html($options['img_placeholder']); ?>">
                                        <p><span class="description">Default: <?php echo $default['img_placeholder'] ?: 'Leave empty'; ?>.</span></p>
                                        <p class="help">Default placeholder for lazy-loaded &lt;img&gt; tags.</p>
                                    </fieldset>
                                </td>
                            </tr>

                            <tr class="top">
                                <th>
                                    <label for="deferjs_iframe_placeholder">Iframe Placeholder</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="text" name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'iframe_placeholder'; ?>" id="deferjs_iframe_placeholder" value="<?php echo esc_html($options['iframe_placeholder']); ?>">
                                        <p><span class="description">Default: <?php echo $default['iframe_placeholder'] ?: 'Leave empty'; ?>.</span></p>
                                        <p class="help">Default placeholder for lazy-loaded &lt;iframe&gt; tags.</p>
                                    </fieldset>
                                </td>
                            </tr>

                            <tr class="top">
                                <th>
                                    <label for="defer_long_copyright">Credits</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <textarea rows="5" style="font-family: monospace;" name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'long_copyright'; ?>" id="defer_long_copyright"><?php echo esc_html($options['long_copyright']); ?></textarea>
                                        <p class="help">If you found this plugin useful, please help share it by adding a short message at the bottom of your HTML output. This won't affect your website.</p>
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
                <h2>Exclude from Lazy-Loading</h2>
                <div class="inside">
                    <table class="form-table">
                        <tbody>
                            <tr class="top">
                                <th>
                                    <label for="defer_ignore_lazyload_css_class">Exclude by CSS Class</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <textarea rows="5" name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'ignore_lazyload_css_class'; ?>" id="defer_ignore_lazyload_css_class"><?php echo esc_html(implode("\n", $options['ignore_lazyload_css_class'])); ?></textarea>
                                        <p><span class="description">Default: Leave empty.</span></p>
                                        <p class="help">Skip lazy-loading for elements containing these CSS class names (one per line).</p>
                                        <p class="help notice">Caution: Adding many classes will reduce performance.</p>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr class="top">
                                <th>
                                    <label for="defer_ignore_lazyload_css_selectors">Exclude by CSS Selector</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <textarea rows="5" name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'ignore_lazyload_css_selectors'; ?>" id="defer_ignore_lazyload_css_selectors"><?php echo esc_html(implode("\n", $options['ignore_lazyload_css_selectors'])); ?></textarea>
                                        <p><span class="description">Default: Leave empty.</span></p>
                                        <p class="help">Skip lazy-loading for elements matching these CSS selectors (one per line).<br>
                                            Read <a rel="nofollow" href="https://www.w3schools.com/cssref/css_selectors.asp" target="_blank">this article</a> for more details.</p>
                                        <p class="help notice">Caution: Too many CSS selectors will reduce performance.</p>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr class="top">
                                <th><label for="defer_ignore_lazyload_css_selectors">Better Solutions</label></th>
                                <td>
                                    <p class="help notice-info notice">You can add a <code>data-ignore</code> attribute to any element you don't want optimized by the plugin.</p>

                                    <pre><code><?php echo esc_html('<!-- Example for add data-ignore for an img tag -->
<img data-ignore src="my_photo.jpeg" alt="Awesome photo" />'); ?></code></pre>

                                    <p class="help notice-info notice">You can add a <code>data-nolazy</code> attribute to &lt;img&gt;, &lt;picture&gt;, &lt;video&gt;, &lt;audio&gt;, &lt;iframe&gt;, and &lt;link rel="stylesheet"&gt; elements to exclude just lazy-loading while allowing other optimizationss.</p>

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
                <h2>Support for Old Browsers (like IE9)</h2>
                <div class="inside">
                    <table class="form-table">
                        <tbody>
                            <tr class="top">
                                <th>
                                    <label for="defer_polyfill_src">JS Polyfill URL</label>
                                </th>
                                <td>
                                    <fieldset>
                                        <input type="text" name="<?php echo DEFER_WP_PLUGIN_PREFIX . 'polyfill_src'; ?>" id="defer_polyfill_src" value="<?php echo esc_html($options['polyfill_src']); ?>">
                                        <p><span class="description">Default: <code><?php echo $default['polyfill_src']; ?></code>.</span></p>
                                        <p class="help">This polyfill library provides <code>IntersectionObserver</code> API support for browsers lacking native support.<br>See the <a rel="nofollow" href="https://developer.mozilla.org/en-US/docs/Web/API/Intersection_Observer_API" target="_blank">API documentation</a> for usage information.</p>
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
            <h2>A faster website! (aka defer.js)</h2>
            <div class="inside">
                <p>🥇 Latest website optimization technologies by experienced web experts. 💯 SEO friendly. 🔰 Very easy to use.</p>
                <p><a href="<?php echo DEFER_WP_RATING; ?>" target="rating">Rate 5 stars (⭐️⭐️⭐️⭐️⭐️)</a> if you guys like it.</p>
                <p>View more: <a href='<?php echo DEFER_WP_PLUGIN_URL; ?>' target='_blank' class='url'>A faster website! (aka defer.js)</a>.</p>
                <hr />

                <h3>Powered by <a href='<?php echo DEFER_WP_HOMEPAGE; ?>' target='_blank' class='url'>@shinsenter/defer.js</a></h3>
                <p>🥇 A super small, super efficient library that helps you lazy load almost everything like images, video, audio, iframes as well as stylesheets, and JavaScript.</p>
                <p>
                    <img src='https://img.shields.io/github/license/shinsenter/defer.js.svg' alt='GitHub' referrerPolicy='no-referrer' />
                    <img src='https://img.shields.io/github/release-date/shinsenter/defer.js.svg' alt='GitHub Release Date' referrerPolicy='no-referrer' />
                    <img src='https://img.shields.io/npm/v/@shinsenter/defer.js.svg' alt='npm' referrerPolicy='no-referrer' />
                    <img src='https://img.shields.io/bundlephobia/minzip/@shinsenter/defer.js.svg' alt='npm bundle size' referrerPolicy='no-referrer' />
                    <a href='https://www.jsdelivr.com/package/npm/@shinsenter/defer.js'><img src='https://data.jsdelivr.com/v1/package/npm/@shinsenter/defer.js/badge?style=rounded' alt='jsDelivr hits (GitHub)' referrerPolicy='no-referrer' /></a>
                </p>

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
                        <a href='<?php echo DEFER_SOURCE_HOMEPAGE; ?>/stargazers' target='_blank' class='url'><?php echo DEFER_SOURCE_HOMEPAGE; ?>/stargazers</a>
                    </li>
                    <li>■ Report an issue:
                        <a href='<?php echo DEFER_SOURCE_HOMEPAGE; ?>/issues' target='_blank' class='url'><?php echo DEFER_SOURCE_HOMEPAGE; ?>/issues</a>
                    </li>
                    <li>■ Keep up-to-date with new releases:
                        <a href='<?php echo DEFER_SOURCE_HOMEPAGE; ?>/releases' target='_blank' class='url'><?php echo DEFER_SOURCE_HOMEPAGE; ?>/releases</a>
                    </li>
                </ul>
                <hr />
                <p>Released under the MIT license.
                    <a href='<?php echo DEFER_SOURCE_HOMEPAGE; ?>/LICENSE' target='_blank' class='url'><?php echo DEFER_SOURCE_HOMEPAGE; ?>/LICENSE</a>
                </p>
                <p>Copyright (c) <?php echo date('Y'); ?> Mai Nhut Tan &lt;<a href='mailto:shin@shin.company'>shin@shin.company</a>&gt;.</p>
                <p>From Vietnam 🇻🇳 with love.</p>
            </div>
        </div>
    </div>
</div>
