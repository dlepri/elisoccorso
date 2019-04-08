<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $appends = array('popover');
    public function getPopoverAttribute() {
    	return view('popover.hospital', ['hospital' => $this])->render();
    }
}
