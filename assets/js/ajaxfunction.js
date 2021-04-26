// JavaScript Document
var root = 'http://apemcl.ap.gov.in/APEMCL/wxms/';
function setState(id,url,datas){
	id='#'+id;
	rul=url;
	$htmlObj=$.ajax({
		type:"POST",
		url:rul,
		ifModified:true,
		dataType:"html",
		data: datas,
		cache: false,
		beforeSend: function() {
			$('#formLoader').fadeIn();
		},
		success: function(result) {
			$('#formLoader').fadeOut();
			$(id).html(result);
		}
	});
}

function addslashes(str) {

	str  = encodeURIComponent(str);


	return (str + '')
		.replace(/[\\"']/g, '\\$&')
		.replace(/\u0000/g, '\\0');
}

function isNumber(evt) {
	evt = (evt) ? evt : window.event;
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode > 31 && (charCode < 46 || charCode > 57)) {
		return false;
	}
	return true;
}