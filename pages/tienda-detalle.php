<!DOCTYPE html>
<?=$headGNRL?>
<body id="menu-dark">
<?=$header?>

<?php 
    $style       = 'max-width:200px;';  
    $noPic       = 'img/design/camara.jpg';
    $rutaPics    = 'img/contenido/productos/';
    $firstPic    = $noPic;
    $firstTalla  = '';
    $firstColor  = '';
    $existencias = '';
    //Fotografía
      $CONSULTA3 = $CONEXION -> query("SELECT * FROM productospic WHERE producto = $id ORDER BY orden LIMIT 1");
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

        $style=($picWidth<$picHeight)?'max-height:200px;':$style;
      }

    $precio='';
   
    $descuento    = $rowCONSULTA['descuento'];
    $preciocampo  = 'precio';
    $claves_pro   = explode_array($rowCONSULTA['claves']);
    $preventa = $rowCONSULTA['preventa'];

    if ($rowCONSULTA[$preciocampo]>0) {
      $precio = ($descuento>0)?'
      <del class="text-8 uk-text-light uk-text-muted">DE: $'.number_format(($rowCONSULTA[$preciocampo]),2).'</del><br>
      <div class="" style="min-height: 35px; width: 250px;">
       A: $ <span class="text-lg">'.number_format(($rowCONSULTA[$preciocampo]*(100-$descuento)/100),2).' Mx</span>
      </div>':'
      <div class="" style="height: 35px; min-width: 250px; max-width: 250px;">
        $ <span class="text-lg">'.number_format(($rowCONSULTA[$preciocampo]*(100-$descuento)/100),2).' Mx</span>
      </div>';
    }
?>


