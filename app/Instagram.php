<?php

namespace App;

use GuzzleHttp\Client as Guzzle;

class Instagram {
  
  private $token;
  private $client;

  public function __construct($token)
  {
    /**
     * Set up a new Guzzle client
     */
    $this->client = new Guzzle([
      'base_uri' => 'https://graph.instagram.com/'
    ]);

    $this->token = $token;
  }

  public function feed(int $limit, array $types = [])
  {    
    /**
     * Query the endpoint to get the data
     */
    $res = $this->client->request('GET', 'me/media', [
      'query' => [
        'fields' => 'id,caption,media_type,media_url,username,timestamp',
        'limit' => $limit,
        'access_token' => $this->token
      ]
    ]);
    
    /**
     * If query is successful, clean out any media types that aren't required and return to the user
     */
    if($res->getStatusCode() == 200){
    
      $feed = json_decode($res->getBody());
      $cleanFeed = [];
    
      foreach($feed->data as $item){
        if($types && !in_array($item->media_type, $types)){
          continue;
        }

        array_push($cleanFeed, $item);
      }
      return $cleanFeed;
    }
  }

  public function renewToken()
  {
    /**
     * Query the endpoint to get the new token
     */
    $res = $this->client->request('GET', 'refresh_access_token', [
      'query' => [
        'grant_type' => 'ig_refresh_token',
        'access_token' => $this->token
      ]
    ]);

    $result = json_decode($res->getBody());
    
    echo $result->access_token;

    /**
     * TODO: Save new token somewhere, run this function inside a cron every 30 days
     */
  }
}