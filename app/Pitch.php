<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pitch extends Model
{
    public function getInformation() {
    	return $this->name. " - <em>".$this->locality." (".$this->province.")</em>";
    }

    
    protected $appends = array('popover');
    public function getPopoverAttribute() {
    	return view('popover.pitch', ['pitch' => $this])->render();
    }
}
