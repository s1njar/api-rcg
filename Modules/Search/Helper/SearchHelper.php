<?php

namespace Modules\Search\Helper;

use ErrorException;
use Modules\Search\Exception\SearchQueryException;
use Modules\Search\Model\SearchModel;

/**
 * Class SearchHelper
 */
class SearchHelper
{
    /**
     * Takes query and builds a new searchModel out of it.
     *
     * @param string $table
     * @param array $query
     * @return SearchModel
     * @throws SearchQueryException
     */
    public function getSearchModelByQuery(string $table, array $query): SearchModel
    {
        $searchModel = new SearchModel();

        try {
            $term = $query['term'] ?: '';
            $pagination = $query['pagination'] ?: 0;

            $searchModel->setTable($table);
            $searchModel->setTerm($term);
            $searchModel->setPagination($pagination);

            if (!is_array($filters = $query['filters'])) {
                $filters = [];
            }

            if (!is_array($orders = $query['orders'])) {
                $orders = [];
            }

            foreach ($filters as $filter) {
                $searchModel->addFilter(
                    $filter['field'],
                    $filter['operator'],
                    $filter['value']
                );
            }

            foreach ($orders as $order) {
                $searchModel->addOrder(
                    $order['field'],
                    $order['direction']
                );
            }

        } catch (ErrorException $errorException) {
            throw new SearchQueryException(
                'Seems that the structure of the query is wrong or some filter/order sub-fields are missing.',
                $errorException->getCode()
            );
        }

        return $searchModel;
    }
}
