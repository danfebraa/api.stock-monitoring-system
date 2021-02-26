<?php

namespace App\Observers;

use App\Models\ActionReport;

class ActionReportObserver
{
    /**
     * Handle the ActionReport "created" event.
     *
     * @param  \App\Models\ActionReport  $actionReport
     * @return void
     */
    public function created(ActionReport $actionReport)
    {
        //
    }

    /**
     * Handle the ActionReport "updated" event.
     *
     * @param  \App\Models\ActionReport  $actionReport
     * @return void
     */
    public function updated(ActionReport $actionReport)
    {
        //
    }

    /**
     * Handle the ActionReport "deleted" event.
     *
     * @param  \App\Models\ActionReport  $actionReport
     * @return void
     */
    public function deleted(ActionReport $actionReport)
    {
        //
    }

    /**
     * Handle the ActionReport "restored" event.
     *
     * @param  \App\Models\ActionReport  $actionReport
     * @return void
     */
    public function restored(ActionReport $actionReport)
    {
        //
    }

    /**
     * Handle the ActionReport "force deleted" event.
     *
     * @param  \App\Models\ActionReport  $actionReport
     * @return void
     */
    public function forceDeleted(ActionReport $actionReport)
    {
        //
    }
}
