<?php

namespace OctolizeShippingCostOnProductPageVendor\WPDesk\View\Resolver;

use OctolizeShippingCostOnProductPageVendor\WPDesk\View\Renderer\Renderer;
use OctolizeShippingCostOnProductPageVendor\WPDesk\View\Resolver\Exception\CanNotResolve;
/**
 * This resolver never finds the file
 *
 * @package WPDesk\View\Resolver
 */
class NullResolver implements \OctolizeShippingCostOnProductPageVendor\WPDesk\View\Resolver\Resolver
{
    public function resolve($name, \OctolizeShippingCostOnProductPageVendor\WPDesk\View\Renderer\Renderer $renderer = null)
    {
        throw new \OctolizeShippingCostOnProductPageVendor\WPDesk\View\Resolver\Exception\CanNotResolve("Null Cannot resolve");
    }
}
