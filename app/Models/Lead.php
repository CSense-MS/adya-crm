<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $table = 'leads';

    protected $fillable = [
        'lead_number',
        'contact_name',
        'gender',
        'mobile_no',
        'email',
        'status',
        'lead_owner_id',
        'lead_source',
        'products_enquired',
        'lead_type',
        'company_name',
        'website',
        'gst_no',
        'address_line_1',
        'address_line_2',
        'district_city',
        'pincode',
        'state',
    ];
}
