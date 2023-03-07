<?php

namespace App\Http\Controllers\Api\v1\Invoice;

use App\Models\Invoice;
use App\Models\ApiResponse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\Invoice\InvoiceRessource;
use App\Http\Requests\Api\v1\Invoice\InvoiceStoreRequest;
use App\Http\Requests\Api\v1\Invoice\InvoiceUpdateRequest;
use Nette\Utils\Random;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = InvoiceRessource::collection(Invoice::all());
        //$invoices = invoice::all();
        return ApiResponse::success($invoices);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InvoiceStoreRequest $request)
    {
        $invoice_number = Str::uuid();
        $total_price = (float) ($request->total_vat) + (float) $request->total_price_excluding_vat;
        $user_id = $request->user()->id;
        $request->merge(['invoice_number' => $invoice_number, 'total_price' => $total_price, 'user_id' => $user_id]);
        $invoice = Invoice::create(
            $request->all()
        );
        return ApiResponse::success(InvoiceRessource::make($invoice), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {

        return ApiResponse::success(InvoiceRessource::make($invoice));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InvoiceUpdateRequest $request, Invoice $invoice)
    {
       
        $total_price = (float) ($request->total_vat) + (float) $request->total_price_excluding_vat;
        $request->merge(['total_price' => $total_price]);
        $invoice->update($request->all());
        return ApiResponse::success(InvoiceRessource::make($invoice));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return ApiResponse::success(['message' => 'Invoice deleted successfully']);
    }
}