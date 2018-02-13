<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Project;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\Collection;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Message\MessagesConfiguration;
use DateTime;

/**
 * @package Commercetools\Core\Model\Project
 * @link https://docs.commercetools.com/http-api-projects-project.html#project
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
 * @method Project setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getTrialUntil()
 * @method Project setTrialUntil(DateTime $trialUntil = null)
 * @method MessagesConfiguration getMessages()
 * @method Project setMessages(MessagesConfiguration $messages = null)
 * @method int getVersion()
 * @method Project setVersion(int $version = null)
 */
class Project extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'version' => [static::TYPE => 'int'],
            'key' => [static::TYPE => 'string'],
            'name' => [static::TYPE => 'string'],
            'countries' => [static::TYPE => Collection::class],
            'currencies' => [static::TYPE => Collection::class],
            'languages' => [static::TYPE => Collection::class],
            'createdAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'trialUntil' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'messages' => [static::TYPE => MessagesConfiguration::class]
        ];
    }
}
