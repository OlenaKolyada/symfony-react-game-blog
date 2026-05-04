<?php

namespace App\Trait;

use Symfony\Component\HttpFoundation\Request;

trait PaginationTrait
{
    protected function preparePaginationCriteria(Request $request): array
    {
        $statusParam = $request->query->get('status', 'Published');
        $page = max(1, (int)$request->query->get('page', 1));
        $limit = min(50, max(1, (int)$request->query->get('limit', 9)));

        $criteria = [];
        if ($statusParam) {
            $criteria['status'] = $statusParam;
        }

        return [
            'criteria' => $criteria,
            'page' => $page,
            'limit' => $limit
        ];
    }
}
