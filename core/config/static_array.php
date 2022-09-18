<?php
return [
	'booking_validity' => [
		24 => '24 Hours',
		48 => '48 Hours',
		74 => '74 Hours',
		96 => '96 Hours'
    ],
    'shipping_status' => [
        00 => 'Not Shipped',
        10 => 'In Progress at Source',
        20 => 'Collected by Shipping Agent at Source',
        30 => 'Cancelled',
        40 => 'In Shipping Line(Departure Country)',
        50 => 'In Shipping Line(Transit)',
        60 => 'In Shipping Line(Arrival Country)',
        70 => 'Shipping Arrived At Destination Receiving Agent',
        80 => 'Shipping Arrived At Destination Warehouse',
        90 => 'Unboxing Finished',
        100 => 'Shipment Complete'
    ],
]
?>
