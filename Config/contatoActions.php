<?php

use classes\Classes\Actions;
class contatoActions extends Actions{
    
    protected $permissions = array(
        
        "CONTATO_ENTRAR" => array(
            "nome"      => "CONTATO_ENTRAR",
            "label"     => "Entrar em contato",
            "descricao" => "Permissão para que um usuário entre em contato com o site",
            'default'   => 's',
        ),
        
        "CONTATO_ADMINISTRAR" => array(
            "nome"      => "CONTATO_ADMINISTRAR",
            "label"     => "Administrar plugin de contato",
            "descricao" => "Permite gerenciar departamentos e tipos de assunto ",
            'default'   => 'n',
        ),
    
    );
    
    protected $actions = array( 
        
        "contato/index/index" => array(
            "label" => "Contato", "publico" => "s", "default" => "n",
            "permission" => "CONTATO_ENTRAR",
            "menu" => array()
        ),
        
    );
}