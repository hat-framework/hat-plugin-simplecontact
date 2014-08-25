<?php

class indexController extends \classes\Controller\Controller{
    
    public function __construct($vars) {
        $this->LoadModel('contato/index', 'model');
        parent::__construct($vars);
    }
    public function index(){
        if($this->LoadModel('usuario/perfil', 'perf')->hasPermissionByName('CONTATO_ADMINISTRAR')){
            Redirect(LINK . "/messages");
        }
        if(!empty($_POST)){return $this->entrarEmContato($_POST);}
        $this->displayForm();
    }
    
    public function contact(){
        if(!empty($_POST)){return $this->entrarEmContato($_POST);}
        $this->displayForm();
    }
    
    public function messages(){
        if(false === getBoleanConstant('CONTATO_SAVE_MESSAGE')){
            Redirect(LINK."/index");
        }
        $page = isset($this->vars[0])?$this->vars[0]:'0';
        $this->registerVar('item', $this->model->paginate($page, LINK ."/messages"));
        $this->registerVar('component', 'contato/index');
        $this->registerVar('comp_action', 'listInTable');
        $this->display('admin/auto/areacliente/page');
    }
    
    public function show(){
        if(false === getBoleanConstant('CONTATO_SAVE_MESSAGE') || false === isset($this->vars[0])){
            Redirect(LINK."/index");
        }
        $cod = $this->vars[0];
        $this->model->setContactMessageRead($cod);
        $this->registerVar('item', $this->model->getItem($cod));
        $this->registerVar('component', 'contato/index');
        $this->registerVar('comp_action', 'show');
        $this->display('admin/auto/areacliente/page');
    }
    
    private function entrarEmContato($post){
        $bool = $this->model->inserir($post);
        $this->setVars($this->model->getMessages());
        $this->registerVar('status', ($bool === false)?'0':'1');
        if(false === $bool){$this->displayForm();}
        $this->display("contato/index/mensagem_enviada");
    }
    
    private function displayForm(){
        $this->registerVar('dados', $this->model->getContactData());
        $this->genTags("Contato ". SITE_NOME, "envie um email para ". SITE_NOME, 'fale com ' . SITE_NOME);
        $this->display("contato/index/index");
    }
    
}