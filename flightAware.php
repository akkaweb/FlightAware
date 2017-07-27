<?php

class FlightAware {

    function __construct( $username, $apiKey ) 
    {
        $this->apiUrl = 'http://flightxml.flightaware.com/json/FlightXML2/';
        $this->authenticate = (object)['username' => (string)$username, 'apiKey' => (string)$apiKey ];
    }
    
    public function pull( $endpoint, $params = [] )
    {
        if( isset( $endpoint ) && !empty( $endpoint )  )
        {
            $queryParams = ( is_array( $params ) && count( $params ) != 0 ) ? urlencode( trim( '?'. (string)http_build_query( $params, '', '&' ) ) ) : '';
            $queryUrl = trim( $this->apiUrl . (string)$endpoint . $queryParams );
            
            $this->request( $queryUrl );
            
            $response = $this->response;
            $response = json_decode( $response, true );
        
            return ( !isset( $response['error'] ) && empty( $response['error'] ) ) ? $response[ $endpoint.'Result' ] : $response;
        }
        else
        {
            return [ 'error' => 'Endpoint missing!' ];
        }
    }
    
    private function request( $url ) 
    {
        $curl = curl_init();
        
        curl_setopt( $curl, CURLOPT_URL, $curl );
        curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $curl, CURLOPT_TIMEOUT, false );
        curl_setopt( $curl, CURLOPT_FOLLOWLOCATION, true );
        curl_setopt( $curl, CURLOPT_MAXREDIRS, 5 );
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $curl, CURLINFO_HEADER_OUT, true );
        curl_setopt( $curl, CURLOPT_HEADER, false );
        curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, 'GET' );
        curl_setopt( $curl, CURLOPT_ENCODING, "gzip" );
        
        if( isset( $this->authenticate ) && !empty( $this->authenticate ) )
        {
            curl_setopt( $curl, CURLOPT_USERPWD, $this->authenticate->username . ":" . $this->authenticate->apiKey );  
        }
        
        $this->response = '';
        $this->response = curl_exec( $curl );
        
        curl_close( $curl );
    }

}