<?php

namespace App\Http\Controllers;

use App\Models\User;
use Http;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getAll()
    {
        try {
            $request = Http::get('https://ogienurdiana.com/career/ecc694ce4e7f6e45a5a7912cde9fe131');

            if ($request->successful()) {

                $get = $request->json();
                $getData = $get['DATA'];

                $rows = explode("\n", $getData);
                $response = [];

                foreach (array_slice($rows, 1) as $row) {
                    $columns = explode("|", $row);

                    if (count($columns) === 3) {
                        $response[] = [
                            'date' => $columns[0],
                            'name' => $columns[1],
                            'nim' => $columns[2],
                        ];
                    }
                }

                return response()->json([
                    'status' => 'success',
                    'data' => $response
                ], 200);

            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to fetch data'
                ], $request->status());
            }

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Exception: ' . $e->getMessage()
            ], 500);
        }
    }

    //Search By NAME
    public function getByName(Request $request)
    {
        $nameQuery = $request->query('name');

        if (!$nameQuery) {
            return response()->json([
                'status' => 'error',
                'message' => 'Query parameter "name" is required'
            ], 400);
        }

        $allDataResponse = $this->getAll();

        $allData = json_decode($allDataResponse->getContent(), true);

        if (!isset($allData['data']) || empty($allData['data'])) {
            return response()->json([
                'status' => 'error',
                'message' => 'No data available'
            ], 404);
        }

        $filteredData = array_filter($allData['data'], function ($student) use ($nameQuery) {
            return stripos($student['name'], $nameQuery) !== false;
        });

        if (empty($filteredData)) {
            return response()->json([
                'status' => 'error',
                'message' => 'No matching data found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => array_values($filteredData)
        ], 200);
    }

    //Search by NIM
    public function getByNim(Request $request)
    {
        $nimQuery = $request->query('nim');

        if (!$nimQuery) {
            return response()->json([
                'status' => 'error',
                'message' => 'Query parameter "nim" is required'
            ], 400);
        }

        $allDataResponse = $this->getAll();

        $allData = json_decode($allDataResponse->getContent(), true);

        if (!isset($allData['data']) || empty($allData['data'])) {
            return response()->json([
                'status' => 'error',
                'message' => 'No data available'
            ], 404);
        }

        $filteredData = array_filter($allData['data'], function ($student) use ($nimQuery) {
            return stripos($student['nim'], $nimQuery) !== false;
        });

        if (empty($filteredData)) {
            return response()->json([
                'status' => 'error',
                'message' => 'No matching data found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => array_values($filteredData)
        ], 200);
    }

    //Date filtering
    public function getByDate(Request $request)
    {
        $dateQuery = $request->query('date');

        if (!$dateQuery) {
            return response()->json([
                'status' => 'error',
                'message' => 'Query parameter "date" is required'
            ], 400);
        }

        $allDataResponse = $this->getAll();

        $allData = json_decode($allDataResponse->getContent(), true);

        if (!isset($allData['data']) || empty($allData['data'])) {
            return response()->json([
                'status' => 'error',
                'message' => 'No data available'
            ], 404);
        }

        $filteredData = array_filter($allData['data'], function ($student) use ($dateQuery) {
            return stripos($student['date'], $dateQuery) !== false;
        });

        if (empty($filteredData)) {
            return response()->json([
                'status' => 'error',
                'message' => 'No matching data found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => array_values($filteredData)
        ], 200);
    }
}
