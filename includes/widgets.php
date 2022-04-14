<?php
// CARRO DE COMPRA       
  //unset($_SESSION['carro']);
  if (isset($_POST['emptycart'])) {
    unset($_SESSION['carro']);
  }
    $carroTotalProds =0 ;
  if(isset($_SESSION['carro'])){
    $arreglo=$_SESSION['carro'];
  }

  // Remover artículos del carro
  if (isset($_POST['removefromcart'])) {
    $id=$_POST['id'];
    $arregloAux=$_SESSION['carro'];
    unset($arreglo);
    $num=0;
    foreach ($arregloAux as $key => $value) {
      if ($id!=$value['Id']) {
        $arreglo[]=array('Id'=>$arregloAux[$num]['Id'],'Cantidad'=>$arregloAux[$num]['Cantidad']);
      }
      $num++;
    }
    $_SESSION['carro']=$arreglo;
  }

  // Agregar artículos al carro
  if (isset($_POST['addtocart'])) {
    if (isset($_POST['cantidad']) and $_POST['cantidad']!==0 and $_POST['cantidad']!=='') {
      $id=$_POST['id'];

      $carroTotalProds+=$_POST['cantidad'];
      $arregloNuevo[]=array('Id'=>$id,'Cantidad'=>$_POST['cantidad']);

      if (!isset($arreglo)) {
        $arreglo=$arregloNuevo;
      }else{
        $arregloAux=$arreglo;
        unset($arreglo);
        $num=0;
        foreach ($arregloAux as $key => $value) {
          if ($id!=$arregloAux[$num]['Id']) {
            $arreglo[]=array('Id'=>$arregloAux[$num]['Id'],'Cantidad'=>$arregloAux[$num]['Cantidad']);
          }else{
            $carroTotalProds-=$arregloAux[$num]['Cantidad'];
          }
          $num++;
        }
        if ($_POST['cantidad']>0) {
          $arreglo[]=array('Id'=>$id,'Cantidad'=>$_POST['cantidad']);
        }
      }
      
      echo '{ "msj":"<div class=\'uk-text-center color-blanco bg-success padding-10 text-lg\'><i class=\'fa fa-check\'></i> &nbsp; Agregado al pedido</div>", "count":'.$carroTotalProds.' }';

      $_SESSION['carro']=$arreglo;
    }
  }

  if (isset($_POST['actualizarcarro'])) {
    $arregloAux=$_SESSION['carro'];
    unset($arreglo);
    $carroTotalProds=0;
    $num=0;
    foreach ($arregloAux as $key => $value) {
      if ($_POST['cantidad'.$num]>0) {
        $arreglo[]=array('Id'=>$arregloAux[$num]['Id'],'Cantidad'=>$_POST['cantidad'.$num]);
        $carroTotalProds+=$_POST['cantidad'.$num];
      }
      $num++;
    }
    $_SESSION['carro']=$arreglo;
  }

  // Si ya hay productos en el carro
  $carroTotalProds=0;
  if(isset($arreglo)){
    foreach ($arreglo as $key => $value) {
      $carroTotalProds+=$value['Cantidad'];
    }
  }

// LIMITAR PALABRAS      
  function wordlimit($string, $length , $ellipsis)
  {
    $words = explode(' ', strip_tags($string));
    if (count($words) > $length)
    {
      return implode(' ', array_slice($words, 0, $length)) ." ". $ellipsis;
    }
    else
    {
      return $string;
    }
  }

