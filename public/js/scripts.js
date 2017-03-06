var Harvest = function() {
	var self = {};
	
	var postcodeValid = false
	$(document).on('change', 'input#postcode_search', function() {
		var regex = /(GIR 0AA)|((([A-Z-[QVX]][0-9][0-9]?)|(([A-Z-[QVX]][A-Z-[IJZ]][0-9][0-9]?)|(([A-Z-[QVX]][0-9][A-HJKPSTUW])|([A-Z-[QVX]][A-Z-[IJZ]][0-9][ABEHMNPRVWXY])))) [0-9][A-Z-[CIKMOV]]{2})/i;
        var enteredPostcode = this.value;
        if(enteredPostcode.length == 0){
            $("#postcode_search_input").css("border-bottom", "2px solid whitesmoke");
        } else if(enteredPostcode.length < 30 && regex.test(enteredPostcode)){
            $("#postcode_search_input").css("border-bottom", "2px solid green");
            postcodeValid =  true;
        } else { 
	        $("#postcode_search_input").css("border-bottom", "2px solid red");
	        postcodeValid = false;	        
		}
	});
	
	$(document).on('keypress', 'input#postcode_search', function(event) {
		if (event.keyCode !== 13) return; //Enter key
		//TODO - functionality for searching for food items based on the entered post code
        alert(this.value);
	});
    
    return self;
};

var harvest = new Harvest();