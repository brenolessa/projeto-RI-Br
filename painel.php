<?php 	
	session_start();
	require 'app/Config.inc.php';
	$login = new Login();
	
	if (!$login->CheckLogin()){
		unset($_SESSION['userlogin']);
		header('Location: index.php?exe=restrito');
	
	}
	else{
		$userLogin = $_SESSION['userlogin'];
	}
	
	$readPesquisa = new Read();
	$readPesquisa->FullRead('SELECT COUNT(*) FROM pesquisa');

	
	$readPublicacao = new Read();
	$readPublicacao->FullRead('SELECT COUNT(*) FROM publicacao WHERE aprovado = :aprovado', "aprovado=S");
	
	$readExtensao = new Read();
	$readExtensao->FullRead('SELECT COUNT(*) FROM extensao');
		
?>
<!DOCTYPE html>
<html class="ls-theme-green ls-html-nobg">
  <head>
    <title>Repositório Institucional - IFBA - VCA</title>

    <?php require_once('assets.php');?>
    <script type="text/javascript" src="assets/js/chartist.min.js"></script>
    <link href="assets/css/chartist.min.css" rel="stylesheet" type="text/css">
    
  </head>
  <body>

    <?php require_once('header.php');?>

    <?php require_once('aside.php');?>

    <main class="ls-main ">
      <div class="container-fluid">
        <h1 class="ls-title-intro ls-ico-dashboard">Dashboard</h1>

<!-- ----------------- -->
<div class="ls-box ls-board-box">
  <header class="ls-info-header">
    <h2 class="ls-title-3">Relatório total</h2>
    <!-- <a href="/locawebstyle/documentacao/exemplos/painel2/stats" class="ls-btn ls-btn-sm">Ver relatórios</a> -->
  </header>

  <div id="sending-stats" class="row ls-clearfix">
    <div class="col-sm-12 col-md-4 col-lg-4">
      <div class="ls-box">
        <div class="ls-box-head">
          <h6 class="ls-title-4">Projetos de Pesquisa</h6>
        </div>
        <div class="ls-box-body">
          <span class="ls-board-data">
            <strong class="ls-color-theme"><?php echo $readPesquisa->getResult()[0]['COUNT(*)']; ?></strong>
          </span>
        </div>
      </div>
    </div>

    <div class="col-sm-12 col-md-4 col-lg-4">
      <div class="ls-box">
        <div class="ls-box-head">
          <h6 class="ls-title-4">Projetos de Extensão</h6>
        </div>
        <div class="ls-box-body">
          <span class="ls-board-data">
            <strong class="ls-color-theme"><?php echo $readExtensao->getResult()[0]['COUNT(*)']; ?></strong>
          </span>
        </div>
      </div>
    </div>

    <div class="col-sm-12 col-md-4 col-lg-4">
      <div class="ls-box">
        <div class="ls-box-head">
          <h6 class="ls-title-4">Publicações</h6>
        </div>
        <div class="ls-box-body">
          <span class="ls-board-data">
            <strong class="ls-color-theme"><?php echo $readPublicacao->getResult()[0]['COUNT(*)']; ?></strong>
          </span>
        </div>
      </div>
    </div>

  </div>
  <hr class="ls-no-border">
  <div id="panel-charts-2" class="ls-clear-both"></div>
</div>

<!-- ------------- -->

<div class="ls-box ls-board-box">
  <header class="ls-info-header">
    <p class="ls-float-right ls-float-none-xs ls-small-info"><strong></strong></p>
    <h2 class="ls-title-3">Gráficos</h2>
  </header>

  <div id="sending-stats" class="row ls-clearfix">

    <div class="col-sm-12 col-md-6">
      <div class="ls-box">
        <div class="ls-box-head">
        <?php 
        $periodo = array();
        $periodo['inicio'] = date('Y') - 1;
        $periodo['fim'] = date('Y');
        
        
        ?>
          <h6 class="ls-title-4">Quantidade de Bolsas por Unidade Financiadora <?= $periodo['inicio'].' - '.$periodo['fim']  ?></h6>
        </div>
        <div class="ls-box-body">
          <span class="ls-board-data">
            

            <div class="ct-chart ct-perfect-fourth ct-golden-section" id="chart1"></div>

          </span>
        </div>
      </div>
    </div>

    <div class="col-sm-12 col-md-6">
      <div class="ls-box">
        <div class="ls-box-head">
          <h6 class="ls-title-4">Quantidade de publicações por área</h6>
        </div>
        <div class="ls-box-body">
          <div class="ct-chart ct-perfect-fourth ct-golden-section" id="chart2"></div>
        </div>
      </div>
    </div>

  </div>
  <br>
</div>


