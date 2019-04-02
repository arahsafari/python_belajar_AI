<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<table class="tabelfuzzy">
    <thead>
    <tr><th>No</th><th>Data Ke</th></tr>
    </thead>
    <tbody>

    </tbody>
</table>
</body>
<script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
<!--<script src="papaparse.js"></script>-->
<script>
    $(document).ready(function() {

        $.ajax({

            type: "GET",

            url: "DataTugas2.csv",

            dataType: "text",

            success: function(data) {processData(data);}

        });

    });

    class Fuzzy {
        constructor(pendapatan,hutang) {
            this.nPendapatan = []
            this.sPendatapan = []
            this.nHutang = []
            this.sHutang = []
            this.hasilYa = []
            this.hasilTidak = []
            this._pendapatan = pendapatan
            this._hutang = hutang
            this.sBerhak = ''
            this.nBerhak = 0
            this.defuzz = 0


        }

        cekPendapatan(data) {
            if (data >= 0 && data <= 0.588) {
                this.sPendatapan.push("miskin")
                this.nPendapatan.push(1.0)
                this.sPendatapan.push("miskin")
                this.nPendapatan.push(1.0)
            }
            else if (data > 0.588 && data <= 0.780) {
                this.sPendatapan.push("miskin")
                this.nPendapatan.push(-(data - 0.923) / (0.923 - 0.747))
                this.sPendatapan.push("sederhana")
                this.nPendapatan.push((data - 0.747) / (0.923 - 0.747))
            }

            else if (data > 0.780 && data <= 0.894){
                this.sPendatapan.push("sederhana")
                this.nPendapatan.push(1.0)
                this.sPendatapan.push("sederhana")
                this.nPendapatan.push(1.0)
            }

            else if (data > 0.894 && data <= 1.178){
                this.sPendatapan.push("sederhana")
                this.nPendapatan.push(-(data - 1.548) / (1.548 - 1.282))
                this.sPendatapan.push("kaya")
                this.nPendapatan.push((data - 1.282) / (1.548 - 1.282))
            }

            else if (data > 1.178 && data <= 1.319 ){
                this.sPendatapan.push("kaya")
                this.nPendapatan.push(1.0)
                this.sPendatapan.push("kaya")
                this.nPendapatan.push(1.0)
            }
            else if (data > 1.319 && data <= 1.423 ){
                this.sPendatapan.push("kaya")
                this.nPendapatan.push(-(data - 1.423) / (1.432 - 1.319))
                this.sPendatapan.push("konglomerat")
                this.nPendapatan.push((data - 1.319) / (1.432 - 1.319))
            }
            else if (data > 1.423 ){
                this.sPendatapan.push("konglomerat")
                this.nPendapatan.push(1.0)
                this.sPendatapan.push("konglomerat")
                this.nPendapatan.push(1.0)
            }
        }

        cekHutang(data) {
            if (data >= 0 && data <= 25.246) {
                this.sHutang.push("sedikit")
                this.nHutang.push(1.0)
                this.sHutang.push("sedikit")
                this.nHutang.push(1.0)
            }
            else if (data > 25.246 && data <= 36.429) {
                this.sHutang.push("sedikit")
                this.nHutang.push(-(data - 36.429) / (36.429 - 25.246))
                this.sHutang.push("lumayan")
                this.nHutang.push((data - 25.246) / (36.429 - 25.246))
            }

            else if (data > 36.429 && data <= 45.566) {
                this.sHutang.push("lumayan")
                this.nHutang.push(1.0)
                this.sHutang.push("lumayan")
                this.nHutang.push(1.0)
            }
            else if (data > 45.566 && data <= 61.661) {
                this.sHutang.push("lumayan")
                this.nHutang.push(-(data - 61.661) / (61.661 - 45.566))
                this.sHutang.push("banyak")
                this.nHutang.push((data - 45.566) / (61.661 - 45.566))
            }
            else if (data > 61.661) {
                this.sHutang.push("banyak")
                this.nHutang.push(1.0)
                this.sHutang.push("banyak")
                this.nHutang.push(1.0)
            }
        }

        inference(){
            for (var i=0; i<2; i++) {
                if (this.sPendatapan[i] == 'miskin' && this.sHutang[i] == 'sedikit'){
                    this.sBerhak = 'Tidak'
                }
                if (this.sPendatapan[i] == "miskin" && this.sHutang[i] == 'lumayan'){
                    this.sBerhak = 'Ya'
                }
                if (this.sPendatapan[i] == 'miskin' && this.sHutang[i] == 'banyak'){
                    this.sBerhak = 'Ya'
                }

                if (this.sPendatapan[i] == 'sederhana' && this.sHutang[i] == 'sedikit'){
                    this.sBerhak = 'Tidak'
                }
                if (this.sPendatapan[i] == "sederhana" && this.sHutang[i] == 'lumayan'){
                    this.sBerhak = 'Tidak'
                }
                if (this.sPendatapan[i] == 'sederhana' && this.sHutang[i] == 'banyak'){
                    this.sBerhak = 'Ya'
                }

                if (this.sPendatapan[i] == 'kaya' && this.sHutang[i] == 'sedikit'){
                    this.sBerhak = 'Tidak'
                }
                if (this.sPendatapan[i] == "kaya" && this.sHutang[i] == 'lumayan'){
                    this.sBerhak = 'Tidak'
                }
                if (this.sPendatapan[i] == 'kaya' && this.sHutang[i] == 'banyak'){
                    this.sBerhak = 'Tidak'
                }

                if (this.sPendatapan[i] == 'konglomerat' && this.sHutang[i] == 'sedikit'){
                    this.sBerhak = 'Tidak'
                }
                if (this.sPendatapan[i] == "konglomerat" && this.sHutang[i] == 'lumayan'){
                    this.sBerhak = 'Tidak'
                }
                if (this.sPendatapan[i] == 'konglomerat' && this.sHutang[i] == 'banyak'){
                    this.sBerhak = 'Tidak'
                }

                this.nBerhak = Math.min(this.nPendapatan[i], this.nHutang[i])
                if (this.sBerhak == 'Tidak'){
                    this.hasilTidak.push([this.nBerhak, this.sBerhak])
                }
                else{
                    this.hasilYa.push([this.nBerhak, this.sBerhak])
                }
            }

            if (this.hasilYa.length == 0){
                this.hasilYa.push([0.0, "Ya"])
            }
            if (this.hasilTidak.length == 0){
                this.hasilTidak.push([0.0, "Tidak"])
            }
        }

        deffuzification(){
            var tidak = this.hasilTidak[0][0]
            var ya = this.hasilYa[0][0]
            if(ya+tidak > 0){
                this.defuzz = ((tidak * 45 + ya * 100) / (ya + tidak))
            }
            else{
                this.defuzz = 0
            }
            return this.defuzz
        }

        cekBerhak(){
            if(this.deffuzification() > 65){
                return 'Ya'
            }
            else{
                return 'Tidak'
            }
        }

        mainprogram(){
            this.cekPendapatan(this._pendapatan)
            this.cekHutang(this._hutang)
            this.inference()
            this.deffuzification()
            return [this.cekBerhak(),this.deffuzification()]
        }

    }



    function processData(allText) {

        var allTextLines = allText.split(/\r\n|\n/);

        var headers = allTextLines[0].split(',');

        var hutang = [];
        var pendapatan = [];
        var kecsvindex = [];
        var kecsvklasifikasi = [];


        for (var i=1; i<allTextLines.length; i++) {

            var data = allTextLines[i].split(',');

            if (data.length == headers.length) {

                var hutangcsv = [];
                hutangcsv.push(data[2]);

                var pendapatancsv = [];
                pendapatancsv.push(data[1]);


                hutang.push(hutangcsv);
                pendapatan.push(pendapatancsv);

            }

        }
        var inkremen = 1
        for (var i=0; i<100; i++) {
            const fuzzying = new Fuzzy(pendapatan[i], hutang[i]);
        // fuzzying.mainprogram()
            if(fuzzying.mainprogram()[0]=="Ya"){
                kecsvindex.push(i+1)
                // kecsvklasifikasi.push(fuzzying.mainprogram()[0])
                console.log(inkremen+" datake = "+(i+1)+" berhak = "+fuzzying.mainprogram());
                inkremen++
            }
        }

        var bodyString = '';
        $.each(kecsvindex, function(index, ctry) {
            bodyString += ('<tr><td>'+(index+1)+'</td><td>'+ctry+'</td></tr>');
        });
        $('.tabelfuzzy tbody').html(bodyString);

        console.log(bodyString)

    }


</script>
</html>