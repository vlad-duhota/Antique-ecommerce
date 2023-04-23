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

use OctolizeShippingCostOnProductPageVendor\Monolog\Logger;
use OctolizeShippingCostOnProductPageVendor\Monolog\Formatter\NormalizerFormatter;
/**
 * Logs to a MongoDB database.
 *
 * usage example:
 *
 *   $log = new Logger('application');
 *   $mongodb = new MongoDBHandler(new \Mongo("mongodb://localhost:27017"), "logs", "prod");
 *   $log->pushHandler($mongodb);
 *
 * @author Thomas Tourlourat <thomas@tourlourat.com>
 */
class MongoDBHandler extends \OctolizeShippingCostOnProductPageVendor\Monolog\Handler\AbstractProcessingHandler
{
    protected $mongoCollection;
    public function __construct($mongo, $database, $collection, $level = \OctolizeShippingCostOnProductPageVendor\Monolog\Logger::DEBUG, $bubble = \true)
    {
        if (!($mongo instanceof \MongoClient || $mongo instanceof \Mongo || $mongo instanceof \OctolizeShippingCostOnProductPageVendor\MongoDB\Client)) {
            throw new \InvalidArgumentException('MongoClient, Mongo or MongoDB\\Client instance required');
        }
        $this->mongoCollection = $mongo->selectCollection($database, $collection);
        parent::__construct($level, $bubble);
    }
    protected function write(array $record)
    {
        if ($this->mongoCollection instanceof \OctolizeShippingCostOnProductPageVendor\MongoDB\Collection) {
            $this->mongoCollection->insertOne($record["formatted"]);
        } else {
            $this->mongoCollection->save($record["formatted"]);
        }
    }
    /**
     * {@inheritDoc}
     */
    protected function getDefaultFormatter()
    {
        return new \OctolizeShippingCostOnProductPageVendor\Monolog\Formatter\NormalizerFormatter();
    }
}
