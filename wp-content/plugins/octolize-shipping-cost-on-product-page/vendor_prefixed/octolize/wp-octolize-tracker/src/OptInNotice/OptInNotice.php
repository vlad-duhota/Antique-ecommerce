<?php

namespace OctolizeShippingCostOnProductPageVendor\Octolize\Tracker\OptInNotice;

use OctolizeShippingCostOnProductPageVendor\WPDesk\Notice\Notice;
use OctolizeShippingCostOnProductPageVendor\WPDesk\Notice\PermanentDismissibleNotice;
use OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Plugin\Hookable;
/**
 * Can display Opt In notice.
 */
class OptInNotice implements \OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Plugin\Hookable
{
    /**
     * @var string
     */
    private $plugin_slug;
    /**
     * @var ShouldDisplay
     */
    private $should_display;
    /**
     * @var string
     */
    private $shop_url;
    /**
     * @param string $plugin_slug
     * @param string $shop_url
     * @param ShouldDisplay $should_display
     */
    public function __construct(string $plugin_slug, string $shop_url, \OctolizeShippingCostOnProductPageVendor\Octolize\Tracker\OptInNotice\ShouldDisplay $should_display)
    {
        $this->plugin_slug = $plugin_slug;
        $this->should_display = $should_display;
        $this->shop_url = $shop_url;
    }
    /**
     * @return void
     */
    public function hooks()
    {
        \add_action('admin_notices', [$this, 'display_notice_if_should']);
    }
    /**
     * @return void
     */
    public function display_notice_if_should()
    {
        if ($this->should_display->should_display()) {
            $this->create_notice();
        }
    }
    /**
     * @return PermanentDismissibleNotice
     */
    protected function create_notice()
    {
        $notice_name = 'octolize_opt_in_' . $this->plugin_slug;
        new \OctolizeShippingCostOnProductPageVendor\WPDesk\Notice\PermanentDismissibleNotice($this->prepare_notice_content(), $notice_name, \OctolizeShippingCostOnProductPageVendor\WPDesk\Notice\Notice::NOTICE_TYPE_SUCCESS);
    }
    /**
     * @return string
     */
    private function prepare_notice_content()
    {
        $user = \wp_get_current_user();
        $username = $user->first_name ? $user->first_name : $user->user_login;
        $terms_url = \sprintf('%1$s/usage-tracking/', \untrailingslashit($this->shop_url));
        $plugin_slug = $this->plugin_slug;
        \ob_start();
        include __DIR__ . '/views/html-notice.php';
        return \ob_get_clean();
    }
}
