<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Categories\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Categories\Command
 * @apidoc http://dev.sphere.io/http-api-projects-categories.html#set-meta-description
 * @method string getAction()
 * @method CategorySetMetaDescriptionAction setAction(string $action = null)
 * @method LocalizedString getMetaDescription()
 * @method CategorySetMetaDescriptionAction setMetaDescription(LocalizedString $metaDescription = null)
 */
class CategorySetMetaDescriptionAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'metaDescription' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setMetaDescription');
    }
}
