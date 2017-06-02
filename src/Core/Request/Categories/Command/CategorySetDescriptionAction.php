<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Categories\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Categories\Command
 * @link https://dev.commercetools.com/http-api-projects-categories.html#set-description
 * @method LocalizedString getDescription()
 * @method CategorySetDescriptionAction setDescription(LocalizedString $description = null)
 * @method string getAction()
 * @method CategorySetDescriptionAction setAction(string $action = null)
 */
class CategorySetDescriptionAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'description' => [static::TYPE => LocalizedString::class]
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

    /**
     * @param LocalizedString $description
     * @param Context|callable $context
     * @return CategorySetDescriptionAction
     */
    public static function ofDescription(LocalizedString $description, $context = null)
    {
        return static::of($context)->setDescription($description);
    }
}
