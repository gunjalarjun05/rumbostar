function hotel_sort_change(current,pageid){  
    var newurl = site_url+'hotel/1/'+current.value; 
    window.location.href = newurl;
}

$("#hotel-filter-form").submit(function(){ 
	
  $("input").css("border","1px solid #b7b7b7");
  $("input").removeClass("form-error-class");  
  $("select").css("border","1px solid #b7b7b7");
  $("select").removeClass("form-error-class");  


  var isvalArr = [];
  if($("#id_destination").val().trim() ==''){
    $("#id_destination").addClass("form-error-class");
    isvalArr.push(false);
  }
  if($("#id_checkin").val().trim() ==''){
    $("#id_checkin").addClass("form-error-class");
    isvalArr.push(false);
  }
  if($("#id_checkout").val().trim() ==''){
    $("#id_checkout").addClass("form-error-class");
    isvalArr.push(false);
  }

/*var startDate = $('#id_checkin').val();
var endDate = $('#id_checkout').val();
 var sDate = new Date(startDate).getTime();
 var eDate = new Date(endDate).getTime();
 
alert(sDate);
alert(eDate);*/
var compartDate = ($("#id_checkin").val() === $("#id_checkout").val());
  if(compartDate == true)
  {
    $("#id_checkout").addClass("form-error-class");
    $('#id_checkout_error').html("Check in and Check out date must be different.");
    $('#id_checkout_error').css('color','red');
    isvalArr.push(false);
  }

  if($("#id_guest").val().trim() ==''){
    $("#id_guest").addClass("form-error-class");
    isvalArr.push(false);
  }  
 
 /*if(addr_flag==0) {
	 alert("Please select city from dropdown");
	  isvalArr.push(false);
 }*/
	 

  for(var i=0;i<isvalArr.length;i++){
    if(isvalArr[i] == false){
      $(".form-error-class").css("border","1px solid red");      
      return false;
    }
  }
});

$(".hotel-filter-form").each(function(){
    $(this).find("input").focus(function(){
    $(this).css("border","1px solid #b7b7b7");
    $(this).removeClass("form-error-class");
    $('#id_checkout_error').html("");
  });
  $(this).find("input").focusout(function(){
    if($(this).attr("value").trim() == ''){
      $(this).css("border","1px solid red");
      $(this).addClass("form-error-class");  
    }
    
  });
  
  $(this).find("select").focus(function(){
    $(this).css("border","1px solid #b7b7b7");
    $(this).removeClass("form-error-class");
  });
  $(this).find("select").focusout(function(){
    if($(this).val().trim() == ''){
      $(this).css("border","1px solid red");
      $(this).addClass("form-error-class");  
    }
    
  });

});

$("#id_destination").focus(function(){ addr_flag = 0;})

function getDate( element ) {
  var date;
  try {
    date = element.value;
  } catch( error ) {
    date = null;
  }

  return element.value;
}


var fromHotel = $( "#id_checkin" )
        .datepicker({
          changeMonth: false,
          numberOfMonths: 1,
          minDate: 2,
          dateFormat : 'dd-mm-yy',
          onClose: function(){
                    if($(this).val().trim() =='' ){
                        $(this).css("border","1px solid red");
                        $(this).addClass("form-error-class"); 
                    }else{
                        $(this).css("border","1px solid #b7b7b7");
                        $(this).removeClass("form-error-class");
                    }                        
                    
                }
        })
        .on( "change", function() {
      toHotel.datepicker( "option", "minDate", getDate( this ) );
      var fromdate = $('#checkin').val();
      var todate = $('#checkout').val();
      if(fromdate !='' && todate !=''){
        //get_price_for_customer(fromdate,todate);
      }
      console.log("to date"+todate);
        })
 var toHotel = $( "#id_checkout" ).datepicker({
  changeMonth: false,
  numberOfMonths: 1,
  minDate: 3,
  dateFormat : 'dd-mm-yy',
  onClose: function(){
              if($(this).attr("value").trim() =='' ){
                  $(this).css("border","1px solid red");
                  $(this).addClass("form-error-class"); 
              }else{
                  $(this).css("border","1px solid #b7b7b7");
                  $(this).removeClass("form-error-class");
              }                        
              
          }
})
.on( "change", function() { 
  //fromHotel.datepicker( "option", "maxDate", getDate( this ) );
  var fromdate = $('#checkin').val();
  var todate = $('#checkout').val();
  if(fromdate !='' && todate !=''){
    //get_price_for_customer(fromdate,todate);
  }
});



 
    
