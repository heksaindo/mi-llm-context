(function($){
	$.fn.novaViewer = function(options) {
	
		var settings = {
			width  : '600px',
			height : '700px',
			url	   : 'http://docs.google.com/viewer?embedded=true',
			download: false
		};
		
		if (options) { 
			$.extend(settings, options);
		}
		
		return this.each(function() {
			var file = $(this).attr('href');
			//var url = 'http://docs.google.com/viewer?efh=false&a=v&toolbar=false&embedded=true&url=';
			var url = 'https://view.officeapps.live.com/op/view.aspx?src=';
            // int SCHEMA = 2, DOMAIN = 3, PORT = 5, PATH = 6, FILE = 8, QUERYSTRING = 9, HASH = 12
			var extregex = /^((http[s]?|ftp):\/)?\/?([^:\/\s]+)(:([^\/]*))?((\/[\w/-]+)*\/)([\w\-\.]+[^#?\s]+)(\?([^#]*))?(#(.*))?$/i;
			var ext = file.match(extregex)[8].split(".").pop();
			if (/^(tiff|ppt|pps|doc|docx|txt|xls|xlsx)$/.test(ext)) {
				var id = $(this).attr('id');
				var gdvId = (typeof id !== 'undefined' && id !== false) ? id + '-novaviewer' : '';
				$(this).after(function () {
					return '<div id="' + gdvId + '" class="novaviewer" style="width:'+settings.width+';height:'+settings.height+';"><iframe id="novaIframe" style="border: none;margin : 0 auto; display : block;"></iframe></div>';
				});
				var ifrm = document.getElementById('novaIframe');
				
				ifrm.src = url+'' + encodeURIComponent(file);
				
				$('#novaIframe').on('load', function(){
					var wdth = $('.novaviewer').width();
					var heig = parseInt(settings.height.replace("px", ""))-15; 
					$('#novaIframe').css({'clip':'rect(79px,'+wdth+'px,'+heig+'px,0px)','height':settings.height,'width':wdth,'position':'absolute','margin-top':'-79px'});
					var vHeight = parseInt(settings.height.replace("px", ""))-92;
					$('.novaviewer').css({'height':vHeight});
				});
			}else if(/^(pdf)$/.test(ext)){
				var id = $(this).attr('id');
				var gdvId = (typeof id !== 'undefined' && id !== false) ? id + '-novaviewer' : '';
				$(this).after(function () {
					var fileOrigin = new URL(file, window.location.href).origin;
					url = settings.url ? settings.url : url;
					
					return '<div id="' + gdvId + '" class="novaviewer" style="height:'+settings.height+';"><iframe id="novaIframe" src="'+url+'?down='+settings.download+'&path=' + encodeURIComponent(file) + '" width="' + settings.width + '" height="' + settings.height + '" style="border: none;margin : 0 auto; display : block;"></iframe></div>';
				});
				
			}
			
			
		});
	};
	
	$.fn.novaDownload = function(options) {
		if (options) { 
			$.extend(settings, options);
		}
		
		return this.each(function() {
			
		});
	}
})( jQuery );