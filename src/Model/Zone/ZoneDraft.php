<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Zone;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\JsonObject;

/**
 * Class ZoneDraft
 * @package Sphere\Core\Model\Zone
 * @method string getName()
 * @method ZoneDraft setName(string $name = null)
 * @method string getDescription()
 * @method ZoneDraft setDescription(string $description = null)
 * @method LocationCollection getLocations()
 * @method ZoneDraft setLocations(LocationCollection $locations = null)
 * @method static ZoneDraft of($name, LocationCollection $locations)
 */
class ZoneDraft extends JsonObject
{
    public function getFields()
    {
        return [
            'name' => [static::TYPE => 'string'],
            'description' => [static::TYPE => 'string'],
            'locations' => [static::TYPE => '\Sphere\Core\Model\Zone\LocationCollection'],
        ];
    }

    /**
     * @param string $name
     * @param LocationCollection $locations
     * @param Context|callable $context
     */
    public function __construct($name, LocationCollection $locations, $context = null)
    {
        $this->setContext($context)->setName($name)->setLocations($locations);
    }

    /**
     * @param array $data
     * @param Context|callable $context
     * @return static
     */
    public static function fromArray(array $data, $context = null)
    {
        $draft = new static(
            $data['name'],
            LocationCollection::fromArray($data['locations'], $context),
            $context
        );
        $draft->setRawData($data);

        return $draft;
    }
}
