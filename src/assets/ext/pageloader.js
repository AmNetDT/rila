
$(document).ready(function(){
	
  $("#loader_httpFeed").hide();
   $('._mc a').click(function(e){
    e.preventDefault(); 
	//Pssing values to nextPage 
	    var rsData     =  "eQvmTfgfru"; 
	    var dataString =  "rsData="+ rsData;
	    $("#loader_httpFeed").show();
	     $.ajax({
             type: "POST",
	         url: $(this).attr('id')+"/index.php",
		     data: dataString,
	         cache: false,
             success: function(msg){  
               $("#contentbar_inner").html(msg);
	           $("#loader_httpFeed").hide();
	         }		
	  });
     return false;
  });
  
  
  
$("#loader_httpFeed").hide();
   $('._adm a').click(function(e){
    e.preventDefault(); 
	$("#loader_httpFeed").show();
	  $.ajax({
      type: "POST",
	  url: $(this).attr('id'), 
	  cache: false,
           success: function(msg){  
            $("#contentbar_inner").scrollTop(0).html(msg);
	        $("#loader_httpFeed").hide();		
	   }		
	});
    return false;
});
  
  
  
});