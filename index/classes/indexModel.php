<?php

class contato_indexModel extends \classes\Model\Model{
     
    protected $tabela = "contato_index";
    protected $pkey   = "cod";
    
    public function inserir($dados) {
        $dados = $this->setUserContact($dados);
        if(true === getBoleanConstant('CONTATO_SAVE_MESSAGE')){
            if(false === parent::inserir($dados)) {return false;}
        }
        return $this->sendMessage($dados);
    }
    
    private function sendMessage($post){
        $this->LoadResource('email', 'email')->configure($post['assunto'], $post['texto'], $post['email'], $post['nome']);
        $this->email->AddAddress(SITE_EMAIL);
        $this->notifyRoles();
        if(false === $this->email->send()){
            $this->setSuccessMessage("");
            return $this->setErrorMessage("Falha ao enviar o email. Os administradores do sistema foram notificados do problema!");
        }
        return $this->setSuccessMessage("Mensagem enviada com sucesso!");
    }
    
    private function notifyRoles(){
        $this->LoadModel('notificacao/notifycount', 'nnc', false);
        if($this->nnc === null || !is_object($this->nnc)){return;}
        if(!defined("Webmaster")){define('Webmaster', 3);}
        $usuarios = $this->LoadModel('usuario/login', 'uobj')->getUsuariosPorPerfil(Webmaster, array('cod_usuario'));
        if(empty($usuarios)){return;}
        foreach($usuarios as $user){
            $this->nnc->addNotify($user['cod_usuario'], 'contato');
        }
    }
    
    public function getContactData(){
        $dados = $this->getDados();
        $cod   = usuario_loginModel::CodUsuario();
        if($cod !== 0){
            unset($dados['nome']);
            unset($dados['email']);
        }
        return $dados;
    }
    
    private function setUserContact($post){
        $cod   = usuario_loginModel::CodUsuario();
        if($cod === 0){return $post;}
        $user = $this->LoadModel('usuario/login', 'uobj')->getItem($cod, "", false, array('user_name', 'email'));
        $post['nome']  = $user['user_name'];
        $post['email'] = $user['email'];
        return $post;
    }
    
    public function setContactMessageRead($cod){
        $post = array('lida' => 's');
        $to = usuario_loginModel::CodUsuario();
        $this->LoadModel('notificacao/notifycount', 'nnc', false);
        if(is_object($this->nnc)){
            $this->nnc->subNotify($to, 'contato');
        }
        return $this->editar($cod, $post);
    }
}