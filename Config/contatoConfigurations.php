<?php
        
class contatoConfigurations extends \classes\Classes\Options{
          
    protected $menu = array(
        array(
            'menuid' => 'contato',
            'menu'   => 'Contato',
            'url'    => 'contato/index/index',
            'ordem'  => '10',
        )
    );
    
     protected $files   = array(
        'contato/options' => array(
            'title'        => 'Opções de envio de mensagens',
            'descricao'    => 'Exibe as opções de envio de mensagens do plugin contato',
            'visibilidade' => 'webmaster', //'usuario', 'admin', 'webmaster'
            'grupo'        => 'Plugin Contato',
            'path'         => 'contato/options',
            'configs'      => array(
                'CONTATO_SAVE_MESSAGE' => array(
                    'name'          => 'CONTATO_SAVE_MESSAGE',
                    'label'         => 'Salvar mensagens no banco de dados',
                    'type'          => 'enum',//varchar, text, enum
                    'options'       =>  "'true' => 'Sim', 'false' => 'Não'",
                    'default'       => 'true',
                    'value'         => 'true',
                    'value_default' => 'true'
                )
            ),
        ),
    );
}