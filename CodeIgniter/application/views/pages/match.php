<hr>
<div class="position-relative"><br><br><br><br><br><br><br><br><br><br>
<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-5 text-info"><strong><h1><?=$matchs[0]['mch_intitule']?></h1></strong></div>
	<div class="col-md-4 premary"><strong><h1><?=$matchs[0]['mch_id']?></h1></strong></div>
</div>
</div>
<hr>
<div class="container">
<?php echo form_open('joueur/afficher_mon_score'); ?>
	<?php if (isset($pseudo)):?>
		<input type="hidden" value="<?=$pseudo?>" name="pseudo_joueur">
		<input type="hidden" name="match" id="exampleRadios1" value="<?=$matchs[0]['mch_id']?>">
		<?php endif; ?>
		<div class="row">
            <div class="col-5"> </div>
		
<?php $question = array();
			$i=0;	foreach($matchs as $match) :?>
				<?php	if(!in_array($match['qes_question'], $question)){
					$question[] = $match['qes_question'];
					$ques = $match['qes_question'];
				
				 ?>
				<tr>
				<strong><h2 class="text-dark bold" scope="row"><?= $match['qes_question'];?>  </h2></strong>
					<ul>
					   <?php foreach($matchs as $match) :?>		
								<?php if(strcmp($ques, $match['qes_question']) == 0) :?>
									<?php $color = "text-dark"; ?>
                                    <?php if($match['rep_etatchoix'] == 'V'){
                                            $color = "text-dark";
                                    }else{
                                        $color = "text-dark";  
                                    }?>
									<div class="form-check">
									<input class="form-check-input" type="radio" name="<?=$i?>" id="exampleRadios1" value="<?= $match['rep_reponsechoix'] ?>">
									<label class="form-check-label <?=$color?>" for="exampleRadios1">
   										 	<?= $match['rep_reponsechoix']; ?>
  										</label>
									</div>

								<?php endif  ;?>
						<?php endforeach //fermetur de foreach ?>
					</ul>
				</tr>
				<?php $i++; } endforeach ; ?> 
				<input type="hidden" name="nbquestion" id="exampleRadios1" value="<?= $i?>">
			</tbody>
			</div>
			<div class="row">
            <div class="col-5"> </div>
           <div class="col-6 " style=" margin-left: 40%;"> <button type="submit" class="btn btn-primary btn-lg">Evnoyer Mes Réponse</button></div>
         </div>
		 </form>