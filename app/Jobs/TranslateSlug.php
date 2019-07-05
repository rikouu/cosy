<?php

namespace App\Jobs;

use App\Models\Model;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class TranslateSlug extends Job
{
    use Dispatchable, InteractsWithQueue, SerializesModels;

    protected $model;

    /**
     * TranslateSlug constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
}
