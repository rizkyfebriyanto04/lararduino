<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NodeMCUController extends Controller
{
    public function receiveData(Request $request)
    {
        $data = $request->input('data');

        // Lakukan apa yang diperlukan dengan data ini (misalnya, simpan ke database)
        // Contoh:
        // $savedData = NodeMCUData::create(['data' => $data]);

        return response()->json(['message' => 'Data received successfully']);
    }
}
