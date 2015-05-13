<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Channel;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\OfTrait;
use Sphere\Core\Model\Common\LocalizedString;

/**
 * Class ChannelDraft
 * @package Sphere\Core\Model\Channel
 * @method string getKey()
 * @method ChannelDraft setKey(string $key = null)
 * @method array getRoles()
 * @method ChannelDraft setRoles(array $roles = null)
 * @method LocalizedString getName()
 * @method ChannelDraft setName(LocalizedString $name = null)
 * @method LocalizedString getDescription()
 * @method ChannelDraft setDescription(LocalizedString $description = null)
 */
class ChannelDraft extends JsonObject
{
    use OfTrait;

    public function getFields()
    {
        return [
            'key' => [static::TYPE => 'string'],
            'roles' => [static::TYPE => 'array'],
            'name' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'description' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
        ];
    }

    /**
     * @param string $key
     * @param Context|callable $context
     */
    public function __construct($key, $context = null)
    {
        $this->setContext($context)->setKey($key);
    }

    /**
     * @param array $data
     * @param Context|callable $context
     * @return static
     */
    public static function fromArray(array $data, $context = null)
    {
        $draft = new static(
            $data['key']
        );
        $draft->setRawData($data);

        return $draft;
    }
}
