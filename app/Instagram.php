<?php

namespace App;

use GuzzleHttp\Client as Guzzle;

class Instagram {
  
  private $token;
  private $client;
  private $file = "instagram.dat";

  public function __construct()
  {
    // Set up the Guzzle instance and set the base uri for all calls
    $this->client = new Guzzle([
      'base_uri' => 'https://graph.instagram.com/'
    ]);
    
    // Read token from file, could easily be changed to read from a database
    $this->token = file_get_contents($this->file);
  }

  /**
   * Query the endpoint to get the data
   */
  public function getFeed(int $limit, array $types = [])
  {
    // Query the media for the user with the values we pass through
    $res = $this->client->request('GET', 'me/media', [
      'query' => [
        'fields' => 'id,caption,permalink,media_type,media_url,username,timestamp',
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

  /**
   * Query the endpoint to refresh the token
   */
  public function renewToken()
  {
    $res = $this->client->request('GET', 'refresh_access_token', [
      'query' => [
        'grant_type' => 'ig_refresh_token',
        'access_token' => $this->token
      ]
    ]);

    if($res->getStatusCode() == 200){
      $result = json_decode($res->getBody());
      $token = $result->access_token;
    } else {
      $token = $this->token;
    }

    // Save token to .dat file. This could be changed to update a database table
    file_put_contents($this->file, $token);
  }
}