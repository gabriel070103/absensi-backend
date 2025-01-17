<?php

namespace App\Http\Controllers\API\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\Models\Guru as GuruModel;
use App\Models\Guru_Mapel as GuruMapelModel;
use App\Models\Jadwal as JadwalModel;
use App\Models\Absensi as AbsensiModel;

use App\Http\Resources\JadwalCollection as JadwalRes;
use App\Http\Resources\AbsensiCollection as AbsensiRes;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'rolecheck:guru']);
    }

    public function getAbsent(Request $request)
    {   
        $absentData = AbsensiRes::collection(AbsensiModel::with(['schedule', 'schedule.teacher_mapel.teacher', 'student'])->get());

        /**
         * I use another instance of laravel collection is for remove(filter)
         * an empty array from array list.
         */
        $tempData = collect($absentData)->filter();

        return generateAPI(['data' => $tempData, 'custom_lenght' => count($tempData), 'message' => generateAPIMessage(['context' => 'jadwal guru', 'type' => 'read'])]);
    }
    
    public function getSchedule(Request $request)
    {
        /**
         * Don't delete this for a week
         */
        // $guruId = GuruModel::where('data_of', Auth::user()->id)->first()->id;
        // $pivotId = GuruMapelModel::select('id')->where('id_guru', $guruId)->get();
        // $jadwalModel = JadwalModel::with('teacher_mapel.mapel')->whereIn('id_guru_mapel', $pivotId)->get();

        $jadwalData = JadwalRes::collection(JadwalModel::with('teacher_mapel.mapel')->get());

        /**
         * Same with above
         */
        $tempData = collect($jadwalData)->filter();
        
        return generateAPI(['data' => $tempData, 'custom_lenght' => count($tempData), 'message' => generateAPIMessage(['context' => 'jadwal guru', 'type' => 'read'])]);
    }
}
