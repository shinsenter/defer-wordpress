!function(){'use strict';var p,n,f,d;function r(t){try{return t.defaultView&&t.defaultView.frameElement||null}catch(t){return null}}function c(t){this.time=t.time,this.target=t.target,this.rootBounds=i(t.rootBounds),this.boundingClientRect=i(t.boundingClientRect),this.intersectionRect=i(t.intersectionRect||o()),this.isIntersecting=!!t.intersectionRect;var e=this.boundingClientRect,t=e.width*e.height,e=this.intersectionRect,e=e.width*e.height;this.intersectionRatio=t?Number((e/t).toFixed(4)):this.isIntersecting?1:0}function t(t,e){var n,o,i,e=e||{};if('function'!=typeof t)throw new Error('callback must be a function');if(e.root&&1!=e.root.nodeType)throw new Error('root must be an Element');this._checkForIntersections=(n=this._checkForIntersections.bind(this),o=this.THROTTLE_TIMEOUT,i=null,function(){i=i||setTimeout(function(){n(),i=null},o)}),this._callback=t,this._observationTargets=[],this._queuedEntries=[],this._rootMarginValues=this._parseRootMargin(e.rootMargin),this.thresholds=this._initThresholds(e.threshold),this.root=e.root||null,this.rootMargin=this._rootMarginValues.map(function(t){return t.value+t.unit}).join(' '),this._monitoringDocuments=[],this._monitoringUnsubscribes=[]}function s(t,e,n,o){'function'==typeof t.addEventListener?t.addEventListener(e,n,o||!1):'function'==typeof t.attachEvent&&t.attachEvent('on'+e,n)}function h(t,e,n,o){'function'==typeof t.removeEventListener?t.removeEventListener(e,n,o||!1):'function'==typeof t.detatchEvent&&t.detatchEvent('on'+e,n)}function g(t){var e;try{e=t.getBoundingClientRect()}catch(t){}return e?(e.width&&e.height||(e={top:e.top,right:e.right,bottom:e.bottom,left:e.left,width:e.right-e.left,height:e.bottom-e.top}),e):o()}function o(){return{top:0,bottom:0,left:0,right:0,width:0,height:0}}function i(t){return!t||'x'in t?t:{top:t.top,y:t.top,bottom:t.bottom,left:t.left,x:t.left,right:t.right,width:t.width,height:t.height}}function m(t,e){var n=e.top-t.top,t=e.left-t.left;return{top:n,left:t,height:e.height,width:e.width,bottom:n+e.height,right:t+e.width}}function e(t,e){for(var n=e;n;){if(n==t)return!0;n=_(n)}return!1}function _(t){var e=t.parentNode;return 9==t.nodeType&&t!=p?r(t):e&&11==e.nodeType&&e.host?e.host:e&&e.assignedSlot?e.assignedSlot.parentNode:e}'object'==typeof window&&('IntersectionObserver'in window&&'IntersectionObserverEntry'in window&&'intersectionRatio'in window.IntersectionObserverEntry.prototype?'isIntersecting'in window.IntersectionObserverEntry.prototype||Object.defineProperty(window.IntersectionObserverEntry.prototype,'isIntersecting',{get:function(){return 0<this.intersectionRatio}}):(p=function(){for(var t=window.document,e=r(t);e;)e=r(t=e.ownerDocument);return t}(),n=[],d=f=null,t.prototype.THROTTLE_TIMEOUT=100,t.prototype.POLL_INTERVAL=null,t.prototype.USE_MUTATION_OBSERVER=!0,t._setupCrossOriginUpdater=function(){return f=f||function(t,e){d=t&&e?m(t,e):o(),n.forEach(function(t){t._checkForIntersections()})}},t._resetCrossOriginUpdater=function(){d=f=null},t.prototype.observe=function(e){if(!this._observationTargets.some(function(t){return t.element==e})){if(!e||1!=e.nodeType)throw new Error('target must be an Element');this._registerInstance(),this._observationTargets.push({element:e,entry:null}),this._monitorIntersections(e.ownerDocument),this._checkForIntersections()}},t.prototype.unobserve=function(e){this._observationTargets=this._observationTargets.filter(function(t){return t.element!=e}),this._unmonitorIntersections(e.ownerDocument),0==this._observationTargets.length&&this._unregisterInstance()},t.prototype.disconnect=function(){this._observationTargets=[],this._unmonitorAllIntersections(),this._unregisterInstance()},t.prototype.takeRecords=function(){var t=this._queuedEntries.slice();return this._queuedEntries=[],t},t.prototype._initThresholds=function(t){t=t||[0];return Array.isArray(t)||(t=[t]),t.sort().filter(function(t,e,n){if('number'!=typeof t||isNaN(t)||t<0||1<t)throw new Error('threshold must be a number between 0 and 1 inclusively');return t!==n[e-1]})},t.prototype._parseRootMargin=function(t){t=(t||'0px').split(/\s+/).map(function(t){t=/^(-?\d*\.?\d+)(px|%)$/.exec(t);if(!t)throw new Error('rootMargin must be specified in pixels or percent');return{value:parseFloat(t[1]),unit:t[2]}});return t[1]=t[1]||t[0],t[2]=t[2]||t[0],t[3]=t[3]||t[1],t},t.prototype._monitorIntersections=function(e){var n,o,i,t=e.defaultView;t&&-1==this._monitoringDocuments.indexOf(e)&&(n=this._checkForIntersections,i=o=null,this.POLL_INTERVAL?o=t.setInterval(n,this.POLL_INTERVAL):(s(t,'resize',n,!0),s(e,'scroll',n,!0),this.USE_MUTATION_OBSERVER&&'MutationObserver'in t&&(i=new t.MutationObserver(n)).observe(e,{attributes:!0,childList:!0,characterData:!0,subtree:!0})),this._monitoringDocuments.push(e),this._monitoringUnsubscribes.push(function(){var t=e.defaultView;t&&(o&&t.clearInterval(o),h(t,'resize',n,!0)),h(e,'scroll',n,!0),i&&i.disconnect()}),e==(this.root&&this.root.ownerDocument||p)||(t=r(e))&&this._monitorIntersections(t.ownerDocument))},t.prototype._unmonitorIntersections=function(o){var i,t,e=this._monitoringDocuments.indexOf(o);-1!=e&&(i=this.root&&this.root.ownerDocument||p,this._observationTargets.some(function(t){if((e=t.element.ownerDocument)==o)return!0;for(;e&&e!=i;){var e,n=r(e);if((e=n&&n.ownerDocument)==o)return!0}return!1})||(t=this._monitoringUnsubscribes[e],this._monitoringDocuments.splice(e,1),this._monitoringUnsubscribes.splice(e,1),t(),o==i||(t=r(o))&&this._unmonitorIntersections(t.ownerDocument)))},t.prototype._unmonitorAllIntersections=function(){var t=this._monitoringUnsubscribes.slice(0);this._monitoringDocuments.length=0;for(var e=this._monitoringUnsubscribes.length=0;e<t.length;e++)t[e]()},t.prototype._checkForIntersections=function(){var s,h;!this.root&&f&&!d||(s=this._rootIsInDom(),h=s?this._getRootRect():o(),this._observationTargets.forEach(function(t){var e=t.element,n=g(e),o=this._rootContainsTarget(e),i=t.entry,r=s&&o&&this._computeTargetAndRootIntersection(e,n,h),r=t.entry=new c({time:window.performance&&performance.now&&performance.now(),target:e,boundingClientRect:n,rootBounds:f&&!this.root?null:h,intersectionRect:r});i?s&&o?this._hasCrossedThreshold(i,r)&&this._queuedEntries.push(r):i&&i.isIntersecting&&this._queuedEntries.push(r):this._queuedEntries.push(r)},this),this._queuedEntries.length&&this._callback(this.takeRecords(),this))},t.prototype._computeTargetAndRootIntersection=function(t,e,n){if('none'!=window.getComputedStyle(t).display){for(var o=e,i=_(t),r=!1;!r&&i;){var s,h,c,u,a=null,l=1==i.nodeType?window.getComputedStyle(i):{};if('none'==l.display)return null;if(i==this.root||9==i.nodeType?(r=!0,i==this.root||i==p?f&&!this.root?!d||0==d.width&&0==d.height?o=a=i=null:a=d:a=n:(h=(s=_(i))&&g(s),c=s&&this._computeTargetAndRootIntersection(s,h,n),h&&c?(i=s,a=m(h,c)):o=i=null)):i!=(u=i.ownerDocument).body&&i!=u.documentElement&&'visible'!=l.overflow&&(a=g(i)),a&&(s=a,h=o,a=l=u=c=void 0,c=Math.max(s.top,h.top),u=Math.min(s.bottom,h.bottom),l=Math.max(s.left,h.left),a=Math.min(s.right,h.right),h=u-c,o=0<=(s=a-l)&&0<=h?{top:c,bottom:u,left:l,right:a,width:s,height:h}:null),!o)break;i=i&&_(i)}return o}},t.prototype._getRootRect=function(){var t,e;return e=this.root?g(this.root):(t=p.documentElement,e=p.body,{top:0,left:0,right:t.clientWidth||e.clientWidth,width:t.clientWidth||e.clientWidth,bottom:t.clientHeight||e.clientHeight,height:t.clientHeight||e.clientHeight}),this._expandRectByRootMargin(e)},t.prototype._expandRectByRootMargin=function(n){var t=this._rootMarginValues.map(function(t,e){return'px'==t.unit?t.value:t.value*(e%2?n.width:n.height)/100}),t={top:n.top-t[0],right:n.right+t[1],bottom:n.bottom+t[2],left:n.left-t[3]};return t.width=t.right-t.left,t.height=t.bottom-t.top,t},t.prototype._hasCrossedThreshold=function(t,e){var n=t&&t.isIntersecting?t.intersectionRatio||0:-1,o=e.isIntersecting?e.intersectionRatio||0:-1;if(n!==o)for(var i=0;i<this.thresholds.length;i++){var r=this.thresholds[i];if(r==n||r==o||r<n!=r<o)return!0}},t.prototype._rootIsInDom=function(){return!this.root||e(p,this.root)},t.prototype._rootContainsTarget=function(t){return e(this.root||p,t)&&(!this.root||this.root.ownerDocument==t.ownerDocument)},t.prototype._registerInstance=function(){n.indexOf(this)<0&&n.push(this)},t.prototype._unregisterInstance=function(){var t=n.indexOf(this);-1!=t&&n.splice(t,1)},window.IntersectionObserver=t,window.IntersectionObserverEntry=c))}();