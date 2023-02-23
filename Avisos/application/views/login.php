<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/login.css")?>">
    <title>Area de redirecionamento</title>
</head>
<body>
    <section>
        <div class = 'login'>
            <h1>Aba de Direcionamento</h1>
            <?php
                echo form_open_multipart();
                echo form_input(array(
                    'name' => 'username',
                    'value' => '',
                    'placeholder' => $value,
                    'class' => 'user'
                ));
                echo form_input(array(
                    'name' => 'enviar',
                    'type' => 'submit',
                    'class' => 'botao',
                    'value' => 'Funcionário'
                ));
                echo form_input(array(
                    'name' => 'enviar',
                    'type' => 'submit',
                    'class' => 'botao',
                    'value' => 'Geral'

                ));
                echo form_input(array(
                    'name' => 'enviar',
                    'type' => 'submit',
                    'class' => 'botao',
                    'value' => 'Diretoria'

                ));
                echo form_close();
                ?>
        </div>
        
    </section>
</body>
</html>