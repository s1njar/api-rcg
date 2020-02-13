<?php

namespace Modules\Generator\Services\Generator\Attributes;

use Modules\Generator\Model\CardGeneratorModel;
use Modules\Generator\Services\Generator\AttributeGeneratorInterface;

/**
 * Class CodeGeneratorService
 */
class CodeGeneratorService implements AttributeGeneratorInterface
{
    /**
     * Generates new attribute or uses existing if it's already set.
     *
     * @param CardGeneratorModel $cardGeneratorModel
     * @return mixed
     */
    public function execute(CardGeneratorModel $cardGeneratorModel): CardGeneratorModel
    {
        if ($cardGeneratorModel->getCode()) {
            return $cardGeneratorModel;
        }

        $name = $cardGeneratorModel->getName();

        $cardGeneratorModel->setCode($this->getCodeByName($name));

        return $cardGeneratorModel;
    }

    /**
     * Takes name and converts it to code.
     *
     * @param string $name
     * @return string
     */
    private function getCodeByName(string $name): string
    {
        return strtolower(
            trim(
                preg_replace(
                    '/[^A-Za-z0-9-]+/',
                    '_',
                    $name
                )
            )
        );
    }
}
