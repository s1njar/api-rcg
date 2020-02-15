<?php

namespace Modules\Search\Model;

/**
 * Class SearchModel
 */
class SearchModel
{
    /** @var string */
    private $table;
    /** @var string */
    private $term;
    /** @var int */
    private $pagination;
    /** @var array */
    private $filters;
    /** @var array */
    private $orders;

    /**
     * @param string $field
     * @param string $operator
     * @param int $value
     * @return SearchModel
     */
    public function addFilter(string $field, string $operator, int $value): SearchModel
    {
        $this->filters[] = [
            'field' => $field,
            'operator' => $operator,
            'value' => $value
        ];

        return $this;
    }

    /**
     * @param string $field
     * @param string $direction
     * @return SearchModel
     */
    public function addOrder(string $field, string $direction): SearchModel
    {
        $this->orders[] = [
            'field' => $field,
            'direction' => $direction
        ];

        return $this;
    }

    /**
     * @param string $table
     * @return SearchModel
     */
    public function setTable(string $table): SearchModel
    {
        $this->table = $table;
        return $this;
    }

    /**
     * @param string $term
     * @return SearchModel
     */
    public function setTerm(string $term): SearchModel
    {
        $this->term = $term;
        return $this;
    }

    /**
     * @param int $pagination
     * @return SearchModel
     */
    public function setPagination(int $pagination): SearchModel
    {
        $this->pagination = $pagination;
        return $this;
    }

    /**
     * @return string
     */
    public function getTable(): ?string
    {
        return $this->table;
    }

    /**
     * @return string
     */
    public function getTerm(): ?string
    {
        return $this->term;
    }

    /**
     * @return int
     */
    public function getPagination(): ?int
    {
        return $this->pagination;
    }

    /**
     * @return array
     */
    public function getFilters(): ?array
    {
        return $this->filters;
    }

    /**
     * @return array
     */
    public function getOrders(): ?array
    {
        return $this->orders;
    }
}
