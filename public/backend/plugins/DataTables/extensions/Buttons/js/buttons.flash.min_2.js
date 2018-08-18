(function(f){"function"===typeof define&&define.amd?define(["jquery","datatables.net","datatables.net-buttons"],function(h){return f(h,window,document)}):"object"===typeof exports?module.exports=function(h,g){h||(h=window);if(!g||!g.fn.dataTable)g=require("datatables.net")(h,g).$;g.fn.dataTable.Buttons||require("datatables.net-buttons")(h,g);return f(g,h,h.document)}:f(jQuery,window,document)})(function(f,h,g,m){var i=f.fn.dataTable,e={version:"1.0.4-TableTools2",clients:{},moviePath:"",nextId:1,
$:function(a){"string"==typeof a&&(a=g.getElementById(a));a.addClass||(a.hide=function(){this.style.display="none"},a.show=function(){this.style.display=""},a.addClass=function(a){this.removeClass(a);this.className+=" "+a},a.removeClass=function(a){this.className=this.className.replace(RegExp("\\s*"+a+"\\s*")," ").replace(/^\s+/,"").replace(/\s+$/,"")},a.hasClass=function(a){return!!this.className.match(RegExp("\\s*"+a+"\\s*"))});return a},setMoviePath:function(a){this.moviePath=a},dispatch:function(a,
b,d){(a=this.clients[a])&&a.receiveEvent(b,d)},register:function(a,b){this.clients[a]=b},getDOMObjectPosition:function(a){var b={left:0,top:0,width:a.width?a.width:a.offsetWidth,height:a.height?a.height:a.offsetHeight};""!==a.style.width&&(b.width=a.style.width.replace("px",""));""!==a.style.height&&(b.height=a.style.height.replace("px",""));for(;a;)b.left+=a.offsetLeft,b.top+=a.offsetTop,a=a.offsetParent;return b},Client:function(a){this.handlers={};this.id=e.nextId++;this.movieId="ZeroClipboard_TableToolsMovie_"+
this.id;e.register(this.id,this);a&&this.glue(a)}};e.Client.prototype={id:0,ready:!1,movie:null,clipText:"",fileName:"",action:"copy",handCursorEnabled:!0,cssEffects:!0,handlers:null,sized:!1,glue:function(a,b){this.domElement=e.$(a);var d=99;this.domElement.style.zIndex&&(d=parseInt(this.domElement.style.zIndex,10)+1);var c=e.getDOMObjectPosition(this.domElement);this.div=g.createElement("div");var j=this.div.style;j.position="absolute";j.left="0px";j.top="0px";j.width=c.width+"px";j.height=c.height+
"px";j.zIndex=d;"undefined"!=typeof b&&""!==b&&(this.div.title=b);0!==c.width&&0!==c.height&&(this.sized=!0);this.domElement&&(this.domElement.appendChild(this.div),this.div.innerHTML=this.getHTML(c.width,c.height).replace(/&/g,"&amp;"))},positionElement:function(){var a=e.getDOMObjectPosition(this.domElement),b=this.div.style;b.position="absolute";b.width=a.width+"px";b.height=a.height+"px";0!==a.width&&0!==a.height&&(this.sized=!0,b=this.div.childNodes[0],b.width=a.width,b.height=a.height)},getHTML:function(a,
b){var d="",c="id="+this.id+"&width="+a+"&height="+b;if(navigator.userAgent.match(/MSIE/))var j=location.href.match(/^https/i)?"https://":"http://",d=d+('<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="'+j+'download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0" width="'+a+'" height="'+b+'" id="'+this.movieId+'" align="middle"><param name="allowScriptAccess" value="always" /><param name="allowFullScreen" value="false" /><param name="movie" value="'+e.moviePath+
'" /><param name="loop" value="false" /><param name="menu" value="false" /><param name="quality" value="best" /><param name="bgcolor" value="#ffffff" /><param name="flashvars" value="'+c+'"/><param name="wmode" value="transparent"/></object>');else d+='<embed id="'+this.movieId+'" src="'+e.moviePath+'" loop="false" menu="false" quality="best" bgcolor="#ffffff" width="'+a+'" height="'+b+'" name="'+this.movieId+'" align="middle" allowScriptAccess="always" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="'+
c+'" wmode="transparent" />';return d},hide:function(){this.div&&(this.div.style.left="-2000px")},show:function(){this.reposition()},destroy:function(){var a=this;this.domElement&&this.div&&(f(this.div).remove(),this.div=this.domElement=null,f.each(e.clients,function(b,d){d===a&&delete e.clients[b]}))},reposition:function(a){a&&((this.domElement=e.$(a))||this.hide());if(this.domElement&&this.div){var a=e.getDOMObjectPosition(this.domElement),b=this.div.style;b.left=""+a.left+"px";b.top=""+a.top+"px"}},
clearText:function(){this.clipText="";this.ready&&this.movie.clearText()},appendText:function(a){this.clipText+=a;this.ready&&this.movie.appendText(a)},setText:function(a){this.clipText=a;this.ready&&this.movie.setText(a)},setFileName:function(a){this.fileName=a;this.ready&&this.movie.setFileName(a)},setAction:function(a){this.action=a;this.ready&&this.movie.setAction(a)},addEventListener:function(a,b){a=a.toString().toLowerCase().replace(/^on/,"");this.handlers[a]||(this.handlers[a]=[]);this.handlers[a].push(b)},
setHandCursor:function(a){this.handCursorEnabled=a;this.ready&&this.movie.setHandCursor(a)},setCSSEffects:function(a){this.cssEffects=!!a},receiveEvent:function(a,b){var d,a=a.toString().toLowerCase().replace(/^on/,"");switch(a){case "load":this.movie=g.getElementById(this.movieId);if(!this.movie){d=this;setTimeout(function(){d.receiveEvent("load",null)},1);return}if(!this.ready&&navigator.userAgent.match(/Firefox/)&&navigator.userAgent.match(/Windows/)){d=this;setTimeout(function(){d.receiveEvent("load",
null)},100);this.ready=!0;return}this.ready=!0;this.movie.clearText();this.movie.appendText(this.clipText);this.movie.setFileName(this.fileName);this.movie.setAction(this.action);this.movie.setHandCursor(this.handCursorEnabled);break;case "mouseover":this.domElement&&this.cssEffects&&this.recoverActive&&this.domElement.addClass("active");break;case "mouseout":this.domElement&&this.cssEffects&&(this.recoverActive=!1,this.domElement.hasClass("active")&&(this.domElement.removeClass("active"),this.recoverActive=
!0));break;case "mousedown":this.domElement&&this.cssEffects&&this.domElement.addClass("active");break;case "mouseup":this.domElement&&this.cssEffects&&(this.domElement.removeClass("active"),this.recoverActive=!1)}if(this.handlers[a])for(var c=0,j=this.handlers[a].length;c<j;c++){var e=this.handlers[a][c];if("function"==typeof e)e(this,b);else if("object"==typeof e&&2==e.length)e[0][e[1]](this,b);else if("string"==typeof e)h[e](this,b)}}};e.hasFlash=function(){try{if(new ActiveXObject("ShockwaveFlash.ShockwaveFlash"))return!0}catch(a){if(navigator.mimeTypes&&
navigator.mimeTypes["application/x-shockwave-flash"]!==m&&navigator.mimeTypes["application/x-shockwave-flash"].enabledPlugin)return!0}return!1};h.ZeroClipboard_TableTools=e;var o=function(a,b){b.attr("id");b.parents("html").length?a.glue(b[0],""):setTimeout(function(){o(a,b)},500)},n=function(a,b){var d="*"===a.filename&&"*"!==a.title&&a.title!==m?a.title:a.filename;-1!==d.indexOf("*")&&(d=d.replace("*",f("title").text()));d=d.replace(/[^a-zA-Z0-9_\u00A1-\uFFFF\.,\-_ !\(\)]/g,"");return b===m||!0===
b?d+a.extension:d},q=function(a){a=a.title;return-1!==a.indexOf("*")?a.replace("*",f("title").text()):a},k=function(a,b){var d=b.match(/[\s\S]{1,8192}/g)||[];a.clearText();for(var c=0,e=d.length;c<e;c++)a.appendText(d[c])},p=function(a,b){for(var d=b.newline?b.newline:navigator.userAgent.match(/Windows/)?"\r\n":"\n",c=a.buttons.exportData(b.exportOptions),e=b.fieldBoundary,f=b.fieldSeparator,h=RegExp(e,"g"),r=b.escapeChar!==m?b.escapeChar:"\\",g=function(a){for(var b="",c=0,d=a.length;c<d;c++)0<c&&
(b+=f),b+=e?e+(""+a[c]).replace(h,r+e)+e:a[c];return b},s=b.header?g(c.header)+d:"",i=b.footer?d+g(c.footer):"",k=[],l=0,n=c.body.length;l<n;l++)k.push(g(c.body[l]));return{str:s+k.join(d)+i,rows:k.length}},l={available:function(){return e.hasFlash()},init:function(a,b,d){e.moviePath=i.Buttons.swfPath;var c=new e.Client;c.setHandCursor(!0);c.addEventListener("mouseDown",function(){d._fromFlash=!0;a.button(b[0]).trigger();d._fromFlash=!1});o(c,b);d._flash=c},destroy:function(a,b,d){d._flash.destroy()},
fieldSeparator:",",fieldBoundary:'"',exportOptions:{},title:"*",filename:"*",extension:".csv",header:!0,footer:!1};i.Buttons.swfPath="//cdn.datatables.net/buttons/1.0.0/swf/flashExport.swf";i.Api.register("buttons.resize()",function(){f.each(e.clients,function(a,b){b.domElement!==m&&b.domElement.parentNode&&b.positionElement()})});i.ext.buttons.copyFlash=f.extend({},l,{className:"buttons-copy buttons-flash",text:function(a){return a.i18n("buttons.copy","Copy")},action:function(a,b,d,c){c._fromFlash&&
(a=c._flash,c=p(b,c),a.setAction("copy"),k(a,c.str),b.buttons.info(b.i18n("buttons.copyTitle","Copy to clipboard"),b.i18n("buttons.copyInfo",{_:"Copied %d rows to clipboard",1:"Copied 1 row to clipboard"},c.rows),3E3))},fieldSeparator:"\t",fieldBoundary:""});i.ext.buttons.csvFlash=f.extend({},l,{className:"buttons-csv buttons-flash",text:function(a){return a.i18n("buttons.csv","CSV")},action:function(a,b,d,c){a=c._flash;b=p(b,c);a.setAction("csv");a.setFileName(n(c));k(a,b.str)},escapeChar:'"'});
i.ext.buttons.excelFlash=f.extend({},l,{className:"buttons-excel buttons-flash",text:function(a){return a.i18n("buttons.excel","Excel")},action:function(a,b,d,c){var a="",d=c._flash,b=b.buttons.exportData(c.exportOptions),e=function(a){for(var b=[],c=0,d=a.length;c<d;c++){if(null===a[c]||a[c]===m)a[c]="";b.push("number"===typeof a[c]||a[c].match&&a[c].match(/^-?[0-9\.]+$/)&&"0"!==a[c].charAt(0)?'<c t="n"><v>'+a[c]+"</v></c>":'<c t="inlineStr"><is><t>'+(!a[c].replace?a[c]:a[c].replace(/&(?!amp;)/g,
"&amp;").replace(/[\x00-\x1F\x7F-\x9F]/g,""))+"</t></is></c>")}return"<row>"+b.join("")+"</row>"};c.header&&(a+=e(b.header));for(var f=0,g=b.body.length;f<g;f++)a+=e(b.body[f]);c.footer&&(a+=e(b.footer));d.setAction("excel");d.setFileName(n(c));k(d,a)},extension:".xlsx"});i.ext.buttons.pdfFlash=f.extend({},l,{className:"buttons-pdf buttons-flash",text:function(a){return a.i18n("buttons.pdf","PDF")},action:function(a,b,d,c){var a=c._flash,d=b.buttons.exportData(c.exportOptions),e=b.table().node().offsetWidth,
f=b.columns(c.columns).indexes().map(function(a){return b.column(a).header().offsetWidth/e});a.setAction("pdf");a.setFileName(q(c));k(a,JSON.stringify({title:n(c,!1),message:c.message,colWidth:f.toArray(),orientation:c.orientation,size:c.pageSize,header:c.header?d.header:null,footer:c.footer?d.footer:null,body:d.body}))},extension:".pdf",orientation:"portrait",pageSize:"A4",message:"",newline:"\n"});return i.Buttons});
