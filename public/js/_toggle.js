jQuery(document).ready(function($){


 

	$.fn._toggle = function(options, callback) {
    	var that = this;
    	var toggle = options.toggle;
   
		var methods = {

		    	doToggle: function(){
		    		if($(that).prop('checked')){

						$(toggle).show();

					} else {

						$(toggle).hide();
					}
				
		    	}
		    }

    //methods.init();

    methods.doToggle();
    
	$(this).click(function () {
				
		methods.doToggle();
		
	});

};



})
