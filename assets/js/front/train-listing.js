function filght_sort_change(current,pageid){  
    var newurl = site_url+'flight/1/'+current.value; 
    window.location.href = newurl;
}

$("#appy-train-filters").submit(function(){

  $("input").css("border","1px solid #b7b7b7");
  $("input").removeClass("form-error-class");
  $("input[name=exampleRadios]").removeClass("form-error-class");
  $(".form-elements.check-field label i").css("border","1px solid #b7b7b7");  

  var isvalArr = [];
  if($("#train_from_id").val().trim() ==''){
    $("#train_from_id").addClass("form-error-class");
    isvalArr.push(false);
  }

  if($("#train_to_id").val().trim() ==''){
    $("#train_to_id").addClass("form-error-class");
    isvalArr.push(false);
  }

  var formLocation =  $("#train_from_id").val();
  var toLocation = $("#train_to_id").val();
  var FromLoc = formLocation.toLowerCase();
  var ToLoc = toLocation.toLowerCase();

  if(FromLoc == ToLoc)
  {
      $("#train_from_id").addClass("form-error-class");
      $("#train_to_id").addClass("form-error-class");
      $("#to_train_error").html('From and To location can not be same.');
      $('#to_train_error').css('color','Red');
      isvalArr.push(false);      
  }else{
    $("#to_train_error").html("");
  }
 
  
  /*if($("#train_to").val().trim() ==''){
    $("#train_to").addClass("form-error-class");
    isvalArr.push(false);
  }*/
 /* if($("#train_depart_id").val().trim() ==''){
    $("train_return_id").addClass("form-error-class");
    isvalArr.push(false);
  }*/
 
 /* if($("#adult_id").val().trim() ==''){
    $("#adult_id").addClass("form-error-class");
    isvalArr.push(false);
  }*/
  if($('input[name=train_roundtrip]:checked').length<=0){
    $("input[name=train_roundtrip]").addClass("form-error-class");
    $(".form-elements.check-field label i").css("border","1px solid red");
    isvalArr.push(false);
  }
  if($('input[name=train_roundtrip]:checked').val() =='return'){
    if($(".return-on").val().trim() ==''){
      $(".return-on").addClass("form-error-class");
      isvalArr.push(false);
    }

    if( $("#return_on").val() != '' &&  $("#return_on").val() != undefined){
      var compartraintDate = ($("#depart_on").val() === $("#return_on").val());
       if(compartraintDate == true){
        $("#return_on").addClass("form-error-class");
        $("#return_on_train_error").html('Depart on and return on can not be same.');
        $("#return_on_train_error").css('color','red');
         isvalArr.push(false);
      }else{
        $("#return_on_train_error").html("");
      }
    }
  }

  for(var i=0;i<isvalArr.length;i++){
    if(isvalArr[i] == false){
      $(".form-error-class").css("border","1px solid red");      
      return false;
    }
  }

});

$("#refresh_btn_train").click(function(){
 var formLocation =  $("#train_from_id").val();
 var toLocation = $("#train_to_id").val();
 $("#train_from_id").val(toLocation);
 $("#train_to_id").val(formLocation);
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
  $("input[name=train_roundtrip]").change(function(){
    $(".form-elements.check-field label i").css("border","1px solid #b7b7b7");
    $(this).removeClass("form-error-class");

    if($('input[name=train_roundtrip]:checked').val() =='return'){
      $("#id_returnradio").show();
    }else{
      $("#id_returnradio").hide();
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
if($('input[name=train_roundtrip]:checked').val() =='return'){
  $("#id_returnradio").show();
}else{
  $("#id_returnradio").hide();
}
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

$('#train_from_id').autoComplete({
    minChars: 1,
    source: function(term, response){
        $.getJSON(site_url+'service/get_station', { q: term }, function(data){ 
          var matches = [];
          for (i=0; i<data.length; i++)
            if (~data[i].toLowerCase().indexOf(term)) matches.push(data[i]);
          response(matches);
        });
    }
});
$('#train_to_id').autoComplete({
    minChars: 1,
    source: function(term, response){
        $.getJSON(site_url+'service/get_station', { q: term }, function(data){ 
          var matches = [];
          for (i=0; i<data.length; i++)
            if (~data[i].toLowerCase().indexOf(term)) matches.push(data[i]);
          response(matches);
        });
    }
});



