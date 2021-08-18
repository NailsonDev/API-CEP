<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CEP - Buscar endereço</title>
</head>
<body>
    <?php 

        if(isset($_POST['procurando'])){
            if(empty($_POST['buscar'])){
                echo 'É necessário colocar um CEP válido!';
            }else{
                
                $cep = $_POST['buscar'];
                $cepReplace = str_replace('-', '', $cep);

                @$API_CEP = "https://viacep.com.br/ws/{$cepReplace}/json/";
                @$apiRequest = json_decode(file_get_contents($API_CEP)); // Receber o conteúdo da API em Array PHP
        
                // echo '<pre>';
                // print_r($apiRequest);
                // echo '</pre>';

                if($apiRequest == false){
                    echo 'Não consegui achar esse lugar :C';
                }else{
                    $endereco = $apiRequest->logradouro;
                    $complemento = $apiRequest->complemento ?? 'Nenhum';
                    $bairro = $apiRequest->bairro;
                    $cidade = $apiRequest->localidade;
                    $estado = $apiRequest->uf;
                    $ibge = $apiRequest->ibge;
                    $gia = $apiRequest->gia;
                    $ddd = $apiRequest->ddd;
                    $siafi = $apiRequest->siafi;
    
                    echo "
                        Procurando por: {$cep} <br />
                        Endereço: {$endereco} <br />
                        Complemento: {$complemento} <br />
                        Bairro: {$bairro} <br />
                        Cidade: {$cidade} <br />
                        Estado: {$estado} <br /> <br />
    
                        Outros:
                            IBGE: {$ibge} <br />
                            GIA: {$gia} <br />
                            DDD: {$ddd} <br />
                            SIAFI: {$siafi} <br /> 
                    ";
                }
            }
        }
    ?>

    <br />
    <br />

    <form method="post">
        <input type="text" name="buscar" placeholder="12345-000">
        <button type="submit" name="procurando">Pesquisar</button>
    </form>

</body>
</html>