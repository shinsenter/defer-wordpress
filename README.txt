=== A faster website! (aka defer.js) ===
Contributors: shinsenter
Donate link: https://www.paypal.me/shinsenter
Tags: lazyload,optimize,pagespeed,performance,defer.js
Requires at least: 4.0
Tested up to: 6.6.1
Stable tag: 3.0.0
Requires PHP: 7.2
License: GPLv2 or later
License URI: https://code.shin.company/defer-wordpress/blob/master/LICENSE

🚀 Unleash the power of cutting edge WordPress optimization tech. 💯 SEO-Optimized and 🎯 Effortlessly User-Friendly!

== Description ==

⚡️ Experience lightning-fast load times with our native, blazingly quick lazy loader. ✅ Backward compatible with legacy browsers (IE9+). 💯 SEO-optimized. 🧩 Lazy-load everything.

This plugin empowers you to optimize a wide range of elements, including images, videos, audio, iframes, stylesheets, and JavaScript, for a seamless user experience.

Leveraging tips from seasoned web experts and harnessing the latest web technologies for resource lazy-loading, this plugin ensures your website operates at peak efficiency, providing your visitors with a lightning-fast browsing experience.

If you find this plugin valuable, please consider leaving a [5-star review (⭐️⭐️⭐️⭐️⭐️)](https://wordpress.org/support/plugin/shins-pageload-magic/reviews/?filter=5#new-post) to support my efforts.

### What People Love

- ⚡️ Native API, blazingly fast performance
- 👍 Support for legacy browsers (IE9+)
- 🥇 SEO-friendly optimization
- ✅ Incredibly easy to use
- 💯 No dependencies, no jQuery required
- 🤝 Works seamlessly with your favorite frameworks
- 🧩 Utilizes [IntersectionObserver API](https://developer.mozilla.org/en-US/docs/Web/API/Intersection_Observer_API) for optimized CPU usage
- 🏞 Supports responsive images with `srcset` and `sizes` attributes

💡 Tip: For optimal results, consider disabling optimization features from other plugins (e.g., lazy-loading, HTML minification, JS minification).

We recommend using this plugin alongside another page-caching solution for best performance.

![Scoring 100/100 in Google PageSpeed Test](https://raw.githubusercontent.com/shinsenter/defer.js/master/docs/assets/scores.jpg)

### Browser support

This plugin also works perfectly on popular browsers, including Internet Explorer 9 and later.

- 🖥 IE9+ / Microsoft EDGE
- 🖥 Firefox 4+
- 🖥 Safari 3+
- 🖥 Chrome
- 🖥 Opera
- 📱 Android 4+
- 📱 iOS 3.2+

### Powered by defer.js, defer.php

[defer.js](https://code.shin.company/defer.js)
🥇 A super small, super efficient library that helps you lazy load almost everything like images, video, audio, iframes as well as stylesheets, and JavaScript.

[defer.php](https://code.shin.company/defer.php)
🚀 A PHP library that focuses on minimizing payload size of HTML document and optimizing processing on the browser when rendering the web page.

#### Key features

- [x] Embed [defer.js](https://code.shin.company/defer.js) plugin
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


### Support my activities

Keep up-to-date with new releases:
[https://wordpress.org/plugins/shins-pageload-magic/](https://wordpress.org/plugins/shins-pageload-magic/)

[Donate via Paypal](https://www.paypal.me/shinsenter)
[Become a sponsor](https://www.patreon.com/appseeds)
[Become a stargazer](https://code.shin.company/defer-wordpress/stargazers)
[Report an issue](https://code.shin.company/defer-wordpress/issues/new)


---

Released under the GNU General Public License v2 license.
[https://code.shin.company/defer-wordpress/blob/master/LICENSE](https://code.shin.company/defer-wordpress/blob/master/LICENSE)

Copyright (c) 2024 Mai Nhut Tan &lt;[shin@shin.company](mailto:shin@shin.company)&gt;


== Installation ==

1. Upload the `defer-wordpress` folder to the `./wp-content/plugins/` directory.

2. Activate the plugin through the 'Plugins' menu in WordPress.

While this plugin maintains compatibility with PHP 5.6, we strongly recommend running your server on PHP version 8.1 or higher for optimal performance and speed.


== Frequently Asked Questions ==

= What is defer.js? =

🥇 Defer.js is a lightweight, native performance powerhouse designed to lazy-load resources like JS, CSS, images, and iframes with lightning speed.

With Defer.js, you can effortlessly supercharge your website's performance.

= Why should I implement lazy-loading? =

Loading all page content at once can significantly slow down your website's loading speed. Users loathe staring at a blank white page and tend to abandon ship quickly.

Implementing lazy-loading can alleviate resource contention, resulting in a silky-smooth browsing experience.

= Why should I use this plugin? =

This plugin offers practical solutions for optimizing on-page resource downloads, based on recommendations from Google Developers available at this website.

You could manually implement these optimizations, but it's a time-consuming process that requires expertise.

= How does this plugin function? =

This plugin optimizes a wide range of elements, including image tags, videos, audio, iframes, stylesheets, and JavaScript.

It incorporates best practices endorsed by seasoned web experts and harnesses the latest web technologies for lazy-loading resources with finesse.

This includes features like creating "data-src" attributes for media and utilizing the loading="lazy" attribute recently introduced by Google Developers.

= High performance and precision =

Additionally, this plugin utilizes the DOM to analyze your website's structure, delivering precise results and outperforming other plugins that rely on HTML text processing.

Give it a try, and you'll likely be pleasantly surprised by the performance boost it brings to your website.

= What about performance and compatibility? =

We've thoroughly tested this plugin alongside numerous others and haven't encountered any significant conflicts.

For optimal use of this plugin, consider disabling other optimization features (e.g., lazy-loading, HTML minification, JS minification) offered by other plugins.

We also recommend using it in conjunction with a page-caching plugin for the ultimate performance experience.

== Screenshots ==

1. Achieving a perfect 100/100 score in Google PageSpeed Test with ease!
2. Defer.js empowers you to effortlessly accelerate your website by deferring resource loading with finesse.


== Changelog ==

3.0: Remove support for PHP versions earlier than 7.2

2.10: Removed dependency from polyfill[.]io

2.9: Fixed broken feeds and API responses

2.8: Updated Defer.js version

2.7: Resolved various bugs

2.6: Fixed bugs related to JSON requests

2.5: Addressed deprecation errors for compatibility with newer PHP versions

2.4: Made minor updates and improvements to the documentation

2.3: Resolved multiple bugs and implemented enhancements

2.2: Enhanced the codebase for better performance

2.1: Fixed bugs (see https://code.shin.company/defer.js/issues/82)

2.0: Upgraded to version 2 and renamed the plugin

1.1.15: Fixed bugs present in defer.js versions 1.1.13 and 1.1.14

1.1.14: Improved overall performance

1.1.13: Fixed specific issues affecting Firefox

1.1.12: Addressed problems related to Internet Explorer and ensured compatibility with the latest WordPress version

1.1.11: Fixed a security vulnerability (CVE-2019-18888)

1.1.10+5: Removed external resources, bug fixes, and general improvements

1.1.10: Resolved various bugs and introduced improvements

1.1.9: Corrected encoding issues related to the mb_detect_encoding() function

1.1.8: Updated defer.php library to version 1.0.15

1.1.7: Fixed issues affecting Firefox and made code improvements

1.1.6: Updated the library version and enhanced JavaScript execution order

1.1.5: Hotfix for escaping HTML node values

1.1.4: Implemented numerous improvements

1.1.3: Unified lazy attributes with other plugins

1.1.2: Fixed known issues with gtm.js and improved plugin caching

1.1.1: Addressed small bugs, including IE polyfill, missing meta tags, and preloading ads

1.1.0: Added a settings page

1.0.9: Enhanced preloading code

1.0.8: Fixed issues related to open web fonts

1.0.7: Optimized script loader, polyfill, and srcset

1.0.6: Addressed minor bugs, including color placeholders and CSS issues

1.0.5: Migrated to defer.js library

1.0.0 to 1.0.4: Initial implementation and development phases

== Upgrade Notice ==

No action is required, simply install and enjoy the plugin!

If you are currently using an older version of this plugin, we strongly recommend updating to the latest version.
While this plugin maintains compatibility with PHP 5.6, we advise running your server on PHP version 8.1 or higher for optimal performance.
