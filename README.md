![Automile](https://content.automile.com/automile_logo_symbol_64x64.png "Automile 291 Alma Street, Palo Alto, California 943 01, US")

# Official Automile REST API for PHP
Automile offers a simple, smart, cutting-edge telematics solution for businesses to track and manage their business vehicles. Automile is a next-gen IoT solution and the overall experience is unmatched. Business of all sizes love to use Automile to get fleet intelligence whether it is understanding driving behavior, recording vehicle defects and expenses, tracking vehicles real time or securing vehicles from un-authorized use. 

Automile gives developers a simple way to build services and applications through its unique application program interface (API).  Our simple REST based API support more than 400 core features empowering developers to access more data and enabling tighter integration to build apps for the connected ecosystem. 

API information can be found at https://api.automile.com. If you need any help, we are here to help. Simply email us at support@automile.com or chat with us.

The latest OpenAPI (fka Swagger) specification may be found at: https://api.automile.com/swagger/docs/v1

:yum:

**This library allows you to quickly and easily use the Automile API via PHP.**

**This SDK is currently in beta. If you need help:**

* **Use the [Issue Tracker](https://github.com/Automile/automile-php/issues) to report bugs or missing functionality in this library.**
* **Send an email to [support@automile.com](support@automile.com) to request help with our API or your account.**

## Prerequisites

- PHP >= 5.4
- The PHP cURL extension

## Composer

To install the package via [Composer](https://getcomposer.org), run the following command:

```
composer require automile/automile-php
```

You also need to require Composer's [autoload](https://getcomposer.org/doc/00-intro.md#autoloading):

```php
require_once('vendor/autoload.php');
```

## Manual Installation

If you prefer manual installation, you can download the [latest release](https://github.com/Automile/automile-php/releases)
and include the autoload.php file in your code:

```php
require_once('/path/to/automile-php/init.php');
```

## Sign Up

If you don't yet have an account, you can create one right here:
```php
$userModel = AutomileClient::signUp('username@example.com');
echo $userModel->toPHP();
```
The code above creates an Automile account and provides you with the PHP code to configure the component:
```php
\Automile\Sdk\Config::setUsername('username@example.com');
\Automile\Sdk\Config::setPassword('*****');
\Automile\Sdk\Config::setApiClient('*****.automile.com');
\Automile\Sdk\Config::setApiSecret('*****');
```
Remember to save the code and/or the credentials for future usage.

## Quickstart

First, let's initialize the client.

It's recommended to store the authentication token for futher use,
otherwise the client would have to retrieve new token each time upon initialization.

The token must be stored either outside of the document root, or the directory must be protected via configuration files.

PHP should be allowed to read and write into the token storage directory for the client to function properly.

**Note:** Please make sure that the token storage path is not accessible via HTTP. 

```php
// import required classes
use Automile\Sdk\AutomileClient;
use Automile\Sdk\Config;
use Automile\Sdk\Types;
use Automile\Sdk\Models;

// path to the token
define('AUTOMILE_TOKEN', '/path/to/storage/automile-token.json');

// Automile account credentials
// see also Sign Up section above
Config::setUsername('username@example.com');
Config::setPassword('*****');
Config::setApiClient('*****.automile.com');
Config::setApiSecret('*****');

// initialize the client from saved token
// if the token is missing, a new one will be created using the credentials above
$client = AutomileClient::fromSavedToken(AUTOMILE_TOKEN);

// provide the path to the token storage file in case the new token is created, or old one refreshed
$client->saveToken(AUTOMILE_TOKEN);

// confirm everything's been set up correctly
$isValid = $client->validateToken();
var_dump($isValid);
```

If the `$isValid` variable contains boolean `true`, everything works as a charm!

If something's not right, please report the issue to the [Issue Tracker](https://github.com/Automile/automile-php/issues),
and we'll get to it as soon as possible. 

**Note:** Automile is currentley accepting username and password authentication for users belonging to private clients you are creating.

## Methods

* [Vehicle](#vehicle-methods)  
* [Trip](#trip-methods)  
* [Driver](#contact-methods)  
* [Geofence](#geofence-methods)  
* [Notification (webhooks, e-mail, text, inbox and push)](#notification-methods)  
* [Notification Messages](#notification-message-methods)  
* [Places (automation)](#place-methods)
* [Devices](#device-methods)
* [Fleets](#fleet-methods)
* [Attach Geofences to Vehicles](#attach-geofence-methods)
* [Attach Places to Vehicles](#attach-places-methods)
* [Attach Vehicles to Fleets](#attach-vehicles-methods)
* [Attach Drivers to Fleets](#attach-drivers-methods)
* [Device Events](#device-events-methods)
* [Publish Subscribe](#publish-subscribe-methods)


### Vehicle Methods

All these methods are used to retrieve one or multiple vehicles and their current locations.
You can also create, edit and delete vehicles.

#### Get all vehicles
```php
$vehicles = $client->getVehicles();
```

#### Get details for a specific vehicle
```php
$vehicleDetails = $client->getVehicleById(33553);
```
#### Get status for all vehicles which will include the position of the actual vehicles
```php
$vehicleStatus = $client->getStatusForVehicles();
```
#### Check-in driver to vehicle
```php
$client->checkInToVehicle(new Models\Vehicle\CheckIn([
    "ContactId" => 2,
    "VehicleId" => 33553,
    "DefaultTripType" => Types\TripType::AUTO, // Use the users schedule, place or other automation rules
    "CheckOutAtUtc" = (new \DateTime('now', 'UTC'))->add(new \DateInterval('P3D')) // Use to schedule future auto-checkout, leave empty for permanent check-in
}));
```

#### Check-out yourself
```php
$client->checkOut();
```

### Trip Methods

#### Get all trips for the last days
```php
$trips = $client->getTrips(3); // number of days
```
#### Get overview for a specific trip
```php
$tripOverview = $client->getTripById(31826384);
```
**Note:** This call contains overview details of a trip,
if you want all datapoints you can instead use `GetCompletedTripDetails()` or `GetCompletedTripDetailsAdvanced()`.

#### Get the start and stop latitude and longitude positions of the trip
```php
$tripStartStopPosition = $client->getTripStartStopLatitudeLongitude(31826384);
```
#### Get all latituide and longitude locations during the trip 
```php
$tripPositions = $client->geoTripLatitudeLongitude(31826384);
```
#### Get trip details for a trip
```php
$tripDetails = $client->getCompletedTripDetails(31826384);
```
#### Get advanced trip details for a trip
```php
$tripAdvanced = $client->getCompletedTripDetailsAdvanced(31826384);
```
#### Get all RPM values during a trip
```php
$rpmValues = $client->getTripRPM(31826384);
```
#### Get all ambient temperature values during a trip
```php
$ambientTemperatures = $client->getTripAmbientTemperature(31826384);
```
#### Get all engine coolant temperature values during a trip
```php
$coolantTemperatures = $client->getTripEngineCoolantTemperature(31826384);
```
#### Get all fuel values during a trip
```php
$fuelLevels = $client->getTripFuelLevel(31826384);
```
**Note:** Only specific US makes and models are supporting fuel levels reporting

#### Edit trip tags and category
```php
$client->editTrip(new Models\Trip([
    "TripId" => 31826384,
    "TripTags" => ['note 1', 'note 2'],
    "TripType" => Types\TripType::BUSINESS
]));
```

#### Set specific contact / driver for a trip
```php
$client->setDriverOnTrip(31826384, 2);
```

### Contact Methods

All these methods are used to retrieve one or multiple contacts (drivers). Contact is considered
a driver if they are checked-in into a vehicle.

#### Get all contacts/drivers
```php
$contacts = $client->getContacts();
```
#### Get contact details by it's id
```php
$contactDetail = $client->getContactById(2);
```
#### Get details around your self
```php
$me = $client->getMe();
```

### Geofence Methods

#### Get all geofences
```php
$geofences = $client->getGeofences();
```

#### Get details for a specific geofence
```php
$geofenceDetails = $client->getGeofenceById(881);
```

#### Create a geofence and associating it with the first vehicle
```php
$polygon = new Models\GeofencePolygon([
    ["Latitude" => 37.44666232, "Longitude" => -122.16905397],
    ["Latitude" => 37.4536707, "Longitude" => -122.16150999],
    ["Latitude" => 37.4416096, "Longitude" => -122.16112375]
]);
$client->createGeofence(new Models\Geofence([
    'Name' => 'My Palo Alto geofence',
    'Description' => 'Outside main offfice',
    'VehicleId' => 33553,
    'GeofencePolygon' => $polygon,
    'GeofenceType' => Types\GeofenceType::OUTSIDE
]));
```

![To see the created geofence visit the web or mobile app](https://content.automile.com/sdk/CreateGeofence.png "The created geofence")

#### Edit a geofence
```php
$polygon = new Models\GeofencePolygon([
    ["Latitude" => 37.44666232, "Longitude" => -122.16905397],
    ["Latitude" => 37.4536707, "Longitude" => -122.16150999],
    ["Latitude" => 37.44873066, "Longitude" => -122.15365648],
    ["Latitude" => 37.4416096, "Longitude" => -122.16112375]
]);
$client->createGeofence(new Models\Geofence([
    'GeofenceId' => 3319,
    'Name' => 'Another name',
    'Description' => 'Outside main offfice',
    'GeofencePolygon' => $polygon,
    'GeofenceType' => Types\GeofenceType::OUTSIDE
]));
```
If you want to associate additional vehicles, check `createVehicleGeofence()` that adds an existing geofence to a vehicle

#### Delete a geofence
```php
$client->deleteGeofence(881);
```

### Notification Methods

All these methods are used to retrieve one or multiple notifications.
You can also create, edit, mute, unmute and delete notifications. Notifications was earlier
called Triggers.

With notifications you can also easily add webhooks, the destination for a notification could be:
* Webhook (HTTP Post)
* Text
* E-mail
* Inbox (in Automile UI)

#### Webhook format
```json
{
    "triggerMessageHistoryId": 0,
    "triggerId": 0,
    "triggerType": 0,
    "vehicleId": 0,
    "messageData1": "",
    "messageData2": ""
}
```

The message data 1 and 2 will contains data relating to the actual used notification type. If you for
example use a notificiation for trip start or trip end the messageData1 will contain the actual trip id.

#### Get all notifications (earlier called triggers)
```php
$notifications = $client->getNotifications();
```

#### Get details for a specific notification (earlier called triggers)
```php
$notificationDetails = $client->getNotificationById(25173);
```

#### Create a notification
```php
$newNotification = $client->createNotification(new Models\Trigger([
    "IMEIConfigId" => 28288, // What is this ?
	// IMEIConfigId is today called DeviceId and is the device identifier 
	// connected to the vehicle, you can get this id from the vehicle (GetVehicleById method)
    "TriggerType" => Types\TriggerType::ACCIDENT,
    "DestinationType" => Types\DestinationType::SMS,
    "DestinationData" => "+14158320378"
]));
```

**Why  using a different identifier for notifications ?** The reasons is that there are two 
objects, the vehicle contains all properties for a vehicle while a device (earlier called IMEIConfig)
is connected to the vehicle. If you move the device to another vehicle the notifications
are still valid.

#### Edit a notification
```php
$client->editNotification(new Models\Trigger([
    "TriggerId" => 190914,
    "IMEIConfigId => 28288, // See note above, this is the DeviceId
    "TriggerType" => Types\TriggerType::ACCIDENT,
    "DestinationType" = Types\DestinationType::SMS,
    "DestinationData" = "+14158320378"
]));
```

#### Mute a notification
```php
$client->muteNotification(190913, 60*60); // mutes for 1 hour
```

#### Unmute a notification
```php
$client->unmuteNotification(190913);
```

#### Delete a notification
```php
$client->deleteNotification(190913);
```

### Notification Message Methods

This is used to get historic messages that have been sent to the destination configured.

#### Get all notifications messages
```php
$notificationMessages = $client->getNotificationMessages();
```

#### Get all notifications messages for a specific notification
```php
$forSpecificNotification = $client->getNotificationMessagesByNotificationId(148638);
```

### Place Methods

With places you can track visits (stops) to locations and carry out certain automation
rules. A place is a position (latitude and longitude) and a radius (given in metric meters).

#### Get all places
```php
$places = $client->getPlaces();
```

#### Get details for a specific place
```php
$placeDetails = $client->getPlaceById(10977);
```

#### Create a place for automation and associate it with the first vehicle
```php
$newPlace = $client->createPlace(new Models\Place([
    "Name" => "My place",
    "Description" => "My home",
    "PositionPoint" => new Models\GeographicPosition([ "Latitude" => 37.445368, "Longitude" => -122.166608 ]),
    "Radius" => 100, //metric meters
	//This will whenever the vehicle starts at this location set it to business
    "TripType" => Types\TripType::BUSINESS,
    "TripTypeTrigger" => Types\TripTypeTriggerType::START,
    "VehicleId" => 33553
]));
```

#### Edit a place
```php
$client->editPlace(new Models\Place([
    "PlaceId" => 11968,
    "Name" => "My place - edited",
    "PositionPoint" => new Models\GeographicPosition([ "Latitude" => 37.445368, "Longitude" => -122.166608 ])
]));
```

#### Delete a place
```php
$client->deletePlace(11968);
```

### Device Methods

Devices are smartphones or/and Automile's smart boxes. Every box is attached to a vehicle.
Notifications are attached to devices while places and geofences are attached to vehicles.

#### Get all devices
```php
$devices = $client->getDevices();
```

#### Get details for a specific device
```php
$deviceDetails = $client->getDeviceById(28288);
```

#### Register a device and associate it to a vehicle
```php
$newDevice = $client->createDevice(new Models\Device([
    "IMEI" => "353466072332998",
    "SerialNumber" => "6070763210",
    "VehicleId" => 33553,
    "IMEIDeviceType" = null // no need if you register a box
]));
```

#### Edit a device
```php
$client->editDevice(new Models\Device([
    "IMEIConfigId" => 28288,
    "VehicleId" => 33553
]));
```
**What do I use this for ?** This method is used to move a device to another vehicle.
Automile still apply automatic creation of vehicles and moving devices when they are 
moved to new vehicles. But in a cases you may want to move the device manually to another
vehicle.

#### Delete a device
```php
$client->deleteDevice(11968);
```

### Fleet Methods

Fleets are used to divide vehicles into groups that can apply different security priviligies.

#### Get all fleets
```php
$fleets = $client->getFleets();
```

#### Get details for a specific fleet
```php
$fleetDetails = $client->getFleetById(3331);
```

#### Create a fleet and associate it with me (in this case)
```php
$newFleet = $client->createFleet(new Models\Company([
    "CreateRelationshipToContactId" => 2,
    "Description" => "Some good description for the fleet",
    "RegisteredCompanyName" => "My new fleet"
]));
```

#### Edit a fleet
```php
$client->editFleet(new Models\Company([
{
    "CompanyId" => 3331,
    "Description" => "Test",
    "RegisteredCompanyName" => "Automile Palo Alto Fleet"
});
```

#### Delete a fleet
```php
$client->deleteFleet(3331);
```

### Attach Geofence Methods

A geofence can have one or many included vehicles which are called relationships. These methods
allows you to list, get, create, edit and delete these relationships.

#### Get all vehicle geofences - relationships between a vehicle and a geofence
```php
$vehicleGeofencesRelationships = $client->getVehicleGeofencesByGeofenceId(3276);
```

#### Get all relationships to vehicles for a specific geofence
```php
$vehicleGeofenceRelationships = $client->getVehicleGeofenceById(44251);
```

#### Create a relationship between a vehicle and a geofence
```php
$newVehicleGeofenceRelationship = $client->createVehicleGeofence(new Models\Vehicle\Geofence([
    "GeofenceId" => 3276,
    "VehicleId" => 33553,
	// Restrict when this geofence should be valid from and to if needed
    "ValidFrom" => null,
    "ValidTo" => null
]));
```

#### Edit a vehicle geofence relationship
```php
$dateTime = new \DateTime('now', new \DateTimeZone('UTC'));
$client->editVehicleGeofence(new Models\Vehicle\Geofence([
    "VehicleGeofenceId" => 44251,
	"ValidFrom" => $dateTime->format('Y-m-d'),
	"ValidTo" => $dateTime->add(new \DateInterval('P7D'))->format('Y-m-d')
}));
```

#### Delete a vehicle geofence relationship
```php
$client->deleteVehicleGeofence(44251);
```

### Attach Places Methods

A place can have one or many included vehicles which are called relationships. These methods
allows you to list, get, create, edit and delete these relationships. A vehicle that has
a relationship to a place also have it's own radius and automation settings.

#### Get all vehicle places - relationships between a vehicle and a place
```php
$vehiclePlacesRelationships = $client->getVehiclePlaceById(10977);
```

#### Get all relationships to vehicles for a specific place
```php
$vehiclePlaceRelationships = $client->getVehiclePlacesByPlaceId(44251);
```

#### Create a relationship between a vehicle and a geofence
```php
$newVehiclePlace = $client->createVehiclePlace(new Models\Vehicle\Place([
    "PlaceId" => 10977,
    "VehicleId" => 33553,
    "Description" => "Some description",
    "Radius" => 100,
    "TripType" => Types\TripType::BUSINESS,
    "TripTypeTrigger" => Types\TripTypeTriggerType::START
]));
```

#### Edit a vehicle place relationship
```php
$client->editVehiclePlace(new Models\Vehicle\Place([
    "VehiclePlaceId" => 30567,
    "Description" => "Some description",
    "Radius" => 100,
    "TripType" => Types\TripType::BUSINESS,
    "TripTypeTrigger" => Types\TripTypeTriggerType::DRIVES_BETWEEN,
    "DrivesBetweenAnotherPlaceId" => 10979
}));
```

#### Delete a vehicle place relationship
```php
$client->deleteVehiclePlace(36405);
```

### Attach Driver Methods

A fleet can have one or multiple drivers (contacts) and one or multiple vehicles.

#### Get all drivers - relationships between all fleets and all drivers
```php
$allFleetDrivers = $client->getFleetContacts();
```

#### Get specific driver relationships
```php
$specificDriverRelationship = $client->getFleetContactById(2);
```

#### Get all drivers for specific fleet - relationships between specific fleet and all drivers
```php
$allDriversForSpecificFleet = $client->getFleetContactsByFleetId(10);
```

#### Create a relationship between a driver and a fleet
```php
$newFleetContact = $client->createFleetContact(new Models\CompanyContact([
    "CompanyId" => 10,
    "ContactId" => 2
]));
```

#### Edit a driver and fleet relationship
```php
$client->editFleetContact(new Models\CompanyContact([
    "CompanyContactId" => 10398,
    "CompanyId" => 11,
    "ContactId" => 2
]));
```

#### Delete a driver fleet relationship
```php
$client->deleteFleetContact(10398);
```

### Device Events Methods

Device events are a number of events like connect, disconnect, mileage indicator lamp (MIL on/off), 
diagnostic trouble codes (DTC).

#### Get all device events
```php
$deviceEvents = $client->getDeviceEvents();
```

#### Getting details about a status event (connected or disconnected)
```php
$deviceStatusEvent = $client->getDeviceEventStatusById(1138161);
```

#### Getting details about a mileage indicator lamp (MIL) event (on or off)
```php
$deviceMILEvent = $client->getDeviceEventMILById(1138162);
```

#### Getting details about a diagnostic trouble code (DTC) event
```php
$deviceDTCEvent = $client->getDeviceEventDTCById(1138213);
```

### Publish Subscribe Methods

**Note:** Currentley in alpha. 

Publish subscribe mimics a message queuing system that allows you to create subscribers that whenever a message 
is published will repost the message to your endpoint. The publish subscribe framework is more resilient compared
to simpler web hooks (that are available as part of our notifications) and allows for anonymous, basic, bearer
and Salesforce specific authentication. It also allows for configurable retries and also extends to cover 
modification and creation of certain objects.

Publish subscribe guranteee that messages received have been fully processed in Automile's microservice architecture
which means you can assume all properties have been set and calculated. 

All published messages contains two common properties called PublishMessageType and PublishMessageDateTimeUtc.

PublishMessageType will contain information what kind of message you are receiving:
* TripStartMessage = 0,
* TripEndMessage = 1,
* VehicleModified = 2,
* VehicleCreated = 3,
* DriverModified = 4,
* DriverCreated = 5

PublishMessageDateTimeUtc is the date and time (UTC) when the message was published.

#### Get all publish subscribe records
```php
$publishSubscribeRecords = $client->getPublishSubscribe();
```

#### Get details about a specific publish subscribe record
```php
$detailsPublishSubscribeRecord = $client->getPublishSubscribeById(1);
```

#### Create a new subscription with anonymous authentication (several overloads available)
```php
$newSubscription = $client->createPublishSubscribe("http://requestb.in/pwimfapw");
```

#### Edit a subscription (pointing to an endpoint requiring basic authentication)
```php
$newSubscription = $client->createPublishSubscribe("http:/your_basic_auth_endpoint", new Models\PublishSubscribeAuthentication\Basic([
    "Username" => "username",
    "Password" => "password"
]));
```
#### Delete a subscription (will also delete queued messages)
```php
$client->deletePublishSubscribe(1);
```

#### Format for Trip End message

```json
{
  "PublishMessageType": 1,
  "PublishMessageDateTimeUtc": "2017-02-11T04:04:36.926967Z",
  "TripId": 32575162,
  "VehicleId": 33553,
  "DriverContactId": null,
  "TripStartDateTime": "2017-02-11T01:14:44",
  "TripStartTimeZone": -8,
  "TripEndDateTime": "2017-02-11T01:21:40",
  "TripEndTimeZone": -8,
  "TripStartFormattedAddress": "2809-2811 Middlefield Rd, Palo Alto, CA 94306, USA",
  "TripEndFormattedAddress": "829 Thornwood Dr, Palo Alto, CA 94303, USA",
  "TripStartCustomAddress": null,
  "TripEndCustomAddress": null,
  "TripLengthInKilometers": 2,
  "TripType": 0,
  "TripTags": null,
  "FuelInLiters": null,
  "IdleTimeInSecondsAllTrip": 123,
  "IdleTimeInSecondsFromStart": 30,
  "CustomCategory": null,
  "TripLengthInMinutes": 7,
  "TripStartLongitude": -122.127766666667,
  "TripStartLatitude": 37.4326833333333,
  "TripEndLongitude": -122.114066666667,
  "TripEndLatitude": 37.4287666666667
}
```

#### Format for Trip Start message

```json
{
  "PublishMessageType": 0,
  "PublishMessageDateTimeUtc": "2017-02-11T03:48:12.0845446Z",
  "TripId": 32575162,
  "VehicleId": 33553,
  "DriverContactId": null,
  "TripStartDateTime": "2017-02-11T01:14:44",
  "TripStartTimeZone": -8,
  "TripStartFormattedAddress": "2809-2811 Middlefield Rd, Palo Alto, CA 94306, USA",
  "TripStartLongitude": -122.127766666667,
  "TripStartLatitude": 37.4326833333333
}
```

#### Format for Vehicle modified and created

For modified PublishMessageType will be 2.

```json
{
  "PublishMessageType": 3,
  "PublishMessageDateTimeUtc": "2017-02-11T03:50:46.284724Z",
  "VehicleId": 33553,
  "VehicleIdentificationNumber": "WA1DGAFE5FD019516",
  "NumberPlate": "7GDC324",
  "Make": "Audi",
  "Model": "Q7",
  "OwnerContactId": null,
  "OwnerCompanyId": null,
  "CurrentOdometerInKilometers": 1558.06,
  "UserVehicleIdentificationNumber": null,
  "ModelYear": 2015,
  "BodyStyle": null,
  "FuelType": 1,
  "DefaultTripType": 0,
  "AllowAutomaticUpdates": true,
  "DefaultPrivacyPolicyType": null,
  "CheckedInContactId": null,
  "MakeImageUrl": "https://content.automile.com/vinlogo/audi.png",
  "AllowSpeedRecording": true,
  "Nickname": "Jens",
  "CategoryColor": 2591227,
  "Tags": "Oakland clients, test"
}
```