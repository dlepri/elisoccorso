<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
	protected $with = array('pitch');
    protected $appends = array('popover');
    public function getPopoverAttribute() {
    	return view('popover.hospital', ['hospital' => $this])->render();
    }
    public function pitch() {
    	return $this->belongsTo(Pitch::class, 'pitch_code', 'code');
    }
}
