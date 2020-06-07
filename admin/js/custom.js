


var ajax_url = '../../includes/inc_ajax.php';

$(document).ready(function(){

/* MENU ITEM TYPE CHANGE */

$('select[name="menu_item_type_2[0]"]').change(function(){
	var id = $(this).val();
	
	
	if(id == 'url'){
		$('select[name="menu_id_item_2[0]"]').closest('.row').hide();
	}
	else{
		$('select[name="menu_id_item_2[0]"]').closest('.row').show();
	}
	
	console.log(id);
	if(id == 'none' || id == ''){
		$('select[name="menu_id_item_2[0]"]').closest('.row').hide();
		$('#menu_url_2_0').closest('.row').hide();
	}
	else{
		$('select[name="menu_url_2[0]"]').closest('.row').show();
		$('#menu_url_2_0').closest('.row').show();
	}

	if(id == 'article' || id == 'page'){
		var url = ajax_url + '?function=getAllTypeItems';
		data = [];
		data['table'] = id; 
		
		$('select[name="menu_id_item_2[0]"]').find('option').remove();
		ajaxCall('POST','json',url,id,function(response){
			$.each(response.items,function(index,item){
				var id = item[0];
				var name = item[2];

				$('select[name="menu_id_item_2[0]"]').append('<option value="'+id+'">'+name+'</option>')
			});
		});
	}
	

}); 



});


function ajaxCall(ajaxType,ajaxDataType,ajaxUrl,ajaxData,callback){
	$.ajax({
		type:ajaxType,
		dataType:ajaxDataType,
		url:ajaxUrl,
		data:{table:ajaxData},
		success:function(response){
			callback(response);
		},
		error:function(xhr,status,error){
			console.log(error);
		}
	});
}
