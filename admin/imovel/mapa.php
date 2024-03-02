<?php
    
    require_once '../login/verificarSessao.php';
    verificarNivelAcesso(1);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imóveis</title>

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script>
       
       const queryString = window.location.search;
       const urlParams = new URLSearchParams(queryString);
       const buscaImovel = urlParams.get('buscaImovel');
       
        fetch('buscaImovel.php?buscaImovel='+buscaImovel)
            .then( 
                imoveis => { return imoveis.json() } 
            )
            .then((imoveis) => {
                
                let map;

                async function initMap() {

                const { Map } = await google.maps.importLibrary("maps");

                map = new Map(document.getElementById("map"), {
                    center: { lat: -7.84264027740452, lng: -35.75399839899564 }, 
                    zoom: 15,
                    disableDefaultUI: true,
                    zoomControl: true,
                    mapTypeControl: false,
                    scaleControl: false,
                    streetViewControl: false,
                    fullscreenControl: false,
                    styles: [
                        {
                            featureType: "poi",
                            stylers: [{ visibility: "off" }]
                        },
                        {
                            featureType: "poi.park",
                            stylers: [{ visibility: "off" }]
                        },
                    ],
                });

                const infoWindow = new google.maps.InfoWindow();

                for (let i=0; i < imoveis.length; i++) {

                    const marker = new google.maps.Marker({
                        position: new google.maps.LatLng(imoveis[i].latitude, imoveis[i].longitude),
                        icon: '../../uploads/icones/'+imoveis[i].icone,
                        map: map,
                        title: imoveis[i].referencia,
                        balao: '<h6><a href="formEdicao.php?id='+imoveis[i].idImovel+'" title="Clique para editar o imóvel">'+imoveis[i].referencia+'</a></h6>',
                    });


                    marker.addListener("click", ({domEvent, latLng}) => {
                    
                        infoWindow.close();
                        infoWindow.setContent(marker.balao);
                        infoWindow.open(marker.map, marker);
                    
                    });


                }//for
            }
            initMap();
                
        })

        

    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        #map {
            height: 500px;
        }
    </style>
</head>

<body>

    <?php require_once '../php/header.php'; ?>


    <main class="col-11 col-md-10 col-lg-9 m-auto bg-secondary-subtle mt-5 p-3 rounded">


    
        <section class="mb-4">
            
            <h3>Imóveis <a href="index.php" class="btn btn-sm btn-secondary">&larr; Voltar</a></h3>
            <hr>
        
            <form action="mapa.php" method="get" id="formBusca">

                <?php

                    if (isset($_GET['buscaImovel'])) {
                        $busca = filter_var($_GET['buscaImovel'],FILTER_SANITIZE_SPECIAL_CHARS);
                    } else {
                        $busca = '';
                    }

                ?>

                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" name="buscaImovel" id="buscaImovel" placeholder="Buscar Imóvel" value="<?php echo $busca; ?>">
                    </div>
                    <div class="col">
                        <button class="btn btn-secondary" type="submit" id="btnBuscar">Buscar</button>
                    </div>
                </div>
            </form>
        </section>


        <div id="map"></div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- prettier-ignore -->
    <script>(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
        ({key: "apikey", v: "weekly"});</script>

</body>

</html>