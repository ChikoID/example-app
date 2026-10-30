<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['first_name',
        'last_name',
        'about',
        'email',
        'phone',
        'photo_url'])]
class Portofolio extends Model
{
}
