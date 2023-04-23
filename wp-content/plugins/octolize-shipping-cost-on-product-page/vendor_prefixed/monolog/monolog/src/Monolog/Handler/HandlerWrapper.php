<?php

/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace OctolizeShippingCostOnProductPageVendor\Monolog\Handler;

use OctolizeShippingCostOnProductPageVendor\Monolog\ResettableInterface;
use OctolizeShippingCostOnProductPageVendor\Monolog\Formatter\FormatterInterface;
/**
 * This simple wrapper class can be used to extend handlers functionality.
 *
 * Example: A custom filtering that can be applied to any handler.
 *
 * Inherit from this class and override handle() like this:
 *
 *   public function handle(array $record)
 *   {
 *        if ($record meets certain conditions) {
 *            return false;
 *        }
 *        return $this->handler->handle($record);
 *   }
 *
 * @author Alexey Karapetov <alexey@karapetov.com>
 */
class HandlerWrapper implements \OctolizeShippingCostOnProductPageVendor\Monolog\Handler\HandlerInterface, \OctolizeShippingCostOnProductPageVendor\Monolog\ResettableInterface
{
    /**
     * @var HandlerInterface
     */
    protected $handler;
    /**
     * HandlerWrapper constructor.
     * @param HandlerInterface $handler
     */
    public function __construct(\OctolizeShippingCostOnProductPageVendor\Monolog\Handler\HandlerInterface $handler)
    {
        $this->handler = $handler;
    }
    /**
     * {@inheritdoc}
     */
    public function isHandling(array $record)
    {
        return $this->handler->isHandling($record);
    }
    /**
     * {@inheritdoc}
     */
    public function handle(array $record)
    {
        return $this->handler->handle($record);
    }
    /**
     * {@inheritdoc}
     */
    public function handleBatch(array $records)
    {
        return $this->handler->handleBatch($records);
    }
    /**
     * {@inheritdoc}
     */
    public function pushProcessor($callback)
    {
        $this->handler->pushProcessor($callback);
        return $this;
    }
    /**
     * {@inheritdoc}
     */
    public function popProcessor()
    {
        return $this->handler->popProcessor();
    }
    /**
     * {@inheritdoc}
     */
    public function setFormatter(\OctolizeShippingCostOnProductPageVendor\Monolog\Formatter\FormatterInterface $formatter)
    {
        $this->handler->setFormatter($formatter);
        return $this;
    }
    /**
     * {@inheritdoc}
     */
    public function getFormatter()
    {
        return $this->handler->getFormatter();
    }
    public function reset()
    {
        if ($this->handler instanceof \OctolizeShippingCostOnProductPageVendor\Monolog\ResettableInterface) {
            return $this->handler->reset();
        }
    }
}
