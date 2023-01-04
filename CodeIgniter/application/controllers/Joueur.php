<?php
/*====================================================================
// Nom du Fchier : joueur.php
//Auteur : Adil Zaim
//Date de Creation : 08/11/2022
//version: dev
//++++++++++++++++++++++++++++++++++++++++++++++++
//Description
//Ce controleur gére le formulaire du saisi du match et celui de  du pseudo.
//
//----------------------------------------//
// A noter:
//=============================================================*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Joueur extends CI_Controller {
	/*-----------------------------
	fonction mombres qui verifie de l'existance du match saisie et genere les erreurs selon l'input de l'utilisateur.
	------------------------------*/
	public function matched()
	{ 
        $this->form_validation->set_rules('mch_id', 'mch_id', 'required|regex_match[/[a-zA-Z]/]',array(
            'regex_match'      => 'Veillez Bien verifier le code: Un caractere non autorisé',
            'required'      => 'Veillez Bien remplir le champ !'
            
    ));
    $mch_id = $this->input->post('mch_id');
    // verification de l'existance du match
    if($this->db_model->check_match_exist($mch_id)== false){
       
        $this->form_validation->set_rules('mch_id', 'mch_id', 'required|regex_match[/[a-zA-Z]/]|erreur',array(
            'regex_match'      => 'Veillez Bien verifier le code: Un caractere non autorisé',
            'required'      => 'Veillez Bien remplir le champ !'
            
    ));
        $this->form_validation->set_message('erreur','Code de match inexistant, veuillez saisir le code fourni par votre formateur ! ');
    }
    // verification de la validiter du quiz
    if($this->db_model->check_quiz_desactiver($mch_id)){
        $this->form_validation->set_rules('mch_id', 'mch_id', 'required|regex_match[/[a-zA-Z]/]|erreur',array(
            'regex_match'      => 'Veillez Bien verifier le code: Un caractere non autorisé',
            'required'      => 'Veillez Bien remplir le champ !'
            
    ));
        $this->form_validation->set_message('erreur','Quiz du match désactivé ! ');
    }
    // verification de la validiter du quiz
    if($this->db_model->check_match_passer($mch_id)){
        $this->form_validation->set_rules('mch_id', 'mch_id', 'required|regex_match[/[a-zA-Z]/]|erreur',array(
            'regex_match'      => 'Veillez Bien verifier le code: Un caractere non autorisé',
            'required'      => 'Veillez Bien remplir le champ !'
            
    ));
        $this->form_validation->set_message('erreur','Le match est terminé  ! ');
    }

     // verification de la validiter du match et genere l'erreur
    if($this->db_model->check_match_desactiver($mch_id)){
        $this->form_validation->set_rules('mch_id', 'mch_id', 'required|regex_match[/[a-zA-Z]/]|erreur',array(
            'regex_match'      => 'Veillez Bien verifier le code: Un caractere non autorisé',
            'required'      => 'Veillez Bien remplir le champ !'
            
    ));
    
        $this->form_validation->set_message('erreur','Match désactivé ou non démarré ! ');

    }


        if($this->form_validation->run() ===FALSE){
            
            if($this->db_model->get_matchs_exist()){
                $data['match_exist'] = 'yes'; 
            }else{
                $data['match_exist'] = 'no'; 
            }
           //recuperation de tout les actualite.
		$data['posts'] =  $this->db_model->get_posts();
        
	    if(empty($data['posts'])){
			$data['title'] = 'Aucune actualité pour l\'instant !';
		}else{
			$data['title'] = 'Toutes les actualités :';

		}
		$this->load->view('templates/header');
		$this->load->view('pages/index', $data);
		$this->load->view('templates/footer');
        }else{
            $data['mch_id'] = $this->input->post('mch_id');
            $data['pseudo'] = $this->input->post('pseudo');
            $this->load->view('templates/header');
            $this->load->view('pages/pseudojoueur',$data);
            $this->load->view('templates/footer');
        }
            //  $url=base_url();
            //  redirect($url);
    }
	
