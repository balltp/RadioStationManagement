	$(document).ready(function() { 
		var options = { 
				target:   		'#output',   // target element(s) to be updated with server response 
				beforeSubmit:  	beforeSubmit,  // pre-submit callback 
				success:       	afterSuccess,  // post-submit callback 
				resetForm: 		true        // reset the form after successful submit 
			}; 	
		 $('#myform').submit(function() { 
				$(this).ajaxSubmit(options);  			
				// return false to prevent standard browser submit and page navigation 
				return false; 
			});
		//after succesful upload
		function afterSuccess()
		{
			$('#send').show(); //hide submit button
		}
		//function to check file size before uploading.
		function beforeSubmit(){
			$('#send').hide(); //hide submit button
		}
	}); 