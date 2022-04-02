<?php

namespace App\Http\Livewire;

use App\Models\EwcCode;
use App\Services\NormalEwcExportService;
use Livewire\Component;

class CarLiveStatistics extends Component
{
    protected $listeners = ['carsTableRefreshed' => 'refreshQuery'];

    public $carCount = 0;
    public $carRetWeight = 0;
    public $carDryWeight = 0;
    public $carAvgYear = 0;
    public $statsByCity = [];
    public $statsByMake = [];

    public function mount()
    {
        $this->emit("loadedStatisticsPanel");
    }

    public function download(){
        return (new NormalEwcExportService(EwcCode::first()))->exportAsXlsx();
    }

    public function refreshQuery($data)
    {
        $this->carCount = $data["count"];
        $this->carRetWeight = $data["car_ret_weight"];
        $this->carDryWeight = $data["car_dry_weight"];
        $this->carAvgYear = $data["car_avg_year"];
        $this->statsByCity = $data["car_stats_by_city"];
        $this->statsByMake = $data["car_stats_by_make"];
    }

    public function render()
    {
        return view('livewire.car-live-statistics');
    }
}
