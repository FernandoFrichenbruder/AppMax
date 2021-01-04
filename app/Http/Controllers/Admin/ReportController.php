<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataNew = \App\Models\ProductHistory::newProducts();
        $dataAdded = \App\Models\ProductHistory::addedProducts();
        $dataReducted = \App\Models\ProductHistory::reductedProducts();

        $lowStock = \App\Models\ProductHistory::lowStock();

        return view('admin.reports.index', compact('dataNew', 'dataAdded', 'dataReducted', 'lowStock'));
    }


}