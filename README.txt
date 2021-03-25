=== A faster website (with defer.js)! ===
Contributors: shinsenter
Donate link: https://www.paypal.me/shinsenter
Tags: defer.js,optimization,core-web-vitals,lazyload,loading-lazy,lazy-loading,lazyload-image,lazyload-video,lazyload-font,lazyload-js,lazyload-css,lazyload-wordpress,lazyload-facebook,lazyload-youtube,site-performance,speed,pagespeed,page-speed,html-minify,shinsenter
Requires at least: 4.0
Tested up to: 5.8-beta
Stable tag: trunk
Requires PHP: 5.6
License: GPL-2.0+
License URI: https://code.shin.company/defer-wordpress/blob/master/LICENSE

⚡️ A native, blazing fast lazy loader. ✅ Legacy browsers support (IE9+). 💯 SEO friendly. 🧩 Lazy-load everything.

== Description ==

⚡️ A native, blazing fast lazy loader. ✅ Legacy browsers support (IE9+). 💯 SEO friendly. 🧩 Lazy-load everything.

This plugin helps you to optimize everything like image tags, video, audio, iframes as well as stylesheets, and JavaScript.

This plugin incorporates tips used a lot by experienced web experts, as well as making the most of the latest web technologies in lazy-loading resources on the page.

