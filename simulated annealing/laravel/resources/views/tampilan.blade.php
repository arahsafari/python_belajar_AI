<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>SA AI</title>
</head>


<body>
<div class="container">
    <h2>Simulated Anneling</h2>
    <div class="form-group">
        <label for="akurasi">Inputan Buat Akurasi:</label>
        <input type="text" required name="akurasi" class="form-control" id="akurasi">
    </div>
    <button onclick="buttonrun()" type="submit" class="btn btn-primary">Run Simulated Anneling</button>
    <button onclick="testakurasi()" type="submit" class="btn btn-primary">Check Akurasi</button>

</div>

</body>

<script>
    function buttonrun(){
        $.ajax({
            type: "GET",
            url:"{{ url('/hasilsa') }}",
            success: function(data) {
                swal("Hasil SAnya adalah : " + data);
            }
        });
    }

    function testakurasi(){
        akurasivar = $("input[name='akurasi']").val()
        if($("input[name='akurasi']").val() == ""){
            swal("Mohon untuk diisi inputan akurasinya ");
        }else{
            var hasil = $.parseJSON($.ajax({
                type: "GET",
                url:"{{ url('/hasilsa') }}",
                dataType: "json",
                async: false
            }).responseText);

            $.ajax({
                type: "GET",
                url:"{{ url('/akurasi') }}"+"/"+hasil+"/"+akurasivar,
                success: function(data) {
                    swal("Hasil akurasinya adalah : " + data+"%");
                }
            });
        }
    }
</script>
</html>