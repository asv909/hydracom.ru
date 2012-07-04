<?php

include_once 'SaltAndHashGenerator.php';

echo 'Соль: ' . $salt = SaltAndHashGenerator::SaltGen();
echo '<br/>';
echo 'Логин: ' . SaltAndHashGenerator::$login . '<br/>';
echo 'Пароль: ' . SaltAndHashGenerator::$passwd . '<br/>';
echo 'Параметр: ' . SaltAndHashGenerator::$param . '<br/>';
echo 'ХЭШ-1: ' . SaltAndHashGenerator::HashGen($salt);
echo '<br/>Сравниваем:<br/>';
echo 'ХЭШ-2: ' . SaltAndHashGenerator::checkHash($salt);