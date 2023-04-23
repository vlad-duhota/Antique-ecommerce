<?php

namespace OctolizeShippingCostOnProductPageVendor\WPDesk\RepositoryRating\DisplayStrategy;

/**
 * DisplayDecision - always display.
 */
class AlwaysDisplayDisplayDecision implements \OctolizeShippingCostOnProductPageVendor\WPDesk\RepositoryRating\DisplayStrategy\DisplayDecision
{
    /**
     * Should display?
     *
     * @return bool
     */
    public function should_display() : bool
    {
        return \true;
    }
}