<div class="ls-box ls-board-box">
  <header class="ls-info-header">
    <p class="ls-float-right ls-float-none-xs ls-small-info"><strong></strong></p>
    <h2 class="ls-title-3"></h2>
  </header>

  <div id="sending-stats" class="row ls-clearfix">

    <div class="col-sm-12 col-md-6">
      <div class="ls-box">
        <div class="ls-box-head">
          <h6 class="ls-title-4">Quantidade de projetos de pesquisa por área</h6>
        </div>
        <div class="ls-box-body">
          <div class="ct-chart ct-perfect-fourth ct-golden-section" id="chart3"></div>
        </div>
      </div>
    </div>

    <div class="col-sm-12 col-md-6">
      <div class="ls-box">
        <div class="ls-box-head">
          <h6 class="ls-title-4">Quantidade de Bolsas por Modalidade <?= $periodo['inicio'].' - '.$periodo['fim']  ?></h6>
        </div>
        <div class="ls-box-body">
          <div class="ct-chart ct-perfect-fourth ct-golden-section" id="chart4"></div>
        </div>
      </div>
    </div>

  </div>
  <br>
</div>

<div class="ls-box ls-board-box">
  <header class="ls-info-header">
    <p class="ls-float-right ls-float-none-xs ls-small-info"><strong></strong></p>
    <h2 class="ls-title-3"></h2>
  </header>

  <div id="sending-stats" class="row ls-clearfix">

    <div class="col-sm-12 col-md-6">
      <div class="ls-box">
        <div class="ls-box-head">
          <h6 class="ls-title-4">Quantidade de publicações por ano</h6>
        </div>
        <div class="ls-box-body">
          <div class="ct-chart ct-perfect-fourth ct-golden-section" id="chart5"></div>
        </div>
      </div>
    </div>

    <div class="col-sm-12 col-md-6">
      <div class="ls-box">
        <div class="ls-box-head">
          <h6 class="ls-title-4">Quantidade de projeto de extensão por área</h6>
        </div>
        <div class="ls-box-body">
          <div class="ct-chart ct-perfect-fourth ct-golden-section" id="chart6"></div>
        </div>
      </div>
    </div>

  </div>
  <br>
</div>


<div class="ls-box ls-board-box">
  <header class="ls-info-header">
    <p class="ls-float-right ls-float-none-xs ls-small-info"><strong></strong></p>
    <h2 class="ls-title-3"></h2>
  </header>

  <div id="sending-stats" class="row ls-clearfix">

    <div class="col-sm-12 col-md-6">
      <div class="ls-box">
        <div class="ls-box-head">
          <h6 class="ls-title-4">Comparativo: Projetos de pesquisa por ano</h6>
        </div>
        <div class="ls-box-body">
          <div class="ct-chart ct-perfect-fourth ct-golden-section" id="chart7"></div>
        </div>
      </div>
    </div>

    <div class="col-sm-12 col-md-6">
      <div class="ls-box">
        <div class="ls-box-head">
          <h6 class="ls-title-4">Comparativo: Projetos de Extensão por ano</h6>
        </div>
        <div class="ls-box-body">
          <div class="ct-chart ct-perfect-fourth ct-golden-section" id="chart8"></div>
        </div>
      </div>
    </div>
    
  </div>
  <br>
</div>
<!-- ---------------- -->

<?php 

// Quantidade de Bolsas por Unidade Financiadora
$read = new Read();
$read->FullRead("SELECT count(*), financiamento FROM pesquisa WHERE ano = :ano GROUP BY financiamento", 'ano='.$periodo['inicio'].'-'.$periodo['fim'].'');

$quantidade = array();
$financiamento = array();
$total = 0;

foreach ($read->getResult() as $r){
	//soma todos os valores
	$total += $r['count(*)'];
}

foreach ($read->getResult() as $r){
	//converte para porcentagem
	$quantidade[] = (($r['count(*)'] * 100)/$total);

	$financiamento[] = $r['financiamento'].' ( '.$r['count(*)'].' )';
}
	//tranforma em string	
	$quantidade = implode(', ', $quantidade);
	
	//transforma em string
	$financiamento = '"'.implode('", "', $financiamento).'"';


// Quantidade de publicações por área

$qpa = new Read();
$qpa->FullRead("SELECT count(*), area FROM publicacao WHERE aprovado='S' GROUP BY area");

$qtd_qpa = array();
$area_qpa = array();

foreach ($qpa->getResult() as $q){
	$qtd_qpa[] = $q['count(*)'];
	$area_qpa[] = $q['area'];
}
//tranforma em string
$qtd_qpa = implode(', ', $qtd_qpa);

//transforma em string
$area_qpa = '"'.implode('", "', $area_qpa).'"';


// Quantidade de projeto de pesquisa por área

$qpp = new Read();
$qpp->FullRead("SELECT count(*), area FROM pesquisa GROUP BY area");

$qtd_qpp = array();
$area_qpp = array();

foreach ($qpa->getResult() as $q){
	$qtd_qpp[] = $q['count(*)'];
	$area_qpp[] = $q['area'];
}
//tranforma em string
$qtd_qpp = implode(', ', $qtd_qpp);

//transforma em string
$area_qpp = '"'.implode('", "', $area_qpp).'"';


