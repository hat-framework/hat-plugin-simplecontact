<?php

class contato_indexData extends \classes\Model\DataModel{
    
    protected $dados = array(
    
        'cod' => array(
            'name'    => "Código",
            'pkey'    => true,
            'ai'      => true,
            'type'    => 'int',
            'display' => true,
            'size'    => '11',
            'grid'    => true,
            'private' => true,
            'notnull' => true
         ),
        
        'nome' => array(
            'name'      => 'Nome',
            'type'      => 'varchar',
            'size'      => '128',
            'notnull'   => true,
         ),

        'email' => array(
            'name'     => 'Email',
            'type'     => 'varchar',
            'display'  => true,
            'size'     => '128',
            'search'   => true,
            'notnull'  => true,
            'grid'     => true,
            'especial' => 'email',
         ),

        'assunto' => array(
            'name'     => 'Assunto',
            'type'     => 'varchar',
            'display'  => true,
            'title'    => true,
            'size'     => '128',
            'notnull'  => true,
            'search'   => true,
            'grid'     => true,
         ),

        'texto' => array(
            'name'        => 'Texto',
            'type'        => 'text',
            'display'     => true,
            'search'      => true,
         ),
    );
    
}