<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Ai_Controller extends Controller
{
    public function index()
    {
        return view("tampilan");
    }
    function rand_float($st_num=0,$end_num=1,$mul=1000000)
    {
        if ($st_num>$end_num) return false;
        return random_int($st_num*$mul,$end_num*$mul)/$mul;
    }
    public function runningsa(){
        $x1 = $this->rand_float(-10, 10);
        $x2 = $this->rand_float(-10, 10);
        return $this->simulated($x1,$x2)[2];
    }

    public function akurasi($hasil,$inputan){
        $akurasis = (1-(($hasil-$inputan)/$inputan))*100;
        return $akurasis;
    }

    public function fungsi($x1, $x2) {
        $hasilkeluaran = -(abs(sin($x1) * cos($x2) * exp(abs(1 - sqrt(pow($x1,2)+ pow($x2,2)) / pi() ))));
        return $hasilkeluaran;
    }

    public function simulated($x1,$x2){
        $alpha = 0.9;
        $temperature = 1.0;
        $min_temperature = 0.00001;
        $state1 = $this->fungsi($x1,$x2);
        while ($temperature > $min_temperature) {
            $i=1;
            while ($i<=100) {
                $x1baru = $this->rand_float(-10,10);
                $x2baru = $this->rand_float(-10,10);
                $state2 = $this->fungsi($x1baru,$x2baru);
                $acak = mt_rand() / mt_getrandmax();
                if($state2 < $state1){
                    $probs = 1.0;
                }else{
                    $dE = $state1 - $state2;
                    $probs = exp(-(abs($dE)) / $temperature);
                }
                if ($acak < $probs) {
                    $state1 = $state2;
                    $x1 = $x1baru;
                    $x2 = $x2baru;
                }
                $i +=1;
            }
            $temperature = $temperature * $alpha;
        }
        return array($x1,$x2,$state1);
    }


}