// Quantidade de Bolsas por Modalidade
$bolsa = new Read();
$bolsa->FullRead("SELECT count(*), modalidade FROM pesquisa WHERE ano = :ano GROUP BY modalidade", 'ano='.$periodo['inicio'].'-'.$periodo['fim'].'');

$qBolsa = array();
$mBolsa = array();
$t = 0;

foreach ($bolsa->getResult() as $r){
	//soma todos os valores
	$t += $r['count(*)'];
}

foreach ($bolsa->getResult() as $r){
	//converte para porcentagem
	$qBolsa[] = (($r['count(*)'] * 100)/$t);

	$mBolsa[] = $r['modalidade'].' ( '.$r['count(*)'].' )';
}
//tranforma em string
$qBolsa = implode(', ', $qBolsa);

//transforma em string
$mBolsa = '"'.implode('", "', $mBolsa).'"';



// Quantidade de publicações por ano

$qpano = new Read();
$qpano->FullRead("SELECT count(*), ano FROM publicacao WHERE aprovado='S' GROUP BY ano");

$countAno = array();
$ano = array();

foreach ($qpano->getResult() as $a){
	$countAno[] = $a['count(*)'];
	$ano[] = $a['ano'];
}
//tranforma em string
$countAno = implode(', ', $countAno);

//transforma em string
$ano = '"'.implode('", "', $ano).'"';


// Quantidade de projeto de extensão por área

$ext = new Read();
$ext->FullRead("SELECT count(*), area FROM extensao GROUP BY area");

$exQtd = array();
$exArea = array();

foreach ($ext->getResult() as $e){
	$exQtd[] = $e['count(*)'];
	$exArea[] = $e['area'];
}
//tranforma em string
$exQtd = implode(', ', $exQtd);

//transforma em string
$exArea = '"'.implode('", "', $exArea).'"';


// Quantidade de pesquisa por ano

$readPes = new Read();
$readPes->FullRead("SELECT count(*), ano FROM pesquisa GROUP BY ano");

$countPes = array();
$anoPes = array();

foreach ($readPes->getResult() as $ee){
	$countPes[] = $ee['count(*)'];
	$anoPes[] = $ee['ano'];
}
//tranforma em string
$countPes = implode(', ', $countPes);

//transforma em string
$anoPes = '"'.implode('", "', $anoPes).'"';

// Quantidade de extensão por ano

$readEx = new Read();
$readEx->FullRead("SELECT count(*), ano FROM extensao GROUP BY ano");

$countEx = array();
$anoEx = array();

foreach ($readEx->getResult() as $eee){
	$countEx[] = $eee['count(*)'];
	$anoEx[] = $eee['ano'];
}
//tranforma em string
$countEx = implode(', ', $countEx);

//transforma em string
$anoEx = '"'.implode('", "', $anoEx).'"';

?>

<script>
  // Drawing a pie chart with padding and labels that are outside the pie
   new Chartist.Pie('#chart1', {
    labels: [<?php echo $financiamento; ?>],
    series: [<?php echo $quantidade; ?>]
}, {
  donut: true,
  donutWidth: 90,
  startAngle: 270,
  total: 100
});

  // Initialize a Line chart in the container with the ID chart2
  new Chartist.Bar('#chart2', {
    labels: [<?php echo $area_qpa; ?>],
    series: [[<?php echo $qtd_qpa; ?>]]
  });

  // Initialize a Line chart in the container with the ID chart2
  new Chartist.Bar('#chart3', {
    labels: [<?php echo $area_qpp; ?>],
    series: [[<?php echo $qtd_qpp; ?>]]
  });

  // Drawing a pie chart with padding and labels that are outside the pie
   new Chartist.Pie('#chart4', {
	   labels: [<?php echo $mBolsa; ?>],
	   series: [<?php echo $qBolsa; ?>]
}, {
  donut: true,
  donutWidth: 90,
  startAngle: 270,
  total: 100
});

   new Chartist.Line('#chart5', {
	   labels: [<?php echo $ano; ?>],
	   series: [[<?php echo $countAno; ?>]]
	 }, {
	   low: 0,
	   showArea: true
	 });
	 
  // Initialize a Line chart in the container with the ID chart2
  new Chartist.Bar('#chart6', {
    labels: [<?php echo $exArea; ?>],
    series: [[<?php echo $exQtd; ?>]]
  });

  new Chartist.Line('#chart7', {
	   labels: [<?php echo $anoPes; ?>],
	   series: [[<?php echo $countPes; ?>]]
	 }, {
	   low: 0,
	   showArea: true
	 });

  new Chartist.Line('#chart8', {
	   labels: [<?php echo $anoEx; ?>],
	   series: [[<?php echo $countEx; ?>]]
	 }, {
	   low: 0,
	   showArea: true
	 });

</script>


    </div>
      <?php require_once('footer.php');?>
    </main>

    
    <?php require_once('assets-footer.php');?>

  </body>
</html>