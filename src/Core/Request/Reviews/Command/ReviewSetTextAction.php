<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Reviews\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Reviews\Command
 * @link https://docs.commercetools.com/http-api-projects-reviews.html#set-text
 * @method string getAction()
 * @method ReviewSetTextAction setAction(string $action = null)
 * @method string getText()
 * @method ReviewSetTextAction setText(string $text = null)
 */
class ReviewSetTextAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'text' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setText');
    }
}
