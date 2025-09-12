<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
?>
<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8">
	<title>API-Übersicht | itsnice2.de</title>
    <link rel="stylesheet" href="<?php echo base_url("assets/bootstrap.min.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/api.css"); ?>">
</head>
<body>

<div class="api-content">

    <div class="api-header">
        <h1>API-Übersicht</h1>
    </div>

    <div class="api-item">
        <h3>Deine IP anzeigen</h3>
        <hr>
        <p>Deine IP: <label class="ip-anzeigen"><?php echo $_SERVER['REMOTE_ADDR'] ?></label></p>
        <a href="<?php echo base_url("ip"); ?>">URL ausprobieren</a>
    </div>

</div>


</body>
</html>
