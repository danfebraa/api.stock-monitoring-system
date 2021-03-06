<?php

namespace App\Http\Controllers;

use App\Http\Resources\ActionReportResource;
use App\Models\ActionReport;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Requests\ActionReportRequest;

class ActionReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return ActionReportResource|array|Response
     */
    public function store(ActionReportRequest $request)
    {
        $valid = $request->only([
            'ProductId',
            'ActionType',
            'UOM',
            'Quantity',
            'PurchaseOrder',
            'Remarks',
            'ClientId'
        ]);
        $toBeCreated = collect($valid)->transformKeys(fn ($key) => Str::snake($key))->toArray();
        $actionReport = ActionReport::firstOrCreate($toBeCreated);
        switch ($actionReport->action_type)
        {
            case "NewArrival" :
                $actionReport->product()->update(['quantity' => $actionReport->product->quantity + (int)$actionReport->quantity]);
                break;
            case "Delivery" :
                $actionReport->product()->update(['quantity' => $actionReport->product->quantity - (int)$actionReport->quantity]);
                break;
        }
        return new ActionReportResource($actionReport);

    }

    /**
     * Display the specified resource.
     *
     * @param ActionReport $actionReport
     * @return Response
     */
    public function show(ActionReport $actionReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param ActionReport $actionReport
     * @return Response
     */
    public function update(Request $request, ActionReport $actionReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ActionReport $actionReport
     * @return Response
     */
    public function destroy(ActionReport $actionReport)
    {
        //
    }
}
