<?php include('./layouts/header.php');



function formatDate($data, $ano_fixo = 2000) {
  
    $data_formatada = DateTime::createFromFormat('d/m', $data);
    if ($data_formatada === false) {

        $data_formatada = DateTime::createFromFormat('Y-m-d', $data);

        if ($data_formatada === false) {
            throw new Exception("Erro ao formatar a data: $data");
        }
        $data_formatada->setDate($ano_fixo, $data_formatada->format('m'), $data_formatada->format('d'));
    } else {
        $data_formatada->setDate($ano_fixo, $data_formatada->format('m'), $data_formatada->format('d'));
    }

    return $data_formatada;
}

function obterSigno($data_nasc, $ano){
    $signos = simplexml_load_file("signos.xml");

    $data_nasc_formated = formatDate($data_nasc, $ano);
    
    $nome_signo = "";
    $desc_signo = "";
    
    foreach ($signos as $signo ){
        $data_inicial_signo = str_contains($signo->dataInicio, '12') ?
             formatDate($signo->dataInicio, $ano - 1) 
             : formatDate($signo->dataInicio, $ano);
             
        $data_final_signo = formatDate($signo->dataFim, $ano);
    
        if($data_inicial_signo)
        if ( $data_nasc_formated >= $data_inicial_signo 
            && $data_nasc_formated <= $data_final_signo ) 
            {
                $nome_signo = $signo->signoNome;
                $desc_signo = $signo->descricao;
                break;
            } 
    }
    
    $response = new stdClass();
    $response->signo = $nome_signo;
    $response->descricao = $desc_signo;

    return $response;
}

function renderizarResultado($resultado){
    echo "<body>

    <div class='d-flex flex-column align-items-center justify-content-center vh-100 text-white'>
        
        <div class='w-100 text-center p-5'>
            <h1 class='display-1 d-block'>$resultado->signo</h1>
            <p class='fs-3'>$resultado->descricao</p>
            <a href='index.php' class='btn btn-dark mt-3'>Voltar</a>
        </div>
    
    </div>

    <script src='https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.bundle.min.js'></script>
</body>

</html>
";
}

$data_nasc= $_POST['data_nascimento'] ??'';

$ano = explode('-', $data_nasc)[0];

$resultado =  obterSigno($data_nasc, $ano);

renderizarResultado($resultado);

?>

