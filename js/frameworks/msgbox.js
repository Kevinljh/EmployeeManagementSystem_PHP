(function($){

	var msgBox;
	
	var style = "position: fixed; top:-40px; left:50%; min-width:150px; box-sizing:border-box; -moz-box-sizing: border-box; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; color:white; text-align: center; padding:5px; padding-left:20px; padding-right:20px; z-index:999999999999999999999999; font-size:14px;";
	
	var redGradient = "background: #a90329; background: -moz-linear-gradient(top,  #a90329 0%, #8f0222 44%, #6d0019 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#a90329), color-stop(44%,#8f0222), color-stop(100%,#6d0019)); background: -webkit-linear-gradient(top,  #a90329 0%,#8f0222 44%,#6d0019 100%); background: -o-linear-gradient(top,  #a90329 0%,#8f0222 44%,#6d0019 100%); background: -ms-linear-gradient(top,  #a90329 0%,#8f0222 44%,#6d0019 100%); background: linear-gradient(to bottom,  #a90329 0%,#8f0222 44%,#6d0019 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a90329', endColorstr='#6d0019',GradientType=0 );";
	
	var greenGradient = "background: #33b70e; background: -moz-linear-gradient(top,  #33b70e 0%, #0b7509 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#33b70e), color-stop(100%,#0b7509)); background: -webkit-linear-gradient(top,  #33b70e 0%,#0b7509 100%); background: -o-linear-gradient(top,  #33b70e 0%,#0b7509 100%); background: -ms-linear-gradient(top,  #33b70e 0%,#0b7509 100%); background: linear-gradient(to bottom,  #33b70e 0%,#0b7509 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#33b70e', endColorstr='#0b7509',GradientType=0 );";
	
	function init(){
		msgBox = $("<div id = 'msgBox'></div>");
		msgBox.attr("style",style);	
		$("body").append(msgBox);		
	}
	
	var out = false;
	var timeout = setTimeout(function(){},0);
	
	function animate(stay,duration){
		if(typeof stay === "undefined"){
			var stay = false;
		}else if(typeof stay === "number"){
			var duration = stay;
			var stay = false;
		}
		
		if(typeof duration === "undefined"){
			var duration = 1300;
		}
		
		out = true;
		msgBox.stop();
		msgBox.css("top",-1*(msgBox.height() + 10));
		msgBox.animate({ top: 0 }, 600, "easeOutQuart",function(){
			if(!stay){
				timeout = setTimeout(function(){
					if(out){
						msgBox.animate({ top: -1*(msgBox.height() + 10) }, 600, "easeOutQuart",function(){
							out = false;
						});						
					}
				}, duration)
			}	
		});	
	}
	
	//Public:
	function error(msg,stay,duration){
		show(msg,stay,duration,redGradient);
	}

	function success(msg,stay,duration){
		show(msg,stay,duration,greenGradient);
	}	
	
	function show(msg,stay,duration,gradient){	
		clearTimeout(timeout);			
		msgBox.stop();
		
		if(out){			
			msgBox.animate({ top: -1*(msgBox.height() + 10) }, 300, "easeOutQuart",function(){
				out = false;
				msgBox.html(msg);
				msgBox.attr("style",style + gradient);
				
				// Center message box
				msgBox.css("margin-left","-" + msgBox.width()/2 + "px");
				animate(stay,duration);		
			});
		}else{
			msgBox.html(msg);
			msgBox.attr("style",style + gradient);
			
			// Center message box
			msgBox.css("margin-left","-" + msgBox.width()/2 + "px");
			animate(stay,duration);			
		}		
	}
	
	function close(){
		msgBox.animate({ top: -1*(msgBox.height() + 10)}, 600, "easeOutQuart");
	}
	
	$.msgBox = {
		init:init,
		error:error,
		success:success,
		close:close
	}
})(jQuery);