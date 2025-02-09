<?php

namespace Modules\Logbook\Entities;

use Illuminate\Database\Eloquent\Model;

class MacLog extends Model
{
    protected $connection = 'maclogger';

    protected $table = 'qso_table_v008';

    public $timestamps = false;

    protected $fillable = [
        'my_grid',
        'my_call',
        'my_rig',
        'call',
        'first_name',
        'last_name',
        'street',
        'city',
        'county',
        'state',
        'postal_county',
        'zip',
        'grid',
        'dxcc_country',
        'iota',
        'sota',
        'cq_zone',
        'itu',
        'ten_ten',
        'email',
        'url',
        'mode',
        'band_rx',
        'band_tx',
        'rst_sent',
        'rst_received',
        'qso_via',
        'qsl-sent',
        'qsl_received',
        'srx',
        'stx',
        'comments',
        'satellite',
        'qso_start',
        'qso_done',
        'latitude',
        'longitude',
        'tx_frequency',
        'rx_frequency',
        'azimuth',
        'elevation',
        'power',
        'srx_numeric',
        'stx_numeric',
        'dxcc_id',
        'contest_id',
        'my_sota',
        'skcc',
        'pota',
        'my_pota',
        'wwff',
        'my_wwff',
        'sig',
        'sig_info',
        'my_sig_info',
        'ext_val_1',
        'ext_val_2',
        'ext_val_3',
        'ext_val_4',
        'distance',
    ];


    protected $dates = [
        //'created_at',
        //'updated_at',
        //'qso_start',
        //'qso_done',
    ];

    //protected $dateFormat = 'd-m-Y h:s';
}
