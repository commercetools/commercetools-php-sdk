<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Project;


use Sphere\Core\Model\Common\JsonObject;

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