// FECHA                 
  // FECHA CORTA
    function fechaCorta($fechaSQL){
      $fechaSegundos=strtotime($fechaSQL);
      $fechaY=date('Y',$fechaSegundos);
      $fechaM=date('m',$fechaSegundos);
      $fechaD=date('d',$fechaSegundos);
      $fechaDay=strtolower(date('D',$fechaSegundos));

      return $fechaD.'-'.$fechaM.'-'.$fechaY;
    }
    
  // FECHA Y HORA
    function fechaHora($fechaSQL){
      $fechaSegundos=strtotime($fechaSQL);
      $fechaY=date('Y',$fechaSegundos);
      $fechaM=date('m',$fechaSegundos);
      $fechaD=date('d',$fechaSegundos);
      $fechaH=date('H',$fechaSegundos);
      $fechaI=date('i',$fechaSegundos);
      $fechaDay=strtolower(date('D',$fechaSegundos));

      return $fechaD.'-'.$fechaM.'-'.$fechaY.'<br>'.$fechaH.':'.$fechaI;
    }
    
  // SOLO HORA
    function soloHora($fechaSQL){
      $fechaSegundos=strtotime($fechaSQL);
      $fechaH=date('H',$fechaSegundos);
      $fechaI=date('i',$fechaSegundos);

      return $fechaH.':'.$fechaI;
    }

  function fechaSQL($fechaSQL){
    $fechaSegundos=strtotime($fechaSQL);

    $fechaY=date('Y',$fechaSegundos);
    $fechaM=date('m',$fechaSegundos);
    $fechaD=date('d',$fechaSegundos);
   
    return $fechaY.'/'.$fechaM.'/'.$fechaD;
  }
  
  // FECHA DIA
    function fechaDisplayDia($fechaSQL){
      $fechaSegundos=strtotime($fechaSQL);
      $fechaY=date('Y',$fechaSegundos);
      $fechaM=date('m',$fechaSegundos);
      $fechaD=date('d',$fechaSegundos);
      $fechaDay=strtolower(date('D',$fechaSegundos));

      switch ($fechaDay) {
        case 'mon':
        $fechaDia='Lunes';
        break;
        case 'tue':
        $fechaDia='Martes';
        break;
        case 'wed':
        $fechaDia='Miércoles';
        break;
        case 'thu':
        $fechaDia='Jueves';
        break;
        case 'fri':
        $fechaDia='Viernes';
        break;
        case 'sat':
        $fechaDia='Sábado';
        break;
        default:
        $fechaDia='Domingo';
        break;
      }
      return $fechaDia;
    }

  // FECHA MES
    function fechaDisplayMes($fechaSQL){
      $fechaSegundos=strtotime($fechaSQL);
      $fechaY=date('Y',$fechaSegundos);
      $fechaM=date('m',$fechaSegundos);
      $fechaD=date('d',$fechaSegundos);
      $fechaDay=strtolower(date('D',$fechaSegundos));

      switch ($fechaM) {
        case 1:
        $mes='enero';
        break;
        
        case 2:
        $mes='febrero';
        break;
        
        case 3:
        $mes='marzo';
        break;
        
        case 4:
        $mes='abril';
        break;
        
        case 5:
        $mes='mayo';
        break;
        
        case 6:
        $mes='junio';
        break;
        
        case 7:
        $mes='julio';
        break;
        
        case 8:
        $mes='agosto';
        break;
        
        case 9:
        $mes='septiembre';
        break;
        
        case 10:
        $mes='octubre';
        break;
        
        case 11:
        $mes='noviembre';
        break;
        
        default:
        $mes='diciembre';
        break;
      }

      return $mes;
    }

  // FECHA LARGA
    function fechaDisplay($fechaSQL){
      $fechaSegundos=strtotime($fechaSQL);
      $fechaY=date('Y',$fechaSegundos);
      $fechaM=date('m',$fechaSegundos);
      $fechaD=date('d',$fechaSegundos);
      $fechaDay=strtolower(date('D',$fechaSegundos));

      switch ($fechaM) {
        case 1:
        $mes='enero';
        break;
        
        case 2:
        $mes='febrero';
        break;
        
        case 3:
        $mes='marzo';
        break;
        
        case 4:
        $mes='abril';
        break;
        
        case 5:
        $mes='mayo';
        break;
        
        case 6:
        $mes='junio';
        break;
        
        case 7:
        $mes='julio';
        break;
        
        case 8:
        $mes='agosto';
        break;
        
        case 9:
        $mes='septiembre';
        break;
        
        case 10:
        $mes='octubre';
        break;
        
        case 11:
        $mes='noviembre';
        break;
        
        default:
        $mes='diciembre';
        break;
      }

      switch ($fechaDay) {
        case 'mon':
        $fechaDia='Lunes';
        break;
        case 'tue':
        $fechaDia='Martes';
        break;
        case 'wed':
        $fechaDia='Miércoles';
        break;
        case 'thu':
        $fechaDia='Jueves';
        break;
        case 'fri':
        $fechaDia='Viernes';
        break;
        case 'sat':
        $fechaDia='Sábado';
        break;
        default:
        $fechaDia='Domingo';
        break;
      }

      return $fechaDia.' '.$fechaD.' de '.$mes.' de '.$fechaY;
    }

