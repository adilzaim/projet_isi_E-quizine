<div class="position-relative"><br><br><br><br><br><br><br><br><br><br>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-4 text-info"><strong>
                <h1></h1>
            </strong></div>
        <div class="col-md-4"></div>
    </div>
</div>

<!-- Header -->

<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <h1 class="lead">Pseudo</h1>
            <!-- <p class="tagline">PROGRESSUS: free business bootstrap template by <a href="http://www.gettemplate.com/?utm_source=progressus&amp;utm_medium=template&amp;utm_campaign=progressus">GetTemplate</a></p> -->
            <p>
                <?php  if(validation_errors() != null): ?>
            <div class="alert alert-warning text-center"style="max-width: 90%;" role="alert">
                <p><strong><?= validation_errors();?> </strong></p>
            </div>
            <?php endif;?>
            <?= form_open('joueur/joueurmatch'); ?>
            <?php if(isset($mch_id)) :?>
            <input type="hidden" value="<?=$mch_id?>" name="mch_id">
            <?php endif ; ?>
            <input type="text" class="btn btn-default btn-lg" name="pseudo">
            <button class="btn btn-action btn-lg" role="button">Participer au match</button></p>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<!-- /Header -->