=== An efficient lazy loader (defer.js) ===
Contributors: shinsenter
Donate link: https://www.paypal.me/shinsenter
Tags: lazy,lazyload,lazy-js,lazy-css,lazy-image,lazy-iframe,lazy-video,pagespeed,website-performance,lazy-loading,lazy-loader,defer,lazy-ads,efficient,avoid-render-blocking,browser-compatibility,intersection-observer,browser-perf,defer.js
Requires at least: 4.0
Tested up to: 5.3.0
Stable tag: trunk
Requires PHP: 5.6
License: GPL-2.0+
License URI: https://github.com/shinsenter/defer-wordpress/blob/master/LICENSE

⚡️ A native, blazing fast lazy loader. ✅ Legacy browsers support (IE9+). 💯 SEO friendly. 🧩 Lazy load almost anything.

== Description ==

WordPress remains one of the most popular CMS platform until now, and I'm excited to make a Wordpress plugin that focuses on minimizing payload size of HTML document and optimizing processing on the browser when rendering the web page.

⚡️ A native, blazing fast lazy loader. ✅ Legacy browsers support (IE9+). 💯 SEO friendly. 🧩 Lazy load almost anything.

Rate [5 stars (⭐️⭐️⭐️⭐️⭐️)](https://wordpress.org/support/plugin/shins-pageload-magic/reviews/?filter=5) if you guys like it.

💡 Tip for defer.js: To archive better result, please disable lazyload and HTML-CSS-JS optimizations by other plugins.

### Powered by defer.js

[defer.js](https://github.com/shinsenter/defer.js) is a super tiny, native performance library for lazy-loading JS, CSS, images, iframes...

- ⚡️ Native API, blazing fast
- 👍 Legacy browsers support (IE9+)
- 🥇 SEO friendly
- ✅ Very easy to use
- 💯 No dependencies, no jQuery
- 🤝 Works well with your favorite frameworks
- 🧩 Uses [IntersectionObserver API](https://developer.mozilla.org/en-US/docs/Web/API/Intersection_Observer_API) for optimized CPU usage
- 🏞 Supports for responsive images, both `srcset` and `sizes` attributes

![Scoring 100/100 in Google PageSpeed Test](https://raw.githubusercontent.com/shinsenter/defer.js/master/docs/assets/scores.jpg)

### Easily speed up your website!

Other lazy loading libraries hook up to the scroll event on elements that need to be lazy loaded. This approach forces the browser to re-layout the page and it is painfully slow.

Here we are, [defer.js](https://github.com/shinsenter/defer.js) is written in plain JavaScript, making lazy-loading more efficient and fast. This library is using the recently added [Intersection Observer](https://developers.google.com/web/updates/2016/04/intersectionobserver) with tremendous native performance benefits.

![Defer loading of JavaScript](https://raw.githubusercontent.com/shinsenter/defer.js/master/docs/assets/defer-script.jpg)

In various cases, using `async` or `defer` does not deliver faster page speed than defer.js does.

### Browser support

Available in latest browsers. This library also works perfectly with Internet Explorer 9 and later.

- 🖥 IE9+
- 🖥 Firefox 4+
- 🖥 Safari 3+
- 🖥 Chrome *
- 🖥 Opera *
- 📱 Android 4+
- 📱 iOS 3.2+

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

== Frequently Asked Questions ==

= What is defer.js? =

🥇 A super tiny, native performance library for lazy-loading JS, CSS, images, iframes... Defer almost anything, easily speed up your website.

= Why should I lazy-load my content? =

The loading of contents on web page may make your load speed more slow, no one likes staring at a blank white page; users are impatient and will leave quickly.

Lazy loading content on web page can help reduce resource contention and improve performance.


== Screenshots ==

1. Scoring 100/100 in Google PageSpeed Test!
2. Defer almost anything, easily speed up your website.


== Changelog ==

1.1.10+2 Bug fixes and improvements

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

1.0.9 Imrpoved preloading code

1.0.8 Fixed issues with open web fonts

1.0.7 Optimized scriptloader, polyfill, scrset

1.0.6 Small bug fixes (color placeholders, css)

1.0.5 Migrated with defer.js library

1.0.0 ~ 1.0.4 The first implement

== Upgrade Notice ==

Nothing to do, just install and enjoy!

If you are using older version of this plugin, please update now!
