<?php if (($this->session->userdata('username') == null)  || ($role_admin->pfl_role == 'A')){
    $url = base_url();
    redirect($url.'index.php/admins/index.php');
} ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Register - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <h1 >code match serai : <?=$code_generated?></h1>
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Creation d'Un Match</h3></div>
                                    <div class="card-body">
                                    <?php  if(validation_errors() != null): ?>
                                        <div class="alert alert-warning text-center pb-0 pt-0" role="alert">
                                        <p><strong><?= validation_errors();?> </strong></p>
                                        </div>
							        <?php endif; ?>
                                    <?php  if(isset($password_changed)): ?>
                                        <div class="alert alert-success text-center pb-0" role="alert">
                                        <p><strong><?= $password_changed;?> </strong></p>
                                        </div>
							        <?php endif; ?>
                                    <?php echo form_open('match/ajouter_match'); ?>
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                       <input  type="hidden" name="code_genrated" value="<?=$code_generated?>"/>
                                                        <input class="form-control" id="inputFirstName" name="titre_match" type ="text" placeholder="Enter your first name" />
                                                        <label for="inputFirstName">titre du match</label>
                                                    </div>
                                                </div>
                                          
                                                
                                            </div>
                                            <div class="form-floating mb-3">
                                            <select class="form-select" aria-label="Default select example" name="sellist">
                                                     <option selected></option>
                                                    <?php foreach($matchs as $match) : $quiz = array();?>
                                                             <option><?=$match['quz_id']?> <?=$match['quz_intitule']?></option>
                                                    <?php endforeach;?>

                                                </select>
                                                <label for="inputEmail">Selectionner le quiz</label>
                                            </div>
                                            <div class="col-md-12">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                       <input  type="hidden" name="code_genrated" value="<?=$code_generated?>"/>
                                                        <input class="form-control" id="date" name="datetimeDebut" type="datetime-local"  placeholder="Enter your first name" />
                                                        <label for="date">titre du match</label>
                                                    </div>
                                           <br>

                                            <!-- <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" name="mdp1" id="mdp1" type="password" placeholder="Create a password" />
                                                        <label for="inputPassword">Password</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" name="mdp2" id="mdp2" type="password" placeholder="Confirm password" />
                                                        <label for="inputPasswordConfirm">Confirm Password</label>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <div class="row mt-8 mb-0 ">
                                            
                                                    <button type="submit" class=" col-6 btn btn-primary btn-block mr-2 d-grid">Ajouter</button>
                                                    <div class="col-6 d-grid"><a class="btn btn-warning btn-block" href="<?=base_url(); ?>index.php/match/matchs_formateur">Anuller</a></div>                                            
                                                </div>
                                            
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="login.html">Have an account? Go to login</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
