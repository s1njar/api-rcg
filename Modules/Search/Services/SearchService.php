<?php

namespace Modules\Search\Services;

use Exception;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Modules\Search\Exception\SearchQueryException;
use Modules\Search\Model\SearchModel;

/**
 * Class SearchService
 */
class SearchService
{
    /**
     * @var Builder
     */
    private $searchBuilder;

    /**
     * Throws exception if table or pagination is missing.
     *
     * @param SearchModel $searchModel
     * @return JsonResponse
     * @throws Exception
     */
    public function execute(SearchModel $searchModel): JsonResponse
    {
        if (!$searchModel->getTable() || !$searchModel->getPagination()) {
            throw new Exception(
                'There is no table or pagination in search request defined.',
                500
            );
        }

        return $this->build($searchModel);
    }

    /**
     * Builds request in searchBuilder.
     *
     * @param SearchModel $searchModel
     * @return JsonResponse
     * @throws SearchQueryException
     */
    private function build(SearchModel $searchModel): JsonResponse
    {
        $this->searchBuilder = DB::table($searchModel->getTable());
        $filters = $searchModel->getFilters() ?: [];
        $orders = $searchModel->getOrders() ?: [];
        $pagination = $searchModel->getPagination();

        if ($term = $searchModel->getTerm()) {
            $this->addFilter('name', 'like', '%' . $term . '%');
        }

        foreach ($filters as $filter) {
            $this->addFilter(
                $filter['field'],
                $filter['operator'],
                $filter['value']
            );
        }

        foreach ($orders as $order) {
            $this->addOrder(
                $order['field'],
                $order['direction']
            );
        }

        return response()->json(
            [
                'data' => $this->search($pagination)
            ]
        );
    }

    /**
     * Searchs with built request.
     *
     * @param int $pagination
     * @return Paginator
     * @throws SearchQueryException
     */
    private function search(int $pagination): Paginator
    {
        try {
            $response = $this->searchBuilder->simplePaginate($pagination);
        } catch (QueryException $queryException) {
            throw new SearchQueryException(
                $queryException->getMessage(),
                500
            );
        }

        return $response;
    }

    /**
     * Adds new filter to searchBuilder.
     *
     * @param string $field
     * @param string $operator
     * @param mixed $value
     * @return void
     */
    private function addFilter(string $field, string $operator, $value): void
    {
        $this->searchBuilder
            ->where(
                $field,
                $operator,
                $value
            );
    }

    /**
     * Adds new order to searchBuilder.
     *
     * @param string $field
     * @param string $direction
     * @return void
     */
    private function addOrder(string $field, string $direction): void
    {
        $this->searchBuilder
            ->orderBy(
                $field,
                $direction
            );
    }
}
