<style type="text/css">
	.btn_simple {
    background: #00b7f1 none repeat scroll 0 0;
    border: 1px solid #00b7f1;
    box-shadow: none;
    color: #fff;
    float: right;
    height: auto;
    line-height: normal;
    padding: 8px;
    text-shadow: none;
    text-transform: uppercase;
    box-shadow: none;
    margin-right: 20px;
}
.btn_simple:hover{ 
background: #fff;
    color: #000;
    border: 1px solid #000;
}
</style>
<section class="user-dashboard-sec">
	<div class="container">
		<div class="row">
			<div class="col-md-12"><?php $this->load->view('message');?></div>
			<div class="col-md-12">
				<?php $this->load->view('user-left-menu');?>
				<div class="col-md-8 col-sm-8 info-right-sec">
					<div class="inner-sec">
					<div class="btn_div pull-right"><a class="btn btn-default colblue" href="<?php echo base_url('user/referred-code'); ?>">My Friends List</a></div>
					<div id="message_error" style="color:red"></div>
					<div id="message_success" style="color: green"></div>
						<form class="refferalForm"  id="referral_user_form" name="referral_user_form">
						<div class="form-group">
							<label> First Name: </label>
							<input type="first_name" class="form-control" name="first_name" id="first_name" value="" maxlength="100">
							<div class="msg_error" id="first_name_error"></div>
						</div>
						<div class="form-group">
							<label> Last Name: </label>
							<input class="form-control" type="last_name" name="last_name" id="last_name" value="" maxlength="100">
							<div class="msg_error" id="last_name_error"></div>
						</div>
						<div class="form-group">										
							<label>Email Id: </label>
							<input class="form-control" type="email" name="email_id" id="email_id" value="">
							<div id="email_id_error"></div>
							<input type="hidden" name="user_id" id="user_id" value="<?php echo $this->session->userdata(USER_SESSION. 'user_id'); ?>">
							<input type="hidden" id="refferal_code" name="refferal_code" value="<?php echo $this->session->userdata(USER_SESSION. 'my_referral_code'); ?>">
						</div>
						<div>
							<button type="button" class="btn btn-default" name="referall_code" id="referall_code" value="referall_code">SEND</button>
						</div>										
					</form>						
					<!-- <button class="btn btn_simple" onclick="auth();">Sync Google Contact</button> -->
					<!-- <a class="btn btn_simple" href="#aaa" id="referallform" data-toggle="tab">Your Friend</a> -->	
					<!-- <form name="referafriendfrom" action="#">
					<div class="flL traveller-info-details">
					<div id="googlecontactlist">
					<div class="row">
					<div class="col-md-3 col-sm-3"></div>
					<div class="col-md-6 col-sm-6">
					<table class="table">
					<thead>
					<tr>
					<th>Email</th>
					<th>Action</th>
					</tr>
					</thead>
					<tbody>
					<tr>
					<td>john@example.com</td>
					<td><input type="checkbox" name="myfriend"></td>
					</tr>								      
					</tbody>
					</table>
					</div>
					<div class="col-md-3 col-sm-3"></div>
					</div>   
					</div> -->
					</div>
				</div>
			</div>
		</div>		
	</div>
</section>

 <script src="https://apis.google.com/js/client.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript"> 

var hrefs = $(this).attr('url'); 
var pathname = window.location.pathname; 
var result = pathname.substring(pathname.lastIndexOf("/") + 1);
console.log(result);

if(result == 'refer-a-friend'){	
	$("#subthree").addClass("open collapse in");
	$("#sett").css("color", "#00AEEF");
	$(".myref").css("color","#00AEEF");	
}

/*$("#referallform").click(function(){
	
	$('#aaa').css('display',"block");
	$("#googlecontactlist").css('display',"none");
})*/


