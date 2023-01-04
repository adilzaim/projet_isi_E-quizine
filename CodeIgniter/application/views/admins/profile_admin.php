

<?php  if ($this->session->userdata('username') == null){
    $url = base_url();
   redirect($url.'index.php/signin.php');
}?>

<style>
    .gradient-custom {
/* fallback for old browsers */
background: #f6d365;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1))
}
</style>

<section class="vh-100" style="background-color: #f4f5f7;">
  <div class="container py-2 h-100">
    <div class="row d-flex justify-content-center  h-100">
      <div class="col col-lg-12 mb-1 mb-lg-0">
        <div class="card mb-3" style="border-radius: .5rem;">
          <div class="row g-0">
            <div class="col-md-4 gradient-custom text-center text-white"
              style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
              <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                alt="Avatar" class="img-fluid my-5" style="width: 80px;" />
              <h4>Pseudo : <?=$this->session->userdata('username'); ?></h4>
            </div>
            
            <div class="col-md-8">
              <div class="card-body p-4">
                <h6>Information</h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                <div class="col-6 mb-3">
                    <h6>Nom</h6>
                    <p class="text-muted"><?= $pfl_admin->pfl_nom?></p>
                  </div>
                  <div class="col-6 mb-3">
                    <h6>Prenom</h6>
                    <p class="text-muted"><?= $pfl_admin->pfl_prenom?></p>
                  </div>
                  <div class="col-6 mb-3">
                    <h6>Email</h6>
                    <p class="text-muted"><?= $pfl_admin->pfl_email?></p>
                  </div>
                </div>
                <h6>Projects</h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                  <div class="col-10 mb-3">
                    <h6>Statut</h6>
                    <p class="text-muted"><?php if($pfl_admin->pfl_role == 'A'){ echo "Administrateur";}else{echo"Formateur";}?></p>
                  </div>
                  <div class="col-2 mb-3">
                  <a  href="<?=base_url();?>index.php/compte/naviger/register.php"><button type="button" type="submit" class="btn btn-outline-dark">Modifier <i class="fas fa-edit"></i></button></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
