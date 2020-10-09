<?php

require 'vendor/autoload.php';

$instagram = new App\Instagram("IGQVJVU1JGcHo4RDhsNm5TUGxHdjFOVWkyZAWpzclJGLThpZAFJXS1hfRFJxX2xvd0FCaWttVlZAhdHBRcS1MRE1oWTBjemlycUtweVp0MnROYjkxcGtJbkEtUllDYzdHbktaMU1PLWZAhTVhFT3E0aDBMbwZDZD");
$items = $instagram->getFeed(6, ['IMAGE', 'CAROUSEL_ALBUM']);

foreach($items as $item){
  echo "<a href='{$item->permalink}' target='_blank'><img src='{$item->media_url}'></a>";
}
?>