// DEPURAR VARIABLES     
  function debug ( $var, $html = true, $backtrace = null ) {

    $id = uniqid ( );

    if ( is_null ( $backtrace ) )
      $backtrace = debug_backtrace ( );

    $debug = "<div id='$id'>" . "<code class=''>" . "<strong>FILE: " . $backtrace [ 0 ] [ 'file' ] . "</strong>" . "<BR />" . PHP_EOL . "<strong>LINE: " . $backtrace [ 0 ] [ 'line' ] . "</strong>" . "<BR />" . PHP_EOL . "<pre>";

    ob_start ( );
    print_r ( $var );
    $dump = ob_get_clean ( );
    $debug .= htmlentities ( $dump );
    $debug .= "</pre>" . "</code>" . "</div>";

    if ( !$html )
      $debug = strip_tags ( $debug );

    echo $debug;
  }

  function breakpoint ( $var, $show_source = false ) {
    $break = debug_backtrace ( );
    debug ( $var, true, $break );
    /*if ( isset ( $this ) )
      unset ( $this );*/
    if($show_source)
      show_source ( $break [ 0 ] [ 'file' ] );
    die ( 'Fin del Brakepoint: ' . date('Y-m-d H:i:s'));

  }

// CARRUSEL              
  // Carousel Inicio
    function carousel($carousel){
      global $CONEXION;
      global $dominio;

      $CONSULTA= $CONEXION -> query("SELECT * FROM configuracion WHERE id = 1");
      $row_CONSULTA = $CONSULTA -> fetch_assoc();
      switch ($row_CONSULTA['slideranim']) {
        case 0:
          $animation='fade';
          break;
        case 1:
          $animation='slide';
          break;
        case 2:
          $animation='scale';
          break;
        case 3:
          $animation='pull';
          break;
        case 4:
          $animation='push';
          break;
        default:
          $animation='fade';
          break;
      }
      $CAROUSEL = $CONEXION -> query("SELECT * FROM $carousel ORDER BY orden");
      $numPics=$CAROUSEL->num_rows;
      if ($numPics>0) {
        echo '
            <!-- Start Carousel -->
            <div uk-slideshow="autoplay:true; autoplay-interval: 4000;animation:'.$animation.';max-height:'.$row_CONSULTA['sliderhmin'].';" class="uk-grid-collapse" uk-grid style="z-index: -1">
              <div class="uk-visible-toggle uk-width-1-1">
                <div class="uk-position-relative">
                  <ul class="uk-slideshow-items">';
                    $num=0;
                    while ($row_CAROUSEL = $CAROUSEL -> fetch_assoc()) {
                      if (strlen($row_CAROUSEL['video'])>0) {
                        $videoUrl=$row_CAROUSEL['video'];
                        $videoPic=$videoUrl;
                        if (strpos($videoPic, 'youtube')) {
                          $pos=strpos($videoPic, 'v');
                          $videoPic=substr($videoPic, ($pos+2));
                        }elseif (strpos($videoPic, 'youtu.be')) {
                          $pos=strrpos($videoPic, '/');
                          $videoPic=substr($videoPic, ($pos+1));
                        }
                        echo '
                          <li>
                          <iframe src="https://www.youtube-nocookie.com/embed/'.$videoPic.'?autoplay=0&amp;showinfo=0&amp;rel=0&amp;modestbranding=1&amp;playsinline=1" frameborder="0" allowfullscreen uk-video="automute: true" uk-cover></iframe>
                          </li>';
                      }else{
                        $caption='';
                        if (strlen($row_CAROUSEL['url'])>0) {
                          $pos=strpos($row_CAROUSEL['url'], $dominio);
                          $target=($pos>0)?'':'target="_blank"';
                          if ($row_CONSULTA['slidertextos']==1 AND strlen($row_CAROUSEL['titulo'])>0 AND strlen($row_CAROUSEL['url'])>0) {
                            $caption='
                            <div class="uk-position-bottom uk-transition-slide-bottom">
                              <div style="min-width:200px;min-height:100px;" class="uk-text-center">
                                <a href="'.$row_CAROUSEL['url'].'" '.$target.' class=" uk-button uk-button-white uk-button-large">
                                  '.$row_CAROUSEL['titulo'].'
                                </a>
                              </div>
                            </div>';
                          }
                        }
                        echo '
                          
                        <li>
                          <div class="uk-container-expand bg-secondary">
                            <div class="padding-h-40 padding-top-40">
                              <div class="uk-grid uk-margin-remove border-u-inver padding-40" style="padding-bottom: 11em">
                                <div class="uk-width-1-2@m uk-width-1-1 uk-flex uk-flex-middle">
                                  <div>
                                    <h1 class="uk-text-uppercase color-primary uk-text-bold text-xxl">'.$row_CAROUSEL['titulo'].'</h1>
                                    <p>'.$row_CAROUSEL['txt'].'</p>
                                    <div class="border-50"></div>
                                  </div>
                                </div>
                                <div class="uk-width-1-2@m uk-width-1-1">
                                  <img src="img/contenido/'.$carousel.'/'.$row_CAROUSEL['imagen'].'">
                                </div>
                              </div>
                            <div>
                          </div>
                        </li>';
                      }
                    }

                    echo '
                  </ul>

                  <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
                  <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>

                </div>

              </div>
            </div>
            <!-- End Carousel -->
            ';
      }
      mysqli_free_result($CAROUSEL);
    }

