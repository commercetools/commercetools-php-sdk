<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Comments\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Comments\Command
 *
 * @method string getAction()
 * @method CommentSetAuthorNameAction setAction(string $action = null)
 * @method string getAuthorName()
 * @method CommentSetAuthorNameAction setAuthorName(string $authorName = null)
 */
class CommentSetAuthorNameAction extends AbstractAction
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
