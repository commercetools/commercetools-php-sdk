<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Project;

use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\Collection;
use Sphere\Core\Model\Common\DateTimeDecorator;

/**
 * Class Project
 * @package Sphere\Core\Model\Project
 * 
 * @method string getKey()
 * @method Project setKey(string $key = null)
 * @method string getName()
 * @method Project setName(string $name = null)
 * @method Collection getCountries()
 * @method Project setCountries(Collection $countries = null)
 * @method Collection getCurrencies()
 * @method Project setCurrencies(Collection $currencies = null)
 * @method Collection getLanguages()
 * @method Project setLanguages(Collection $languages = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method Project setCreatedAt(\DateTime $createdAt = null)
 * @method DateTimeDecorator getTrialUntil()
 * @method Project setTrialUntil(\DateTime $trialUntil = null)
 */
class Project extends JsonObject
{
    public function getFields()
    {
        return [
            'key' => [static::TYPE => 'string'],
            'name' => [static::TYPE => 'string'],
            'countries' => [static::TYPE => '\Sphere\Core\Model\Common\Collection'],
            'currencies' => [static::TYPE => '\Sphere\Core\Model\Common\Collection'],
            'languages' => [static::TYPE => '\Sphere\Core\Model\Common\Collection'],
            'createdAt' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Sphere\Core\Model\Common\DateTimeDecorator'
            ],
            'trialUntil' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Sphere\Core\Model\Common\DateTimeDecorator'
            ],
        ];
    }
}
