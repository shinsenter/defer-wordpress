=== A performant lazy loader (defer.js) ===
Contributors: shinsenter
Donate link: https://www.paypal.me/shinsenter
Tags: defer.js, defer, lazy, lazyload, lazy-loading, lazy-loader, lazy-js, lazy-css, lazy-image, lazy-iframe, lazy-video, lazy-ads, performant, pagespeed, website-performance, avoid-render-blocking, browser-compatibility, intersection-observer, browser-perf
Requires at least: 4.0
Tested up to: 5.1.1
Stable tag: trunk
Requires PHP: 5.6
License: GPL-2.0+
License URI: https://github.com/shinsenter/defer-wordpress/blob/master/LICENSE

🔌 A Wordpress plugin integrating my beloved "defer.js" library into your websites. Hope you guys like it.

== Description ==

🔌 WordPress remains one of the most popular CMS platform until now, and I'm excited to make a Wordpress plugin integrating my beloved [defer.js](https://github.com/shinsenter/defer.js) library into your websites.

Rate [5 stars (⭐️⭐️⭐️⭐️⭐️)](https://wordpress.org/support/plugin/shins-pageload-magic/reviews/?filter=5) if you guys like it.

### defer.js

[defer.js](https://github.com/shinsenter/defer.js) is a super tiny, native performant library for lazy-loading JS, CSS, images, iframes...

- ⚡️ Native API, blazing fast
- 👍🏻 Legacy browsers support (IE9+)
- 🥇 SEO friendly
- ✅ Very easy to use
- 💯 No dependencies, no jQuery
- 🤝 Works well with your favorite frameworks
- 🧩 Uses [IntersectionObserver API](https://developer.mozilla.org/en-US/docs/Web/API/Intersection_Observer_API) for optimized CPU usage
- 🏞 Supports for responsive images, both `srcset` and `sizes` attributes

![Scoring 100/100 in Google PageSpeed Test](https://raw.githubusercontent.com/shinsenter/defer.js/master/docs/assets/scores.jpg)

### Easily speed up your website!

Other lazy loading libraries hook up to the scroll event on elements that need to be lazy loaded. This approach forces the browser to re-layout the page and it is painfully slow.

Here we are, [defer.js](https://github.com/shinsenter/defer.js) is written in plain JavaScript, making lazy-loading more efficient and performant. This library is using the recently added [Intersection Observer](https://developers.google.com/web/updates/2016/04/intersectionobserver) with tremendous native performance benefits.

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

- Become a stargazer:
[https://github.com/shinsenter/defer-wordpress/stargazers](https://github.com/shinsenter/defer-wordpress/stargazers)
- Report an issue:
[https://github.com/shinsenter/defer-wordpress/issues](https://github.com/shinsenter/defer-wordpress/issues)
- Keep up-to-date with new releases:
[https://github.com/shinsenter/defer-wordpress/releases](https://github.com/shinsenter/defer-wordpress/releases)

### Follow my defer.js project:

[https://github.com/shinsenter/defer.js/releases](https://github.com/shinsenter/defer.js/releases)

[https://github.com/shinsenter/defer.js/stargazers](https://github.com/shinsenter/defer.js/stargazers)

---

Released under the GNU General Public License v2 license.
[https://github.com/shinsenter/defer-wordpress/blob/master/LICENSE](https://github.com/shinsenter/defer-wordpress/blob/master/LICENSE)

Copyright (c) 2019 Mai Nhut Tan &lt;[shin@shin.company](mailto:shin@shin.company)&gt;


== Installation ==

1. Upload `defer-wordpress` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= What is defer.js? =

🥇 A super tiny, native performant library for lazy-loading JS, CSS, images, iframes... Defer almost anything, easily speed up your website.

= Why should I lazy-load my content? =

The loading of contents on web page may make your load speed more slow, no one likes staring at a blank white page; users are impatient and will leave quickly.

Lazy loading content on web page can help reduce resource contention and improve performance.


== Screenshots ==

1. Scoring 100/100 in Google PageSpeed Test!
2. Defer almost anything, easily speed up your website.


== Changelog ==

1.1.0 Added settings page

1.0.9 Imrpoved preloading code

1.0.8 Fixed issues with open web fonts

1.0.7 Optimized scriptloader, polyfill, scrset

1.0.6 Small bug fixes (color placeholders, css)

1.0.5 Migrated with defer.js library

1.0.0 ~ 1.0.4 The first implement

== Upgrade Notice ==

Nothing to do, just install and enjoy!
