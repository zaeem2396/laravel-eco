<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function products(Request $request)
    {
        // To enable query log
        // DB::enableQueryLog();

        $perPage = $request->input('per_page', 10);
        $page = $request->input('page', 1);
        $min = $request->input('min');
        $max = $request->input('max');

        // Construct the initial SQL query
        $query = "SELECT * FROM products";

        // Add WHERE clauses for filters
        $whereClauses = [];
        if ($min !== null) {
            $whereClauses[] = "prodprice >= '$min'";
        }
        if ($max !== null) {
            $whereClauses[] = "prodprice <= '$max'";
        }

        if (!empty($whereClauses)) {
            $query .= " WHERE " . implode(" AND ", $whereClauses);
        }

        // Calculate the OFFSET
        $offset = ($page - 1) * $perPage;

        // Append the LIMIT and OFFSET clauses for pagination
        $query .= " LIMIT $perPage OFFSET $offset";

        // Execute the raw query
        $pagedData = DB::select($query);

        $totalRecordsOnPage = count($pagedData);

        // To display raw query
        // $rawQuery = DB::getQueryLog()[0]['query'];
        // var_dump($rawQuery);exit;

        // Create the response
        if (empty($pagedData)) {
            return response()->json(['message' => 'No Information available']);
        } else {
            $response = [
                'data' => $pagedData,
                'current_page' => $page,
                'total_record_perPage' => $totalRecordsOnPage
            ];
            return response()->json($response);
        }
    }
}
