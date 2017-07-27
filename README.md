# FlightAware FlightXML2
A small but useful PHP library for FlightAware FlightXML2, the library is pretty straight forward and very easy when it comes to usage. In just a few steps you will be able to pull data from FlightAware.

Before proceeding with this readme I suggest you read the FlightAware documentation via;
http://flightxml.flightaware.com/soap/FlightXML2/doc

# Step 1: Include flightAware.php
```php
include('flightAware.php');
```
# Step 2: Initiate FlightAware class
```php
$flightAware = new FlightAware('#YOUR_FLIGHT_AWARE_USERNAME#', '#YOUR_FLIGHT_AWARE_API_KEY#');
```
# Step 3: Pull data from FlightAware
```php
$scheduledFleet = $flightAware->pull('FleetScheduled', [ 'fleet' => 'KLM' ] );
```
The FlightAware pull function expects 2 parameters, the first parameter (string) is the FlightAware operation e.g. "FleetScheduled". The second parameter (array) is a list of url params that needs to be sent with the request.

# Errors:
If, for what reason an error occurs the FlightAware pull function will return an array with key "error" => "message".
