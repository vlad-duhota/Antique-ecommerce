<?php

namespace OctolizeShippingCostOnProductPageVendor\WPDesk\View\Resolver;

use OctolizeShippingCostOnProductPageVendor\WPDesk\View\Renderer\Renderer;
use OctolizeShippingCostOnProductPageVendor\WPDesk\View\Resolver\Exception\CanNotResolve;
/**
 * Class should resolve name by serching in provided dir. If empty then current dir
 *
 * @package WPDesk\View\Resolver
 */
class DirResolver implements \OctolizeShippingCostOnProductPageVendor\WPDesk\View\Resolver\Resolver
{
    /** @var string */
    private $dir;
    /**
     * Base path for templates ie. subdir
     *
     * @param $dir
     */
    public function __construct($dir)
    {
        $this->dir = $dir;
    }
    /**
     * Resolve name to full path
     *
     * @param string $name
     * @param Renderer|null $renderer
     *
     * @return string
     */
    public function resolve($name, \OctolizeShippingCostOnProductPageVendor\WPDesk\View\Renderer\Renderer $renderer = null)
    {
        $dir = \rtrim($this->dir, '/');
        $fullName = $dir . '/' . $name;
        if (\file_exists($fullName)) {
            return $fullName;
        }
        throw new \OctolizeShippingCostOnProductPageVendor\WPDesk\View\Resolver\Exception\CanNotResolve("Cannot resolve {$name}");
    }
}
