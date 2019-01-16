function comman_ajax_function(){
	var $this = this;
	this.dataObj = {};
	this.reload = true;
	this.url = '';
	this.table = "table";
	this.process_data = false;	
	this.context_type = false;	
	this.ajax_call = function(url){
		var data;
		$.ajax({
			url:url,
			data:$this.dataObj,
			type:"post",
			dataType:"json",
			success:function(data){
				if($this.reload == true){
					window.location.reload();	
				}
			}
		});			
	}
	this.return_ajax_call = function(url){
		return $.ajax({
			url:url,
			data:$this.dataObj,
			type:"post",
			dataType:"json"
		});
	}
	this.ajax_file_upload=function(url){
		return $.ajax({
			url:url,
			data:$this.dataObj,
			type:"post",
			dataType:"json",
			processData : $this.process_data,
			contentType : $this.context_type
		});	
	}	
}

//function  for city list on chnage country
function get_city(country_obj){
	country = country_obj.value;
	getCountry(country_obj.options[country_obj.selectedIndex].innerHTML);
	var city_str = document.getElementById('city');
	if(country !=''){
		//var commanObj = new comman_ajax_function();
		var dataObj = {country:country};
		$.ajax({
			url: site_url+'global_class/city_list',
			data: dataObj,
			type: 'post',
			dataType:'json',
			success:function(data){ 
				if(data.status =='success'){				
				city_str.innerHTML ='';
				for(city in data.country_list){
					//console.log(data.country_list[city]);
					var option = document.createElement("option");
					if(city ==0){
						option.value='';
					}else{
						option.value=city;
					}
					option.selected="";
					option.innerHTML= data.country_list[city];
					city_str.appendChild(option);
				}			
			}
			}

		});

	}else{
		city_str.innerHTML ='';	
		var option = document.createElement("option");
		option.value='';
		option.innerHTML= 'Select City';
		city_str.appendChild(option);
		getCountry('Australia');
	}
}
//function  for city list on chnage country
function get_city_for_owner(country_obj){
	country = country_obj.value;
	var city_str = document.getElementById('city');
	if(country !=''){
		var dataObj = {country:country};
		$.ajax({
			url:site_url+'global_class/city_list',
			type:'post',
			data:dataObj,
			dataType:'json',
			success:function(data){ 
				if(data.status =='success'){ 				
					city_str.innerHTML ='';
					for(city in data.country_list){
						var option = document.createElement("option");
						if(city ==0){
							option.value='';
						}else{
							option.value=city;
						}
						option.selected="";
						option.innerHTML= data.country_list[city];
						city_str.appendChild(option);
					}			
				}
			}
		});

	}else{
		city_str.innerHTML ='';	
		var option = document.createElement("option");
		option.value='';
		option.innerHTML= 'Select City';
		city_str.appendChild(option);
	}
}

function ValidateEmail(email) {
	//var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
	//var expr = /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i;
	var expr = /^[a-z0-9]+((\.|_)[a-z0-9]+)*@([a-z0-9_][a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i;
	return expr.test(email);
}

function check_first_char_in_string(char){
	var expr = /^[a-zA-Z]*$/;
	return expr.test(char.charAt(0));
}

function flash_message(type,msg){
	if(type == 'error'){
		var addclass ="danger";
	}else{
		var addclass ="success";
	}
	var  html = '<div class="alert alert-'+addclass+'">'+
						'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+
						msg +
					'</div>';
	return html;
}



