<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Categories\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Categories\Command
 * @apidoc http://dev.sphere.io/http-api-projects-categories.html#set-external-id
 * @method string getExternalId()
 * @method CategorySetExternalIdAction setExternalId(string $externalId = null)
 * @method string getAction()
 * @method CategorySetExternalIdAction setAction(string $action = null)
 */
class CategorySetExternalIdAction extends AbstractAction
{
    public function getPropertyDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'externalId' => [static::TYPE => 'string']
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setExternalId');
    }

    /**
     * @param string $externalId
     * @param Context|callable $context
     * @return CategorySetExternalIdAction
     */
    public static function ofExternalId($externalId, $context = null)
    {
        return static::of($context)->setExternalId($externalId);
    }
}
