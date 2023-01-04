<?php
/*====================================================================
// Nom du Fchier : match.php
//Auteur : Adil Zaim
//Date de Creation : 08/11/2022
//version: 
//++++++++++++++++++++++++++++++++++++++++++++++++
//Description
//Ce controleur gere maodification du mot de passe l'affichge du match et le score moyenne .
//
//----------------------------------------//
// A noter:
//=============================================================*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Modification extends CI_Controller {
	/*-----------------------------
	fonction mombres qui pemet de gerer la modiication du mot de passe des gestionnaire.
	------------------------------*/
	public function modifier_mdp(){
        $admin_mdp1 =  $this->input->post('mdp1');
        $admin_mdp2 =  $this->input->post('mdp2');
        $pseudo = $this->session->userdata('username');
         $this->form_validation->set_rules('mdp1', 'Mdp1', 'trim|required|min_length[8]|max_length[12]',array(
            'regex_match'      => 'Veillez Bien verifier votre pseudo: Un caractére non autorisé',
            'required'        => 'Veillez Bien remplir le champ password !', 
            'min_length'      => 'mot de passe trop court Veuiler saisir un autre de 8 caractéres minimum et 12 maximum !',
            'max_length'      => 'pseudo trop long Veuiler saisir un autre de 8 caractéres minimum et 12 maximum !'  
       ));
       $this->form_validation->set_rules('mdp2', 'Mdp2', 'trim|required|min_length[8]|max_length[12]|matches[mdp1]',array(
        'regex_match'      => 'Veillez Bien verifier votre pseudo: Un caractére non autorisé',
        'required'        => 'Veillez Bien remplir le champ password connfirmation !', 
        'min_length'      => 'mot de passe trop court Veuiler saisir un autre de 8 caractéres minimum et 12 maximum !',
        'max_length'      => 'pseudo trop long Veuiler saisir un autre de 8 caractéres minimum et 12 maximum !',
        'matches'        => 'Confirmation du mot de passe erronée, Veuillez réessayer.'  
      ));
      $data['pfl_admin'] = $this->db_model->data_profil_admin();

      if($this->form_validation->run() === FALSE){
        $this->load->view('templates/header_admin');
		    $this->load->view('admins/register',$data);
		    $this->load->view('templates/footer_admin');
    }else{
        $salt = "OnRajouteDuSelPourAllongerleMDP123!!45678__Test";
        $password = hash('sha256', $salt.$admin_mdp1);
        $data['password_changed'] = "Votre Mot de pass a bien été modifier !";
       if($this->db_model->update_password($password)){
        $this->load->view('templates/header_admin');
		    $this->load->view('admins/register',$data);
		    $this->load->view('templates/footer_admin');
       }
    }

    }
    /*--------------------------------------------------
        fonction mombres qui affiche le match passer en pramétre.
        ---------------------------------------------------*/
    public function afficher_match($macth){
        $data['matchs']=$this->db_model->get_afficher_match($macth);
        
        if( $data['matchs'] == false){
          $url=base_url();
          redirect($url.'index.php/match/matchs_formateur');
      
        }else{
          if($data['matchs'][0]['mch_date_fin']!=null){
            $data['score'] = $this->db_model->get_score_match($macth);
          }
          if($data['matchs'][0]['mch_correction_visibilite'] == 'O' && $data['matchs'][0]['mch_date_fin']!=null){
            $data['correction_autoriser'] = "ok";
          }else{ $data['correction_autoriser'] = "no";}
          $data['role_admin'] = $this->db_model->get_role_admin($this->session->userdata('username'));
          
          $this->load->view('templates/header_admin',$data);
         $this->load->view('admins/view_match',$data);
          $this->load->view('templates/footer_admin');
        }
     }
     /*--------------------------------------------------
        fonction mombres qui affiche le score moyenne d'un match.
        ---------------------------------------------------*/
     public function afficher_score_moyenne($id_match){
      
      $data['matchs']=$this->db_model->get_match($id_match);
        if( $data['matchs'] == false){
          $url=base_url();
          redirect($url.'index.php/match/matchs_formateur');
      
        }else{
        
         $this->load->view('templates/header_admin');
         $this->load->view('admins/view_match',$data);
        $this->load->view('templates/footer_admin');
        }
    }
    

    }