$(document).ready(function(){
	$('.delete').click(function(e){
		e.preventDefault();
		var url = $(this).attr('href');
		var $id = $(this).attr('id');
		console.log($id);
		$.ajax(url, {
			success: function(){
				console.log('ok');
				 $('#' + $id).parents('tr').remove();
			}
		});
	});
});