<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    const ADMIN = ['id' => 1, 'name' => 'Administrator'];
    const USER = ['id' => 2, 'name' => 'User'];

}
