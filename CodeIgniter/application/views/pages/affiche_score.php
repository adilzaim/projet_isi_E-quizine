<br><br><br><br><br><br><br><br>

<?php if(isset($score_joueur)): ?>
    <div class="container">
    <div class="alert alert-info  text-center pb-0 pt-0" role="alert">
               					 <p><strong>Votre Score est de : <?=$score_joueur?>  %</strong></p>
            					</div>
                                
<?php endif; ?>

<?php if(isset($score_non_inserer)): ?>
    <div class="container">
    <div class="alert alert-danger  text-center pb-0 pt-0" role="alert">
               					 <p><strong> <?=$score_non_inserer?></strong></p>
            					</div>
                                
<?php endif; ?>
<?php if(isset($correction_etat[0]['mch_correction_visibilite']) && $correction_etat[0]['mch_correction_visibilite'] == 'O') :?>
    <?= form_open('match/afficher_correction/'.$match); ?>
    <input type="hidden" name="pseudo" value=<?=$pseudo?>>
    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
           <button type="submit"class="btn btn-primary btn-lg" role="button">Voir la Correction</button>
   </div>
   </form>
    <?php endif; ?>
    </div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>