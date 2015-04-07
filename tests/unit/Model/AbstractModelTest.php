<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model;


use Symfony\Component\Yaml\Yaml;

/**
 * Class AbstractModelTest
 * @package Sphere\Core\Model
 */
abstract class AbstractModelTest extends \PHPUnit_Framework_TestCase
{
    protected $fixture = 'models.yaml';

    protected $modelFields;

    public function fieldProvider()
    {
        if (is_null($this->modelFields)) {
            $fixturePath = __DIR__ . '/../../fixtures/';
            $this->modelFields = Yaml::parse(file_get_contents($fixturePath . $this->fixture));
        }

        return $this->modelFields;
    }

    protected function getInstance($className)
    {
        $class = new \ReflectionClass($className);
        if (!$class->isAbstract()) {
            $object = $class->newInstanceWithoutConstructor();
        } else {
            $object = $this->getMockForAbstractClass($className, [], '', false);
        }

        return $object;
    }

    protected function getClassName($domain, $model)
    {
        return '\Sphere\Core\Model\\' . ucfirst($domain) . '\\' . ucfirst($model);
    }
}
