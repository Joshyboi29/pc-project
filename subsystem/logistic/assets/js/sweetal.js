function add() 
{
	$("#addrequest").on("click", function() {
		var $this 		    = $(this); //submit button selector using ID
        var $caption        = $this.html();// We store the html content of the submit button
        var form 			= "#form"; //defined the #form ID
        var formData        = $(form).serializeArray(); //serialize the form into array
        var route 			= $(form).attr('action'); //get the route using attribute action

        // Ajax config
    	$.ajax({
	        type: "POST", //we are using POST method to submit the data to the server side
	        url: route, // get the route value
	        data: formData, // our serialized array data for server side
	        beforeSend: function () {//We add this before send to disable the button once we submit it so that we prevent the multiple click
	            $this.attr('disabled', true).html("Processing...");
	        },
	        success: function (response) {//once the request successfully process to the server side it will return result here
	            $this.attr('disabled', false).html($caption);

	            // Reload lists of employees
	            all();

	            // We will display the result using alert
	            Swal.fire({
				  icon: 'success',
				  title: 'Success.',
				  text: response
				});

	            // Reset form
	            resetForm(form);
	        },
	        error: function (XMLHttpRequest, textStatus, errorThrown) {
	        	// You can put something here if there is an error from submitted request
	        }
	    });
	});
}

function resetForm(selector) 
{
	$(selector)[0].reset();
}


function get() 
{
	$(document).delegate("[data-target='#edit-employee-modal']", "click", function() {

		var employeeId = $(this).attr('data-id');

		// Ajax config
		$.ajax({
	        type: "GET", //we are using GET method to get data from server side
	        url: 'get.php', // get the route value
	        data: {employee_id:employeeId}, //set data
	        beforeSend: function () {//We add this before send to disable the button once we submit it so that we prevent the multiple click
	            
	        },
	        success: function (response) {//once the request successfully process to the server side it will return result here
	            response = JSON.parse(response);
	            $("#edit-form [name=\"id\"]").val(response.id);
	            $("#edit-form [name=\"email\"]").val(response.email);
	            $("#edit-form [name=\"first_name\"]").val(response.first_name);
	            $("#edit-form [name=\"last_name\"]").val(response.last_name);
	            $("#edit-form [name=\"address\"]").val(response.address);
	        }
	    });
	});
}

function update() 
{
	$("#btnUpdateSubmit").on("click", function() {
		var $this 		    = $(this); //submit button selector using ID
        var $caption        = $this.html();// We store the html content of the submit button
        var form 			= "#edit-form"; //defined the #form ID
        var formData        = $(form).serializeArray(); //serialize the form into array
        var route 			= $(form).attr('action'); //get the route using attribute action

        // Ajax config
    	$.ajax({
	        type: "POST", //we are using POST method to submit the data to the server side
	        url: route, // get the route value
	        data: formData, // our serialized array data for server side
	        beforeSend: function () {//We add this before send to disable the button once we submit it so that we prevent the multiple click
	            $this.attr('disabled', true).html("Processing...");
	        },
	        success: function (response) {//once the request successfully process to the server side it will return result here
	            $this.attr('disabled', false).html($caption);

	            // Reload lists of employees
	            all();

	            // We will display the result using alert
	            Swal.fire({
				  icon: 'success',
				  title: 'Success.',
				  text: response
				});

	            // Reset form
	            resetForm(form);

	            // Close modal
	            $('#edit-employee-modal').modal('toggle');
	        },
	        error: function (XMLHttpRequest, textStatus, errorThrown) {
	        	// You can put something here if there is an error from submitted request
	        }
	    });
	});
}


function del() 
{
	$(document).delegate(".btn-delete-employee", "click", function() {

		
		Swal.fire({
			icon: 'warning',
		  	title: 'Are you sure you want to delete this record?',
		  	showDenyButton: false,
		  	showCancelButton: true,
		  	confirmButtonText: 'Yes'
		}).then((result) => {
		  /* Read more about isConfirmed, isDenied below */
		  if (result.isConfirmed) {

		  	var employeeId = $(this).attr('data-id');

		  	// Ajax config
			$.ajax({
		        type: "GET", //we are using GET method to get data from server side
		        url: 'delete.php', // get the route value
		        data: {employee_id:employeeId}, //set data
		        beforeSend: function () {//We add this before send to disable the button once we submit it so that we prevent the multiple click
		            
		        },
		        success: function (response) {//once the request successfully process to the server side it will return result here
		            // Reload lists of employees
	            	all();

		            Swal.fire('Success.', response, 'success')
		        }
		    });

		    
		  } else if (result.isDenied) {
		    Swal.fire('Changes are not saved', '', 'info')
		  }
		});

		
	});
}


$(document).ready(function() {

	// Get all employee records
	all();

	// Submit form using AJAX To Save Data
	save();

	// Get the data and view to modal
	get();
	 
	// Updating the data
	update();

	// Delete record via ajax
	del();
});