<div class="bg-gris-blanco">
  <div class="uk-container uk-container-xlarge">
    <div>
      <div class="uk-flex uk-flex-center top-pa-media">
        <img class="padding-10" src="img/design/logo.png">
      </div>
      <div uk-grid>
        <div class="uk-width-1-1 uk-width-1-3@m">
          <?php
          echo'
          <div>
              <div class="mini-linea"></div>
              <div class="uk-text-uppercase text-xxl">
              '.$rowCONSULTA['titulo'].'
              </div>
              <div>
                '.$rowCONSULTA['txt'].'
              </div>
              <div>
               '; 
              if ($rowCONSULTA['precio']>0) {
                
                echo'
                <div class="detalle-precio uk-width-small uk-text-bolder"> 
                  '.$precio.'
                </div>
                ';
              }
              echo'
              </div>
              <div>
                <div class="uk-flex uk-flex-right" style="padding-right: 2em;">
                  <div class="mini-linea"></div>
                </div>
                <div class="uk-flex uk-flex-right">
                  <img src="img/design/tiendalogo.png">
                </div>  
              </div>
          </div>';
          ?>

        </div>
        <div class="uk-width-1-1 uk-width-2-3@m">
          <div class="uk-grid">
            <div class=" uk-width-1-2@s uk-flex uk-flex-center uk-flex-middle">
               <?php  
                  $CONSULTA4 = $CONEXION -> query("SELECT * FROM productospic WHERE producto = $id ORDER BY orden LIMIT 1");
                  $rowCONSULTA4 = $CONSULTA4 -> fetch_assoc();
               
                    $firstPic = $rutaPics.$rowCONSULTA4['imagen'];
                     if (file_exists($firstPic)) {
                        $pic=$firstPic;
                      }else{
                        $pic='img/design/camara.jpg';
                      }

                ?>
              <img  class="img-primary" src="<?=$pic?>" style="height: 100%; object-fit: cover;">

            </div>


          
          <div class="uk-width-1-2@s" >
            <div class="uk-width-large uk-position-relative">
              
              <div class="detalle-descripcion uk-text-justify text-small" style="padding-top: 10px;">
                <div uk-slider>

                    <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1">

                        <ul class="uk-slider-items uk-child-width-1-2 uk-child-width-1-3@s">
                           <?php  
                              $CONSULTA4 = $CONEXION -> query("SELECT * FROM productospic WHERE producto = $id ORDER BY orden");
                              while($rowCONSULTA4 = $CONSULTA4 -> fetch_assoc()){
                                $firstPic = $rutaPics.$rowCONSULTA4['imagen'];
                                 if (file_exists($firstPic)) {
                                    $pic=$firstPic;
                                  }else{
                                    $pic='img/design/camara.jpg';
                                  }

                            echo'
                                <li>
                                    <img class="thumb-img" data-img="'.$pic.'" src="'.$pic.'" alt="">
                                </li>
                              ';

                              }
                           
                                
                             ?>
                        </ul>

                        <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
                        <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

                    </div>

                    <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul>

                </div>
              </div>

              <?php
              echo '
                <div class="uk-margin">
                  <div class="uk-grid uk-margin-remove tallas-border">
                      <div class="uk-margin-auto-vertical uk-width-1-3 uk-text-bold uk-text-uppercase uk-text-right uk-padding-remove">
                        Tallas:
                      </div>
                      <div class="uk-width-expand">
                  <ul class="uk-subnav uk-subnav-pill uk-flex-left" uk-switcher="connect: #colores">
                  ';
                    $sql="SELECT DISTINCT 
                      productosexistencias.talla,
                      productostalla.txt
                      FROM productosexistencias 
                      INNER JOIN productostalla ON productostalla.id = productosexistencias.talla
                      WHERE productosexistencias.producto = $id 
                      AND productosexistencias.estatus = 1
                      ORDER BY productostalla.orden";
         
                    $CONSULTA1 = $CONEXION -> query($sql);
                    while ($rowCONSULTA1 = $CONSULTA1 -> fetch_assoc()) {
                      $tallaID=$rowCONSULTA1['talla'];
                      echo '
                          <li value="'.$tallaID.'">
                            <a class="" style="padding: 10px 10px;" href="#">'.$rowCONSULTA1['txt'].'</a>
                          </li>
                          ';
                    }

                    
                    echo '
                    
                  </ul>
                   </div>
                  </div>
                </div>
                <div>
                  <div class="uk-grid uk-margin-remove tallas-border">
                    <div class="uk-margin-auto-vertical uk-width-1-3 uk-text-bold uk-text-uppercase uk-text-right uk-padding-remove">
                      Color:
                    </div>
                

                      <div class="uk-width-expand">
                        <ul id="colores" class="uk-switcher uk-margin seleccionproducto">';
                        $cuentaTalla = 0;
                          $sql="SELECT DISTINCT 
                            productosexistencias.talla,
                            productostalla.txt
                            FROM productosexistencias 
                            INNER JOIN productostalla ON productostalla.id = productosexistencias.talla
                            WHERE productosexistencias.producto = $id 
                            AND productosexistencias.estatus = 1
                            ORDER BY productostalla.txt";
                          $CONSULTA1 = $CONEXION -> query($sql);
                          $numTallas = $CONSULTA1->num_rows;
                          if ($numTallas>0) {
                            while ($rowCONSULTA1 = $CONSULTA1 -> fetch_assoc()) {
                              $tallaID=$rowCONSULTA1['talla'];
                              $tallaName=$rowCONSULTA1['txt'];
                              echo '
                                  <li>
                                    <div uk-grid>';

                              $CONSULTA2 = $CONEXION -> query("SELECT * FROM productosexistencias WHERE producto = $id AND talla = $tallaID AND estatus = 1");
                              while($rowCONSULTA2 = $CONSULTA2 -> fetch_assoc()){

                                $itemId=$rowCONSULTA2['id'];
                                $colorID=$rowCONSULTA2['color'];
                                //$colorName=$rowCONSULTA2['name'];
                                $existencias=$rowCONSULTA2['existencias'];
                                $existenciasTooltip=($existencias==0)?'uk-tooltip="Agotado"':'';
                                $seleccionable=($existencias==0)?'':'item';

                                if(!isset($selectedId) AND $existencias>0){
                                  $selectedId=$itemId;
                                  $max=$existencias;
                                  $selectedClass='colorseleccionado';
                                  $firstTalla=$tallaName;
                                }else{
                                  $selectedClass='';
                                }

                                $CONSULTA3 = $CONEXION -> query("SELECT * FROM productoscolor WHERE id = $colorID");
                                $numColors = $CONSULTA3->num_rows;
                                if ($numColors>0) {
                                  $rowCONSULTA3 = $CONSULTA3 -> fetch_assoc();

                                  if(!isset($colorCanged) AND $existencias>0){
                                    $colorCanged=1;
                                    $firstColor=$rowCONSULTA3['name'];
                                  }

                                  $imagen   = 'img/contenido/varios/'.$rowCONSULTA3['imagen'];
                                  $colorTxt = (strlen($rowCONSULTA3['imagen'])>0 AND file_exists($imagen))?'background:url('.$imagen.');background-size:cover;':'background:'.$rowCONSULTA3['txt'].';';

                                  echo '
                                      <div class="padding-v-10">
                                        <div id="'.$itemId.'" class="'.$seleccionable.' uk-border-circle pointer colornoselect '.$selectedClass.'" '.$existenciasTooltip.' style="'.$colorTxt.'width:20px;height:20px;" data-inventario="'.$existencias.'" data-id="'.$itemId.'">
                                          &nbsp;
                                        </div>
                                      </div>';
                                }
                              }
                              echo '
                                    </div>
                                  </li>';
                            }
                          }
                          echo '
                        </ul>
                      </div>
                    </div>
                </div>';

                echo'
                
                <div class="uk-margin" style="margin-bottom: 0px;">
                  <div class="uk-grid uk-margin-remove tallas-border">
                    <div class="uk-margin-auto-vertical uk-width-1-3 uk-text-bold uk-text-uppercase uk-text-right uk-padding-remove">Cantidad:</div>
                    <div class="uk-width-expand">
                    <input class="cantidad uk-input input-number" type="number" value="1" min="1" style="width: 60px; background: black; color: white">
                    </div>
                  </div>
                </div>
                
                ';

                echo'
                
                <div class="uk-margin" style="margin-bottom: 0px;">
                  <div class="uk-grid uk-margin-remove tallas-border">
                    <div class="uk-margin-auto-vertical uk-width-1-3 uk-text-bold uk-text-uppercase uk-text-right uk-padding-remove">Precio:</div>
                    <div class="uk-width-expand  ">
                      <div class="bg-black padding-v-10" style="padding-left: 5px; color: white">
                      '.$precio.'
                      </div>
                    </div>
                  </div>
                </div>
                
                ';



              if ($rowCONSULTA['precio']>0) {
                
                echo '
                <div class="uk-margin uk-flex uk-flex-center     ">
                  <div class="text-8 uk-hidden" id="productoselectedtxt">
                    Talla seleccionada: '.$firstTalla.'<br>
                    Color seleccionado: '.$firstColor.'
                  </div>
                  <button class="buybutton uk-button uk-button-default uk-button-personal"  style="font-weight: 100" data-id="'.$selectedId.'">&nbsp; COMPRAR <img data-src="img\design\carrito.png" uk-img></button>
                </div>
                ';
              }
              

              ?>

            </div>  
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>

  <!--####### inicio productos-->
  <?php
    $round = "";
    $LikeItems = "";
    $numitems = count($claves_pro);
    foreach ($claves_pro as $key => $value) {
      if ($key != 0) {
        if ($numitems == ($key+1) ) {
          $LikeItems.= "claves LIKE '%,".$value."%'";
          
        }else{
          $LikeItems.= "claves LIKE '%,".$value."%' OR ";
          
        }
      }
    }


    $sql="SELECT * FROM productos WHERE estatus = 1 AND preventa = ".$preventa." AND id != $id AND (".$LikeItems.") LIMIT 8";
    echo $sql;
    $Consulta = $CONEXION -> query($sql);
    $numProds = $Consulta->num_rows;
    if ($numProds>0) {
      echo '
      <div class="margin-top-50">
        <div class="uk-container uk-container-xlarge padding-v-10 " >
        <div class="uk-child-width-1-1" uk-grid>
          <div>
            <h1 class="uk-card-title text-xxxl">El mejor complemento <h1>
          </div>
        </div>  
      </div>
      <div class="uk-container uk-container-xlarge padding-v-50 top-headerBG" style="visibility:hidden; margin-bottom: 15px;" uk-scrollspy="cls:uk-animation-fade;delay:500;">
        
            <div class="uk-position-relative uk-visible-toggle " tabindex="-1" uk-slider="sets:true; autoplay:true; autoplay-interval:3000;">
          <ul class="uk-slider-items uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-4@l uk-text-center" uk-height-match="target: .texto">';
          while ($row_Consulta = $Consulta -> fetch_assoc()) {
            echo '<li><div class="padding-20">'.item($row_Consulta['id'],0).'</div></li>';
            
          }
          echo '
          </ul>

          <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin uk-visible@m"></ul>

          <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
          <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

              </div>
          </div>
      </div>';
    }
  ?>

  <?=$footer?>
