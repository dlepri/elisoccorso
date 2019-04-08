<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Type extends Model
{
    public function getInformation() {
        $src = asset('storage/'.$this->icon);
        return "<img height='20' src=$src> ".$this->name;
    }
    public function add($request) {
		$this->name = $request['name'];
        $this->icon = (array_key_exists('icon', $request)) ? $request['icon']->store('type_icons', 'public') : null;
        self::save();
    }
    public function edit($request) {
		$this->name = $request['name'];
        $this->icon = (array_key_exists('icon', $request)) ? $request['icon']->store('type_icons', 'public') : $this->icon;
        self::save();
    }

    public static function boot() {
        parent::boot();
        static::deleting(function($type) {
            if ($type->icon) {
                if (Storage::disk('public')->exists($type->icon)) {
                    Storage::disk('public')->delete($type->icon);
                }
            }
        });

    }
}
