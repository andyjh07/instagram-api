<?php

namespace App;

use GuzzleHttp\Client as Guzzle;

class Instagram {
  
  private $token;

  public function __construct($token)
  {
    $this->token = $token;
  }

  public function feed(int $limit, array $types = [])
  {
    $client = new Guzzle([
      'base_uri' => 'https://graph.instagram.com/'
    ]);
    
    $res = $client->request('GET', 'me/media', [
      'query' => [
        'fields' => 'id,caption,media_type,media_url,username,timestamp',
        'limit' => $limit,
        'access_token' => $this->token
      ]
    ]);
    
    if($res->getStatusCode() == 200){
    
      $feed = json_decode($res->getBody());
    
      foreach($feed->data as $item){
        if($types && !in_array($item->media_type, $types)){
          continue;
        }

        echo "<img src='$item->media_url'>";
        echo "<p>$item->caption</p>";
      }
    }
  }
}