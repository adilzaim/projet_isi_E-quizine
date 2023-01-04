<?php
/*====================================================================
// Nom du Fchier : match.php
//Auteur : Adil Zaim
//Date de Creation : 08/11/2022
//version: dev
//++++++++++++++++++++++++++++++++++++++++++++++++
//Description
//Ce controleur gére la navigation dans les pages admin et l'authontification danss l'application.
//
//----------------------------------------//
// A noter:
//=============================================================*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Compte extends CI_Controller {

	/*-----------------------------
	fonction mombres qui fait la gestion de la navigation.
	------------------------------*/
	public function naviger($page = 'index.php')
	{
		if(!file_exists(APPPATH.'views/admins/'.$page)){
			show_404();
		}
		if($page == 'register.php'){
			$this->changer_password_admin();
		}
		if($page == 'index.php'){
			$data['pfls'] = $this->db_model->get_all_about_profil();
			$data['role_admin'] = $this->db_model->get_role_admin($this->session->userdata('username'));
			$this->load->view('templates/header_admin',$data);
			$this->load->view('admins/index',$data);
			$this->load->view('templates/footer_admin');
			
		}else{
			$data['pfls'] = $this->db_model->get_all_about_profil();
			$data['role_admin'] = $this->db_model->get_role_admin($this->session->userdata('username'));
			$this->load->view('templates/header_admin',$data);
			$this->load->view('admins/'.$page);
			$this->load->view('templates/footer_admin');
		}
		
		
	}
	/*-----------------------------
	fonction mombres qui affiche un match dont sont id est passer au parametre.
	------------------------------*/
	public function connecter(){

 $this->load->helper('form');
 $this->load->library('form_validation');

 $this->form_validation->set_rules('pseudo', 'pseudo', 'required|regex_match[/[a-zA-Z]/]',array(
	'regex_match'      => 'Veillez Bien verifier le code: Un caractéresnon autorisé',
	'required'      => 'Veillez Bien saisir votre pseudo!'));

 $this->form_validation->set_rules('mdp', 'mdp', 'required|regex_match[/[a-zA-Z]/]',array(
            'regex_match'      => 'Veillez Bien verifier votre pseudo: Un caractére non autorisé',
            'required'      => 'Veillez Bien saisir votre mot de passe !'));

 if ($this->form_validation->run() == FALSE)
 {
	$this->load->view('templates/header');
	$this->load->view('pages/signin');
	$this->load->view('templates/footer');
 }
 else
 {
	$username = $this->input->post('pseudo');
	$password = $this->input->post('mdp');
	$salt = "OnRajouteDuSelPourAllongerleMDP123!!45678__Test";
	$password = hash('sha256', $salt.$password);

	if($admin = $this->db_model->connect_compte($username,$password))
	{
		$session_data = array('username' => $username );
		$this->session->set_userdata($session_data);
		$data['pfls'] = $this->db_model->get_all_about_profil();
		$data['role_admin'] = $this->db_model->get_role_admin($this->session->userdata('username'));

		
		$this->load->view('templates/header_admin',$data);
		$this->load->view('admins/index',$data);
		$this->load->view('templates/footer_admin');
	}
	else
	{ 
		$data['erreur_identifiant'] = 'Identifiants ou mot de passe erronés ou inexistants ! ';
		$this->load->view('templates/header');
		$this->load->view('pages/signin',$data);
		$this->load->view('templates/footer');
	}
 }
}
   /*--------------------------------------------------
        fonction mombres qui permet la deconnexion d'un gestionnaire .
    ---------------------------------------------------*/
 public function Deconnexion(){
			
	//removing session data 
		$this->session->unset_userdata('username'); 
		$this->load->view('templates/header');
		$this->load->view('pages/signin');
		$this->load->view('templates/footer');

 }
    /*--------------------------------------------------
        fonction mombres qui affiche le profile de l'admin connecté.
     ---------------------------------------------------*/
 public function Profile_admin(){
	$data['pfl_admin'] = $this->db_model->data_profil_admin();
	if(!empty($data)){
		$data['role_admin'] = $this->db_model->get_role_admin($this->session->userdata('username'));
		$this->load->view('templates/header_admin',$data);
		$this->load->view('admins/profile_admin',$data);
		$this->load->view('templates/footer_admin');
	}else{
		$this->Deconnexion();
	}
 }
    /*--------------------------------------------------
        fonction mombres qui permet de gerer la modification du mot de passse d'un gestionnaire .
        ---------------------------------------------------*/
 public function changer_password_admin(){
	$data['pfl_admin'] = $this->db_model->data_profil_admin();
	if(!empty($data)){
		$data['role_admin'] = $this->db_model->get_role_admin($this->session->userdata('username'));
		$this->load->view('templates/header_admin',$data);
		$this->load->view('admins/register',$data);
		$this->load->view('templates/footer_admin');
	}else{
		$this->Profile_admin();
	}
 }
 	/*--------------------------------------------------
        fonction mombres qui permet d'afficher les comptes pour un administrateur  .
        ---------------------------------------------------*/
 public function affiche_Comptes(){
	$data['pfls'] = $this->db_model->get_all_about_profil();
	$data['role_admin'] = $this->db_model->get_role_admin($this->session->userdata('username'));
	$data['compte_ok'] = 'ok';
	$this->load->view('templates/header_admin',$data);
	$this->load->view('admins/index',$data);
	$this->load->view('templates/footer_admin');
 }
 


}