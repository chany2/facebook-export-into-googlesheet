<?php
session_start();

require_once 'vendor/autoload.php';
require_once 'Config.php';
require_once 'GoogleSheet.php';

use \Lib\Common;

$clientId = CLIENT_ID;
$clientSecret = CLIENT_SECRET;
$redirectUrl = REDIRECT_URL;

$client = new Google_Client();
$client->setClientId($clientId);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUrl);
$client->setScopes(array('https://spreadsheets.google.com/feeds'));
//if (isset($_GET['code'])) {
    //$client->authenticate($_GET['code']);
    //print_r($_SESSION['access_token']);
    //exit;
//}
//print '<a href="' . $client->createAuthUrl() . '">Authenticate</a>';

//$accessToken = $_SESSION['access_token'];
//$service_token = json_decode($accessToken);

use Google\Spreadsheet\DefaultServiceRequest;
use Google\Spreadsheet\ServiceRequestFactory;

$serviceRequest = new DefaultServiceRequest(Common::getAccessToken($_SESSION['access_token']));
ServiceRequestFactory::setInstance($serviceRequest);

$spreadsheetFeed = GoogleSheet::getAllSpreadSheetFeed();

?>

<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Title Page</title>

	<!-- Bootstrap CSS -->
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<h1 class="text-center">Facebook Feed Into GoogleSheet</h1>

<div class="container">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<form action="" method="post">
				<div class="form-group">
					<label for="">SpreadSheet</label>
					<select name="spreadsheet" id="spreadsheet" class="form-control">
						<option value="">Select SpreadSheet</option>
						<?php foreach ($spreadsheetFeed as $key => $value) : ?>
							<option value="<?=$spreadsheetFeed[$key]->getTitle()?>"><?=$spreadsheetFeed[$key]->getTitle()?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="form-group">
					<label for="">WorkSheet</label>
					<select name="worksheet" id="worksheet" class="form-control">
						<option value="">Select WorkSheet</option>

					</select>
				</div>
			</form>
		</div>
	</div>
</div>


<!-- jQuery -->
<script src="//code.jquery.com/jquery.js"></script>
<!-- Bootstrap JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<script type="text/javascript">
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
</script>

</body>
</html>
