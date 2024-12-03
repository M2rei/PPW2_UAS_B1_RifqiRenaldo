<?php

namespace App\Http\Controllers;

use App\Models\Transaksi; // Import the model if you're fetching data from the database

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch the transaction count
        $transaksi_count = Transaksi::count(); // Replace this with your logic to get the count

        // Optionally, fetch other data
        $item_count = 0; // Add your actual logic here
        $omzet = 0; // Add your actual logic here

        // Pass the data to the view
        return view('dashboard', compact('transaksi_count', 'item_count', 'omzet'));
    }
}
