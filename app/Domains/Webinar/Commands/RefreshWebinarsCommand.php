<?php
namespace App\Domains\Webinar\Commands;

use App\Domains\Webinar\Models\Webinar;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Throwable;

class RefreshWebinarsCommand extends Command
{
    protected $signature = 'webinar:refresh';

    public function handle()
    {
        $webinars = Webinar::finished()->whereNotNull('repeat')->get();

        /** @var Webinar $webinar */
        foreach ($webinars as $webinar) {
            $this->updateDate($webinar);
            $this->clearChat($webinar);
        }
    }

    private function calculateDate(Carbon $date, string $repeat): Carbon
    {
        while ($date->lt(Carbon::now())) {
            $date->add($repeat);
        }

        return $date;
    }

    /**
     * @param Webinar $webinar
     */
    private function updateDate(Webinar $webinar): void
    {
        if (empty(rtrim($webinar->repeat))) {
            $webinar->update([
                'repeat' => null,
            ]);

            return;
        }

        try {
            $newDate = $this->calculateDate($webinar->scheduled_at, rtrim($webinar->repeat));

            $webinar->update([
                'scheduled_at' => $newDate,
            ]);
        } catch (Throwable $exception) {
            $webinar->update([
                'repeat' => null,
            ]);
        }
    }

    private function clearChat(Webinar $webinar)
    {
        $webinar->messages()->delete();
    }
}
