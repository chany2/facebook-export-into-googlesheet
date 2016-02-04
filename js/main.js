/**
 * Created by hungnguyen on 02/04/16.
 */

$(document).ready(function(){
	var spreadSheetFeed = $('#spreadsheet'),
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
});