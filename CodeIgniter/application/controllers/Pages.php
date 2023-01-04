<?php
/*====================================================================
// Nom du Fchier : Pages.php
//Auteur : Adil Zaim
//Date de Creation : 08/11/2022
//version: 
//++++++++++++++++++++++++++++++++++++++++++++++++
//Description
//Ce controleur gere la navigation dans les pages.
//
//----------------------------------------//
// A noter:
//=============================================================*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {
	/*-----------------------------
	fonction mombres de gestion de la navigation.
	------------------------------*/
	public function afficher($page = 'index.php')
	{
		if(!file_exists(APPPATH.'views/pages/'.$page)){
			show_404();
		}
		if($page == 'index.php'){
			$this->actualites();
			
		}else{
			$this->load->view('templates/header');
			$this->load->view('pages/'.$page);
			$this->load->view('templates/footer');
		}
		
		
	}

	/*-----------------------------
	fonction mombre affiche toutes les actualités.
	------------------------------*/
	public function actualites(){
		
		if($this->db_model->get_matchs_exist()){
			$data['match_exist'] = 'yes'; 
		}else{
			$data['match_exist'] = 'no'; 
		}
		//recuperation de tout les actualite.
		$data['posts'] =  $this->db_model->get_posts();
	    if(empty($data['posts'])){
			$data['title'] = 'Acunne Actualité pour le moment :';
		}else{
			$data['title'] = 'Toutes les actualités :';
		}
		$this->load->view('templates/header');
		$this->load->view('pages/index', $data);
		$this->load->view('templates/footer');
	}
/*-----------------------------
	fonction mombre affiche une actualite particulier.
	------------------------------*/
	public function actualite($idAct = NULL){
		//recuperation de tout les actualite.
		if($this->db_model->get_matchs_exist()){
			$data['match_exist'] = 'yes'; 
		}else{
			$data['match_exist'] = 'no'; 
		}
		$data['post'] = $this->db_model->get_posts($idAct);
                if(empty($data['post'])){
                    $url=base_url().''; header("Location:$url");
                }
				
              
                $data['title'] = $data['post']->act_intitule;
                $this->load->view('templates/header');
                $this->load->view('pages/actualite', $data);
                $this->load->view('templates/footer');
		
	}
}
