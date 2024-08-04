<?php

declare(strict_types=1);

namespace Modules\Cargo\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Cargo\Entities\Cargo;

class SoftDeleteCargoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $cargo;

    /**
     * Create a new job instance.
     *
     * @param Cargo $cargo
     */
    public function __construct(Cargo $cargo)
    {
        $this->cargo = $cargo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->cargo->delete();
    }
}

