<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    use HasFactory;
    public $table = 'codes';

    protected $primaryKey = 'code';

    public const TYPE = [
        1 => 'กาโตะข้าวเหนียวมะม่วง',
        2 => 'กาโตะมะม่วงแรด',
        3 => 'กาโตะมะม่วงพริกเกลือ'
    ];

    public const REGISTER = [
        1 => 'SMS',
        2 => 'Website',
    ];

    public const TASTE = [
        1 => 'รสข้าวเหนียวมะม่วง',
        2 => 'รสมะม่วงแรด',
        3 => 'รสมะม่วงพริกเกลือ'
    ];

    protected $fillable = [
        'code',
        'status',
        'type',
        'phone_number',
        'updated_at'
    ];

}
