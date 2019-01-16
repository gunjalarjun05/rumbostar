<style type="text/css">
table.blueTable {
  border: 1px solid #1C6EA4;
  background-color: #EEEEEE;
  /*width: 100%; */
  text-align: left;
  border-collapse: collapse;
}
table.blueTable td, table.blueTable th {
  border: 1px solid #AAAAAA;
  padding: 3px 2px;
}
table.blueTable tbody td {
  font-size: 13px;
}
table.blueTable tr:nth-child(even) {
  background: #D0E4F5;
}
table.blueTable thead {
  background: #1C6EA4;
  background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  border-bottom: 2px solid #444444;
}
table.blueTable thead th {
  font-size: 15px;
  font-weight: bold;
  color: #FFFFFF;
  border-left: 2px solid #D0E4F5;
}
table.blueTable thead th:first-child {
  border-left: none;
}

table.blueTable tfoot {
  font-size: 14px;
  font-weight: bold;
  color: #FFFFFF;
  background: #D0E4F5;
  background: -moz-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  background: -webkit-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  background: linear-gradient(to bottom, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  border-top: 2px solid #444444;
}
table.blueTable tfoot td {
  font-size: 14px;
}
table.blueTable tfoot .links {
  text-align: right;
}
table.blueTable tfoot .links a{
  display: inline-block;
  background: #1C6EA4;
  color: #FFFFFF;
  padding: 2px 8px;
  border-radius: 5px;
}	
.seat_av{
background-color:green;
cursor: pointer;	
width:50px;
}
</style>

<div class="preloader"></div>
<section class="product-detail">
 <div class="container">
 <div class="col-md-12 col-sm-12">
<?php 
$result = $this->session->userdata('sitemap');
$pass_cnt = $this->session->userdata('pass_cnt');
//print_r($pass_cnt['result']);
//print_r($result['result']->seatmap);
echo "<input type='hidden' id='pass_cnt' value='".$pass_cnt['result']."' />";
echo "<input type='hidden' id='select_cnt' value='0' />";
echo "<input type='hidden' id='seat_array' value='[]' />";
echo"<table style='width:35%;'>
<tr>
<td><table><tbody><tr><td style='background-color:green;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td>Available Seat</td>
</tr></tbody>
</table></td>
<td><table><tbody><tr><td style='background-color:red;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td>Booked Seat</td>
</tr></tbody>
</table></td>

<td><table><tbody><tr><td style='background-color:violet;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td>Selected Seat</td>
</tr></tbody>
</table></td>
</tr></table><br><br>";
echo"<table style='width:100%;'>";
$i=1;
foreach ($result['result']->seatmap as $key => $value) {
	if($i==1) {
	echo "<tr>";
	} else {
	echo "<td><div style='width:30px;'></div></td>";	
	}		

 echo"<td><table class='blueTable' style='background-color: #008ecc;color: white;'><tr><td>Wagon Code: ".$value->wagon_code."</td><td>Wagon No: ".$value->wagon_no." </td></tr></table>";	 
echo"<table class='blueTable'>";
foreach ($value->seat as $key1 => $value1) {	
	 echo "<tr>";
	foreach ($value1 as $key2 => $value2) {	 	
	 if($value2->seat_row){
	 if($value2->status =='booked') {
	 echo "<td style='background-color:red;width:50px;'>".$value2->seat_row.",".$value2->seat_col."</td>";	
	 } else{

	 $v= $value->wagon_code.",".$value->wagon_no.",".$value2->seat_row.",".$value2->seat_col.",".$value2->status;

	 echo "<td class='seat_av' data-info='".$v."' data-bookstatus='no' onclick='book(this);'>".$value2->seat_row.",".$value2->seat_col."</td>";		
	 }	 
	 }	else{
	  echo "<td  style='background-color: #9E9E9E;width:40px;'>&nbsp;&nbsp;</td>";	 	
	 }
	 } 
	 echo "</tr>";		
	 }
	echo "</table></td>";

if($i==3) {
    echo "</tr><tr><td>&nbsp;</td><td>&nbsp;</td><tr>";
    $i= 0;
	}
   
$i= $i+1;
}
echo"</table>";
?>
</div>
</div>
</section>
<script type="text/javascript">

function book(cur){
bookInfo= $(cur).data("info");	
bookStatus= $(cur).data("bookstatus");	
if(bookStatus == 'no') {
$(cur).css("background-color","violet");	
var select_cnt = (parseInt($("#select_cnt").val(),10) + 1);
$(cur).data("bookstatus", "yes");
var elems = JSON.parse($("#seat_array").val());
elems.push(bookInfo);
$("#seat_array").val(JSON.stringify(elems));
} else {
$(cur).css("background-color","green");	
var select_cnt = (parseInt($("#select_cnt").val(),10) - 1);
$(cur).data("bookstatus", "no");

var elems = JSON.parse($("#seat_array").val());
elems.splice($.inArray(bookInfo, elems),1);
$("#seat_array").val(JSON.stringify(elems));

}
$("#select_cnt").val(select_cnt);
}	
</script>