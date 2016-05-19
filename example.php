<?php
require __DIR__ . '/vendor/autoload.php';

use Vinnia\PackageMapping\Client;
use Vinnia\PackageMapping\SearchParameter;

$env = require __DIR__ . '/env.php';
$client = Client::make($env['web_service_key']);
$data = [];

if ($_POST) {
    $res = $client->getTrackList([
        new SearchParameter($_POST['tracking_number']),
    ]);
    $data = json_decode((string) $res->getBody(), true);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Package tracker</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
          crossorigin="anonymous">


</head>
<body>

    <div class="container">
        <h1>Package tracker</h1>

        <?php if ($data): ?>
            Tracking <strong><?php echo $_POST['tracking_number']; ?></strong>

            <table class="table">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Location</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data['Tracks'][0]['Activities'] as $act): ?>
                    <tr>
                        <td><?php echo $act['Date']; ?> <?php echo $act['Time']; ?></td>
                        <td><?php echo $act['Location']; ?></td>
                        <td><?php echo $act['Status']; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <hr />

        <?php endif; ?>

        <form method="post" action="">
            <input class="form-control"
                   type="text"
                   name="tracking_number"
                   placeholder="Tracking number" />

            <br />

            <button class="btn btn-primary">Track</button>
        </form>
    </div>



</body>
</html>
