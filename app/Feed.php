<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model {
	protected $table = 'feed';

	protected $fillable = ['user_id', 'building_id', 'content'];

	public function building() {
		return $this->hasOne( 'App\Building' );
	}

	public function user() {
		return $this->hasOne( 'App\User', 'id', 'user_id' );
	}
}
