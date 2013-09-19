function getCurrentArray() {
	var currentArray = [];

	$(".list-group-item").each(function() {
		currentArray.push(this.id);
	});

	return currentArray;
}

function updateSuggestions() {
	currentDisplayed = JSON.stringify(getCurrentArray());
	firstName = $("#firstname").val();
	lastName = $("#lastname").val();
	emailAddress = $("#email").val();
	eventId = $("#event_id").val();
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
	eventID = $('#event_id').val();


	valid = validateForm(firstName, lastName, emailAddress, year, dorm, eventID);
	if(valid[0] < 1){
		insertUser(firstName, lastName, emailAddress, year, eventID, dorm);
	} else if( valid[0] == 10){
		updateAttendance(valid[1], eventID);
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
	
}

function displayConfirmation(){
	$("#loginForm").addClass("hidden");
	$("#confirmation").removeClass("hidden");
}