Rate [5 stars (⭐️⭐️⭐️⭐️⭐️)](https://wordpress.org/support/plugin/shins-pageload-magic/reviews/?filter=5) if you guys like it.


### Good points

- ⚡️ Native API, blazing fast
- 👍 Legacy browsers support (IE9+)
- 🥇 SEO friendly
- ✅ Very easy to use
- 💯 No dependencies, no jQuery
- 🤝 Works well with your favorite frameworks
- 🧩 Uses [IntersectionObserver API](https://developer.mozilla.org/en-US/docs/Web/API/Intersection_Observer_API) for optimized CPU usage
- 🏞 Supports for responsive images, both `srcset` and `sizes` attributes

💡 Tip: To archive better result, you should consider disabling all optimization features (Eg. lazy-loading, HTML minification, JS minification, etc.) by other plugins.

We recommend you use it with another page-caching plugin for best performance.

![Scoring 100/100 in Google PageSpeed Test](https://raw.githubusercontent.com/shinsenter/defer.js/master/docs/assets/scores.jpg)


### Browser support

Available in latest browsers. This library also works perfectly with Internet Explorer 9 and later.

- 🖥 IE9+ / Microsoft EDGE *
- 🖥 Firefox 4+
- 🖥 Safari 3+
- 🖥 Chrome *
- 🖥 Opera *
- 📱 Android 4+
- 📱 iOS 3.2+

### Powered by defer.php

[defer.php](https://github.com/shinsenter/defer.php) is a library that focuses on minimizing payload size of HTML document and optimizing processing on the browser when rendering web pages.

- [x] Simplify library options
- [x] Embed defer.js library
- [x] Normalize DOM elements
- [x] Fix missing meta tags
- [x] Fix missing media attributes
- [x] Preconnect to required origins
- [x] Preload key requests
- [x] Prefetch key requests
- [x] Browser-level image lazy-loading for the web
- [x] Lazy-load offscreen and hidden iframes
- [x] Lazy-load offscreen and hidden videos
- [x] Lazy-load offscreen and hidden images
- [x] Lazy-load CSS background images
- [x] Reduce the impact of JavaScript
- [x] Defer non-critical CSS requests
- [x] Defer third-party assets
- [x] Add fallback `<noscript>` tags for lazy-loaded objects
- [x] Add custom HTML while browser is rendering the page (splashscreen)
- [x] Attribute to ignore optimizing the element
- [x] Attribute to ignore lazyloading the element
- [x] Optimize AMP document
- [x] Minify HTML output


### Keep in touch

[![Become a sponsor](https://c5.patreon.com/external/logo/become_a_patron_button@2x.png)](https://www.patreon.com/appseeds)

- Keep up-to-date with new releases:
[https://wordpress.org/plugins/shins-pageload-magic/](https://wordpress.org/plugins/shins-pageload-magic/)
- Become a stargazer:
[https://github.com/shinsenter/defer.js/stargazers](https://github.com/shinsenter/defer.js/stargazers)
- Report an issue:
[https://github.com/shinsenter/defer.js/issues](https://github.com/shinsenter/defer.js/issues)

---

Released under the GNU General Public License v2 license.
[https://github.com/shinsenter/defer-wordpress/blob/master/LICENSE](https://github.com/shinsenter/defer-wordpress/blob/master/LICENSE)

Copyright (c) 2019 Mai Nhut Tan &lt;[shin@shin.company](mailto:shin@shin.company)&gt;


== Installation ==

1. Upload `defer-wordpress` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

This library still supports PHP 5.6, but we recommend that your server should be running PHP version 7.3 or greater for better performance.


== Frequently Asked Questions ==

= What is defer.js? =

🥇 A super tiny, native performance library for lazy-loading JS, CSS, images, iframes... Defer almost anything, easily speed up your website.

= Why should I lazy-load my content? =

The loading of contents on web page may make your load speed more slow, no one likes staring at a blank white page; users are impatient and will leave quickly.

Lazy loading content on web page can help reduce resource contention and improve performance.

= Why should I use this plugin? =

This plugin supports you to handle some common tips to help your website optimize the download of on-page resources.

These tips are published at [following website](https://web.dev/) by Google Developers, if you are interested you can consult to understand more about website optimization.

You can also manually implement these tips your-self, but it takes a lot of time and requires a lot of expertise.

= How does this plugin work? =

This plugin helps you to optimize everything like image tags, video, audio, iframes as well as stylesheets, and JavaScript.

This plugin incorporates tips used a lot by experienced web experts, as well as making the most of the latest web technologies in lazy-loading resources on the page.

Among them are creating "data-src" attributes to laza-load the media, even the [loading="lazy" feature](https://web.dev/browser-level-image-lazy-loading/) recently introduced by Google Developers.

= High performance and accuracy =

In addition, this plugin uses DOM to process the website structure so it produces accurate results and is faster than any other plugin that uses HTML text processing.

You can give it a try and I believe you will be surprised by the results it brings to your website.

= How about performance and compatibility? =

We have tested this plugin with quite a few others and have not found any significant conflicts.

For best use of this plugin, you should consider disabling all optimization features (Eg. lazy-loading, HTML minification, JS minification, etc.) by other plugins.

We recommend you use it with another page-caching plugin for best performance.


== Screenshots ==

1. Scoring 100/100 in Google PageSpeed Test!
2. Defer almost anything, easily speed up your website.


== Changelog ==

2.0.0 Upgraded to v2. Renamed plugin.

1.1.15 Fixed bugs in defer.js 1.1.13, 1.1.14

1.1.14 Improved performance

1.1.13 Fixed some Firefox bugs

1.1.12 Fixed some IE bugs, tested with the latest WordPress version

1.1.11 Fixed security issue (Fixed CVE-2019-18888)

1.1.10+5 Removed external resources

1.1.10 Bug fixes and improvements

1.1.9 Fixed wrong encoding when using mb_detect_encoding() function

1.1.8 Updated defer.php library (v1.0.15)

1.1.7 Fixed issues of FireFox, code improvements

1.1.6 Updated library version, improved javascript execution order

1.1.5 Hotfix: Escape HTML node value

1.1.4 Many improvements

1.1.3 Unify lazy attributes of another plugins

1.1.2 Fixed some known issues with gtm.js, improve library's caches

1.1.1 Small bug fixes (IE polyfill, missing meta tags, preloading ads)

1.1.0 Added settings page

1.0.9 Improved preloading code

1.0.8 Fixed issues with open web fonts

1.0.7 Optimized scriptloader, polyfill, scrset

1.0.6 Small bug fixes (color placeholders, css)

1.0.5 Migrated with defer.js library

1.0.0 ~ 1.0.4 The first implement


== Upgrade Notice ==

Nothing to do, just install and enjoy!

If you are using older version of this plugin, please update now!

This library still supports PHP 5.6, but we recommend that your server should be running PHP version 7.3 or greater for better performance.
