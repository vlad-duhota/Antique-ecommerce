<?php

namespace OctolizeShippingCostOnProductPageVendor\Octolize\Tracker\OptInNotice;

/**
 * Should display $_GET parameter present.
 */
class ShouldDisplayGetParameterPresent implements \OctolizeShippingCostOnProductPageVendor\Octolize\Tracker\OptInNotice\ShouldDisplay
{
    /**
     * @var string
     */
    private $parameter;
    /**
     * @param string $parameter
     */
    public function __construct(string $parameter)
    {
        $this->parameter = $parameter;
    }
    /**
     * @inheritDoc
     */
    public function should_display()
    {
        return isset($_GET[$this->parameter]);
    }
}
