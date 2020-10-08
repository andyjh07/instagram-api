<?php

require 'vendor/autoload.php';

$instagram = new App\Instagram("IGQVJYYUpzZA043UnJtVEpyZA0UwT1pfWWROQTczZA3Q3ZAUM0UTRhTW9iR2RoNFFSbHZAyYTFnanNWTVZArUjhoaUlxQngxNFNqU3l1THp4T2p0RGE5Sk1kUlRvQVNDY1dVQTRRLU5JQzB3");
$items = $instagram->feed(6, ['IMAGE', 'CAROUSEL_ALBUM']);

foreach($items as $item){
  echo $item->media_url;
}
?>