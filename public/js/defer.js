!function(e,o,t,n,i,r,c){function f(e,t){r?n(e,t):i.push(e,t)}function u(e,t,n,i){return i=o.createElement(e||'SCRIPT'),t&&(i.id=t),n&&(i.onload=n),(t?o.getElementById(t):0)||i}r=/p/.test(o.readyState),c=o.head.appendChild.bind(o.head),e.addEventListener('on'+t in e?t:'load',function(){for(r=1;i[0];)n(i.shift(),i.shift())}),f._=u,f.$=c,e.defer=f,e.deferscript=function(t,n,e,i){f(function(e){(e=u(0,n,i)).src=t,c(e)},e)}}(this,document,'pageshow',setTimeout,[]),function(s,n){var a='IntersectionObserver',d='src',l='data-',h='lazied',y=l+h,e='Attribute',m='get'+e,p='set'+e,b='load',v='forEach',I=Function(),g=s.defer||I,r=g._||I,c=g.$;function E(e,t){return[].slice.call((t||n).querySelectorAll(e))}function t(u){return function(e,t,o,r,c,f){g(function(n,t){function i(n){!1!==(r||I).call(n,n)&&((f||['style','srcset',d])[v](function(e,t){(t=n[m](l+e))&&n[p](e,t)}),E('SOURCE',n)[v](i),b in n&&n[b]()),n.className+=' '+(o||h)}t=a in s?(n=new s[a](function(e){e[v](function(e,t){e.isIntersecting&&(t=e.target)&&(n.unobserve(t),i(t))})},c)).observe.bind(n):i,E(e||u+'['+l+d+']:not(['+y+'])')[v](function(e){e[m](y)||(e[p](y,u),t(e))})},t)}}function i(){g(function(n,i,o){o=E((n='[type=deferjs]')+':not('+(i='[async]')+')').concat(E(n+i)),function e(t){if(n=o.shift()){for(i in n.parentNode.removeChild(n),t=r(),n)if(t[i]!=n[i])try{t[i]=n[i]}catch(e){}t.removeAttribute('type'),t[d]&&!t.hasAttribute('async')?(t.onload=t.onerror=e,c(t)):(c(t),e())}}()})}g.all=i,s.deferstyle=function(t,n,e,i){g(function(e){(e=r('LINK',n,i)).rel='stylesheet',e.href=t,c(e)},e)},s.deferimg=t('IMG'),s.deferiframe=t('IFRAME'),i()}(this,document);