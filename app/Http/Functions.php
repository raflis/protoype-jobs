<?php

function getRole($id)
{
    $roles=['2'=>'Usuario normal','1'=>'Supervisor','0'=>'Administrador'];
    return $roles[$id];
}