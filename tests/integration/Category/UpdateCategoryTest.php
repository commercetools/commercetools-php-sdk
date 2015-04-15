<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Category;


use Sphere\Core\ApiTestCase;
use Sphere\Core\Model\Category\Category;
use Sphere\Core\Model\Category\CategoryDraft;
use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Request\Categories\CategoriesQueryRequest;
use Sphere\Core\Request\Categories\CategoryCreateRequest;
use Sphere\Core\Request\Categories\CategoryDeleteByIdRequest;
use Sphere\Core\Request\Categories\CategoryUpdateRequest;
use Sphere\Core\Request\Categories\Command\CategoryChangeNameAction;

class UpdateCategoryTest extends ApiTestCase
{
    protected function cleanup()
    {
        $items = $this->getClient()->execute(CategoriesQueryRequest::of())->toObject();

        foreach ($items as $item) {
            $this->getClient()->addBatchRequest(CategoryDeleteByIdRequest::of($item->getId(), $item->getVersion()));
        }
        $this->getClient()->executeBatch();
    }

    /**
     * @param $name
     * @param $slug
     * @return CategoryDraft
     */
    protected function getDraft($name, $slug)
    {
        $draft = CategoryDraft::of(
            LocalizedString::of(['en' => $name]),
            LocalizedString::of(['en' => $slug])
        );

        return $draft;
    }

    public function testUpdateName()
    {
        /**
         * @var Category $category
         */
        $category = $this->getClient()
            ->execute(CategoryCreateRequest::of($this->getDraft('update name', 'update-name')))
            ->toObject();

        $result = $this->getClient()->execute(
            CategoryUpdateRequest::of(
                $category->getId(),
                $category->getVersion(),
                [
                    CategoryChangeNameAction::of(LocalizedString::of(['en' => 'new name']))
                ]
            )
        )->toObject();

        $this->assertInstanceOf('\Sphere\Core\Model\Category\Category', $result);
        $this->assertSame('new name', $result->getName()->en);
    }
}
