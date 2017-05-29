<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\TaxCategories\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\TaxCategories\Command
 * @link https://dev.commercetools.com/http-api-projects-taxCategories.html#set-description
 * @method string getAction()
 * @method TaxCategorySetDescriptionAction setAction(string $action = null)
 * @method string getDescription()
 * @method TaxCategorySetDescriptionAction setDescription(string $description = null)
 */
class TaxCategorySetDescriptionAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'description' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setDescription');
    }
}
