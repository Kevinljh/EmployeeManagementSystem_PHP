var Section = function(selector){	
	var section = $(selector);
	var cover = $("#cover");
	var animation = { progress:0 };
	
	function animate(show,back,howMuch,time,fade){
		
		var sign = back ? -1 : 1;
		
		if(show){
			if(back){
				var scale = 1 + howMuch;
			}else{
				var scale = 1 - howMuch;		
			}
			if(fade){
				section.css("opacity",0);
				section.show();						
			}	
		}else{
			var scale = 1;
			if(fade){
				section.css("opacity",1);
			}
		}
		
		section.css("transform","scale(" + scale + "," + scale + ")");
		animation.progress = 0;
		$(animation).stop().animate({ progress: 1 },{
			 duration:time
			,easing:"easeOutQuart"
			,step:function(progress){
				section.css("transform","scale(" + (scale + sign*progress*howMuch) + "," + (scale + sign*progress*howMuch) + ")");
				if(fade){
					if(show){
						section.css("opacity",progress);
					}else{
						section.css("opacity",1 - progress);
					}					
				}
			}
			,complete:function(){
				if(fade){
					if(!show){
						section.hide();
					}					
				}
			}
		})	
	}
	
	function show(){
		animate(true,true,0.3,800,true);
	}
	
	function hide(){
		animate(false,true,0.3,800,true);
	}
	
	function dialogyHide(){
		animate(false,true,0.05,600,true);
	}
	
	function dialogyShow(){
		animate(true,false,0.05,600,true);
	}
	
	function blur(){
		cover.css("opacity",0);
		cover.insertAfter(section);
		cover.show();
		cover.stop().animate({ opacity:1 },600,"easeOutQuart");
		
		animate(false,true,0.05,600,false);
	}
	
	function focus(){
		cover.stop().animate({ opacity:0 },600,"easeOutQuart",function(){
			cover.hide();
		});	
		
		animate(true,false,0.05,600,false);
	}
	
	function visible(){
		return section.is(":visible");
	}
	
	return{
		 hide:hide
		,dialogyHide:dialogyHide
		,dialogyShow:dialogyShow
		,show:show
		,blur:blur
		,focus:focus
		,visible:visible
	}
}

