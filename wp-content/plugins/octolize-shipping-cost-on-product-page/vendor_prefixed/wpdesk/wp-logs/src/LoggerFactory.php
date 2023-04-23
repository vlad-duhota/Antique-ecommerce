<?php

namespace OctolizeShippingCostOnProductPageVendor\WPDesk\Logger;

use OctolizeShippingCostOnProductPageVendor\Monolog\Logger;
/*
 * @package WPDesk\Logger
 */
interface LoggerFactory
{
    /**
     * Returns created Logger
     *
     * @param string $name
     *
     * @return Logger
     */
    public function getLogger($name);
}
