<?php

namespace App\Exports;

use Auth;
use App\Models\Admin\Activity;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ActivityExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $nameuser;

    public function __construct( $nameuser )
    {
        $this->nameuser = $nameuser;
    }

    public function view(): View
    {
        if($this->nameuser):
            $this->nameuser = decrypt($this->nameuser);
            return view('admin.records.excelactivity', [
                'activities' => Activity::where('user_id', $this->nameuser)
                                ->where('user_id', '<>', Auth::user()->id)
                                ->orderBy('created_at','Desc')
                                ->orderBy('name', 'Asc')
                                ->get(),
            ]);
        else:
            return view('admin.records.excelactivity', [
                'activities' => Activity::orderBy('created_at','Desc')
                                ->where('user_id', '<>', Auth::user()->id)
                                ->orderBy('name', 'Asc')
                                ->get(),
            ]);
        endif;
    }
}
