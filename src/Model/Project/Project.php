<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Project;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\Collection;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Message\MessagesConfiguration;

/**
 * @package Commercetools\Core\Model\Project
 * @link https://dev.commercetools.com/http-api-projects-project.html#project
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
 * @method MessagesConfiguration getMessages()
 * @method Project setMessages(MessagesConfiguration $messages = null)
 */
class Project extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'key' => [static::TYPE => 'string'],
            'name' => [static::TYPE => 'string'],
            'countries' => [static::TYPE => '\Commercetools\Core\Model\Common\Collection'],
            'currencies' => [static::TYPE => '\Commercetools\Core\Model\Common\Collection'],
            'languages' => [static::TYPE => '\Commercetools\Core\Model\Common\Collection'],
            'createdAt' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'trialUntil' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'messages' => [static::TYPE => '\Commercetools\Core\Model\Message\MessagesConfiguration']
        ];
    }
}
