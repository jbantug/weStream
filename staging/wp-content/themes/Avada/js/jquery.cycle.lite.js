(function(d){function k(e,b,c,f){function a(a){a.timeout&&(g.cycleTimeout=setTimeout(function(){k(e,a,0,!a.rev)},a.timeout))}if(!b.busy){var g=e[0].parentNode,h=e[b.currSlide],j=e[b.nextSlide];if(0!==g.cycleTimeout||c)c||!g.cyclePause?(b.before.length&&d.each(b.before,function(a,c){c.apply(j,[h,j,b,f])}),b.nextSlide!=b.currSlide&&(b.busy=1,d.fn.cycle.custom(h,j,b,function(){d.browser.msie&&this.style.removeAttribute("filter");d.each(b.after,function(a,c){c.apply(j,[h,j,b,f])});a(b)})),c=b.nextSlide+
1==e.length,b.nextSlide=c?0:b.nextSlide+1,b.currSlide=c?e.length-1:b.nextSlide-1):a(b)}}function l(d,b,c){var f=d[0].parentNode,a=f.cycleTimeout;a&&(clearTimeout(a),f.cycleTimeout=0);b.nextSlide=b.currSlide+c;0>b.nextSlide?b.nextSlide=d.length-1:b.nextSlide>=d.length&&(b.nextSlide=0);k(d,b,1,0<=c);return!1}d.fn.cycle=function(e){return this.each(function(){e=e||{};this.cycleTimeout&&clearTimeout(this.cycleTimeout);this.cyclePause=this.cycleTimeout=0;var b=d(this),c=e.slideExpr?d(e.slideExpr,this):
b.children(),f=c.get();if(2>f.length)window.console&&console.log("terminating; too few slides: "+f.length);else{var a=d.extend({},d.fn.cycle.defaults,e||{},d.metadata?b.metadata():d.meta?b.data():{}),g=d.isFunction(b.data)?b.data(a.metaAttr):null;g&&(a=d.extend(a,g));a.before=a.before?[a.before]:[];a.after=a.after?[a.after]:[];a.after.unshift(function(){a.busy=0});g=this.className;a.width=parseInt((g.match(/w:(\d+)/)||[])[1],10)||a.width;a.height=parseInt((g.match(/h:(\d+)/)||[])[1],10)||a.height;
a.timeout=parseInt((g.match(/t:(\d+)/)||[])[1],10)||a.timeout;"static"==b.css("position")&&b.css("position","relative");a.width&&b.width(a.width);a.height&&"auto"!=a.height&&b.height(a.height);c.css({position:"absolute",top:0}).each(function(a){d(this).css("z-index",f.length-a)});d(f[0]).css("opacity",1).show();d.browser.msie&&f[0].style.removeAttribute("filter");a.fit&&a.width&&c.width(a.width);a.fit&&(a.height&&"auto"!=a.height)&&c.height(a.height);a.pause&&b.hover(function(){this.cyclePause=1},
function(){this.cyclePause=0});(g=d.fn.cycle.transitions[a.fx])&&g(b,c,a);c.each(function(){var b=d(this);this.cycleH=a.fit&&a.height?a.height:b.height();this.cycleW=a.fit&&a.width?a.width:b.width()});a.cssFirst&&d(c[0]).css(a.cssFirst);if(a.timeout){a.speed.constructor==String&&(a.speed={slow:600,fast:200}[a.speed]||400);a.sync||(a.speed/=2);for(;250>a.timeout-a.speed;)a.timeout+=a.speed}a.speedIn=a.speed;a.speedOut=a.speed;a.slideCount=f.length;a.currSlide=0;a.nextSlide=1;b=c[0];a.before.length&&
a.before[0].apply(b,[b,b,a,!0]);1<a.after.length&&a.after[1].apply(b,[b,b,a,!0]);a.click&&!a.next&&(a.next=a.click);a.next&&d(a.next).unbind("click.cycle").bind("click.cycle",function(){return l(f,a,a.rev?-1:1)});a.prev&&d(a.prev).unbind("click.cycle").bind("click.cycle",function(){return l(f,a,a.rev?1:-1)});a.timeout&&(this.cycleTimeout=setTimeout(function(){k(f,a,0,!a.rev)},a.timeout+(a.delay||0)))}})};d.fn.cycle.custom=function(e,b,c,f){var a=d(e),g=d(b);g.css(c.cssBefore);var h=function(){g.animate(c.animIn,
c.speedIn,c.easeIn,f)};a.animate(c.animOut,c.speedOut,c.easeOut,function(){a.css(c.cssAfter);c.sync||h()});c.sync&&h()};d.fn.cycle.transitions={fade:function(d,b,c){b.not(":eq(0)").hide();c.cssBefore={opacity:0,display:"block"};c.cssAfter={display:"none"};c.animOut={opacity:0};c.animIn={opacity:1}},fadeout:function(e,b,c){c.before.push(function(b,a,c,e){d(b).css("zIndex",c.slideCount+(!0===e?1:0));d(a).css("zIndex",c.slideCount+(!0===e?0:1))});b.not(":eq(0)").hide();c.cssBefore={opacity:1,display:"block",
zIndex:1};c.cssAfter={display:"none",zIndex:0};c.animOut={opacity:0};c.animIn={opacity:1}}};d.fn.cycle.ver=function(){return"Lite-1.6"};d.fn.cycle.defaults={animIn:{},animOut:{},fx:"fade",after:null,before:null,cssBefore:{},cssAfter:{},delay:0,fit:0,height:"auto",metaAttr:"cycle",next:null,pause:!1,prev:null,speed:1E3,slideExpr:null,sync:!0,timeout:4E3}})(jQuery);