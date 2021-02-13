<?php
                        if (isset($_SESSION['user_id'])) { ?>
                    <a class="btn btn-primary btn-block mb-2" href="" data-toggle="modal" data-target="#upload">Enrichir le site</a>

                            <?php 
                            if(isset($msg)){ ?>
                                <div class="alert alert-info">
                                  <strong>PHD Algeria!</strong> <?= $msg ?>
                                </div>
                            <?php } ?>

                            <?php 
                            if(isset($_GET['upload'])){ ?>
                                <div class="alert alert-info">
                                  <strong>PHD Algeria!</strong> Le fichier a été téléchargé avec succès
                                </div>
                            <?php } ?>

                <!-- The Modal -->
              <div class="modal fade" id="upload">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                  
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Enrichir le site</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                      <form class="user" action="index.php" method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                <select class="form-control action" name="domaine" id="domaine" required>
                                <option value="">Choisir un domaine</option>
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
                                <option value="">Choisir la filière</option>
                                </select>
                                </div>

                                <div class="form-group">
                                <select class="form-control" name="wilaya" required>
                                <option value="">Ce fichier est pour la wilaya</option>
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
                                        placeholder="Titre de ce fichier" required>
                                </div>
                                <div class="form-group">
                                    <input type="URL" class="form-control form-control-user" name="url"
                                        placeholder="Si vous possédez le lien des fichiers dans Google Drive ou le lien YouTube">
                                </div>

                                <p class="text-center"><span style="color: red">OR</span> Upload des fichiers (jpg, docx, xlsx, pptx, pdf, zip, rar)</p>
                                 <div class="custom-file mb-3">
                                 <input type="file" class="custom-file-input" id="customFile" name="fileToUpload">
                                 <label class="custom-file-label" for="customFile">Choisir un fichier </label>
                                 </div>

                                <input type="submit" name="submit" class="btn btn-primary btn-user btn-block" value="Enrichir le site">
                            </form>
                    </div>
                    
                    <!-- Modal footer  -->
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    
                  </div>
                </div>
              </div>

              <?php } ?>