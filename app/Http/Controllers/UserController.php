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
            // Request ke API lain
            $response = Http::get('https://ogienurdiana.com/career/ecc694ce4e7f6e45a5a7912cde9fe131');

            // Cek apakah request berhasil
            if ($response->successful()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $response->json()
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to fetch data'
                ], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Exception: ' . $e->getMessage()
            ], 500);
        }
    }

    //search by name
    public function getByName(){

    }
    
    //search by nim
    public function getByNim(){

    }

    //filtering by date
    public function getByDate(){

    }
}
