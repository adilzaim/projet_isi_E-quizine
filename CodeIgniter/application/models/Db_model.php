<?php 
/*====================================================================
// Nom du Fchier : Db_model.php
//Auteur : Adil Zaim
//Date de Creation : 08/11/2022
//version: dev
//++++++++++++++++++++++++++++++++++++++++++++++++
//Description
//Ce Model gere la connexion, recupération, la mosdification et le persistance dans la base de donnée  .
//
//----------------------------------------//
// A noter:
//=============================================================*/
    class Db_model extends CI_Model{
        public function __construct(){
            $this->load->database();
        }
        /*-----------------------------
        fonction mombres recupere toutes les actualitees sous forme d'un tableau associatif.
        ------------------------------*/
        public function get_posts($idAct = FALSE){
            if($idAct == FALSE){
                $query = $this->db->get('t_actualite_act');
             return $query->result_array();
            }
            $query = $this->db->get_where('t_actualite_act', array('act_id'=>$idAct));
            return $query->row();
        }
        
        /*-----------------------------
        fonction mombres recupere un match particulier.
        ------------------------------*/
        public function get_match($id_match = FALSE){
           
            $query = $this->db->query("SELECT * from  t_match_mch c
                                        natural join t_question_qes
                                        natural join t_reponse_rep   
                                        where mch_id='".$id_match."' and mch_date_debut <= now() order by qes_id  ASC;");
            return $query->result_array();
        }
        /*-----------------------------
        fonction mombres verifiante l'existance d'un match et son validiter.
        ------------------------------*/
        public function check_match_exist($mch_id){
            
           /* $query = $this->db->query("SELECT * from  t_match_mch c
                                        natural join t_question_qes
                                        natural join t_reponse_rep   
                                        where mch_id ='".$mch_id."' and mch_date_debut <= now();");*/

         $this->db->select('*');
         $this->db->from('t_match_mch');
         //$this->db->join('t_question_qes', 't_match_mch.quz_id = t_question_qes.quz_id');
        // $this->db->join('t_reponse_rep', 't_question_qes.qes_id = t_reponse_rep.qes_id');
         $this->db->where(array('mch_id =' => $mch_id));
        $query = $this->db->get();   
                      
            if(empty($query->row_array())){
                return false;
            }
           else{ return true;}
        }
         /*-----------------------------
        fonction mombres verifiante si  le quiz associer au match est activer.
        ------------------------------*/
       public function check_quiz_desactiver($mch_id){
        $this->db->select('*');
        $this->db->from('t_match_mch');
        $this->db->join('t_quiz_quz', 't_quiz_quz.quz_id = t_match_mch.quz_id');
        $this->db->where(array('mch_id =' => $mch_id, 'quz_etat =' =>'D'));
       $query = $this->db->get();  
                         
           if(empty($query->row_array())){
               return false;
           }
          else{ return true;}
       }
      /*-----------------------------
        fonction mombres verifiante si  le match associer est descativer ou non demarré.
        ------------------------------*/
       public function check_match_desactiver($mch_id){
        // $query= $this->db->query("select * from t_match_mch
        //          where mch_id = '".$mch_id."' and (mch_etat='D' or mch_date_debut > now())");
                
               $query =  $this->db->get_where('t_match_mch', array('mch_id'=>$mch_id,'mch_etat'=>'D'));
               if(empty($query->row_array())){
                   $query =  $this->db->get_where('t_match_mch', array('mch_id'=>$mch_id,'mch_date_debut >'=>date("Y-m-d H:i:s")));
                } 

           if(!empty($query->row_array())){
               return true;
           }
          else{ 
            return false;}
       }


       public function check_match_passer($mch_id){
        $query =  $this->db->get_where('t_match_mch', array('mch_id'=>$mch_id,'mch_date_fin <'=>date("Y-m-d H:i:s")));
          if($query->num_rows()>0){
            return true;
          }else{
            return false;
          }
       }
      /*-----------------------------
        fonction mombres verifiante le joueur est deja inscrit dans le match.
        ------------------------------*/
        public function check_joueurmatch_exist($joueur_pseudo, $mch_code){
            $query = $this->db->get_where('t_joueur_joe', array('mch_id' => $mch_code,'joe_pseudo' => $joueur_pseudo ));
            if(!empty($query->row_array())){
            
                return true;
            }
           else{ 
               return false;
            }
        }
         /*-----------------------------
        fonction mombres d'insertion du joueur avec un score 0.
        ------------------------------*/
        public function insert_joueurmatch_exist($joueur_pseudo, $mch_code){

           return  $this->db->insert('t_joueur_joe', array('mch_id' => $mch_code,'joe_pseudo' => $joueur_pseudo, 'score'=>0));
            
        }
         /*-----------------------------
        fonction mombres recuperant tout les match  .
        ------------------------------*/
        public function get_matchs_exist(){
            return  $this->db->get('t_match_mch');
        }
        /*-----------------------------
        fonction mombres qui  recupére tout les match  .
        ------------------------------*/
        public function connect_compte($username, $password) {

            $query =$this->db->query("SELECT * FROM t_responsableCompte_cpt
                                        natural join t_responsableProfil_pfl
                                             WHERE cpt_pseudo='".$username."'
                                                AND cpt_motDePasse='".$password."' and pfl_validite = 'A';");
              return $query->result_array();

           /*                                     
            if($query->num_rows() > 0)
            {
            return true;
            }
            else
            {
            return false;
            }*/
        }
       
       /*---------------------------------------------------------------------------------
                                    partie administration
        --------------------------------------------------------------------------------*/ 
        /*-------------------------------------------------------------
        fonction mombres qui modifier le mot de passe d'un gestionnaire  .
        --------------------------------------------------------------*/
       public function update_password($password){
        $this->db->where('cpt_pseudo' , $this->session->userdata('username'));
        return  $this->db->update('t_responsableCompte_cpt', array('cpt_motDePasse' => $password));
       }
       /*--------------------------------------------------
        fonction mombres qui récupere tous les donnés d'un profil .
        ---------------------------------------------------*/
       public function get_all_about_profil(){
        $query = $this->db->query("SELECT * FROM t_responsableProfil_pfl");
        return  $query->result_array();
       }
        /*--------------------------------------------------
        fonction mombres qui récupere les donnés d'un profil connecté .
        ---------------------------------------------------*/
       public function data_profil_admin() {
        $username = $this->session->userdata('username');
        $query =$this->db->query("SELECT * FROM t_responsableProfil_pfl 
                                    natural join t_responsableCompte_cpt
                                         WHERE cpt_pseudo='".$username."';");
        return $query->row() ;
      }
         /*--------------------------------------------------
        fonction mombres qui récupere le match créer par un formateur .
        ---------------------------------------------------*/
      public function get_matchs_formateur(){
        $username = $this->session->userdata('username');
        $query =$this->db->query("SELECT t.mch_intitule,t.mch_id,t.mch_etat, t.mch_date_debut, t.mch_date_fin, t.mch_correction_visibilite, t.cpt_pseudo as posteur,q.quz_intitule, q.cpt_pseudo as auteur  
        FROM t_match_mch t
   	    join t_quiz_quz q using(quz_id)
        where q.quz_etat = 'A';");
        return $query->result_array() ;
      }
         /*--------------------------------------------------
        fonction mombres qui récupere les données d'un match particulier .
        ---------------------------------------------------*/
      public function get_afficher_match($id_match = FALSE){
           
        $query = $this->db->query("SELECT * from  t_match_mch c
                                    natural join t_question_qes
                                    natural join t_reponse_rep   
                                    where mch_id='".$id_match."' ");
        return $query->result_array();
    }


/*
      public function paly_match($match){
        $username = $this->session->userdata('username');
        $query =$this->db->query("UPDATE `t_match_mch` SET `mch_date_debut` = now(), mch_date_fin = null
                                    WHERE `t_match_mch`.`mch_id` = '".$match."' and cpt_pseudo='".$username."';");
            if($query){
                return $this->get_match($match);
            }
            return false;

      }
*/
         /*--------------------------------------------------
        fonction mombres qui récupere reupére et calcule le score totale d'un match.
        ---------------------------------------------------*/
      public function get_score_match($id_match){
        $query0 =$this->db->query("UPDATE `t_match_mch` SET `mch_date_fin` = now()
                                    WHERE `t_match_mch`.`mch_id` = '".$id_match."';");
       
        $query = $this->db->query("SELECT ROUND(avg(score)) as avg_score FROM t_joueur_joe
        WHERE mch_id='".$id_match."';");
       
        
        return $query->row() ;
      
      }
         /*--------------------------------------------------
        fonction mombres mis a jour la date de debut et de fin d'un match pour declanché le truggers qui faite le RESET du match.
        ---------------------------------------------------*/
      public function raz_match($mch){
        $query0 =$this->db->query("UPDATE `t_match_mch` SET `mch_date_debut` = now() + INTERVAL 1 DAY, `mch_date_fin`  = null
        WHERE `t_match_mch`.`mch_id` = '".$mch."';");
      }
         /*--------------------------------------------------
        fonction mombres qui mis à jour l'etat d'un  match .
        ---------------------------------------------------*/
      public function update_state_match($mch,$etat_mch){
        if($etat_mch == 'D'){
            $query0 =$this->db->query("UPDATE `t_match_mch` SET mch_etat ='A'
            WHERE `t_match_mch`.`mch_id` = '".$mch."';");
            }else{
                $query0 =$this->db->query("UPDATE `t_match_mch` SET mch_etat ='D'
                WHERE `t_match_mch`.`mch_id` = '".$mch."';");
            } 
      }
         /*--------------------------------------------------
        fonction mombres qui rsupprime un match et ses données .
        ---------------------------------------------------*/
      public function delete_one_match($sup_mch){
        $this->raz_match($sup_mch);
        // $query0 =$this->db->query("DELETE from `t_match_mch` 
        //                              WHERE `t_match_mch`.`mch_id` = '".$sup_mch."';");
        $query0 =$this->db->query('CALL delete_one_match(?)', array('mch_id'=>$sup_mch));
                                     
                                     
      }
         /*--------------------------------------------------
        fonction mombres qui récupere les quiz actif .
        ---------------------------------------------------*/
      public function get_quiz_active(){
        $query =$this->db->query("select distinct * from t_quiz_quz where quz_etat = 'A'");
        return $query->result_array();
      }
         /*--------------------------------------------------
        fonction mombres qui ajoute un match dont le code et gérer.
        ---------------------------------------------------*/
      public function add_match($code_genrated, $titre_choisi, $id_quiz_choisi, $date_debut){

        return $this->db->insert('t_match_mch', array('cpt_pseudo'=>$this->session->userdata('username'),'mch_id' => $code_genrated,'mch_intitule' => $titre_choisi, 'quz_id'=>$id_quiz_choisi, 'mch_date_debut'=>$date_debut,'mch_correction_visibilite'=>'N', 'mch_etat'=>'D'));;
      }
         /*--------------------------------------------------
        fonction mombres qui récupere le role du gestionaire connecté a l'application .
        ---------------------------------------------------*/
     public function get_role_admin($pseudo){
      $query =$this->db->query("select  * from t_responsableProfil_pfl where cpt_pseudo = '".$pseudo."'");
      return $query->row();
     }
        /*--------------------------------------------------
        fonction mombres qui récupere les reponses du quiz d'un match dans un ordre particulier.
        ---------------------------------------------------*/
     public function get_answers($match){
      $query0 =$this->db->query("SELECT distinct `rep_reponsechoix`, qes_id from t_quiz_quz c 
                                   left join t_question_qes USING(quz_id)
                                   left join t_reponse_rep USING(qes_id)
                                   left join t_match_mch USING(quz_id)
                                   where c.quz_id in (select quz_id from t_match_mch where mch_id ='".$match."') and `rep_etatchoix`='V' order by qes_id ASC;");
      return $query0->result_array();
    }
       /*--------------------------------------------------
        fonction mombres qui récupere l'etate de voir la correction d'un match .
        ---------------------------------------------------*/
    public function get_correction_etat($match){
      $query = $this->db->query("SELECT mch_correction_visibilite from  t_match_mch 
      where mch_id='".$match."'");
      return $query->result_array();
    }
       /*--------------------------------------------------
        fonction mombres mis à jour le score du joueur aprés la fin de sont match .
        ---------------------------------------------------*/
    public function add_score_joueur($pseudo,$score){
     return $query = $this->db->query("UPDATE  t_joueur_joe  SET score = '".$score."' WHERE joe_pseudo = '".$pseudo."'");
    }
       /*--------------------------------------------------
        fonction mombres qui verifier si un quiz est vide.
        ---------------------------------------------------*/
    public function verify_quiz_vide($id_quiz_match){
      $query = $this->db->query("select * from t_reponse_rep 
                                     where qes_id in (select qes_id from t_question_qes where quz_id ='".$id_quiz_match."')");
      return $query->result_array();
    }
	
    }
       
