<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Helper\Annotate;

class AnnotationGenerator
{
    /**
     * @var \ReflectionClass
     */
    protected $reflectionClass;
    protected $newDocBlock;
    protected $fields;
    protected $fieldNames;
    protected $includes;
    protected $uses;

    public function run($path)
    {
        $allFiles = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
        $phpFiles = new \RegexIterator($allFiles, '/\.php$/');

        $this->analyzeFiles($phpFiles);
    }

    protected function analyzeFiles(\RegexIterator $phpFiles)
    {
        $jsonObjects = $this->getJsonObjects($phpFiles);

        foreach ($jsonObjects as $jsonObject) {
            $annotator = new ClassAnnotator($jsonObject);

            $annotator->generate();
        }

        $traitObjects = $this->getOfTraitObjects($phpFiles);

        foreach ($traitObjects as $traitObject) {
            $annotator = new ClassAnnotator($traitObject);

            $annotator->generateOfMethod();
        }
    }

    protected function getJsonObjects(\RegexIterator $phpFiles)
    {
        $jsonObjects = [];
        foreach ($phpFiles as $phpFile) {
            $class = $this->getClassName($phpFile->getRealPath());

            if (!empty($class)) {
                if (in_array('Sphere\Core\Model\Common\JsonObject', class_parents($class))) {
                    $jsonObjects[] = $class;
                }
            }
        }

        return $jsonObjects;
    }

    protected function getOfTraitObjects(\RegexIterator $phpFiles)
    {
        $traitObjects = [];
        foreach ($phpFiles as $phpFile) {
            $class = $this->getClassName($phpFile->getRealPath());

            if (!empty($class)) {
                if (in_array('Sphere\Core\Model\Common\OfTrait', class_uses($class))) {
                    $traitObjects[] = $class;
                }
            }
        }

        return $traitObjects;
    }

    protected function getClassName($fileName)
    {
        $tokens = $this->tokenize($fileName);
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

    protected function tokenize($fileName)
    {
        $content = file_get_contents($fileName);
        return token_get_all($content);
    }
}
