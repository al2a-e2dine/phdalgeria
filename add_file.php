<?php
                        if (isset($_SESSION['user_id'])) { ?>
                    <a class="btn btn-primary btn-block mb-2" href="" data-toggle="modal" data-target="#upload"><?= $lang['23'] ?></a>

                            <?php 
                            if(isset($msg)){ ?>
                                <div class="alert alert-info">
                                  <strong><?= $lang['1'] ?>!</strong> <?= $msg ?>
                                </div>
                            <?php } ?>

                            <?php 
                            if(isset($_GET['upload'])){ ?>
                                <div class="alert alert-info">
                                  <strong><?= $lang['1'] ?>!</strong> <?= $lang['24'] ?>
                                </div>
                            <?php } ?>

                <!-- The Modal -->
              <div class="modal fade" id="upload">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                  
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title"><?= $lang['23'] ?></h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                      <form class="user" action="index.php" method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                <select class="form-control action" name="domaine" id="domaine" required>
                                <option value=""><?= $lang['4'] ?></option>
                                <?php 
                                    $qd="SELECT * FROM `domaine`";
                                    $rd=mysqli_query($dbc,$qd);
                                    while ($rowd=mysqli_fetch_assoc($rd)) { ?>
                                        <option value="<?= $rowd['id'] ?>"><?= $rowd['domaine'] ?></option>
                                    <?php } ?>
                                </select>
                                </div>

                                <div class="form-group">
                                <select class="form-control action" name="filiere" id="filiere" required>
                                <option value=""><?= $lang['5'] ?></option>
                                </select>
                                </div>

                                <div class="form-group">
                                <select class="form-control" name="wilaya" required>
                                <option value=""><?= $lang['6'] ?></option>
                                <?php
                                $q="SELECT DISTINCT wilaya_name,id FROM `algeria_cities`";
                                $r=mysqli_query($dbc,$q);
                                while($row=(mysqli_fetch_assoc($r))){ ?>
                                
                                    <option value="<?= $row['id'] ?>"><?= $row['id']."-".$row['wilaya_name'] ?></option>
                                <?php } ?>
                                </select>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="title"
                                        placeholder="<?= $lang['25'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="URL" class="form-control form-control-user" name="url"
                                        placeholder="<?= $lang['26'] ?>">
                                </div>

                                <p class="text-center"><span style="color: red"><?= $lang['27'] ?></span> <?= $lang['28'] ?></p>
                                 <div class="custom-file mb-3">
                                 <input type="file" class="custom-file-input" id="uploadFile" name="fileToUpload">
                                 <label class="custom-file-label" for="uploadFile"><?= $lang['29'] ?> </label>
                                 </div>

                                 
                                  
                                <input type="submit" name="submit" class="btn btn-primary btn-user btn-block" value="<?= $lang['23'] ?>">

                            </form>
                    </div>
                    
                    <!-- Modal footer  -->
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $lang['21'] ?></button>
                    </div>
                    
                  </div>
                </div>
              </div>

              <?php } ?>