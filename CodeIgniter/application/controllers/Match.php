<?php
/*====================================================================
// Nom du Fchier : match.php
//Auteur : Adil Zaim
//Date de Creation : 08/11/2022
//version: dev
//++++++++++++++++++++++++++++++++++++++++++++++++
//Description
//Ce controleur fait le gestion CRUD des matchs.
//
//----------------------------------------//
// A noter:
//=============================================================*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Match extends CI_Controller {
	/*-----------------------------
	fonction mombres qui affiche un match dont sont id est passer au parametre.
	------------------------------*/
	public function afficher_match($id_match = FALSE)
	{
		$data['matchs'] = $this->db_model->get_match($id_match);
                if(empty($data['matchs'])){
					$url = base_url();
					redirect($url);
                }
               
                $this->load->view('templates/header');
                $this->load->view('pages/match', $data);
                $this->load->view('templates/footer');
	}
	/*-----------------------------
	fonction mombres qui affiche les matchs d'un formateur.
	------------------------------*/
	public function matchs_formateur(){
		$data['matchs'] = $this->db_model->get_matchs_formateur();
		$data['role_admin'] = $this->db_model->get_role_admin($this->session->userdata('username'));

		if(!empty($data)){
			$this->load->view('templates/header_admin',$data);
			$this->load->view('admins/matchs', $data);
			$this->load->view('templates/footer_admin');
		}else{
			$this->load->view('templates/header_admin',$data);
			$this->load->view('admins/matchs', $data);
			$this->load->view('templates/footer_admin');
		}
	}
	/*-----------------------------
	fonction mombres qui fait le RESET d'un match.
	------------------------------*/
	public function  Raz_match(){
		$mch = $this->input->post('Raz_mch');
		$this->db_model->raz_match($mch);
		$this->matchs_formateur();
	 }
	 /*-----------------------------
	fonction mombres qui active/desactive un match.
	------------------------------*/
	 public function activer(){
		$mch = $this->input->post('Raz_mch');
		$etat_mch = $this->input->post('etat_mch');
		$this->db_model->update_state_match($mch,$etat_mch);
		$url = base_url();
		redirect($url.'index.php/match/matchs_formateur');
	 }
	  /*-----------------------------
	fonction mombres qui supprime un match.
	------------------------------*/
	 public function supprimer_mch(){
		$sup_mch = $this->input->post('sup_mch');
	
		$this->db_model->delete_one_match($sup_mch);
		$url = base_url();
		redirect($url.'index.php/match/matchs_formateur');
	 }

	  /*-----------------------------
	fonction mombres qui gére le formulaire pour créer un match.
	------------------------------*/
	 public function formulaire_match(){

	   $Strings = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	   $code_generated = substr(str_shuffle($Strings), 8, 8);
		// faire la verification du code 
		while($this->db_model->check_match_exist($code_generated)){
			$Strings = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$code_generated = substr(str_shuffle($Strings), 8, 8);
		}
		$data['code_generated'] = $code_generated;
		$data['matchs'] = $this->db_model->get_quiz_active();
		$data['role_admin'] = $this->db_model->get_role_admin($this->session->userdata('username'));
		$this->load->view('templates/header_admin',$data);
		$this->load->view('admins/formulaire_match', $data);
		$this->load->view('templates/footer_admin');


	 }
	  /*-----------------------------
	fonction mombres qui gére l'ajout d'un match  assiciée a un quize non vide.
	------------------------------*/
	 public function ajouter_match(){
		$code_genrated =  $this->input->post('code_genrated');
        $quiz_choisi  =  $this->input->post('sellist');
        $titre_choisi = $this->input->post('titre_match');
		$date_debut = $this->input->post('datetimeDebut');

		$this->form_validation->set_rules('titre_match', 'titre_match', 'trim|required|min_length[8]',array(
			'required'        => 'Veillez Bien saisir un titre pour le match !',
			'min_length'      => 'le titre est tro court Veuiler saisir un autre de 8 caractéres minimum !'
		  ));
         $this->form_validation->set_rules('sellist', 'sellist', 'trim|required',array(
            'required'        => 'Veillez Bien selectionner un quiz !'  
       ));
       $this->form_validation->set_rules('code_genrated', 'code_genrated', 'trim|required',array(
        'required'        => 'Veillez Bien remplir le champ password connfirmation !'
      ));
	 
	  $this->form_validation->set_rules('datetimeDebut', 'datetimeDebut', 'trim|required',array(
        'required'        => 'Veillez Bien saisir la date de debut du match !'
		
      ));
	 
      if($this->form_validation->run() === FALSE){
        	 $this->formulaire_match();

			}else{
		$exploded = explode( ' ' ,$quiz_choisi);
		$id_quiz_match = $exploded[0];
		
		$data['matchs'] = $this->db_model->get_matchs_formateur();
		if($this->db_model->verify_quiz_vide($id_quiz_match) == false){	
			$data['role_admin'] = $this->db_model->get_role_admin($this->session->userdata('username'));
			$data['match_not_created']  = "Quiz Vide et le match n'est pas créé";
			$this->load->view('templates/header_admin',$data);
			$this->load->view('admins/matchs', $data);
			$this->load->view('templates/footer_admin');
			header("Refresh:3; url=".base_url()."index.php/match/formulaire_match"); 
		}
	// verifier si le quiz est sélectionné	
	elseif(!$this->db_model->check_match_exist($code_genrated)){
       if($this->db_model->add_match($code_genrated, $titre_choisi, $id_quiz_match,$date_debut)){
		if(!empty($data)){
			$data['code_quiz_created'] = $code_genrated;
			$data['role_admin'] = $this->db_model->get_role_admin($this->session->userdata('username'));
			$this->load->view('templates/header_admin',$data);
			$this->load->view('admins/matchs', $data);
			$this->load->view('templates/footer_admin');
			header("Refresh:2; url=".base_url()."index.php/match/matchs_formateur"); 

		}
       }
	}else{
		$data['role_admin'] = $this->db_model->get_role_admin($this->session->userdata('username'));
		$data['match_not_created']  = "le match n'est pas créé";
		$this->load->view('templates/header_admin',$data);
		$this->load->view('admins/matchs', $data);
		$this->load->view('templates/footer_admin');
		header("Refresh:2; url=".base_url()."index.php/match/matchs_formateur"); 
	   }
    }
	 }
 /*-----------------------------
	fonction Callback .
	------------------------------*/
	 public function _verifier_quiz_vide($id_quiz_match){
		// $quz = $this->input->post('titre_match');
		// $exploded = explode( ' ' ,$quz);
		// $id_quiz_match = $exploded[0];
		return $this->db_model->verify_quiz_vide($id_quiz_match);

	 }
	  /*-----------------------------
	fonction membre qui affiche la correction d'un match si autorisé .
	------------------------------*/
	 public function afficher_correction($match){
		$data['matchs'] = $this->db_model->get_match($match);
                if(empty($data['matchs'])){
					$url = base_url();
					redirect($url);
                }
					$data['pseudo_joueur'] = $this->input->post('pseudo');
                $this->load->view('templates/header');
                $this->load->view('pages/match_reponse', $data);
                $this->load->view('templates/footer');
	 }
}
