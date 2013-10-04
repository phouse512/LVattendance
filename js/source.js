function getCurrentArray() {
	var currentArray = [];

	$(".list-group-item").each(function() {
		currentArray.push(this.id);
	});

	return currentArray;
}
/*
function updateSuggestions() {
	currentDisplayed = JSON.stringify(getCurrentArray());
	firstName = $("#firstname").val();
	lastName = $("#lastname").val();
	emailAddress = $("#email").val();
	eventId = $("#event_id").attr("id");
	year = $("#yearSelect").val();
	dormitory = $("#dorm").val();

	console.log(firstName);
	$.ajax({
		url: 'script/updateSuggestions.php',
		type: 'POST',
		data: ({email: emailAddress,
				first_name: firstName,
				last_name: lastName,
				eventID: eventId,
				year: year,
				dorm: dormitory,
				currentArray: currentDisplayed}),
		success: function(data, textStatus, xhr){
            console.log(data);
		},
		error: function(xhr, textStatus, errorThrown){
			alert(textStatus);
		}
	});
}*/

function updateSuggestions() {
	firstName = $("#firstname").val();
	lastName = $("#lastname").val();
	emailAddress = $("#email").val();
	eventId = $("#event_id").attr("id");
	var year = '';
	if($("#yearSelect").val() != ".."){
		year = $("#yearSelect").val();
	}

	$.ajax({
		url: 'script/updateSuggestions.php',
		type: 'POST',
		data: ({email: emailAddress,
				first_name: firstName,
				last_name: lastName,
				eventID: eventId,
				year: year}),
		success: function(data, textStatus, xhr){
			displaySuggestions(data);
		},
		error: function(xhr, textStatus, errorThrown){
			alert(textStatus);
		}
	});
}

function autoCompleteListeners(){
	$("ul").on("click", "li", function(){
		$("#firstname").val($(this).find(".suggestFirstName").html());
		$("#lastname").val($(this).find(".suggestLastName").html());
		$("#email").val($(this).find(".suggestEmail").html());
		$("#yearSelect").val($(this).find(".suggestYear").html());
		$("#dorm").val($(this).find(".suggestDorm").html());
	});
}

function displaySuggestions(data){
	var users = data.getElementsByTagName("user");
	var listHTML = '<ul class="list-group">';
	var tempHTML = '';

	for(var i=0; i<users.length; i++) {
		userID = users[i].getElementsByTagName("user_id")[0].textContent;
		firstName = users[i].getElementsByTagName("first_name")[0].textContent;
		lastName = users[i].getElementsByTagName("last_name")[0].textContent;
		email = users[i].getElementsByTagName("email")[0].textContent;
		dorm = users[i].getElementsByTagName("dorm")[0].textContent;
		year = users[i].getElementsByTagName("year")[0].textContent;
		tempHTML = '<li id="' + userID + '" class="list-group-item"><strong>' + firstName + ' ' + lastName + '</strong><span class="pull-right"><strong>' + email + '</strong><span>';
		tempHTML += '<span class="hidden-field suggestFirstName">' + firstName + '</span><span class="hidden-field suggestLastName">' + lastName + '</span>';
		tempHTML += '<span class="hidden-field suggestEmail">' + email + '</span><span class="hidden-field suggestDorm">' + dorm + '</span>';
		tempHTML += '<span class="hidden-field suggestYear">' + year + '</span></li>';
		listHTML += tempHTML;
	}
	listHTML += '</ul>';

	$("#suggestions").hide().html(listHTML).slideDown('slow');
	autoCompleteListeners();
}

function updateSuggestionsListeners(){
	$("input").focusout(function() {
		updateSuggestions();
	});
}

function validateForm(firstName, lastName, emailAddress, year, dorm, eventID){
	output = new Array()
	output[0] = 0;
	if (isBlank(firstName)){
		output[0] += 1;
		output[1] = "No first name";
	}

	if (isBlank(lastName)){
		output[0] += 1;
		output[1] = "No last name";
	}

	if (isBlank(emailAddress)){
		output[0] += 1;
		output[1] = "No email address";
	}

	if (year == ".."){
		output[0] += 1;
		output[1] = "No year selected";
	}

	$.ajax({
		url: 'script/validateEmail.php',
		type: 'POST',
		data: ({email: emailAddress}),
		success: function(data, textStatus, xhr){
            console.log(data);
            if(data != "none"){
            	output[0] += 10;
            	output[1] = data;
            }      
		},
		error: function(xhr, textStatus, errorThrown){
			alert(textStatus);
		},
		async: false
	});

	return output;
}

function isBlank(str) {
    return (!str || /^\s*$/.test(str));
}

function submitForm(){
	valid = 0;

	firstName = $('#firstname').val();
	lastName = $('#lastname').val();
	emailAddress = $('#email').val();
	dorm = $('#dorm').val();
	year = $('#yearSelect').val();
	eventID = $('.event_id').attr("id");


	valid = validateForm(firstName, lastName, emailAddress, year, dorm, eventID);
	if(valid[0] < 1){
		insertUser(firstName, lastName, emailAddress, year, eventID, dorm);
		resetForm();
	} else if( valid[0] == 10){
		updateAttendance(valid[1], eventID);
		resetForm();
	} else {
		console.log(valid[1]);
		$(".alert").find("strong").html(valid[1]);
		$(".alert").addClass("in");
	}
}

function updateAttendance(userID, eventID){
	$.ajax({
		url: 'script/updateAttendance.php',
		type: 'POST',
		data: ({userID: userID,
				eventID: eventID}),
		success: function(data, textStatus, xhr){
			console.log("Update attendance " + data);
		},
		error: function(xhr, textStatus, errorThrown){
			alert(textStatus);
		}
	});
}

function insertUser(firstName, lastName, emailAddress, year, eventName, dormitory){
	$.ajax({
		url: 'script/createUser.php',
		type: 'POST',
		data: ({email: emailAddress,
				first: firstName,
				last: lastName,
				eventID: eventName,
				study: year,
				dorm: dormitory}),
		success: function(data, textStatus, xhr){
			console.log("Insert user" + data);
		},
		error: function(xhr, textStatus, errorThrown){
			alert(textStatus);
		}
	});
}

function displayErrorMessages(errorText){
	$(".alert").find("strong").html(errorText);
	$(".alert").addClass("in");
}

function resetForm(){
	$("#loginForm").fadeOut("slow", function() {
		$("#confirmation").fadeIn();
		clearForm();
		$("#suggestions").html("");
		setTimeout(function() {
			$("#confirmation").fadeOut("slow", function() {
				$("#loginForm").fadeIn();
			});
		}, 1250);
	});
}

function clearForm(){
	$("#firstname").val("");
	$("#lastname").val("");
	$("#email").val("");
	$("#dorm").val("");
	$("#yearSelect").val("..");
}

function displayEventTracking(){
      $.ajax({
            url: 'script/getEventTracking.php',
            type: 'GET',
            async: false,
            success: function(data, textStatus, xhr){
				$("#currentTrack").prepend(data);
            },
            error: function(xhr, textStatus, errorThrown){
                  alert(textStatus);
            } 
      });
}

function closeEventTracking(){
      $.ajax({
            url: 'script/closeEventTracking.php',
            type: 'GET',
            success: function(data, textStatus, xhr){
			    location.reload();
            },
            error: function(xhr, textStatus, errorThrown){
            	alert(textStatus);
            }
      });
}
