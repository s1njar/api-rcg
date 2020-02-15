<?php

namespace Modules\Generator\Services\Generator\Attributes;

use Exception;
use GuzzleHttp\Client;
use Modules\Cards\Entities\Card;
use Modules\Generator\Exceptions\CardGeneratorAttributeException;
use Modules\Generator\Model\CardGeneratorModel;
use Modules\Generator\Services\Generator\AttributeGeneratorInterface;

/**
 * Class NameGeneratorService
 */
class NameGeneratorService implements AttributeGeneratorInterface
{
    public const API_URL = 'https://www.behindthename.com/api/random.json';

    /**
     * List of name categories.
     */
    public const USAGES = [
        'myth',
        'anci',
        'medi',
        'bibl',
        'hist',
        'lite'
    ];

    /**
     * Generates new attribute or uses existing if it's already set.
     *
     * @param CardGeneratorModel $cardGeneratorModel
     * @return mixed
     * @throws CardGeneratorAttributeException
     */
    public function execute(CardGeneratorModel $cardGeneratorModel): CardGeneratorModel
    {
        if ($cardGeneratorModel->getName()) {
            return $cardGeneratorModel;
        }

        $name = '';
        $isAlreadyUsed = true;
        $break = 0;

        while ($isAlreadyUsed) {
            if ($break > 20) {
                throw new CardGeneratorAttributeException(
                    'Seems that name generation went wrong.',
                    500
                );
            }

            $name = $this->getName();
            $isAlreadyUsed = $this->isAlreadyUsed($name);

            if ($isAlreadyUsed) {
                // Wait half second before new request.
                usleep(500000);
            }

            $break++;
        }

        $cardGeneratorModel->setName($name);

        return $cardGeneratorModel;
    }

    /**
     * Makes api get request to behind the name api.
     *
     * @return string
     * @throws CardGeneratorAttributeException
     */
    private function getName()
    {
        $client = new Client();

        try {
            $response = $client->get(
                self::API_URL,
                [
                    'query' => [
                        'key' => 'ja134081294',
                        'gender' => 'm',
                        'number' => rand(1, 2),
                        'usage' => $this->getUsage()
                    ]
                ]
            );

            $name = implode(
                ' ',
                json_decode(
                    $response->getBody()
                )->names
            );
        } catch (Exception $exception) {
            throw new CardGeneratorAttributeException(
                $exception->getMessage(),
                $exception->getCode()
            );
        }

        return $name;
    }

    /**
     * Returns randomly the usage of name.
     *
     * @return string
     */
    private function getUsage(): string
    {
        $randomKey = array_rand(self::USAGES);

        return self::USAGES[$randomKey];
    }

    /**
     * Checks if name is already used for another card.
     *
     * @param string $name
     * @return bool
     */
    private function isAlreadyUsed(string $name): bool
    {
        $card = Card::where('name', '=', $name)->first();

        if ($card !== null) {
            return true;
        }

        return false;
    }
}
