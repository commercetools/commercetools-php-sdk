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
 * @method CommentSetTitleAction setAction(string $action = null)
 * @method string getTitle()
 * @method CommentSetTitleAction setTitle(string $title = null)
 */
class CommentSetTitleAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'title' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setTitle');
    }
}
