<?php

namespace OctolizeShippingCostOnProductPageVendor\Octolize\Tracker\OptInNotice;

/**
 * Should display always.
 */
class ShouldDisplayAlways implements \OctolizeShippingCostOnProductPageVendor\Octolize\Tracker\OptInNotice\ShouldDisplay
{
    /**
     * @inheritDoc
     */
    public function should_display()
    {
        return \true;
    }
}
