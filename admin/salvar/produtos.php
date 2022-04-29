<?php
    if(!isset($page)) exit;

    // if($_POST){
    //     print_r($_POST);
    //     print_r($_FILES);
    // }

    //Recuperar os dados enviados.
    foreach($_POST as $key => $value){
        $$key = trim($value ?? NULL);
    }

    //Pegar os nomes dos arquivs:
   $imagem1 = $_FILES["imagem1"]["name"] ?? NULL;
   $imagem2 = $_FILES["imagem2"]["name"] ?? NULL;

    //Validar os Campos
    if(empty($valor)){
        mensagemErro("Preencha o Valor!");
    }else if (empty($categoria_id)){
        mensagemErro("Selecione uma Categoria!!!");
    }else if (empty($nome)){
        mensagemErro("Digite o nome do produto!!!");
    }else if((empty($id)) and (empty($imagem1))){
        mensagemErro("Selecione a primeira imagem!!!");
    }else if((empty($id)) and (empty($imagem2))){
        mensagemErro("Selecione a segunda imagem!!!");
    }

    if((!empty($imagem1))){
        $imagem1 = time()."_{$imagem1}";
        //copiar a imagem para o servidor
        if(!move_uploaded_file($_FILES["imagem1"]["tmp_name"], "../produtos/{$imagem1}")){
            mensagemErro("Erro ao enviar a Imagem 1");
        }
    }
    
    if((!empty($imagem2))){
        $imagem2 = time()."_{$imagem2}";
        //copiar a imagem para o servidor
        if(!move_uploaded_file($_FILES["imagem1"]["tmp_name"], "../produtos/{$imagem1}")){
            mensagemErro("Erro ao enviar a Imagem 1");
        }
    }

    $valor = str_replace(".","",$valor);

    $valor = str_replace(",","",$valor);

    if(empty($id)){
        $sql = "insert into produto (nome, categoria_id, valor, descricao, imamgem1, imagem2 values(:nome, :categoria_id,
        :valor,:descricao, :imagem1, :imagem2)";

        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":nome", $nome);
        $consulta->bindParam(":categoria_id", $categoria_id);
        $consulta->bindParam(":valor", $valor);
        $consulta->bindParam(":descricao", $descricao);
        $consulta->bindParam(":imagem1", $imagem1);
        $consulta->bindParam(":imagem2", $imagem2);
    }

    ?>