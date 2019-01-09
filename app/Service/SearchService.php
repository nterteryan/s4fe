<?php
namespace App\Service;

class SearchService
{
    public function searchItems($query, $filters)
    {
        $result = \DB::select("CALL search_items_procedure(?, ?)", [
                \DB::connection()->getPdo()->quote($query),
                $filters?\DB::connection()->getPdo()->quote($filters):$filters,
            ]);
        return $result;
    }
}