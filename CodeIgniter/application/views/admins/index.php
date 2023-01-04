
<?php  if ($this->session->userdata('username') == null){
    $url = base_url();
   redirect($url.'index.php/signin.php');
}?>
       <?php if(isset($role_admin->pfl_role) && $role_admin->pfl_role == 'A' && isset($compte_ok) && $compte_ok == 'ok'):?>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Compte des Gestionnaire
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Prenom</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Validité</th>
                                            <th>Pseudo</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        
                                        <tr>
                                            <th>Nom</th>
                                            <th>Prenom</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Validité</th>
                                            <th>Pseudo</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php foreach($pfls as $pfl):?>
                                        <tr>
                                            <td><?=$pfl['pfl_nom']?></td>
                                            <td><?=$pfl['pfl_prenom']?></td>
                                            <td><?=$pfl['pfl_email']?></td>
                                            <td><?=$pfl['pfl_role']?></td>
                                            <td><?=$pfl['pfl_validite']?></td>
                                            <td><?=$pfl['cpt_pseudo']?></td>
                                            <td>
                                            <a href="#" class="text-info me-2 infoBtn" data-id="$Bill->id" title="Voir detaile"><i class="fas fa-info-circle"></i></a>
                                            <a href="#" class="text-warning me-2 editBtn" data-id="$Bill->id" title="Modifier" data-bs-toggle="modal" data-bs-target="#updateModal"><i class="fas fa-edit"></i></a>
                                            <a href="#" class="text-danger me-2 deleteBtn" data-id="$Bill->id" title="Supprimer"><i class="fas fa-trash-alt"></i></a></td>
                                        </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                        <?php endif;?>
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
                   
               