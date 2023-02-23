<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/pages.css")?>">
    <title>Painel de Avisos</title>
</head>
<body>
    <header>
        <h1>Portal de Avisos</h1>
            <div class="icons">
                <a href="<?php echo base_url("index.php/noticia/cadastrar") ?>"><button><img src="https://img.icons8.com/ios/512/add--v1.png" alt="" id="icons_0"></button></a>
                <a href="<?php echo base_url("index.php/noticia/filtrar") ?>" id='icons_1'><button><img src="https://cdn-icons-png.flaticon.com/512/2319/2319177.png" alt="" id="icons_0"></button></a>
            </div>
    </header>

        <?php 
        switch($tela1):
            case 'geral':
            if(isset($noticias) and sizeof($noticias) > 0):?>
                <thead>
                    <div class="tool-bar">
                        <th><h2>Remetente</h2></th>
                        <th><h2>Assunto</h2></th>
                        <th><h2>Data</h2></th>
                        <th><h2>Permissão</h2></th>
                    </div>
                </thead>    
                <?php 
                endif;
                if(isset($noticias) and sizeof($noticias) > 0):
                    foreach($noticias as $noticias):
                        if($noticias->nivel_permissao == 0):
                            $noticias->nivel_permissao = 'Geral';
                        else:
                            if($noticias->nivel_permissao == 1):
                                $noticias->nivel_permissao = 'Funcionário';
                            else:
                                $noticias->nivel_permissao = 'Diretoria';
                            endif;
                        endif;
                    ?>

                <table>
                    <tbody>
                        <tr class="row">
                            <td><button id= 'visualizar'><?php echo anchor('noticia/post/'.$noticias->id, '<img src="https://cdn-icons-png.flaticon.com/512/2874/2874780.png" alt ="" id="btn_image">');?></button></td>
                            <td><h2 class = 'conteudos' name="remetente" id = 'campo_0'><?php echo $noticias->remetente; ?></h2></td>
                            <td><h2 class = 'conteudos' name="assunto" id = 'campo_1'> <?php echo $noticias->titulo; ?> </h2></td>
                            <td><h2 class = 'conteudos' name="data" id = 'campo_2'> <?php echo $noticias->data; ?></h2></td>
                            <td><h2 class = 'conteudos' name="permissao" id = 'campo_3'> <?php echo $noticias->nivel_permissao; ?> </h2></td>
                            <td><button id= 'deletar'><?php echo anchor('noticia/excluir/'.$noticias->id, '<img src="https://cdn-icons-png.flaticon.com/512/25/25008.png" alt="" id="btn_image">');?></button></td>
                            <td><button id= 'editar'><?php echo anchor('noticia/editar/'.$noticias->id, '<img src="https://cdn-icons-png.flaticon.com/512/6492/6492748.png" alt="" id="btn_image">');?></button></td>
                        </tr>
                    </tbody>
                </table>
                <?php endforeach;?>
                <?php 
                else:
                    echo '<div class= "card">';
                    echo '<div class ="upper_text">';
                        echo '<h1>Nenhuma notícia foi cadastrada no Sistema!</h1>';
                        echo '<h3>Gênero do texto: Aviso</h3>';
                    echo "</div>;";

                    echo "<div class='content'> <p>Nenhuma notícia foi encotrada no sistema. Clique no canto superior direito para adicionar uma notícia!</p></div>";           
                echo "</div>;";
                endif;
                break;
                case 'filtrar':

                if($check_filtro == TRUE):
                    echo form_open();
                    echo form_label('Envie o filtro: ','filtro_titulo');
                    echo form_input(array(
                        'name' => 'filtro_titulo',
                        'placeholder' => $value
                    ));
                    echo form_submit('enviar', 'Enviar Resultado', 'class = "filtro"');
                    echo form_close();
                else:
                    if(isset($noticias) and sizeof($noticias) > 0):?>
                        <thead>
                            <div class="tool-bar">
                                <th><h2>Remetente</h2></th>
                                <th><h2>Assunto</h2></th>
                                <th><h2>Data</h2></th>
                                <th><h2>Permissão</h2></th>
                            </div>
                        </thead>    
                        <?php 
                        endif;
                        if(isset($noticias) and sizeof($noticias) > 0):
                            foreach($noticias as $noticias):
                                if($noticias->nivel_permissao == 0):
                                    $noticias->nivel_permissao = 'Geral';
                                else:
                                    if($noticias->nivel_permissao == 1):
                                        $noticias->nivel_permissao = 'Funcionário';
                                    else:
                                        $noticias->nivel_permissao = 'Diretoria';
                                    endif;
                                endif;

                            ?>
        
                        <table>
                            <tbody>
                                <a href="#">
                                    <tr class="row">
                                        <td><button id= 'visualizar'><?php echo anchor('noticia/post/'.$noticias->id, '<img src="https://cdn-icons-png.flaticon.com/512/2874/2874780.png" alt ="" id="btn_image">');?></button></td>
                                        <td><h2 class = 'conteudos' name="remetente" id = 'campo_0'><?php echo $noticias->remetente; ?></h2></td>
                                        <td><h2 class = 'conteudos' name="assunto" id = 'campo_1'> <?php echo $noticias->titulo; ?> </h2></td>
                                        <td><h2 class = 'conteudos' name="data" id = 'campo_2'> <?php echo $noticias->data; ?></h2></td>
                                        <td><h2 class = 'conteudos' name="permissao" id = 'campo_3'> <?php echo $noticias->nivel_permissao; ?> </h2></td>
                                        <td><button id= 'deletar'><?php echo anchor('noticia/excluir/'.$noticias->id, '<img src="https://cdn-icons-png.flaticon.com/512/25/25008.png" alt="" id="btn_image">');?></button></td>
                                        <td><button id= 'editar'><?php echo anchor('noticia/editar/'.$noticias->id, '<img src="https://cdn-icons-png.flaticon.com/512/6492/6492748.png" alt="" id="btn_image">');?></button></td>
                                    </tr>
                                </a>
                                
                            </tbody>
                        </table>
                        <?php endforeach;
                        
                        else:
                            if($noticias == NULL):
                                echo '<div class= "card">';
                                echo '<div class ="upper_text">';
                                    echo '<h1>Parâmetros não encotrados!</h1>';
                                    echo '<h3>Gênero do texto: Aviso</h3>';
                                echo "</div>;";

                                echo "<div class='content'> <p>Nenhum Valor foi encontrado para esses parâmetros</p></div>";           
                            echo "</div>;";
                            else:
                                echo '<div class= "card">';
                                    echo '<div class ="upper_text">';
                                        echo '<h1>Nenhuma notícia foi cadastrada no Sistema!</h1>';
                                        echo '<h3>Gênero do texto: Aviso</h3>';
                                    echo "</div>;";

                                    echo "<div class='content'> <p>Nenhuma notícia foi encotrada no sistema. Clique no canto superior direito para adicionar uma notícia!</p></div>";           
                                echo "</div>;";
                            endif;
                        endif;

                    endif;
                    break;

                    case 'ler':
                        if(isset($noticias)):
                            if (($_SESSION['permissao'] == $noticias->nivel_permissao) or ($noticias->nivel_permissao == 'Geral')):
                        ?>
                        <div class = 'card'>
                            <div class= 'upper_text'>
                                <h1><?php echo $noticias->titulo ?></h1>
                                <h3>Gênero do texto: <?php echo $noticias->tipo_aviso?></h3>

                            </div>

                            <div class = 'content'>
                                <p><?php echo $noticias->conteudo?></p>
                            </div>

                            <div class = 'footer_msg'>
                                <h4>Enviado por <?php echo $noticias->remetente?> na seguinte data: <?php echo $noticias->data?></h4>
                            </div>
                        </div>


                        <?php

                            else:
                                echo '<div class= "card">';
                                    echo '<div class ="upper_text">';
                                        echo '<h1>ERRO!</h1>';
                                        echo '<h3>Gênero do texto: Aviso</h3>';
                                    echo "</div>;";

                                    echo "<div class='content'> <p>Nível de permissão inválido!</p></div>";           
                                echo "</div>;";

                            endif;
                        endif;
                        break;
                    endswitch;
                        ?>




                        

</body>
</html>