/*function valid_first_letter(email){ 
	var regexp = /^[a-z 0-9]/;	
	return regexp.test(email);
}
*/
$("#referall_code").click(function(){
	var emailId = $("#email_id").val();	
	var first_name = $('#first_name').val();
	var last_name = $("#last_name").val();
	var user_id = $("#user_id").val();	
	var refferal_code = $("#refferal_code").val();	
	console.log(emailId);

	if(first_name == '' || first_name == undefined){
		$("#first_name_error").html("Please enter First Name");
		$("#first_name_error").css('color','red');
		return false;
	}else{
		var charRegExp = /^[a-zA-Z ']+$/;
	 	if(first_name.search(charRegExp)!=0 ){
 			$("#first_name_error").html("Invalid first Name entered.");	
 			$("#first_name_error").css('color','red');	
	    	return false;
		}else{
			
			$("#first_name_error").html("");			
		}		
	}

	if(last_name == '' || last_name == undefined){
		$("#last_name_error").html("Please enter Last Name");
		$("#last_name_error").css('color','red');
		return false;
	}else{
		var charRegExp = /^[a-zA-Z ']+$/;
	 	if(last_name.search(charRegExp)!=0 ){
 			$("#last_name_error").html("Invalid Last Name entered.");	
 			$("#last_name_error").css('color','red');	
	    	return false;
		}else{
			
			$("#last_name_error").html("");			
		}		
	}

	if(emailId == '' || emailId == undefined){

		$("#email_id_error").html("Please enter email Id");
		$("#email_id_error").css('color','red');
		return false;		
	}else{
		if(!ValidateEmail_front(emailId)){
			$("#email_id_error").html("Please enter valid email Id");
			$("#email_id_error").css('color','red');
			return false;	
		}else{
			$("#email_id_error").html("");
		}

		var datas = {'first_name':first_name,'last_name':last_name,'email_id':emailId, 'user_id':user_id, 'refferal_code': refferal_code }

		$.ajax({
			url: site_url+"user/referral_code",
			type: 'POST',
			dataType: 'json',	
			data:datas,		
			success:function(results){
				console.log(results);
				if(results.status == 'fail'){					
					$("#message_error").html(results.msg);
					setTimeout(function() { $("#message_error").hide(); }, 5000);
					$("#message_success").html("");
					//location.reload();
				}

				if(results.status == 'success'){
					$("#message_success").html(results.msg);
					setTimeout(function() { $("#message_success").hide(); }, 5000);
					$("#message_error").html("");
					$("#email_id").val("");
					$('#first_name').val("");
					$("#last_name").val("");
					//location.reload();
				}
			}
		});

		//
	}
});

function ValidateEmail_front(email) {	
	var expr = /^[a-z0-9]+((\.|_)[a-z0-9]+)*@([a-z0-9_][a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i;
	return expr.test(email);
}


  function auth() {
    var config = {
      'client_id': '906515371138-qufs9feqnvahqhddtcl0sna38sn1olji.apps.googleusercontent.com',
      'scope': 'https://www.google.com/m8/feeds'
    };
    gapi.auth.authorize(config, function() {
      fetch(gapi.auth.getToken());
    });
  }

	referFriendlist = {};
	var obj = [];
  function fetch(token) {
    $.ajax({
    url: "https://www.google.com/m8/feeds/contacts/default/full?access_token=" + token.access_token + "&alt=json",
    dataType: "jsonp",
    success:function(data) {  
      	$.each(data.feed.entry, function(index, value) {
		  	item = {};
		 	item['emailid'] = value.gd$email[0].address;
		 	item['friend_name'] = value.title.$t;
		 	referFriendlist['item'] = item;			 			 
		 	obj.push(referFriendlist);
		});
    }
});

console.log(obj);
var datas = {0:obj};
console.log(datas);
$.ajax({
	url: site_url+"user/my_friend_list",
	type: 'POST',
	dataType: 'json',	
	data:datas,		
	success:function(results){
		console.log(results);
	}

});


}
</script>

       