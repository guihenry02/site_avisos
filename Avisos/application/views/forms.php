<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/forms.css")?>">
    <title>Avisos</title>
</head>
<body>
    <section>
        <?php switch($tela):
            case 'cadastrar':
                echo form_open_multipart();
                echo form_label('Titulo:', 'titulo');
                echo form_input(array(
                    'name' => 'titulo',
                    'minlength' => '10',
                    'maxlength' => '30'
                ));
                echo form_label("Conteúdo:", 'conteudo');
                echo form_textarea('conteudo');
                echo form_label("Nível de Acesso:", 'permissao');
                echo form_dropdown('permissao', array('Geral','Funcionario', 'Diretoria'), 'class = "drop"');
                echo form_label("Tipo de Aviso:");
                ?>
                <div class = "class_check">
                <?php
                echo form_label('Notícia: ', 'check1');
                echo form_input(array(
                    'name'=>'options[]',
                    'id'=>'check1',
                    'type'=>'checkbox',
                    'value' => 'noticia',
                    'class' => 'check_class'
                )
                );
                echo form_label('Atividades: ', 'check2');
                echo form_input(array(
                    'name'=>'options[]',
                    'id'=>'check2',
                    'type'=>'checkbox',
                    'value' => 'atividades',
                    'class' => 'check_class'
                )
                );
                echo form_label('Urgente: ', 'check3');
                echo form_input(array(
                    'name'=>'options[]',
                    'id'=>'check3',
                    'type'=>'checkbox',
                    'value' => 'urgente',
                    'class' => 'check_class'
                )
                );
                echo form_label('Dúvidas: ', 'check4');
                echo form_input(array(
                    'name'=>'options[]',
                    'id'=>'check4',
                    'type'=>'checkbox',
                    'value' => 'duvidas',
                    'class' => 'check_class'
                )
                );
                ?>
                </div>
                <?php
                echo form_button(
                    array("class" => 'btn',
                    "type" => 'submit',
                    "content" => 'Cadastrar')
                );
                echo form_close();
                
                break;

            case 'editar':
                echo form_open_multipart();
                echo form_label('Titulo:', 'titulo');
                echo form_input(array(
                    'name' => 'titulo',
                    'minlength' => '10',
                    'maxlength' => '30'
                ));
                echo form_label("Conteúdo:", 'conteudo');
                echo form_textarea('conteudo');
                echo form_label("Nível de Acesso:", 'permissao');
                echo form_dropdown('permissao', array('Geral','Funcionario', 'Diretoria'), 'class = "drop"');
                echo form_label("Tipo de Aviso:");
                ?>
                <div class = "class_check">
                <?php
                echo form_label('Notícia: ', 'check1');
                echo form_input(array(
                    'name'=>'options[]',
                    'id'=>'check1',
                    'type'=>'checkbox',
                    'value' => 'noticia',
                    'class' => 'check_class'
                )
                );
                echo form_label('Atividades: ', 'check2');
                echo form_input(array(
                    'name'=>'options[]',
                    'id'=>'check2',
                    'type'=>'checkbox',
                    'value' => 'atividades',
                    'class' => 'check_class'
                )
                );
                echo form_label('Urgente: ', 'check3');
                echo form_input(array(
                    'name'=>'options[]',
                    'id'=>'check3',
                    'type'=>'checkbox',
                    'value' => 'urgente',
                    'class' => 'check_class'
                )
                );
                echo form_label('Dúvidas: ', 'check4');
                echo form_input(array(
                    'name'=>'options[]',
                    'id'=>'check4',
                    'type'=>'checkbox',
                    'value' => 'duvidas',
                    'class' => 'check_class'
                )
                );
                ?>
                </div>
                <?php
                echo form_button(
                    array("class" => 'btn',
                    "type" => 'submit',
                    "content" => 'Editar')
                );
                echo form_close();
                
                break;
            case 'excluir':
                echo form_open_multipart();
                echo form_label('Titulo:', 'titulo');
                echo form_input("titulo", set_value('titulo', $noticias->titulo));
                echo form_label("Conteúdo", 'conteudo');
                echo form_textarea('conteudo', set_value('titulo', $noticias->conteudo));
                echo form_button(
                    array("class" => 'btn',
                    "type" => 'submit',
                    "content" => 'Excluir',
                    'name' => 'enviar'
                    )
                );
                echo form_close();
                break;
        endswitch;
?>

    </section>
</body>
</html>