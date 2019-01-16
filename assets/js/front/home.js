if ( ($(window).height() + 400) < $(document).height() ) {
    $('#top-link-block').removeClass('hidden').affix({
        // how far to scroll down before link "slides" into view
        offset: {top:100}
    });
}
$('.carousel').carousel({
        interval: 4000 //changes the speed
    })

function collapse(){
     if($("#bs-example-navbar-collapse-1").hasClass("in")){
      $("#bs-example-navbar-collapse-1").removeClass("in");
    }else{
      $("#bs-example-navbar-collapse-1").addClass("in");
    }
   }
    $(document).ready(function () { 
      
   
});
function scroll() {   
  if ($(window).scrollTop() >= origOffsetY) {
      $('.sticky_header').addClass('sticky');
      $('#con').addClass('menu-padding');
  } else {
      $('.sticky_header').removeClass('sticky');
      $('#con').removeClass('menu-padding');
  }
}
$("#refresh-btn").click(function(){
  var from_in = $("#flight_from_id").val();
  var to_in = $("#flight_to_id").val();
  $("#flight_from_id").val(to_in);
  $("#flight_to_id").val(from_in);  
});

$("#flight-search-form").submit(function(e){  
  $("input").css("border","1px solid #b7b7b7");
  $("input").removeClass("form-error-class");
  $("input[name=exampleRadios]").removeClass("form-error-class");
  $("input[name=exampleRadios]").css("border","1px solid #b7b7b7");
  $("#adult_id").css("border","0px solid #b7b7b7");
  $("#adult_id").removeClass("form-error-class");

  var isvalArr = [];
  if($("#flight_from_id").val().trim() ==''){ 
    $("#flight_from_id").addClass("form-error-class");
    isvalArr.push(false);
  }
 
   var flight_from_id = $('#flight_from_id').val();
   var flight_to_id = $('#flight_to_id').val(); 
   if(flight_from_id!= '' && flight_to_id!= '' && flight_from_id == flight_to_id){
      $("#flight_to_id").addClass("form-error-class");
      $("#to_flight_error").html('From and To location can not be same.');
      $('#to_flight_error').css('color','Red');
      isvalArr.push(false);
   }


  
  if($("#flight_to_id").val().trim() ==''){
    $("#flight_to_id").addClass("form-error-class");
    isvalArr.push(false);
  }
  if($(this).find(".depart-on").val().trim() ==''){
    $(this).find(".depart-on").addClass("form-error-class");
    isvalArr.push(false);
  }
 
  if($("#adult_id").val().trim() ==''){
    $("#adult_id").addClass("form-error-class");
    isvalArr.push(false);
  }
  if($('input[name=exampleRadios]:checked').length<=0){
    $("input[name=exampleRadios]").addClass("form-error-class");
    $(".form-elements.check-field label i").css("border","1px solid red");
    isvalArr.push(false);
  }
  if($('input[name=exampleRadios]:checked').val() =='return'){
    if($(this).find(".return-on").val().trim() ==''){
      $(this).find(".return-on").addClass("form-error-class");
      isvalArr.push(false);
    }

    // var dtTodays = new Date();
    //var nowDates = (dtTodays.getMonth() + 1) + '/' + dtTodays.getDate() + '/' +  dtTodays.getFullYear()
    //var return_date = new Date($(this).find(".return-on").val());
    //var dept_date = new Date($(this).find(".depart-on").val());

    if($(this).find(".return-on").val() != '' && $(this).find(".depart-on").val() !='' && $(this).find(".depart-on").val() == $(this).find(".return-on").val()){
      $(this).find(".return-on").addClass("form-error-class");
      $('.error_return_date_flight').html("Depart on and return on date must be different.");
      $('.error_return_date_flight').css('color','red');
      isvalArr.push(false);
    }
  
  }

  for(var i=0;i<isvalArr.length;i++){
    if(isvalArr[i] == false){
      $(".form-error-class").css("border","1px solid red");      
      return false;
    }
  }
  //e.preventdefault();

});
$(".form-field-section").each(function(){

  $(this).find("input").focus(function(){
    $(this).css("border","1px solid #b7b7b7");
    $(this).removeClass("form-error-class");
  });
  $(this).find("input").focusout(function(){
    if($(this).val().trim() == ''){
      $(this).css("border","1px solid red");
      $(this).addClass("form-error-class");  
    }
    
  });
  $("input[name=exampleRadios]").change(function(){
    //$(".form-elements.check-field label i").css("border","1px solid #b7b7b7");
    $(this).removeClass("form-error-class");

    if($('input[name=exampleRadios]:checked').val() =='return'){
      $("#id_returnradio").show();
    }else{
      $("#id_returnradio").hide();
    }
  });
  
   $("input[name=flightRadios]").change(function(){
  $('#flight_from_id').val("");
    $('#flight_to_id').val("");
    $(".form-elements.check-field label i").css("border","1px solid #b7b7b7");
    $(this).removeClass("form-error-class");

    if($('input[name=flightRadios]:checked').val() =='domestic'){
      $("#id_domesticairline").show();
    }else{
      $("#id_domesticairline").hide();
    }

  });
  

});


