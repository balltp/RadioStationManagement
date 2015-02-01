$(document).ready(function() { 
	var progressbox     = $('#progressbox');
	var progressbar     = $('#progressbar');
	var statustxt       = $('#statustxt');
	var completed       = '0%';
	
	var options = { 
			target:   '#output',   // target element(s) to be updated with server response 
			beforeSubmit:  beforeSubmit,  // pre-submit callback 
			uploadProgress: OnProgress,
			success:       afterSuccess,  // post-submit callback 
			resetForm: true        // reset the form after successful submit 
		}; 
		
	 $('#MyUploadForm').submit(function() { 
		 	
		 	var Data = MyUploadForm.List.value;	
			var splitDay = Data.split(":");	
			Lid = splitDay[0];
			Day = splitDay[1];	
			var Time = MyUploadForm.Time.value;
			var Date = MyUploadForm.Date.value;
			
			if(Data=="" || Time==""){
				alert('กรุณาใส่ข้อมูลให้ครบ');
			}else{
				$.ajax("ajax-upload/check.php?Lid="+Lid+"&Day="+Day+"&Time="+Time+"&Date="+Date)
					.done(function(codeCheck){
						var splitcodeCheck = codeCheck.split("-");	
						if(splitcodeCheck[0]=='N'){
							var msg = 'คุณ '+splitcodeCheck[1]+' ได้มีการอัพโหลดรายการนี้แล้ว';
							$("#war").html(msg);
							$( "#war" ).dialog({
							      width: 450,
							      autoOpen: false,
							      modal: true,
							      draggable: false,
							      title: "Replace File",
							      buttons: {
							      	"อัพโหลดทับ": function() {
							      		$( this ).dialog( "close" );		 		
							      		$('#MyUploadForm').ajaxSubmit(options);
							      		$("#upload-wrapper").dialog("open");
							          },
							          ยกเลิก: function() {
							            $( this ).dialog( "close" );           
							          }
							        }
							    });
							$("#war").dialog("open");
						}else{
							$("#upload-wrapper").dialog("open");
							$('#MyUploadForm').ajaxSubmit(options);
						}
					})
					.fail(function(){
						alert("Fail");
					});
			}
			
		 	//$('#MyUploadForm').ajaxSubmit(options);			
			// return false to prevent standard browser submit and page navigation 
			return false; 
		});
	
//when upload progresses	
function OnProgress(event, position, total, percentComplete)
{
	//Progress bar
	$("#msg").html("<span class='label label-success' style='font-size: 25px;'><b>กำลังอัพโหลดไฟล์");
	progressbar.width(percentComplete + '%') //update progressbar percent complete
	statustxt.html(percentComplete + '%'); //update status text
	if(percentComplete>50)
		{
			statustxt.css('color','#fff'); //change status text to white after 50%
		}
}

//after succesful upload
function afterSuccess()
{
	$("#msg").html("<span class='label label-success' style='font-size: 25px;'><b>อัพโหลดไฟล์ สำเร็จ</b></span>");
	$('#submit-btn').show(); //hide submit button
	//$('#loading-img').hide(); //hide submit button
	//window.location.reload();

}

//function to check file size before uploading.
function beforeSubmit(){
    //check whether browser fully supports all File API
   if (window.File && window.FileReader && window.FileList && window.Blob)
	{

		if( !$('#upload_file').val()) //check empty input filed
		{
			$("#output").html("<span class='label label-success' style='font-size: 25px;'><b>กรุณาเลือกไฟล์ด้วย</b></span>");
			return false
		}
		
		var fsize = $('#upload_file')[0].files[0].size; //get file size
		var ftype = $('#upload_file')[0].files[0].type; // get file type
		
		//allow only valid image file types 
		switch(ftype)
        {
			case 'video/mp4':
            case 'audio/mp3':
            case 'audio/mpeg':
                break;
            default:
                $("#output").html("<span class='label label-success' style='font-size: 25px;'><b>"+ftype+"</b> ไฟล์เสียงที่ไม่สนับสนุน!</span>");
				return false
        }
		
		//Allowed file size is less than 50 MB (1048576)*50
		//if(fsize>(1048576*50)) 
		//{
		//	$("#output").html("<span class='label label-success' style='font-size: 25px;'><b>"+bytesToSize(fsize) +"</b> ขนาดของไฟล์ใหญ่เกิน 50 MB.</span>");
		//	return false
		//}
		
		//Progress bar
		progressbox.show(); //show progressbar
		progressbar.width(completed); //initial value 0% of progressbar
		statustxt.html(completed); //set status text
		statustxt.css('color','#000'); //initial color of status text

				
		$('#submit-btn').hide(); //hide submit button
		//$('#loading-img').show(); //hide submit button
		$("#output").html("");  
	}
	else
	{
		//Output error to older unsupported browsers that doesn't support HTML5 File API
		$("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
		return false;
	}
}

//function to format bites bit.ly/19yoIPO
function bytesToSize(bytes) {
   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
   if (bytes == 0) return '0 Bytes';
   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}

}); 