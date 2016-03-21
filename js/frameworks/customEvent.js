/*
 * CustomEvent Version 1.1.0
 *
 * Custom Event is a jquery plugin used to encapsulates the code required
 * to make custom events in javascript.  Custom event handling between modules is
 * a beautiful way to maintain loose coupling.  This ensures each module is 
 * independent of eachother, so that they can be changed easily without resulting 
 * in any effects in other modules.
 * See https://github.com/BenLorantfy/CustomEvent for details
 *
 *
 * The MIT License (MIT)
 *
 * Copyright (c) 2015 Ben Lorantfy
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.

 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */
(function ($) {
	//
	// Use
	// ===
	//
	// $.customEvent returns a function that is in a way an event
	// If event is called, it pushes a function provided as a parameter to
	// the list of handlers that will be called when the event is triggered
	//
	// event is also given a trigger method (i.e. event.trigger()) that the
	// user can call to trigger the event, which calls every function on the
	// previously mentioned list of handlers
	//
	//
	// Example
	// =======
	//
	// var onLogin = $.customEvent();
	//
	// ...
	//
	// onLogin(function(){
	//		alert("Logged in");
	//		...
	// });
	//
	// ...
	//
	// $("#loginButton").click(function(){
	//		onLogin.trigger();
	// });
	//
	//
	var customEvent = function(){
		var enabled = true;
		var callbacks = [];
		
		var event = function(fn){
			callbacks.push(fn);
		}
		
		event.trigger = function(eventObject){
			if(enabled){
				for(var i = 0; i < callbacks.length; i++){
					callbacks[i](eventObject);
				}				
			}
		}
		
		event.disable = function(){
			enabled = false;
		}
		
		event.enable = function(){
			enabled = true;
		}
		
		return event;
	}
	
    $.extend({
        customEvent: customEvent
    });
})(jQuery);
