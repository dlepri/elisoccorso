<?php

namespace App\Http\Controllers;

use App\Pitch;
use App\Hospital;
use App\Secondary;
use Illuminate\Http\Request;
use App\Http\Resources\Pitch as PitchResource;
use App\Http\Resources\Hospital as HospitalResource;
use App\Http\Resources\Secondary as SecondaryResource;

class ApiController extends Controller
{
    public function pois(Request $request) {
		$hospitals = Hospital::whereActive(true)->whereHas('pitch')->get();
		$pitches = Pitch::whereActive(true)->get();
		$secondaries = Secondary::whereActive(true)->get();
		return compact('hospitals', 'pitches', 'secondaries');
    }

    public function getHospitals(Request $request) {
		return HospitalResource::collection(Hospital::whereActive(true)->whereHas('pitch')->get());
    }

    public function getPitches(Request $request) {
		return PitchResource::collection(Pitch::whereActive(true)->get());
    }

    public function getSecondaries(Request $request) {
		return SecondaryResource::collection(Secondary::whereActive(true)->get());
    }

    public function getPoiData(Request $request) {
        $hospitals = HospitalResource::collection(Hospital::whereActive(true)->whereHas('pitch')->get());
        $pitches = PitchResource::collection(Pitch::whereActive(true)->get());
        $secondaries = SecondaryResource::collection(Secondary::whereActive(true)->get());
        return collect(['hospitals' => $hospitals, 'pitches' => $pitches, 'secondaries' => $secondaries])->toArray();
    }
}
