var Harvest = function() {
	var self = {};
	
	// TODO - functionality for searching for food items based on the entered post code
	self.postcodeSearch = function() {
        var postcodeEntry = document.getElementById("postcode_search_input").value;
        if(validatePostcode()){ alert(postcodeEntry); }
    }
	
    self.validatePostcode = function() {
        var regex = /(GIR 0AA)|((([A-Z-[QVX]][0-9][0-9]?)|(([A-Z-[QVX]][A-Z-[IJZ]][0-9][0-9]?)|(([A-Z-[QVX]][0-9][A-HJKPSTUW])|([A-Z-[QVX]][A-Z-[IJZ]][0-9][ABEHMNPRVWXY])))) [0-9][A-Z-[CIKMOV]]{2})/i;
        var enteredPostcode = document.getElementById("postcode_search_input").value;
        if(enteredPostcode.length == 0){
            $("#postcode_search_input").css("border-bottom", "2px solid whitesmoke");
        }
        else if(enteredPostcode.length < 30 && regex.test(enteredPostcode)){
            $("#postcode_search_input").css("border-bottom", "2px solid green");
            return true;
        }
        else { $("#postcode_search_input").css("border-bottom", "2px solid red"); }
        return false;
    }
    
    return self;
};

var harvest = new Harvest();