// ITEM                  
  function item($id){
    global $CONEXION;
    global $caracteres_si_validos;
    global $caracteres_no_validos;

    $widget    = '';
    $style     = 'max-width:200px;';  
    $noPic     = 'img/design/camara.jpg';
    $rutaPics  = 'img/contenido/productos/';
    $firstPic  = $noPic;

    $CONSULTA1 = $CONEXION -> query("SELECT * FROM productos WHERE id = $id");
    $row_CONSULTA1 = $CONSULTA1 -> fetch_assoc();
    $link=$id.'_'.urlencode(str_replace($caracteres_no_validos,$caracteres_si_validos,html_entity_decode(strtolower($row_CONSULTA1['titulo'])))).'-.tienda';


    if ($row_CONSULTA1['precio']>0) {
      $precio = ($row_CONSULTA1['descuento']>0)?'
      <del class="text-8" style="color: grey">DE: $'.number_format(($row_CONSULTA1['precio']),2).'</del>
       a: $'.number_format(($row_CONSULTA1['precio']*(100-$row_CONSULTA1['descuento'])/100),2).' Mx
      ':''.number_format(($row_CONSULTA1['precio']*(100-$row_CONSULTA1['descuento'])/100),2).' Mx';
    }else{
      $precio = '';
    }
    // Fotografía
      $CONSULTA3 = $CONEXION -> query("SELECT * FROM productospic WHERE producto = $id ORDER BY orden,id LIMIT 1");
      while ($rowCONSULTA3 = $CONSULTA3 -> fetch_assoc()) {
        $firstPic = $rutaPics.$rowCONSULTA3['imagen'];
      }

      $picWidth=0;
      $picHeight=0;
      $picSize=getimagesize($firstPic);
      foreach ($picSize as $key => $value) {
        if ($key==3) {
          $arrayCadena1=explode(' ',$value);
          $arrayCadena1=str_replace('"', '', $arrayCadena1);
          foreach ($arrayCadena1 as $key1 => $value1) {

            $arrayCadena2=explode('=',$value1);
            foreach ($arrayCadena2 as $key2 => $value2) {
              if (is_numeric($value2)) {
                $picProp[]=$value2;
              }
            }
          }
        }
      }
      if (isset($picProp)) {
        $picWidth=$picProp[0];
        $picHeight=$picProp[1];

        $style=($picWidth<$picHeight)?'max-height:330px;':$style;
      }

    $widget.='
          <div class="uk-margin-auto-left uk-margin-auto-right" >
              <a href="'.$link.'">
                <div class="uk-card uk-card-default padding-10 margin-bottom-5">
                    <div class="uk-card-media-top  uk-cover-container pro-card" >
                        <img src="'.$firstPic.'" alt=""uk-cover>
                    </div>
                    <div class="uk-text-center">
                        <div class="uk-text-uppercase uk-text-bold">'.$row_CONSULTA1['titulo'].'</div>
                        <div class="text-9">'.$precio.'</div>
                    </div>';
                  $widget.=($row_CONSULTA1['preventa'] == 1)? '<div class="text-8 uk-text-right uk-text-muted">'.$row_CONSULTA1['fechapreve'].'</div>': '';
              $widget.='
                </div>
                

                
              </a>
          </div>
        ';
      

    return $widget;
  }

  //Utilidad
    function explode_array($string){
        $array = explode(",", $string);
      return $array;
    }
    function implode_array($array){
      $string = implode(",", $array);
      return $string;
    }
    
  function cardSucurcal($id, $tipo){
    global $CONEXION;
    $widget ='';
    $consulta = $CONEXION -> query("SELECT * FROM sucursales WHERE id = $id");
    $row_consulta = $consulta -> fetch_assoc();

    switch ($tipo) {
      case 'productos':
        $widget.='
          <div id="'.$row_consulta['id'].'" class="uk-card uk-card-default margin-bottom-30">
                <div class=" uk-text-center" style="max-width: 600px;">
                  <div class="uk-card-title padding-v-10 uk-text-bold">'.$row_consulta['titulo'].'</div>
                  <p class="uk-margin-remove uk-text-bold">Direcci&oacute;n</p>
                  <p class="uk-margin-remove">'.$row_consulta['calle'].' '.$row_consulta['numero'].'</p>
                  <p class="uk-margin-remove">'.$row_consulta['colonia'].'</p>
                  <p class="uk-margin-remove">'.$row_consulta['municipio'].', '.$row_consulta['estado'].'</p>
                  <p class="uk-margin-remove"><a href="sucursales"><u>CONTACTO</u></a></p>
          </div>      
            <div class="uk-text-right">  
                <button class="mapas uk-button uk-button-black margin-v-10" href="" data-id="'.$row_consulta['id'].'" data-lon="'.$row_consulta['lon'].'" data-lat="'.$row_consulta['lat'].'">Ver mapa</button>
              </div>
          </div>
        ';
        break;
      case 'sucursales':
        $widget.='
          <div id="'.$row_consulta['id'].'" class="uk-card uk-card-default margin-bottom-30 uk-flex uk-flex-center uk-flex-middle border-card-suc" style="min-height: 16rem; max-width: 600px;">
            <div class=" uk-text-center">
                <div class="uk-card-title padding-v-10 uk-text-bold">'.$row_consulta['titulo'].'</div>
                <p class="uk-margin-remove uk-text-bold">Direcci&oacute;n</p>
                <p class="uk-margin-remove">'.$row_consulta['calle'].' '.$row_consulta['numero'].'</p>
                <p class="uk-margin-remove">'.$row_consulta['colonia'].'</p>
                <p class="uk-margin-remove">'.$row_consulta['municipio'].', '.$row_consulta['estado'].'</p>
                <button class="mapas uk-button uk-button-black margin-v-10" style="line-height: 25px; padding: 0px 10px;" data-id="'.$row_consulta['id'].'" data-lon="'.$row_consulta['lon'].'" data-lat="'.$row_consulta['lat'].'">M&aacute;s informaci&oacute;n</button>
            </div>   
          </div>
        ';
        break;
      
      default:
         $widget.='<div>error en parametros</div>';
        break;
    }
    return $widget;
  }

