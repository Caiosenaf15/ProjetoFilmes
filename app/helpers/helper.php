<?php

function userFormat($username) {
    if (empty($username)) {
        return '';
    }

    $tamanho = mb_strlen($username);

    return strtoupper(mb_substr($username, 0, 1, 'UTF-8')).mb_substr($username, 1, $tamanho - 1, 'UTF-8');
}
