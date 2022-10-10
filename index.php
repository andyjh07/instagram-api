<?php
  require 'vendor/autoload.php';

  $instagram = new App\Instagram();
  $items = $instagram->getFeed(6, ['IMAGE', 'CAROUSEL_ALBUM']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Basic Instagram API library</title>
  
  <link rel="stylesheet" href="dist/output.css">
</head>
<body>
  <div id="instagramFeed" class="grid grid-cols-12 gap-y-6 gap-x-6">
    <?php
      foreach($items as $item){
        $item->caption = trim(substr($item->caption, 0, 60));
        echo "<a class='col-span-2' target='_blank' href='{$item->permalink}'><img src='{$item->media_url}' alt=''><span>@{$item->username}: {$item->caption}...</span></a>";
      }
    ?>		
  </div>
</body>
</html>