function add_file() {
	$.ajax({
		type : 'POST',
		url : 'ajax.php?my_form=ajax_form',
		data : new FormData($('#upload_file')[0]),
		processData : false,
		contentType : false,
		success : function(data) {
			$('.show').html(data);
			show_images();
		}
	});
}


// Showing database images
function show_images() {
	$.ajax({
		type : 'POST',
		url : 'ajax.php?my_form=show',
		success : function(data) {
			$(".show_images").html(data);
		}
	})
}
show_images();


function delete_img(id) {
	$.ajax({
		type : 'post',
		url : 'ajax.php?my_form=delete',
		data : {'id': id},
		success: function(data) {
			show_images();
			$('.show').html(data);
		}
	});
}