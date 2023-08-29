@php
    $dt = Carbon\Carbon::now();
    $dt->tz = new DateTimeZone('America/Campo_Grande');
    $dt->tz = 'America/Campo_Grande';
@endphp
<!DOCTYPE html>
<html>
<head>
     <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Carteirinha nº: {{$socio->id}}</title>
     <!-- Bootstrap CSS -->
    
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
   
    <!-- Font Awesome JS -->

    <script src="https://kit.fontawesome.com/275566dc00.js" crossorigin="anonymous"></script>

    <!--DATATABLES-->
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
    <style type="text/css" media="screen">
        .carteira {
            border: solid;
            border-color: green;
            border-radius: 10px;
            width: 321.25px;
            height: 207.87px;
            margin: 40px;
            margin-top: 10px;
        }
        @font-face {
           font-family: barras;
           src: url(/3OF9_NEW.TTF);
         }
    </style>
</head>
<body>

    <div class="row">
        <div class="carteira" id="carteira">
            <div class="row">
                <div class="col-5">
                    <img style="margin-left: 10px; margin-top: 4px" src="/storage/foto/{{$socio->foto}}" width="110px" height="115px">
                </div>
                <div class="col">
                    <center><h6 style="font-family: barras; font-size: 30px;">{{$socio->carteira}}</h6></center>
                    <center>
                        <h6 style="font-size: 15px; margin-top: 10px"><strong>SÓCIO Nº:</strong> {{$socio->id}}</h6>
                    </center>
                </div>

                
            </div>
            <div class="row">
                <div class="col">
                    <h6 style="font-size: 13px; margin-left: 10px; margin-top: 10px"><strong>Grad/N. Guerra:</strong> {{$socio->posto_grad}} {{$socio->nome_guerra}}</h6>
                    <h6 style="font-size: 13px; margin-left: 10px"><strong>Contato:</strong>     {{$socio->celular}}</h6>
                    <h6 style="font-size: 13px; margin-left: 10px"><strong>SARAM:</strong> {{$socio->saram}}</h6>
                </div>
                <div class="col-3" style="margin-left: -105px">
                     <img style="margin-top: 10px" src="/imagens/logo.png" width="70px" height="70px">
                     
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <input style="margin-top: 5px; margin-left: 100px" class="btn btn-success" type="button" name="gerar" value="SALVAR CARTEIRINHA" onclick="doCapture();" id="btnSave2">
    </div>

     

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script type="text/javascript" src="http://code.jquery.com/jquery-3.0.0.min.js"></script>
    <script src="/js/mask/dist/jquery.mask.min.js" ></script>

    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>

    <script src="/js/html2canvas.min.js"></script>
    
    <script>

         $("#btnSave2").click(function() {
        var container = document.getElementById("carteira"); //specific element on page
            //var container = document.body; // full page 
            html2canvas(container).then(function(canvas) {
                var link = document.createElement("a");
                document.body.appendChild(link);
                link.download = "renomear_com_SARAM.png";
                link.href = canvas.toDataURL("image/png");
                link.target = '_blank';
                link.click();
            });
      });

    </script>
</body>
</html>