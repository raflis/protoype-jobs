<?php

namespace App\Exports;

use Auth;
use App\Models\Admin\Progress;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProgressExport implements FromView
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
            $k = decrypt($this->nameuser);
            return view('admin.records.excelprogress', [
                'progress' => Progress::whereHas('activity', function($query) use($k){
                                            $query->where('user_id', $k);
                                        })->orderBy('created_at', 'Desc')->orderBy('activity_id', 'Asc')
                                        ->get(),
            ]);
        else:
            return view('admin.records.excelprogress', [
                'progress' => Progress::whereHas('activity', function($query){
                                            $query->where('user_id', '<>', Auth::user()->id);
                                        })->orderBy('created_at', 'Desc')->orderBy('activity_id', 'Asc')
                                        ->get(),
            ]);
        endif;
    }
}
