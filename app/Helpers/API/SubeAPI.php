<?php

namespace App\Helpers\API;

use App\SubeRequest;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class SubeAPI
{
  
  /**
   * Obtain the types of studies levels
   * 
   * @return array
   * 
   */
  public static function getStudyLevels()
  {
    $study_levels = Cache::get('study_levels', null);
    
    if(!$study_levels){
        $tokenKey = self::_generateKey();

        # build the endpoint with the url context
        $endpoint = "obtenerNivelesEstudio/". $tokenKey;
    
        $response = self::_subeRequest('GET_STUDY_LEVELS', null, $endpoint, 'POST', null);

        Cache::put('study_levels', json_encode($response->nivelesEstudio), 3600);
        
        $study_levels = json_encode($response->nivelesEstudio);
        
    }
    
    return json_decode($study_levels);
  }

   /**
   * Obtain the types of documents
   * 
   * @return array
   * 
   */
  public static function getDocumentTypes()
  {
    $document_types = Cache::get('document_types', null);
    
    if(!$document_types){
        $tokenKey = self::_generateKey();

        # build the endpoint with the url context
        $endpoint = "obtenerTiposDocumento/". $tokenKey;
    
        $response = self::_subeRequest('GET_DOCUMENT_TYPES', null, $endpoint, 'POST', null);

        Cache::put('document_types', json_encode($response->tiposDocumento), 3600);
        
        $document_types = json_encode($response->tiposDocumento);
        
    }
    
    return json_decode($document_types);
  }

  /**
   * Obtain the study level
   * 
   * @param string $document
   * 
   * @return object
   * 
   */
  public static function getStudyLevel($document)
  {
    $tokenKey = self::_generateKey();

    # build the endpoint with the url context
    $endpoint = "obtenerNivelEstudio/". $tokenKey. "/". $document;

    $response = self::_subeRequest('GET_STUDY_LEVEL', null, $endpoint, 'POST', null);

   // dd($response);
    if(count($response->errors) > 0){
      $nivelEstudio = $response->errors[0]->value;
    }else{
      $nivelEstudio = $response->nivelEstudio;
    }

    return $nivelEstudio;
  }


  /**
   * Obtain operations for document
   * 
   * @param string $document
   * 
   * @return array
   * 
   */
  public static function getOperations($document)
  {
    $tokenKey = self::_generateKey();

    # build the endpoint with the url context
    $endpoint = "obtenerOperacionesRealizadas/". $tokenKey. "/". $document;

    $response = self::_subeRequest('GET_OPERATIONS', null, $endpoint, 'POST', null);
    
    if(count($response->errors) > 0){
      $operations = $response->errors[0]->value;
    }else{
      $operations = $response->operaciones;
    }
    return $operations;
  }

  /**
   * Obtain operations for document
   * 
   * @param string $document
   * 
   * @return array
   * 
   */
  public static function getTarjetaAsociada($document)
  {
    $tokenKey = self::_generateKey();

    # build the endpoint with the url context
    $endpoint = "obtenerTarjetaAsociada/". $tokenKey. "/". $document;

    $response = self::_subeRequest('GET_SUBE_CARD', null, $endpoint, 'POST', null);
    
    if(count($response->errors) > 0){
      $tarjetaAsociada = $response->errors[0]->value; 
    }else{
      $tarjetaAsociada = $response->tarjetaAsociada;
    }
    return $tarjetaAsociada;
  }


  /**
   * Executes the request to SUBE API
   * 
   * @param string $action action to do 
   * @param string $body
   * @param string $endpoint
   * @param string $method Verbos HTTP ej: GET, PATCH, PUT, POST
   * @param string|null $ip IP origen
   * @param int|null $user_id
   * 
   * @return object|null
   */
  private static function _subeRequest($action, $body, $endpoint, $method = "POST", $ip = null): ?object
  {
    $headers = [
      "Content-Length" => strlen($body),
      "Content-Type"   => "application/json",
    ];

    $sube_request = new SubeRequest();
    $sube_request->action     = $action;
    $sube_request->headers    = json_encode($headers);
    $sube_request->body       = $body;
    $sube_request->endpoint   = $endpoint;
    $sube_request->method     = $method;
    $sube_request->ip         = $ip;
    $sube_request->save();

    $client = new Client([
      'base_uri'        => env('SUBE_BASE_URL'),
      'timeout'         => 90,
      'connect_timeout' => 90,
      'headers'         => $headers,
      'http_errors'     => false
    ]);

    # Execute the request and saves the response
    $response = $client->request($method, $endpoint, [
      'body' => $body
    ]);

    if ($response) {
   
      $response_status = $response->getStatusCode();
      $response_body   = $response->getBody();
    } else {
      # 0 to set a difference with the default, which is Null
      $response_status = '0';
      $response_body   = null;
    }
 
    $sube_request->status   = $response_status;     
    $sube_request->response = $response_body;
    $sube_request->save();
    return json_decode($response_body);
  }

  /**
   * Generate the authenticate key need to consume the sube webservices
   * 
   * @return string
   */
  private static function _generateKey():string
  {
    $tokenKey = Cache::get('subeKey', null);

    if (!$tokenKey) {
      $endpoint = "generateKey/". env("SUBE_USER"). '/'. env("SUBE_PASSWORD");
    
      $response = self::_subeRequest('SEARCH_CONTACT', null, $endpoint, 'POST', null);
      
      Cache::put('subeKey', $response->key, env("SUBE_EXPIRATION_SECONDS_KEY"));
      
      $tokenKey = $response->key;
    }

    return $tokenKey;
  }
}
