var Harvest = (function($) {
	var self = {};
	
	/**** HOMEPAGE POSTCODE SEARCH ****/
	var postcodeValid = false
	$(document).on('change', 'input#locationSearch', function() {
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
	
	$(document).on('keypress', 'input#locationSearch', function(event) {
		if (event.keyCode !== 13) return; //Enter key
		window.location.href = '/browse#'+encodeURI(this.value);
	});
    
    /**** MAP ****/
	var map;
	var geocoder;
	var position = [54.767563, -1.570737];
	var circle;
	var markers = [];
	var windows = [];
	var items = [];
	var searchAsMove = true;
	var icons = {
	  dairy: {
		  normal: '/images/pins/cupboard.png',
		  selected: '/images/pins/cupboardSelected.png'
	  },
	  fruit: {
		  normal: '/images/pins/fruit.png',
		  selected: '/images/pins/fruitSelected.png'
	  },
	  vegetable: {
		  normal: '/images/pins/vegetable.png',
		  selected: '/images/pins/vegetableSelected.png'
	  },
	  meat: {
		  normal: '/images/pins/meat.png',
		  selected: '/images/pins/meatSelected.png'
	  },
	  drink: {
		  normal: '/images/pins/drink.png',
		  selected: '/images/pins/drinkSelected.png'
	  },
	  cupboard: {
		  normal: '/images/pins/cupboard.png',
		  selected: '/images/pins/cupboardSelected.png'
	  }
	};
	
	function sortByAscending(a, b) {
        if (a["name"] < b["name"]) return -1;
        if(a["name"] > b["name"]) return 1;
        return 0;
    }

    function sortByDescending(a, b) {
        if (a["name"] > b["name"]) return -1;
        if(a["name"] < b["name"]) return 1;
        return 0;
    }

    function sortByDistance(a, b) {
        if (a["distance"] < b["distance"]) return -1;
        if(a["distance"] > b["distance"]) return 1;
        return 0;
    }

    function sortByExpiryShortest(a, b) {
        if (a["best_before"] < b["best_before"]) return -1;
        if(a["best_before"] > b["best_before"]) return 1;
        return 0;
    }

    function sortByExpiryLongest(a, b) {
        if (a["best_before"] > b["best_before"]) return -1;
        if(a["best_before"] < b["best_before"]) return 1;
        return 0;
    }

    function resetItemsList() {
        $("#itemsList").empty();
    }
    
    //Sort items according to dropdown choice
	function sort() {
		var selection = $('#sortBy').find(":selected").val();
        switch (selection) {
	        case 'name':
	        	items.sort(sortByAscending);
	        	break;
	        case 'distance':
	        	items.sort(sortByDistance);
	        	break;
	        case 'best_before':
	        	items.sort(sortByExpiryLongest);
	        	break;
        }
	}
	
	function formQuery() {
	  var query = "distance=" + $("#distanceFilter").val()
	  if ($("#expirationFilter").val() != 0) {
	      query = query + "&best_before=" + $("#expirationFilter").val();
	  }
	  if ($("#typeFilter").val() != 0) {
	      query = query + "&category=" + $("#typeFilter").val();
	  }
	
	  return query;
	}
	
	function addItemToMap(item) {
	  var marker = new google.maps.Marker({
	    position: new google.maps.LatLng(item["latitude"], item["longitude"]),
	    icon: icons[item.category].normal,
	    type: item.category,
	    map: map,
	    id: item["id"]
	  });
	  markers.push(marker);
	
	  var infowindow = new google.maps.InfoWindow({
	    content: ("<div class='container-fluid customInfoWindow'>" +
	      "<h3 col-xs-12>" + item["name"] + "</h3>" +
	      "<p>Best Before: " + item["best_before"] + "</p>" +
	      "<button class='btn btn-default btn-block' data-food='"+item.id+"' data-toggle='modal' data-target='#modal'><i class='glyphicon glyphicon-envelope'></i> Contact</button></div>"),
	    id: item["id"]
	  });
	  windows.push(infowindow);
	
	  marker.addListener("click", function() {
	    resetMap();
	    marker.setIcon(icons[marker.type].selected);
	    infowindow.open(map, marker);
	    map.setCenter(marker.getPosition());
	  })
	
	  google.maps.event.addListener(infowindow, 'closeclick', function() {  
	      resetMap();
	  }); 
	}
	
	function renderItem(item) {
		var markup = ""+
			"<li class='food list-group-item media'>"+
		        "<div class='media-left'>"+
	                "<figure class='food-image media-object' style='background-image:url("+ item.image +");' alt='"+ item.name +"'>"+
		        "</div>"+
		        "<div class='media-body'>"+
		        	"<button class='btn big pull-right' data-food='"+ item.id +"' data-toggle='modal' data-target='#modal'><i class='glyphicon glyphicon-envelope'></i> Contact</button>"+
					"<button class='btn big locate pull-right' data-food='"+ item.id +"'><i class='glyphicon glyphicon-map-marker'></i> Locate</button>"+
	                "<h3 class='list-group-item-heading'>"+ item.name +"</h3>"+
	                "<p class='food-details'><time class='food-best-before'>Best Before: "+ item.best_before +"</time> | Shared by <span class='food-owner' data-user='"+ item.user.id +"' data-toggle='modal' data-target='#modal'>"+ item.user.name +"</span></p>"+
		            "<p class='list-group-item-text'>"+ item.description +"</p>"+
		        "</div>"+
		    "</li>"+
		"";
		return markup;
	}
	
	function addItemToItemsList(item) {
		var markup = renderItem(item);
		$("#itemsList").append(markup);
	}
	
	function getItems(query) {
	  items = [];
	  $("#itemsList").empty();
	  for (var i = 0; i < markers.length; i++) {
	    markers[i].setMap(null);
	  }
	  markers = [];
	  windows = [];
	
	  $.ajax({
	    type: "GET",
	    url: "/api/foods?latitude=" + position[0] + "&longitude=" + position[1] + "&" + query,
	    dataType: "json", 
	    cache: false,
	    success: function(result) {
	      if (result.data.length == 0) {
	        var itemList = $(document).find("#itemsList");
	        $(itemList).html("<p>There are currently no items here, check back later!</p>")
	      } else {
		      resetItemsList();
		      result.data.forEach(function(item) {
		        items.push(item);
		      });
		      sort();
		      var item;
		      for (var i = 0; i < items.length; i++) {
			    item = items[i];
			    addItemToMap(item);
		        addItemToItemsList(item);
		      }
	      }
	      drawRadius($("#distanceFilter").val());
	    },
	  });
	};
	
	function resetMap() {
	  markers.forEach(function(marker) {
	    marker.setIcon(icons[marker.type].normal);
	  });
	  windows.forEach(function(window) {
	    window.close();
	  });
	}
	
	function redrawMap() {
	  markers = [];
	  windows = [];
	  items = getItems();
	}
	
	function drawRadius(distance) {
	  if (circle != null) {
	    circle.setMap(null);
	  }
	  circle = new google.maps.Circle({
	    map: map,
	    radius: distance * 1609.34,    // 10 miles in metres
	    center: new google.maps.LatLng(position[0], position[1]),
	    strokeColor: '#AA0000',
	    strokeWeight: 1,
	    fillOpacity: 0
	  });
	}
	
	function codeAddress(address, query) {
	  geocoder.geocode({'address':address}, function(results, status) {
	    if (status == 'OK') {
	      map.setCenter(results[0].geometry.location);
	      position = [results[0].geometry.location.lat(), results[0].geometry.location.lng()]
	      map.setZoom(14);
	      getItems(query);
	    } else {
	      console.log('Geocode was not successful: ' + status);
	    }
	  });
	}
	
	self.initMap = function() {
	  if (!document.getElementById('map')) return;
	  geocoder = new google.maps.Geocoder();
	  map = new google.maps.Map(document.getElementById('map'), {
	    zoom: 14,
	    center: new google.maps.LatLng(position[0], position[1]),
	    mapTypeId: 'roadmap',
	    mapTypeControl: false,
	    streetViewControl: false,
	    zoomControlOptions: {
	        position: google.maps.ControlPosition.TOP_LEFT
	    },  
	  });
	
	  google.maps.event.addListener(map, 'dragend', function(event) {
	    if ($("#searchAsMove").prop("checked")) {
	      position[0] = map.getCenter().lat();
	      position[1] = map.getCenter().lng();
	      var query = formQuery();
	      getItems(query);
	    }
	  });
	
	  // Create the DIV to hold the control and call the CenterControl()
	  // constructor passing in this DIV.
	  var moveAsSearchDiv = document.createElement('div');
	  var moveAsSearch = new moveAsSearchControl(moveAsSearchDiv, map);
	
	  moveAsSearchDiv.index = 1;
	  map.controls[google.maps.ControlPosition.TOP_LEFT].push(moveAsSearchDiv);
	
	  // Try HTML5 geolocation.
	  if (navigator.geolocation) {
	    navigator.geolocation.getCurrentPosition(function(newPosition) {
	      getItems("distance=5");
	    }, function() {
	      console.log("Could not geolocate automatically");
	      getItems("distance=5");
	    });
	  } else {
	    // Browser doesn't support Geolocation
	    console.log("Sorry, your browser does not offer geolocation");
	    getItems("distance=5");
	  }
	};
	
	function moveAsSearchControl(controlDiv, map) {
	
	  var controlUI = document.createElement('div');
	  controlUI.style.paddingTop = "10px";
	  controlDiv.appendChild(controlUI);
	
	  var controlInnerDiv = document.createElement('div');
	  controlInnerDiv.style.backgroundColor = '#fff';
	  controlInnerDiv.style.color = 'rgb(25,25,25)';
	  controlInnerDiv.style.fontFamily = 'Roboto,Arial,sans-serif';
	  controlInnerDiv.style.paddingLeft = '5px';
	  controlInnerDiv.style.paddingRight = '5px';
	  controlUI.appendChild(controlInnerDiv);
	
	  var controlCheckbox = document.createElement("input");
	  controlCheckbox.type = "checkbox";
	  controlCheckbox.checked = "true";
	  controlCheckbox.id = "searchAsMove"
	  controlCheckbox.style.width = "18px";
	  controlCheckbox.style.height = "18px";
	  controlCheckbox.style.verticalAlign = "text-bottom";
	  controlInnerDiv.appendChild(controlCheckbox);
	  
	  var controlText = document.createElement("label");
	  controlText.for = "searchAsMove";
	  controlText.innerHTML = "Search as I move the map";
	  controlText.style.fontSize = '12px';
	  controlText.style.paddingLeft = '5px';
	  controlInnerDiv.appendChild(controlText);
	}
	
	function go() {
        var query = formQuery()
        codeAddress($("#locationSearchInput").val(), query);
	}
	
	$(document).ready(function() {
	    //Prepopulate location search with postcode from hash
	    if (location.hash && $('#locationSearchInput').length > 0) {
		    $("#locationSearchInput").val(decodeURI(location.hash.substring(1)));
		    go();
	    }
	    
        $("#locationSearchInput").keypress(function(e) {
            if(e.which == 13 && $("#locationSearchInput").val().length > 0) {
                go();
            }
        })

        $("#locationSearchButton").click(function() {
            if($("#locationSearchInput").val().length > 0) {
                go();
            }
        });

        $("#distanceFilter").on("input change", function() {
            if ($("#distanceFilter").val() == 1) {
                $("#distanceFilterValue").text("1 mile");    
            }
            else {
                $("#distanceFilterValue").text($("#distanceFilter").val() + " miles");
            }
            $("#distanceFilterValue").append("<span class='caret'></span>")
            var query = formQuery();
            getItems(query);
        });

        $(document).on("change", "#expirationFilter", function() {
            var query = formQuery();
            getItems(query);
        });

        $(document).on("change", "#typeFilter", function() {
            var query = formQuery();
            getItems(query);
        });

        $(document).on("change", "#sortBy", function() {
	        sort();
	        resetItemsList();
            for (var i = 0; i < items.length; i++) {
                addItemToItemsList(items[i]);
            }
        });
    });
    
    /**** LOCATE ON MAP BUTTON ****/
    $(document).on('click', '.btn.locate', function() {
	    var id = $(this).attr('data-food');
		for(marker in markers) {
		  if (markers[marker]["id"] == id) {
		    for(infowindow in windows) {
		      if (windows[infowindow]["id"] == id) {
		        $("html, body").animate({
		          scrollTop: -100 + $("#map").offset().top}, 400);
		        resetMap();
		        windows[infowindow].open(map, markers[marker]);
		        map.setCenter(markers[marker].getPosition());
		      }
		    }
		  }
		}
	});
    
    /**** GEOCODE ADDRESS FIELDS ****/
    function geocode(address, callback) {
	    if (!geocoder) geocoder = new google.maps.Geocoder();
		geocoder.geocode({'address':address}, function(results, status) {
			if (status == 'OK') {
				var position = [results[0].geometry.location.lat(), results[0].geometry.location.lng()];
				callback(position);
			} else {
				console.error(status);
				alert('Your address could not be found. Are you sure it is correct?');
			}
		});
		
	}
	$(document).on('submit', 'form.geocode', function(event) { //Capture submission of forms with address geocoding
		if (!$(this).hasClass('geocode-completed')) {
			event.preventDefault();
			var form = this;
			var address = $(this).find('.geocode-address');
		    if(address.val().length > 0) {
		        geocode(address.val(), function(position) {
			        address.siblings('.geocode-latitude').val(position[0]);
			        address.siblings('.geocode-longitude').val(position[1]);
			        $(form).addClass('geocode-completed');
				    $(form).submit();
		        });
		    } else {
			    alert('Please provide an address');
		    }
		}
	});
	
	/**** FOOD CONTACT BUTTON ****/
	$(document).on('show.bs.modal', '#modal', function(event) {
		var foodID = $(event.relatedTarget).attr('data-food');
		if (!foodID) return;
		
		var modal = $(this);
		$.get('/messages/create/'+foodID, function(response) {
			modal.find('.modal-body').html(response);
			modal.find('.modal-title').html('New Message');
		}).fail(function() { //Redirect to login if not authenticated
			window.location.href = '/login';
		});;
	});
	
	/**** FOOD DELETE BUTTON ****/
	$(document).on('click', '.btn.food-delete', function(event) {
		if (confirm('Are you sure?')) {
			var button = this;
			$.ajax({
			    url: '/api/foods/'+$(button).attr('data-id'),
			    data: {_token:$(button).attr('data-token')},
			    type: 'DELETE',
			    success: function(result) {
			        location.reload();
			    }
			});
		}
	});
	
	/**** MESSENGER ****/
	if ($('#messages').length > 0) $('#messages').scrollTop($('#messages')[0].scrollHeight);
	    
	/**** USER PROFILES ****/
	$(document).on('click', '#editProfile', function() { //edit profile
		if ($(this).hasClass('edit')) {
			$('#userProfile').addClass('hide');
			$(this).removeClass('edit').html('Save');
		} else {
			$('#userProfileForm').submit();
		}
	});
	$(document).on('show.bs.modal', '#modal', function(event) {
		var userID = $(event.relatedTarget).attr('data-user');
		if (!userID) return;
		
		var modal = $(this);
		$.get('/api/users/'+userID, function(response) {
			var user = response.data;
			modal.find('.modal-body').html(''+
				'<div class="user">'+
					'<figure class="user-profile-pic" style="background-image:url('+ user.image +')"></figure>'+
					'<h4>'+ user.name +'</h4>'+
					'<p>'+ user.bio +'</p>'+
				'</div>'+
			'');
			modal.find('.modal-title').html('Profile');
		});
	});
	
	return self;
	
})(jQuery);