var dateFormat ='dd-mm-yy';
var from = $( ".depart-on" )
        .datepicker({
          changeMonth: false,
          numberOfMonths: 1,
          minDate: 0,
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
      to.datepicker( "option", "minDate", getDate( this ) );
      var fromdate = $('#checkin').val();
      var todate = $('#checkout').val();
      if(fromdate !='' && todate !=''){
        //get_price_for_customer(fromdate,todate);
      }
      console.log("to date"+todate);
        })
 var to = $( ".return-on" ).datepicker({
  changeMonth: false,
  numberOfMonths: 1,
  minDate: 0,
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
  //from.datepicker( "option", "maxDate", getDate( this ) );
  var fromdate = $('#checkin').val();
  var todate = $('#checkout').val();
  if(fromdate !='' && todate !=''){
    //get_price_for_customer(fromdate,todate);
  }
});
function getDate( element ) {
  var date;
  try {
    date = element.value;
  } catch( error ) {
    date = null;
  }

  return element.value;
}

$("#hotel-search-form").submit(function(){ 
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

  if($("#id_checkin").val() != '' && $("#id_checkout").val() !='' && $("#id_checkin").val() == $("#id_checkout").val())
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
  if($("#id_number-of-rooms").val().trim() ==''){
    $("#id_number-of-rooms").addClass("form-error-class");
    isvalArr.push(false);
  }


  for(var i=0;i<isvalArr.length;i++){
    if(isvalArr[i] == false){
      $(".form-error-class").css("border","1px solid red");      
      return false;
    }
  }
});

