<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Reviews\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Reviews\Command
 * @link https://docs.commercetools.com/http-api-projects-reviews.html#set-author-name
 * @method string getAction()
 * @method ReviewSetAuthorNameAction setAction(string $action = null)
 * @method string getAuthorName()
 * @method ReviewSetAuthorNameAction setAuthorName(string $authorName = null)
 */
class ReviewSetAuthorNameAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'authorName' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setAuthorName');
    }
}
