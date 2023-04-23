<?php

namespace OctolizeShippingCostOnProductPageVendor\WPDesk\Logger\WC;

use OctolizeShippingCostOnProductPageVendor\Monolog\Handler\AbstractProcessingHandler;
use OctolizeShippingCostOnProductPageVendor\Monolog\Logger;
/**
 * Class WooCommerceFactory
 */
class WooCommerceHandler extends \OctolizeShippingCostOnProductPageVendor\Monolog\Handler\AbstractProcessingHandler
{
    const DEFAULT_WC_SOURCE = 'wpdesk-logger';
    /** @var \WC_Logger_Interface */
    private $wc_logger;
    /** @var string */
    private $channel;
    /**
     * Writes the record down to the log of the implementing handler
     *
     * @param  array $record
     * @return void
     */
    protected function write(array $record)
    {
        $context = \array_merge(['source' => $this->channel], $record['extra'], $record['context']);
        $this->wc_logger->log($this->convertMonologLevelToWC($record['level']), $record['message'], $context);
    }
    /**
     * @param int $level
     * @return string
     */
    private function convertMonologLevelToWC($level)
    {
        return \OctolizeShippingCostOnProductPageVendor\Monolog\Logger::getLevelName($level);
    }
    public function __construct(\WC_Logger_Interface $originalWcLogger, string $channel = self::DEFAULT_WC_SOURCE)
    {
        parent::__construct();
        $this->wc_logger = $originalWcLogger;
        $this->channel = $channel;
    }
}
