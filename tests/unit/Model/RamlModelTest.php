<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model;

use Commercetools\Core\Model\Common\JsonObject;
use Symfony\Component\Yaml\Yaml;


class RamlModelTest extends AbstractModelTest
{
    const RAML_MODEL_PATH = __DIR__ . '/../../../../commercetools-api-reference/types/';
    const MODEL_PATH = __DIR__ . '/../../../src/Core/Model';
    const COMMAND_PATH = __DIR__ . '/../../../src/Core/Request';

    public function setUp()
    {
        $this->markTestIncomplete('API reference incomplete');
        parent::setUp();
    }

    /**
     * @dataProvider modelFieldProvider
     * @param string $domain
     * @param string $model
     * @param array $validFields
     */
    public function testModelValidProperties($domain, $model, array $validFields = [])
    {
        $className = $this->getClassName($domain, $model);
        $object = $this->getInstance($className);

        $validFields = array_flip($validFields);
        foreach ($object->fieldDefinitions() as $fieldKey => $field) {
            $this->assertArrayHasKey(
                $fieldKey,
                $validFields,
                sprintf('Failed asserting that \'%s\' is a valid field at \'%s\'', $fieldKey, $className)
            );
        }
    }

    /**
     * @dataProvider modelFieldProvider
     * @param string $domain
     * @param string $model
     * @param array $validFields
     */
    public function testModelPropertiesExist($domain, $model, array $validFields = [])
    {
        $className = $this->getClassName($domain, $model);
        $object = $this->getInstance($className);

        foreach ($validFields as $fieldKey) {
            $this->assertArrayHasKey(
                $fieldKey,
                $object->fieldDefinitions(),
                sprintf('Failed asserting that \'%s\' has a field \'%s\'', $className, $fieldKey)
            );
        }
    }

    /**
     * @dataProvider commandFieldProvider
     * @param string $domain
     * @param string $model
     * @param array $validFields
     */
    public function testCommandValidProperties($domain, $model, array $validFields = [])
    {
        $className = $this->getCommandClass($domain, $model);
        $object = $this->getInstance($className);

        $validFields = array_flip($validFields);
        foreach ($object->fieldDefinitions() as $fieldKey => $field) {
            $this->assertArrayHasKey(
                $fieldKey,
                $validFields,
                sprintf('Failed asserting that \'%s\' is a valid field at \'%s\'', $fieldKey, $className)
            );
        }
    }

    /**
     * @dataProvider commandFieldProvider
     * @param string $domain
     * @param string $model
     * @param array $validFields
     */
    public function testCommandPropertiesExist($domain, $model, array $validFields = [])
    {
        $className = $this->getCommandClass($domain, $model);
        $object = $this->getInstance($className);

        foreach ($validFields as $fieldKey) {
            $this->assertArrayHasKey(
                $fieldKey,
                $object->fieldDefinitions(),
                sprintf('Failed asserting that \'%s\' has a field \'%s\'', $className, $fieldKey)
            );
        }
    }

    protected function getCommandClass($domain, $model)
    {
        return 'Commercetools\\Core\\Request\\' . ucfirst($domain) . 's\\Command\\' . ucfirst($model);
    }

    public function modelFieldProvider()
    {
        return $this->objectFieldProvider(static::MODEL_PATH);
    }

    public function commandFieldProvider()
    {
        return $this->objectFieldProvider(static::COMMAND_PATH, 'getCommandClass');
    }

    public function objectFieldProvider($searchPath, $classNameBuilder = 'getClassName') {
        $ramlTypesFile = static::RAML_MODEL_PATH . 'types.raml';
        if (!file_exists($ramlTypesFile)) {
            return [];
        }
        $allFiles = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($searchPath));
        $phpFiles = new \RegexIterator($allFiles, '/\.php$/');

        $modelClasses = [];
        foreach ($phpFiles as $phpFile) {
            $class = $this->getFileClassName($phpFile->getRealPath());
            if (strpos($class, 'Core\\Helper') > 0) {
                continue;
            }

            if (!empty($class)) {
                if (in_array(JsonObject::class, class_parents($class))) {
                    $modelClasses[$class] = $class;
                }
            }
        }

        $types = Yaml::parse(file_get_contents($ramlTypesFile));

        $ramlTypes = [];
        foreach ($types as $typeName => $typeFile) {
            $ramlFile = trim(str_replace('!include', '', $typeFile));
            $ramlType = Yaml::parse(file_get_contents(static::RAML_MODEL_PATH . $ramlFile));

            if (isset($ramlType['properties']) || isset($ramlType['type'])) {
                $ramlTypes[$typeName] = $ramlType;
            }
        }

        $ramlInfos = [];
        foreach ($ramlTypes as $typeName => $ramlType) {
            $ramlFile = trim(str_replace('!include', '', $types[$typeName]));
            $package = $this->pascalcase(dirname($ramlFile));
            $ramlInfos[$typeName] = [
                'domain' => $package,
                'model' => $typeName,
                'fields' => $this->resolveProperties($ramlTypes, $ramlType)
            ];
        }

        $fixtures = array_filter(
            $ramlInfos,
            function ($fixture) use ($modelClasses, $classNameBuilder) {
                $className = $this->$classNameBuilder($fixture['domain'], $fixture['model']);
                return class_exists($className) && isset($modelClasses[$className]);
            }
        );
        return $fixtures;
    }

    private function resolveProperties($ramlTypes, $ramlType)
    {
        if (isset($ramlType['type'])) {
            $parentType = isset($ramlTypes[$ramlType['type']]) ? $ramlTypes[$ramlType['type']] : [];
            $parentProperties = $this->resolveProperties($ramlTypes, $parentType);
        } else {
            $parentProperties = [];
        }
        if (isset($ramlType['properties'])) {
            $properties = array_map(
                function ($property) {
                    return str_replace('?', '', $property);
                },
                array_keys($ramlType['properties'])
            );
        } else {
            $properties = [];
        }
        return array_merge($parentProperties, $properties);
    }

    private function getFileClassName($fileName)
    {
        $content = file_get_contents($fileName);
        $tokens = token_get_all($content);
        $namespace = '';
        for ($index = 0; isset($tokens[$index]); $index++) {
            if (!isset($tokens[$index][0])) {
                continue;
            }
            if (T_NAMESPACE === $tokens[$index][0]) {
                $index += 2; // Skip namespace keyword and whitespace
                while (isset($tokens[$index]) && is_array($tokens[$index])) {
                    $namespace .= $tokens[$index++][1];
                }
            }
            if (T_CLASS === $tokens[$index][0]) {
                $index += 2; // Skip class keyword and whitespace
                $class = $namespace.'\\'.$tokens[$index][1];
                return $class;
            }
        }

        return null;
    }

    protected function pascalcase($scored)
    {
        return ucfirst(
            implode(
                '',
                array_map(
                    'ucfirst',
                    array_map(
                        'strtolower',
                        explode('-', $scored)
                    )
                )
            )
        );
    }
}
