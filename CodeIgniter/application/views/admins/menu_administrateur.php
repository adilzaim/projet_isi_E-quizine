


	<header id="head" class="secondary"></header>

<!-- container -->
<div class="container">

    <ol class="breadcrumb">
        <li><a href="index.html">Home</a></li>
        <li class="active">User access</li>
    </ol>

    <div class="row">
        
        <!-- Article main content -->
        <article class="col-xs-12 maincontent">
            <header class="page-header">
                <h1 class="page-title">Sign in</h1>
            </header>
            
            <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3 class="thin text-center">Bienvenu dans votre espace adminstrateur</h3>
                        <hr>
                        
                        <?php echo validation_errors(); ?>
                        <?php echo form_open('compte/connecter'); ?>
                            <div class="top-margin">
                                <label>Password <span class="text-danger">*</span></label>
                                <input type="password" name="mdp1" class="form-control">
                            </div>
                            <div class="top-margin">
                                <label>Password confirmation<span class="text-danger">*</span></label>
                                <input type="password" name="mdp2" class="form-control">
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-lg-8">
                                    <b><a href="">Forgot password?</a></b>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <button class="btn btn-action" type="submit">Sign in</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            
        </article>
        <!-- /Article -->

    </div>
</div>	<!-- /container -->

