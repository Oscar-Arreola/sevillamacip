<!DOCTYPE html>
<html lang="<?=$languaje?>">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# website: http://ogp.me/ns/website#">
  <meta charset="utf-8">
  <title><?=$title?></title>
  <meta name="description" content="<?=$description?>">
  
  <meta property="og:type" content="website">
  <meta property="og:title" content="<?=$title?>">
  <meta property="og:description" content="<?=$description?>">
  <meta property="og:url" content="<?=$rutaEstaPagina?>">
  <meta property="og:image" content="<?=$ruta?>img/design/logo-og.jpg">
  <meta property="fb:app_id" content="<?=$appID?>">

  <?=$headGNRL?>

</head>
<body id="tienda">
<?=$header?>

<div class="bg-gris-blanco ">
  <div class="uk-container uk-container-xlarge">
    <div>
      <div class="uk-flex uk-flex-center">
        <img class="padding-10" src="img/design/logo.png">
      </div>
      <div class="uk-flex uk-flex-center">
        <div class="pa-list" style="border-bottom: 5px solid black;" >preventa</div>
      </div>
      <section id="seccion-tien-1">
        <div uk-grid>
          <div class="uk-width-1-1 uk-width-1-2@m" id="sidebar">
            
              <div class="uk-container padding-top-50">
                <?=filtros($cat,$marca,'preventa')?>
              </div>
            
          </div><!-- / Filtros -->


          <!-- Productos -->
            <div class="uk-width-1-1 uk-width-1-2@m">
              <!-- Navegación moviles -->

              <!-- Productos -->  
              <div class="padding-h-20 padding-top-50">
                <div class="uk-grid uk-child-width-1-1 uk-child-width-1-2@m" uk-height-match="target: .texto" uk-scrollspy="target: > div; cls: uk-animation-fade; delay: 100">
                  <?php
                  // echo '<div class="uk-width-1-1">'.$sqlProd.'</div>';
                  $Consulta = $CONEXION -> query($sqlProd);
                  $numItems = $Consulta->num_rows;
                  $pag = (!isset($pag))?0:$pag;
                  $prodInicial = $prodsPagina*$pag;
                  $Consulta = $CONEXION -> query($sqlProd." ORDER BY sku,orden,id DESC LIMIT $prodInicial, $prodsPagina");
                  while ($row_Consulta = $Consulta -> fetch_assoc()) {
                    echo '<div>'.item($row_Consulta['id']).'</div>';
                  }
                  ?> 
                </div>
              </div>

              <!-- PAGINATION -->
              <div class="uk-container uk-flex uk-flex-center uk-flex-middle padding-v-50">
                <ul class="uk-pagination">
                  <?php

                  $txt=urlencode(str_replace($caracteres_no_validos,$caracteres_si_validos,html_entity_decode(strtolower($title))));
                  $pagTotal=intval($numItems/$prodsPagina);
                  $modulo=$numItems % $prodsPagina;

                  $disable = "uk-disabled";
                  echo'<li class="'.($pag == 0 ? $disable : "").'"><a href="'.$cat.'_'.$marca.'_'.($pag-1).'_'.$txt.'_wozial'.'"><span uk-pagination-previous></span></a></li>';

                  if (($modulo) == 0){
                    $pagTotal=($numItems/$prodsPagina)-1;
                  }
                  for ($i=0; $i <= $pagTotal; $i++) { 
                    $clase='';
                    if ($pag==$i) {
                      $clase='uk-active';
                    }
                    $link=$cat.'_'.$marca.'_'.$i.'_'.$txt.'_wozial';
                    echo '
                    <li class="'.$clase.'"><a href="'.$link.'">'.($i+1).'</a></li>';
                  }

                  echo '<li class="'.($pagTotal == $pag ? $disable : "" ).'"><a href="'.$cat.'_'.$marca.'_'.($pag+1).'_'.$txt.'_wozial'.'"><span uk-pagination-next></span></a></li>';
                  ?>
                </ul>
              </div><!-- PAGINATION -->
          
            </div>
        </div>
      </section>
    </div>
  </div>
  <?=$footer?>
</div>


<?=$scriptGNRL?>

</body>
</html>