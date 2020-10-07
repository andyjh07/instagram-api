<?php

namespace App;

use GuzzleHttp\Client as Guzzle;

class Instagram {
  private $token;

  public function __construct($token)
  {
    $this->token = $token;
  }

  public function feed()
  {
    $client = new Guzzle([
      'base_uri' => 'https://graph.instagram.com/'
    ]);
    
    $res = $client->request('GET', 'me/media', [
      'query' => [
        'fields' => 'id,caption,media_type,media_url,username,timestamp',
        'limit' => 6,
        'access_token' => "IGQVJYYUpzZA043UnJtVEpyZA0UwT1pfWWROQTczZA3Q3ZAUM0UTRhTW9iR2RoNFFSbHZAyYTFnanNWTVZArUjhoaUlxQngxNFNqU3l1THp4T2p0RGE5Sk1kUlRvQVNDY1dVQTRRLU5JQzB3"
      ]
    ]);
    
    if($res->getStatusCode() == 200){
    
      $result = json_decode($res->getBody());
    
      foreach($result->data as $item){
        if($item->media_type == 'VIDEO'){
          continue;
        }
    
        echo "<img src='$item->media_url'>";
        echo "<p>$item->caption</p>";
      }
    }
  }
}