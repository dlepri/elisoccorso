<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Secondary extends Model
{
    protected $with = array('type', 'pitch');

    protected $appends = array('popover');
    public function getPopoverAttribute() {
        return view('popover.secondary', ['secondary' => $this])->render();
    }
    public function type() {
    	return $this->belongsTo(Type::class)->withDefault(Type::where('name', 'Altro')->first()->toArray());
    }
    public function pitch() {
    	return $this->belongsTo(Pitch::class)->withDefault([
	        'name' => 'Piazzola non assegnata'
	    ]);
    }

    public function edit($request) {
		$this->name = $request['name'];
		$this->description = $request['description'];
		$this->pitch_id = $request['pitch_id'];
		$this->type_id = $request['type_id'];
        $this->image = (array_key_exists('image', $request)) ? $request['image']->store('secondary_points/photos', 'public') : $this->image;
        $this->active = (array_key_exists('active', $request)) ? true : false;
        self::save();
    }
}