// FILTROS               
  function filtros ($cat,$marca,$tipo){
    global $CONEXION;
    global $caracteres_si_validos;
    global $caracteres_no_validos;
    global $noPic;


    $estatusCatAll=($cat==0)?'active':'';
    $linkAllCat   = '0_0_0_tienda_wozial';

    $linktipo = ($tipo == 'tienda')? '_0_0_tienda_wozial': '_0_0_preventa';

    $widget = '
      <!-- Filtros -->
      <!--<h2 class="uk-text-center color-primary">Categorías</h2>-->

      <div>
        <!--<a href="'.$linkAllCat.'" class="'.$estatusCatAll.'">Todo</a>-->
        <div>
          <div class="mini-linea"></div>
        </div>
        <ul class=" uk-nav-parent-icon" uk-nav>';
          $sql="SELECT * FROM productoscat WHERE parent = 0 ORDER BY orden,txt,id";
          $Consulta2 = $CONEXION -> query($sql);
          $numSub = $Consulta2->num_rows;
          if ($numSub > 0) {
            while ($row_Consulta2 = $Consulta2 -> fetch_assoc()) {
            
              // $link = $subMenuId.'_'.$marca.'_0_'.urlencode(str_replace($caracteres_no_validos,$caracteres_si_validos,html_entity_decode(strtolower($row_Consulta2['txt'])))).'_wozial';
              $widget .= '
              <li class="uk-parent">
                <a href="#" class="pa-list">'.$row_Consulta2['txt'].' </a>
                <ul class="uk-nav-sub">
                  ';
                    $idcat = $row_Consulta2['id'];
                    $sql="SELECT * FROM productoscat WHERE parent = $idcat ORDER BY orden,txt,id";
                    $Consulta3 = $CONEXION -> query($sql);
                     while ($row_Consulta3 = $Consulta3 -> fetch_assoc()) {
                      $widget .='
                        <li class="pa-list-sub"><a href="'.$row_Consulta3['id'].$linktipo.'">'.$row_Consulta3['txt'].'</a></li>
                        ';
                      }
                $widget.='
                </ul>
              </li>';
            }
          }
          $widget .= '
        </ul>
        <div style="padding-top: 5em;">
          <div class="uk-flex uk-flex-right" style="padding-right: 2em;">
            <div class="mini-linea"></div>
          </div>
          <div class="uk-flex uk-flex-right">
            <img src="img/design/tiendalogo.png">
          </div>
        </div>
      </div>

     ';

    return $widget;
  }


