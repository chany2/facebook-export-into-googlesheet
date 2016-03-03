/**
 * Created by hungnguyen on 02/04/16.
 */

$(document).ready(function(){
	var spreadSheetFeed = $('#spreadsheet'),
			worksheet = $('#worksheet'),
			facebook_user_id = $('#facebook_user_id'),
			url = 'page/get-worksheet.php/?feedTitle=';

	spreadSheetFeed.change(function(){
		var feedTitle = $(this).val();
		$.ajax({
			type: "GET",
			dataType: "json",
			url: url + feedTitle,
			success: function(data) {
				console.log(data);
				$('#worksheet :not(:first-child)').remove();
				$.each(data, function(index, title){
					$('#worksheet').append('<option>' + title + '</option>');
				});
			}
		});
	});

	//Export button is clicked

	$('#exportingButton').on('click', function () {
		if(spreadSheetFeed.val() == '' || worksheet.val() == '' || facebook_user_id.val() == '')
		{
			alert('Please fill all fields before to do process');
			return false
		} else {

			var $btn = $(this).button('loading');

			$.ajax({
				type: "post",
				dataType: "json",
				data: {"spreadSheet": spreadSheetFeed.val(), "worksheet": worksheet.val(), "facebook_user_id" :facebook_user_id.val()},
				url: "page/export.php",
				success: function(data) {
					if (data.status)
					{
						$btn.button('reset');
						alert('The Exporting has been successfully');
					} else {
						$btn.button('reset');
						alert('The Exporting has an error. Please try again!');
					}
				}
			});

			//business logic...
			//$btn.button('reset');
		}

	});


	// Export Facebook Group
	$('#exportingFbGroup').on('click', function () {
		if(facebook_user_id.val() == '')
		{
			alert('Please fill all fields before to do process');
			return false
		} else {

			var $btn = $(this).button('loading');
			var table = $('#list_fbGroup tbody');
			var html = '';

			$.ajax({
				type: "post",
				dataType: "json",
				data: {"facebook_user_id" :facebook_user_id.val()},
				url: "page/export_fb_group.php",
				success: function(data) {
					if (data.status)
					{
						console.log(data.items);

						if (data.items.length >0) {
							$.each(data.items, function(i, item) {
								html += '<tr><td>' + item.link +'</td><td>'+ item.name +'</td><td>'+ item.description +'</td><td>' + item.message + '</td><td>' + item.button + '</td></tr>';
							});
						}

						$(html).appendTo(table);

						$btn.button('reset');
						alert('The Exporting has been successfully');
					} else {
						$btn.button('reset');
						alert('The Exporting has an error. Please try again!');
					}
				}
			});

			//business logic...
			//$btn.button('reset');
		}

	});

});