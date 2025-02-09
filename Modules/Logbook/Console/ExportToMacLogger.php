<?php

namespace Modules\Logbook\Console;

use DateTime;
use Illuminate\Console\Command;
use Modules\Logbook\Entities\Logbook;
use Modules\Logbook\Entities\LogbookEntry;
use Modules\Logbook\Entities\MacLog;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ExportToMacLogger extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'maclogger:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export to MacLogger DX.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     * @throws \DateMalformedStringException
     */
    public function handle() : void
    {

        $calls =  LogbookEntry::all();

        foreach ($calls as $call) {

            $start =  $call->qso_start;
            $end = $call->qso_end;

            $startDate = new DateTime( $call->qso_start);
            $startTimestamp = floatval($startDate->getTimestamp());
            $endDate = new DateTime( $call->qso_end);
            $endTimestamp = floatVal($startDate->getTimestamp());

            $macLog = new MacLog();
            $macLog->call = $call->call;
            $macLog->first_name = $call->first_name;
            $macLog->last_name = $call->last_name;
            $macLog->dxcc_country = $call->dxcc_country;
            $macLog->grid = $call->grid;
            $macLog->band_rx = $call->band_rx;
            $macLog->band_tx = $call->band_tx;
            $macLog->rst_sent = $call->rst_sent;
            $macLog->rst_received = $call->rst_received;
            $macLog->comments = $call->comments;
            $macLog->qso_start = $startTimestamp;
            $macLog->qso_done = $endTimestamp;
            $macLog->latitude = $call->latitude;
            $macLog->longitude = $call->longitude;
            $macLog->power = $call->power;
            $macLog->tx_frequency = $call->tx_frequency;
            $macLog->rx_frequency = $call->rx_frequency;
            $macLog->dxcc_id = $call->dxcc_id;
            $macLog->distance = $call->distance_miles;

            $macLog->save();
        }
    }

}
