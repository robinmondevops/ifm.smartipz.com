

$(document).on('click', '.add_group', function() {
	var $this = $(this);											  
	var $category_id =  $this.data('id');
	
   	$.blockUI({ message: '<h1><img src="'+base_url+'/assets/global/img/loading-spinner-blue.gif" /> Just a moment...</h1>' });     
   	$.ajax({
		type: 'POST',   
		url: $this.data('url'),  
		data:{ 'category_id': $category_id },
		success: function(data){
			//$('#'+$category_id).remove();
			$('#add_'+$category_id).addClass('hidden');
			$('#remove_'+$category_id).removeClass('hidden');
			$.unblockUI();
		}
	});
		
	
	return false;
});



$(document).on('click', '.remove_group', function() {
	var $this = $(this);											  
	var $category_id =  $this.data('id');
	
   	$.blockUI({ message: '<h1><img src="'+base_url+'/assets/global/img/loading-spinner-blue.gif" /> Just a moment...</h1>' });     
   	$.ajax({
		type: 'POST',   
		url: $this.data('url'),  
		data:{ 'category_id': $category_id },  
		success: function(data){
			//$('#'+$category_id).remove();
			$('#add_'+$category_id).removeClass('hidden');   
			$('#remove_'+$category_id).addClass('hidden');    
			$.unblockUI();
		}
	});
		
	
	return false;
});


