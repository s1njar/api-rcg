<?php

namespace Modules\Search\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Search\Helper\SearchHelper;
use Modules\Search\Services\SearchService;

/**
 * Class SearchController
 */
class SearchController extends Controller
{
    /**
     * @var SearchService
     */
    private $searchService;
    /**
     * @var SearchHelper
     */
    private $searchHelper;

    /**
     * SearchController constructor.
     *
     * @param SearchService $searchService
     * @param SearchHelper $searchHelper
     */
    public function __construct(
        SearchService $searchService,
        SearchHelper $searchHelper
    ) {
//        $this->middleware('auth:api');

        $this->searchService = $searchService;
        $this->searchHelper = $searchHelper;
    }

    /**
     * Card search endpoint.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function searchCards(Request $request): JsonResponse
    {
        $request->validate([
            'query' => 'required|array'
        ]);

        $table = 'cards';
        $query = $request->get('query');

        $searchModel = $this->searchHelper->getSearchModelByQuery($table, $query);

        return $this->searchService->execute($searchModel);
    }
}
