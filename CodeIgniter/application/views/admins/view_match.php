<?php if (($this->session->userdata('username') == null) || ($role_admin->pfl_role == 'A')){
    $url = base_url();
    redirect($url.'index.php/admins/index.php');
} ?>
<?php if(isset($score)): ?>
<div class="row"> <div class="col-4"></div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Taux de réussite est de : <strong><?= $score->avg_score?>%</strong></div>
                                </div>
                            </div>
							</div>

<?php endif; ?>
<hr>
<div class="position-relative">
<div class="row">
	
	<div class="col-md-8 text-info"><strong><h1><?=$matchs[0]['mch_intitule']?></h1></strong></div>
	<div class="col-md-4 premary text-center"><strong><h1><?=$matchs[0]['mch_id']?></h1></strong></div>
</div>
</div>
<hr>

<div class="container">
<?php $question = array();
				foreach($matchs as $match) :?>
				<?php $i = 1;	if(!in_array($match['qes_question'], $question)){
					$question[] = $match['qes_question'];
					$ques = $match['qes_question'];
				
				 ?>
				<tr>
				<strong><h2 class="text-dark bold" scope="row"><?= $match['qes_question'];?>  </h2></strong>
					<ul>
					   <?php  foreach($matchs as $match) :?>		
								<?php if(strcmp($ques, $match['qes_question']) == 0) :?>
                                    <?php if($match['rep_etatchoix'] == 'V' && $correction_autoriser == 'ok'){
                                            $color = "text-dark";
                                    }else{
                                        $color = "text-dark";  
                                    }?>
									<div class="form-check">
  										<input class="form-check-input" type="checkbox" value="<?=$i?>" id="defaultCheck1">
  										<label class="form-check-label <?= $color?>" for="defaultCheck1">
   										 	<?= $match['rep_reponsechoix']; ?>
  										</label>
									</div>
								
								<?php endif  ;?>
						<?php endforeach //fermetur de foreach ?>
					</ul>
				</tr>
				<?php $i++; } endforeach ;?> 
			</tbody>
			<?php $id = $matchs[0]['mch_id'];?>
        </div>
		<?php if(!isset($score)): ?>	
		<?php echo form_open('modification/afficher_score_moyenne/'.$id); ?>
        <div class="row">
            <div class="col-5"> </div>
           <div class="col-6"> <button type="submit" class="btn btn-primary btn-lg">Terminer Le Match</button></div>
        </div>
		<?php endif;?>
		</form>
