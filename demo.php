<?php
    
    // Include the FlightAware class
    include('flightAware.php');
    
    // Initiate class
    $flightAware = new FlightAware('#YOUR_FLIGHT_AWARE_USERNAME#', '#YOUR_FLIGHT_AWARE_API_KEY#');
    
    // Pull data from FlghtAware
    $scheduledFleet = $flightAware->pull('FleetScheduled', [ 'fleet' => 'KLM' ] );
    
    // Output data
    echo "<pre>"; print_r( $scheduledFleet );
