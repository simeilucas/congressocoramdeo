<?php
    # Validação se está em teste ou não;
    define("IS_SANDBOX", false); 
    define("AUTO_RETURN", "approved");

    define("TABLE_INSCRICAO", "wp_inscricao_congressocoramdeo");
    define("TABLE_PAGAMENTO", "wp_pagamento_congressocoramdeo");
    define("TABLE_EMAIL", "wp_email");
    define("TABLE_SORTEADOS","wp_sorteados");
    define("TABLE_KIT", "wp_pegou_kit");
    
    define("DIA_SORTEIO", "dia_cinco_manha");

    define("VALOR_CONGRESSO",30);
    define("QUANTIDADE", "1");
    define("URL", "congressocoramdeo.com");

    ## Informações ambiente de TESTES;
    define("ACCESS_TOKEN_SANDBOX", "TEST-6283098671109909-100618-e8418d5b2a8bf16ab6c1b31832ebd3df-148447347");
    define("PUBLIC_KEY_SANDBOX", "TEST-24b90cc8-994d-4b6e-bf94-d89ec15e89f0");

    define("URL_SUCCESS_SANDBOX","https://congressocoramdeo.com/index.php/pagamento-realizado/");
    define("URL_FAILURE_SANDBOX","https://congressocoramdeo.com/index.php/falha-pagamento/");
    define("URL_PENDING_SANDBOX","https://congressocoramdeo.com/index.php/pagamento-pendente/");
    define("NOTIFICATION_URL_SANDBOX","https://congressocoramdeo.com/wp-content/themes/congressocoramdeo/notification.php");
    

    ## Informações ambiente PRODUÇÃO;
    define("PUBLIC_KEY", "APP_USR-0b4d2b17-da34-4b95-976f-bb361232a5e1");
    define("ACCESS_TOKEN","APP_USR-6283098671109909-100618-c4e101b54d5d9e8cb5c34b54761035ce-148447347");
    define("CLIENT_ID","6283098671109909");
    define("CLIENT_SECRET","P74MOrfEfIp7gzctFj1ltJjacct3UEDz");

    define("URL_SUCCESS","https://congressocoramdeo.com/index.php/pagamento-realizado/");
    define("URL_FAILURE","https://congressocoramdeo.com/index.php/falha-pagamento/");
    define("URL_PENDING","https://congressocoramdeo.com/index.php/pagamento-pendente/");
    define("NOTIFICATION_URL","https://congressocoramdeo.com/wp-content/themes/congressocoramdeo/notification.php");
    

?>