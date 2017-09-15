<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegisteredUser extends Model
{
	protected $table = 'registered_users';
	public $timestamps = true;
	protected $fillable = [ 'content', 'user_id', 'building_id'];
}
