<?php

namespace Modules\Generator\Model;

/**
 * Class CardGenerator
 */
class CardGeneratorModel
{
    /** @var string */
    private $name;

    /** @var string */
    private $code;

    /** @var int */
    private $life;

    /** @var int */
    private $moral;

    /** @var array */
    private $abilities;

    /** @var int */
    private $strength;

    /** @var int */
    private $speed;

    /** @var int */
    private $range;

    /** @var string */
    private $picture;

    /** @var int */
    private $category;

    /** @var int */
    private $cardType;

    /** @var int */
    private $rarity;

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return int
     */
    public function getLife(): ?int
    {
        return $this->life;
    }

    /**
     * @param int $life
     */
    public function setLife(int $life): void
    {
        $this->life = $life;
    }

    /**
     * @return int
     */
    public function getMoral(): ?int
    {
        return $this->moral;
    }

    /**
     * @param int $moral
     */
    public function setMoral(int $moral): void
    {
        $this->moral = $moral;
    }

    /**
     * @return array
     */
    public function getAbilities(): ?array
    {
        return $this->abilities;
    }

    /**
     * @param array $abilities
     */
    public function setAbilities(array $abilities): void
    {
        $this->abilities = $abilities;
    }

    /**
     * @return int
     */
    public function getStrength(): ?int
    {
        return $this->strength;
    }

    /**
     * @param int $strength
     */
    public function setStrength(int $strength): void
    {
        $this->strength = $strength;
    }

    /**
     * @return int
     */
    public function getSpeed(): ?int
    {
        return $this->speed;
    }

    /**
     * @param int $speed
     */
    public function setSpeed(int $speed): void
    {
        $this->speed = $speed;
    }

    /**
     * @return int
     */
    public function getRange(): ?int
    {
        return $this->range;
    }

    /**
     * @param int $range
     */
    public function setRange(int $range): void
    {
        $this->range = $range;
    }

    /**
     * @return string
     */
    public function getPicture(): ?string
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     */
    public function setPicture(string $picture): void
    {
        $this->picture = $picture;
    }

    /**
     * @return int
     */
    public function getCategory(): ?int
    {
        return $this->category;
    }

    /**
     * @param int $category
     */
    public function setCategory(int $category): void
    {
        $this->category = $category;
    }

    /**
     * @return int
     */
    public function getCardType(): ?int
    {
        return $this->cardType;
    }

    /**
     * @param int $cardType
     */
    public function setCardType(int $cardType): void
    {
        $this->cardType = $cardType;
    }

    /**
     * @return int
     */
    public function getRarity(): ?int
    {
        return $this->rarity;
    }

    /**
     * @param int $rarity
     */
    public function setRarity(int $rarity): void
    {
        $this->rarity = $rarity;
    }

}