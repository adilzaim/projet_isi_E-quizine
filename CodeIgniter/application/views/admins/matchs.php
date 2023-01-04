
<?php if (($this->session->userdata('username') == null) || ($role_admin->pfl_role == 'A')){
    $url = base_url();
    redirect($url.'index.php/admins/index.php');
} ?>

        <?php echo $role_admin->pfl_role; ?>
        <?php if(isset($code_quiz_created)) {?>
        <div class="card text-white bg-success mb-3 ml-5 mr-6" >
        <div class="card-header text-center"><h1>Le match dont l'id = <?=$code_quiz_created?> a bien été Creer</h1></div>
        </div>
        <?php }?>

        <?php if(isset($match_not_created)) {?>
        <div class="card text-white bg-danger mb-3 ml-5 mr-6" >
        <div class="card-header text-center"><h1> Erreur :<?=$match_not_created?> </h1></div>
        </div>
        <?php }?>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                DataTable Example
            </div>
            <a href="<?=base_url();?>index.php/match/formulaire_match" class="btn btn-primary btn-sm mb-0 mt-2" style="margin-right:2%;margin-left:85%; "><i class="fas fa-plus"></i> Creer un Match</a>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>quiz_intitule</th>
                                            <th>auteur_quiz</th>
                                            <th>match_id</th>
                                            <th>intitueleMatch+auteur+datefin</th>
                                            <th>lancer raz superimer activer desactiver</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        
                                        <tr>
                                        
                                            <th>quiz_intitule</th>
                                            <th>auteur_quiz</th>
                                            <th>Code_match</th>
                                            <th>intitueleMatch+auteur+datefin</th>
                                            <th>lancer raz superimer activer desactiver</th>

                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        
                                        <!-- gggggggggggggggggggggggggggggggggg -->
                                    <?php foreach($matchs as $match):?>
                                    
                                        <tr>
                                            <td><?=$match['quz_intitule']?></td>
                                            <td><?=$match['auteur']?></td>
                                            <td><?=$match['mch_id']?></td>
                                            <td><a class="btn btn-info btn-block btn-sm" href="<?=base_url(); ?>index.php/modification/afficher_match/<?=$match['mch_id']?>"><?=$match['mch_intitule']?></a>+ <?=$match['posteur']?>  fini le   <?=$match['mch_date_fin']?></td>  
                                          
                                            <td style="display:flex;">
                                            <?php if($match['posteur'] == $this->session->userdata('username')) :?>
                                                <?php echo form_open('match/raz_match'); ?>
                                                <input type="hidden" name="Raz_mch" class="btn btn-warning btn-block" placeholder="Reset" value="<?=$match['mch_id']?>">
                                                <button type="submit" class="btn btn-warning btn-block mr-3">Reset</button>
                                                <!-- </form> -->
                                                <?= form_close(); ?>
                                                <?php echo form_open('match/supprimer_mch'); ?>
                                                <input type="hidden" name="sup_mch" class="btn btn-warning btn-block" placeholder="Reset" value="<?=$match['mch_id']?>"> 
                                                <button type="submit" class="btn btn-secondary btn-block" style ="margin-left:10%;">supprimer</button>
                                            <!-- </form> -->
                                            <?= form_close(); ?>
                                            
                                            <?php echo form_open('match/activer'); 
                                                if($match['mch_etat'] == 'A'){
                                                    $class = "danger";
                                                    $text = "Desactiver";
                                                }else{
                                                    $class = "success";
                                                    $text = "Activer";
                                                } ?>
                                             <input type="hidden" name="Raz_mch" class="btn btn-warning btn-block"  value="<?=$match['mch_id']?>"> 
                                             <input type="hidden" name="etat_mch" class="btn btn-warning btn-block"  value="<?=$match['mch_etat']?>"> 
                                             <button type="submit" class="btn btn-<?=$class?> btn-block" style ="margin-left:20%;">
                                             <?=$text?>
                                             </button>
                                             <?= form_close(); ?>
                                             <!-- </form> -->
                                                <?php endif;?>
                                            </td>
                                            </form>
                                            
                                        </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                        
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Primary Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Warning Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Success Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Danger Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Area Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Bar Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>
                   
               