</div>


<?=$scriptGNRL?>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<?php
if($es_movil!==TRUE){
  echo "<script src='library/elevatezoom/jquery.elevatezoom.js'></script>";
}
?>
<script>
  $("#pic").elevateZoom({ 
    zoomType : "lens", 
    lensShape : "round", 
    lensSize : 130,
    scrollZoom: true
  });

  $('.thumb-img').click(function() {
    let imgurl = $(this).data('img');
    $('.img-primary').attr('src',imgurl);
  })

  <?php 
    if (isset($arregloPics)) {
    ?>
    $('.pic').click(function(){
      var arreglo = [<?=$arregloPics?>];
      var id = $(this).attr('data-id');
      $('#actual').val(id);
      $( "#pic" ).addClass( "alpha0", 200 );
      setTimeout(function() {
        $('#pic').attr('src','<?=$rutaImg?>'+arreglo[id]+'.jpg');
        $('#pic').attr('data-zoom-image','<?=$rutaImg?>'+arreglo[id]+'.jpg');
        $('#pic').removeClass( "alpha0", 500 );
        var ez = $('#pic').data('elevateZoom');
        ez.swaptheimage('<?=$rutaImg?>'+arreglo[id]+'.jpg', '<?=$rutaImg?>'+arreglo[id]+'.jpg');
      }, 200 );
    });
    <?php 
    }
  ?>

  $('#seleccionartalla').change(function() {
    var talla = $(this).val();
    console.log(talla);
    $('.item').removeClass('colorseleccionado');
    $('.item-'+talla+'-0').addClass('colorseleccionado');
    var id = $('.item-'+talla+'-0').attr('data-id');
    var inventario = $('.item-'+talla+'-0').attr('data-inventario');
    dameItem(id,inventario);

  });

  $('.item').click(function(){
    var id = $(this).attr('data-id');
    var inventario = $(this).attr('data-inventario');
    dameItem(id,inventario);

  });

  function dameItem(id,inventario){
    $('.buybutton').attr('data-id', id);
    $('.cantidad').attr('max', inventario);
    $('.item').removeClass('colorseleccionado');
    $('#'+id).addClass('colorseleccionado');
    $.ajax({
      method: "POST",
      url: "includes/acciones.php",
      data: {
        tallaycolor: 1,
        id: id,
        inventario: inventario
      }
    })
    .done(function( response ) {
      console.log(response);
      datos = JSON.parse(response);
      $('#productoselectedtxt').html(datos.xtras);
    
    });
  }
  
  // Agregar al carro
  $(".buybutton").click(function(){
    var id=$(this).attr("data-id");
    var cantidad=$(".cantidad").val();
    var l=id.length;
    console.log( id + ' - ' + cantidad );
    if (l>0) {
      $.ajax({
        method: "POST",
        url: "addtocart",
        data: { 
          id: id,
          cantidad: cantidad,
          addtocart: 1
        }
      })
      .done(function( response ) {
        console.log( response );
        datos = JSON.parse(response);
        UIkit.notification.closeAll();
        UIkit.notification(datos.msj);
        $(".cartcount").html(datos.count);
        $("#cotizacion-fixed").removeClass("uk-hidden");
      });
    }
  });


  $(".cantidad").keyup(function() {
    var inventario = $(this).attr("data-inventario");
    var cantidad = $(this).val();
    inventario=1*inventario;
    cantidad=1*cantidad;
    if(inventario<=cantidad){
      $(this).val(inventario);
    }
    console.log(inventario+" - "+cantidad);
  })
  $(".cantidad").focusout(function() {
    var inventario = $(this).attr("data-inventario");
    var cantidad = $(this).val();
    inventario=1*inventario;
    cantidad=1*cantidad;
    if(inventario<=cantidad){
      //console.log(inventario*2+" - "+cantidad);
      $(this).val(inventario);
    }
  })



  $("#seleccionartalla").change(function(){
    var valor = $(this).val();
    UIkit.switcher("#colores").show(valor);
  });

</script>
</body>
</html>