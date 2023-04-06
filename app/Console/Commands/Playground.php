<?php

namespace App\Console\Commands;

use App\Models\AuditAttachment;
use App\Models\GpsAttachment;
use Illuminate\Console\Command;

class Playground extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'playground';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        GpsAttachment::all()->each(function (GpsAttachment $gpsAttachment) {
            if (!AuditAttachment::query()->where('content', $gpsAttachment->content)->exists()) {
                AuditAttachment::query()->create($gpsAttachment->toArray());
            };
        });

        AuditAttachment::all()->each(function (AuditAttachment $auditAttachment) {
            if (!GpsAttachment::query()->where('content', $auditAttachment->content)->exists()) {
                $auditAttachment->delete();
            };
        });
    }
}
