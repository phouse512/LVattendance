function loginTracking(username, password, eventID) {
	$.ajax({
		url: 'script/loginEventTracking.php',
		type: 'POST',
		data: ({userName: username,
				password: password,
				eventID: eventID}),
		success: function(data, textStatus, xhr){
			if (data == "success"){
				window.location.replace("http://nuaaiv.com/attendance");
			}
		},
		error: function(xhr, textStatus, errorThrown){
			alert(textStatus);
		}
	});
}

function submitLogin() {
	username = $("#inputUser").val();
	password = $("#inputPassword").val();
	eventID = $("#selectEvent").val();

	login(username, password, eventID);
}

function login(username, password, eventID){
	$.ajax({
		url: 'script/loginEventTracking.php',
		type: 'POST',
		data: ({userName: username,
				password: password,
				eventID: eventID}),
		success: function(data, textStatus, xhr){
			if (data == "success"){
				window.location.replace("http://nuaaiv.com/attendance");
			}
		},
		error: function(xhr, textStatus, errorThrown){
			alert(textStatus);
		}
	});
}

function validateForm(username, password, eventID){
	var output = 0;
	if (isBlank(username)){
		output += 1;
		$("#usernameFG").addClass("has-error");
	}

	if (isBlank(password)){
		output += 1;
		$("#passwordFG").addClass("has-error");
	}

	if (isNaN(eventID)){
		output += 1;
	}

	return output;
}

function displayEventSelectBox(){
	$.ajax({
		url: 'script/listEvents.php',
		type: 'GET',
		success: function(data, textStatus, xhr){
            var events = data.getElementsByTagName("event");
            var html= '<option value="..">choose event..</option>';

            for (var i=0;i<events.length; i++){
            	id = events[i].getElementsByTagName("event_id")[0].textContent;
            	name = events[i].getElementsByTagName("event_name")[0].textContent;
            	date = events[i].getElementsByTagName("event_date")[0].textContent;

            	html += '<option value="' + id + '">' + name + " " + date + '</option>'
            }
            select = $("#selectEvent");
            $(select).html(html);
		},
		error: function(xhr, textStatus, errorThrown){
			alert(textStatus);
		}
	});
}