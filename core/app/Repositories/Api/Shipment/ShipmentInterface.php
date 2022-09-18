<?php

namespace App\Repositories\Api\Shipment;

interface ShipmentInterface
{
    public function ShipmentPost($request);
    public function shipmentReceived($request);
}
