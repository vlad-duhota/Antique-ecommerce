<?php

namespace OctolizeShippingCostOnProductPageVendor\WPDesk\View\Resolver;

use OctolizeShippingCostOnProductPageVendor\WPDesk\View\Renderer\Renderer;
use OctolizeShippingCostOnProductPageVendor\WPDesk\View\Resolver\Exception\CanNotResolve;
/**
 * Class should resolve name by standard wp theme resolve
 *
 * @package WPDesk\View\Resolver
 */
class WPThemeResolver implements \OctolizeShippingCostOnProductPageVendor\WPDesk\View\Resolver\Resolver
{
    /** @var string */
    private $template_base_path;
    /**
     * Base path for templates ie. subdir
     *
     * @param $template_base_path
     */
    public function __construct($template_base_path)
    {
        $this->template_base_path = $template_base_path;
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
        $templateFile = \locate_template([\trailingslashit($this->template_base_path) . $name]);
        if (!$templateFile) {
            throw new \OctolizeShippingCostOnProductPageVendor\WPDesk\View\Resolver\Exception\CanNotResolve("Cannot resolve {$name}");
        }
        return $templateFile;
    }
}
