<?php
    session_start();

    $url = 'http://go-art.herokuapp.com/messages';
    
    $fields = array();
    $fields['message'] = $_POST["contenido"];
    $fields['receptant'] = $_POST["username"];
    $fields['sender'] = $_SESSION["id"];
    $options = array(
        'http' => array(
        'method'  => 'POST',
        'content' => json_encode( $fields ),
        'header'=>  "Content-Type: application/json\r\n" .
                    "Accept: application/json\r\n"
        )
    );
    $context  = stream_context_create( $options );
    $response = file_get_contents( $url, false, $context );

    header("Location: msg_enviados.php");
    die();
?>