/**---------------------------------------------------------------------------------------- */
	/*-----------------------------
	fonction mombres qui verifie que le joueur n'est pas déja 
    inscrit au match demander et le rederiger dans le cas conteraire et genere des erreurs selon leurs nature.
	------------------------------*/
    public function joueurmatch(){
        if(empty($this->input->post('mch_id'))){
              $url=base_url();
              redirect($url);
         }

         $joueur_pseudo =  $this->input->post('pseudo');
         $mch =  $this->input->post('mch_id');
         $this->form_validation->set_rules('pseudo', 'Pseudo', 'trim|required|regex_match[/[a-zA-Z]/]|min_length[3]|max_length[8]',array(
            'regex_match'      => 'Veillez Bien verifier votre pseudo: Un caractere non autorisé',
            'required'        => 'Veillez Bien remplir le champ !', 
            'min_length'      => 'pseudo trop court Veuiler saisir un autre de 3 cracter minimum et 8 maximum !',
            'max_length'      => 'pseudo trop long Veuiler saisir un autre de 3 cracter minimum et 8 maximum !'
            
       ));
       //verification de l'existance du pseudo pour un match et genration d'erreur.
         if($this->db_model->check_joueurmatch_exist($joueur_pseudo ,  $mch)){
            $this->form_validation->set_rules('pseudo', 'Pseudo', 'trim|required|regex_match[/[a-zA-Z]/]|min_length[3]|max_length[8]|erreur',array(
                'regex_match'      => 'Veillez Bien verifier votre pseudo: Un caractere non autorisé',
                'required'      => 'Veillez Bien remplir le champ !',
                'min_length'      => 'pseudo trop court Veuiler saisir un autre de 3 cracter minimum et 8 maximum !',
                'max_length'      => 'pseudo trop long Veuiler saisir un autre de 3 cracter minimum et 8 maximum !'

     
        ));
        $this->form_validation->set_message('erreur','ce pseudo existe déja veillez choisir un autre! ');
         }

        if($this->form_validation->run() === FALSE){
            $data['mch_id'] =  $this->input->post('mch_id');;
            $this->load->view('templates/header');
            $this->load->view('pages/pseudojoueur',$data);
            $this->load->view('templates/footer');
        }else{
            $data['matchs'] = $this->db_model->get_match($this->input->post('mch_id'));
            if(empty($data['matchs'])){
                show_404();
            }
            //tester si insert c'est bien fait 
            $this->db_model->insert_joueurmatch_exist($joueur_pseudo, $mch);
            $data['mch_id'] =  $this->input->post('mch_id');
            $data['pseudo'] = $this->input->post('pseudo');
            $this->load->view('templates/header');
            $this->load->view('pages/match', $data);
            $this->load->view('templates/footer');
           // redirect('https://obiwan.univ-brest.fr/difal3/zzaimad00/dev/CodeIgniter/index.php/match/afficher_match/'.$this->input->post('mch_id'));
        }
    }
    /*--------------------------------------------------
        fonction mombres qui  calcule et d'afficher le score d'un joueur.
        ---------------------------------------------------*/
   public function afficher_mon_score(){
       if(empty($this->input->post('pseudo_joueur'))){
            redirect(base_url());
       }

    $i=0;
    $nbq = $this->input->post('nbquestion');
    $match = $this->input->post('match');
    $pseudo = $this->input->post('pseudo_joueur');
    $repenses = $this->db_model->get_answers($match);
    $score=0.0;
    foreach($repenses as $rep){
        $vrai[] = $rep['rep_reponsechoix'];
    }
 //echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
    while($i<$nbq){
        $r =$this->input->post($i);
        $v =$vrai[$i];
        if(strcmp($v,$r)==0){
            $score++;
        }
        $i++;
    }
    $score = ($score/$nbq)*100;
    
    $data['score_joueur'] = $score;
    $data['pseudo'] = $this->input->post('pseudo_joueur');
    $data['match'] = $this->input->post('match');
   if(!$this->db_model->add_score_joueur($pseudo, $score)){
       $data["score_non_inserer"] = "Votre score n'est pas pris en comptre veiller rafrechir la page !";
   }
    $data['correction_etat'] = $this->db_model->get_correction_etat($match);
    $this->load->view('templates/header');
    $this->load->view('pages/affiche_score', $data);
    $this->load->view('templates/footer');
    
   }

}