<?php

namespace Modules\Generator\Services\Generator;

use Modules\Generator\Model\CardGeneratorModel;

/**
 * Interface AttributeGeneratorInterface
 */
interface AttributeGeneratorInterface
{
    /**
     * Generates new attribute or uses existing if it's already set.
     *
     * @param CardGeneratorModel $cardGeneratorModel
     * @return mixed
     */
    public function execute(CardGeneratorModel $cardGeneratorModel): CardGeneratorModel;
}
