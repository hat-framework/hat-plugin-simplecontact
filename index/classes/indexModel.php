<?php

class contato_indexModel extends \classes\Model\Model{
     
    protected $tabela = "contato_index";
    protected $pkey   = "cod";
    
    public function inserir($dados) {
        if(true === getBoleanConstant('CONTATO_SAVE_MESSAGE')){
            if(false === parent::inserir($dados)) {return false;}
        }
        return $this->sendMessage($dados);
    }
    
    private function sendMessage($post){
        $this->LoadResource('email', 'email')->configure($post['assunto'], $post['texto'], $post['email'], $post['nome']);
        $this->email->AddAddress(SITE_EMAIL);
        if(false === $this->email->send()){
            $this->setSuccessMessage("");
            return $this->setErrorMessage("Falha ao enviar o email. Os administradores do sistema foram notificados do problema!");
        }
        return $this->setSuccessMessage("Mensagem enviada com sucesso!");
    }
    
}