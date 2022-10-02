<?php

require 'vendor/autoload.php';

$instagram = new App\Instagram();
$instagram->renewToken();

?>