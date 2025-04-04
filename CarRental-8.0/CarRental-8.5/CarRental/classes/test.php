<?php

use classes\Client;

require_once 'User.php';
require_once 'Client.php';

$client = new Client (1, "Chid", "RFM@gmail.com","password","12345678",false,"D555","VISA");

//calling methods
echo $client->searchCar("SUV", "DUBLIN\n");
echo $client->bookCar(101,"2025-04-01","2025-04-05\n");
echo $client->cancelBooking(2001);
echo $client->viewHistory();