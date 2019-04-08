<?php

namespace App\Http\Controllers;

use App\Pitch;
use App\Hospital;
use App\Secondary;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function pois(Request $request) {
		$hospitals = Hospital::whereActive(true)->where('pitch', '!=', '')->whereNotNull('pitch')->get();
		$pitches = Pitch::whereActive(true)->get();
		$secondaries = Secondary::whereActive(true)->get();
		return compact('hospitals', 'pitches', 'secondaries');
    }
}
