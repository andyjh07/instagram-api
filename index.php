<?php

require 'vendor/autoload.php';

$instagram = new App\Instagram();
$items = $instagram->getFeed(6, ['IMAGE', 'CAROUSEL_ALBUM']);
?>

<div id="instagramFeed">
  <?php
    foreach($items as $item){
      $item->caption = trim(substr($item->caption, 0, 60));
      echo "<a target='_blank' href='{$item->permalink}'><img src='{$item->media_url}' alt=''><span>@{$item->username}: {$item->caption}...</span></a>";
    }
  ?>		
</div>