$(".hotel-search-form").each(function(){
  $(this).find("input").focus(function(){
    $(this).css("border","1px solid #b7b7b7");
    $(this).removeClass("form-error-class");
    $('#id_checkout_error').html("");
  });
  $(this).find("input").focusout(function(){
    if($(this).val().trim() == ''){
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
  //fromHotel.datepicker( "option", "maxDate", getDate( this ) );
  var fromdate = $('#checkin').val();
  var todate = $('#checkout').val();
  if(fromdate !='' && todate !=''){
    //get_price_for_customer(fromdate,todate);
  }
});

$("#adult_id").change(function(){
  var totlaAdults = $(this).val();
  if(totlaAdults>0){
    var childSelect = document.getElementById('id_child');
    childSelect.innerHTML ='';
    var noOfChild = 7- parseInt(totlaAdults) ; 
    for(i=0;i<=noOfChild;i++){
      var option = document.createElement("option");
      option.value=i;
      option.innerHTML= i;
      childSelect.appendChild(option);
    }
    
    var infantSelect = document.getElementById('id_infant');
    infantSelect.innerHTML ='';
    for(j=0;j<=parseInt(totlaAdults);j++){
      var option = document.createElement("option");
      option.value=j;
      option.innerHTML= j;
      infantSelect.appendChild(option);
    }
    
    
  }
});
//for train search api

$("input[name=train_roundtrip]").change(function(){
    //$(".form-elements.check-field label i").css("border","1px solid #b7b7b7");
  $(this).removeClass("form-error-class");

  if($('input[name=train_roundtrip]:checked').val() =='return'){
    $("#id_returnradio_train").show();
  }else{
    $("#id_returnradio_train").hide();
  }

});

$("#refresh-btn_train").click(function(e){ 
  var from_in = $("#train_from_id").val();
  var to_in = $("#train_to_id").val();
  $("#train_from_id").val(to_in);
  $("#train_to_id").val(from_in);
  //e.preventdefault();
});

$("#train-search-form").submit(function(){
  $("input").css("border","1px solid #b7b7b7");
  $("input").removeClass("form-error-class");
  $("input[name=exampleRadios]").removeClass("form-error-class");
  $("input[name=train_roundtrip]").css("border","1px solid #b7b7b7");
  

  var isvalArr = [];
  if($("#train_from_id").val().trim() ==''){
    $("#train_from_id").addClass("form-error-class");
    isvalArr.push(false);
  }
  if($("#train_to_id").val().trim() ==''){
    $("#train_to_id").addClass("form-error-class");
    isvalArr.push(false);
  }

if($("#train_from_id").val() != '' && $("#train_to_id").val() != '' &&  $("#train_from_id").val() == $("#train_to_id").val()){
      $("#train_to_id").addClass("form-error-class");
      $("#to_train_error").html('From and To location can not be same.');
      $('#to_train_error').css('color','Red');
      isvalArr.push(false);
}

  if($("#train_depart_id").val().trim() ==''){
    $("#train_depart_id").addClass("form-error-class");
    isvalArr.push(false);
  }
 
  if($("#adult_id").val().trim() ==''){
    $("#adult_id").addClass("form-error-class");
    isvalArr.push(false);
  }
  if($('input[name=train_roundtrip]:checked').length<=0){
    $("input[name=train_roundtrip]").addClass("form-error-class");
    $("input[name=train_roundtrip]").css("border","1px solid red");
    isvalArr.push(false);
  }
  if($('input[name=train_roundtrip]:checked').val() =='return'){
    if($("#train_return_id").val().trim() ==''){
      $("#train_return_id").addClass("form-error-class");
      isvalArr.push(false);
    }

    if($("#train_return_id").val() != '' && $("#train_depart_id").val() !='' && $("#train_depart_id").val() == $("#train_return_id").val()){
      $("#train_return_id").addClass("form-error-class");
      $('.error_return_date_train').html("Depart on and return on date must be different.");
      $('.error_return_date_train').css('color','red');
      isvalArr.push(false);
    }

  }

  for(var i=0;i<isvalArr.length;i++){
    if(isvalArr[i] == false){
      $(".form-error-class").css("border","1px solid red");      
      return false;
    }
  }

});

var xhr;
addr_select_flag = 0;
var depart_airport = $("#flight_from_id").val().trim();
var flt_type = $("input[name='flightRadios']:checked").val();
$('#flight_from_id').autoComplete({
    minChars: 1,
    source: function(term, response){
    var flt_type = $("input[name='flightRadios']:checked").val();
    var depart_airport = $("#flight_from_id").val().trim();
    var airline = $("#flight_domestic_airline").val().trim();

        $.getJSON(site_url+'service/get_depature_airports', { q: term , f: 'from', t: flt_type, a:airline }, function(data){ 
          
          response(data);
          //console.log(data);
        });
    }
});
$('#flight_to_id').autoComplete({
    minChars: 1,
    source: function(term, response){
    var flt_type = $("input[name='flightRadios']:checked").val();
    var depart_airport = $("#flight_from_id").val().trim();
    var airline = $("#flight_domestic_airline").val().trim();

        $.getJSON(site_url+'service/get_depature_airports', { q: term, f: 'to', t: flt_type, d: depart_airport, a:airline }, function(data){           
          response(data);
          //console.log(data);
        });
    }
});

/*$('#flight_domestic_airline').autoComplete({
    minChars: 1,
    source: function(term, response){
        $.getJSON(site_url+'service/get_domestic_airlines', { q: term }, function(data){ 
          
          response(data);
        });
    }
});*/

$('#train_from_id').autoComplete({
    minChars: 1,
    source: function(term, response){
      var src = term.toLowerCase();
        $.getJSON(site_url+'service/get_station', { q: term }, function(data){ 
          var matches = [];
          for (i=0; i<data.length; i++)
           {
           var dt= data[i].toLowerCase();
            if (dt.indexOf(src) >= 0){
             matches.push(data[i]); 
            } 
          }
          response(matches);
        });
    }
});
$('#train_to_id').autoComplete({
    minChars: 1,
    source: function(term, response){
      var src = term.toLowerCase();
        $.getJSON(site_url+'service/get_station', { q: term }, function(data){ 
          var matches = [];
          for (i=0; i<data.length; i++) {
            var dt= data[i].toLowerCase();
            if (dt.indexOf(src) >= 0) { 
            matches.push(data[i]); 
          }
          }
          response(matches);
        });
    }
});

$('#flight_domestic_airline').autoComplete({
    minChars: 1,
    source: function(term, response){
        $.getJSON(site_url+'service/get_domestic_airlines', { q: term }, function(data){ 
          $('#flight_from_id').val("");
          $('#flight_to_id').val("");

          response(data);

          

        });
    }
});

//sk add code for social login show popup and submit/update usertype in database 28-12-2017

/*$("#socialRegister").click(function(e){  
var user_type = $('input[name=users_type]:checked').val();
var user_id = $('#user_id').val(); 
if(user_type != '' && user_type != undefined){
 
  var data = {'user_type' : user_type, 'user_id': user_id}
  $.ajax({
        type: 'POST',
        url: site_url+"home/socialUserType",
        data: data,
        dataType: "json",
        success: function(resultData) {
         console.log(resultData); 
         if(resultData == 'success')
         {
          $('#socialRegisterModel').modal('hide');
         }
       }
  });
  
 $('#error_user_type').html('');
}else{  
  $("#error_user_type").css("color","red");
  $('#error_user_type').html('please Select Your User Type');
  return false;
}

});*/