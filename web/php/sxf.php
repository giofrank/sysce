<?php
    header('Content-Type: text/html; charset=iso-8859-1'); 
    include_once "xbd.php";

    $ObjetoBD=new BaseDatos();



    $dni                = htmlentities(addslashes($_POST['dni']));
    $cod_alumno         = mysql_escape_string($_POST['cod_alumno']);
    // $cod_alumno         = "18-001";
    $response_recaptcha = $_POST['g-recaptcha-response'];

    

    if (isset($response_recaptcha)&& $response_recaptcha) {
        $secret_id="6Ldxul0UAAAAAI4A_j1dvaruNg7gnp1bwzihJFWr";
        $ip=$_SERVER['REMOTE_ADDR'];
        $validation_server= file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret_id&response=$response_recaptcha&remoteip=$ip");
        $validation = json_decode($validation_server, TRUE);
        if ($validation['success'] ==TRUE) {

            $parametros=array($cod_alumno, $dni);

            $rc=$ObjetoBD->RetornaConsulta("SELECT * FROM ALUMNO
                INNER JOIN PERSONA ON ALUMNO.id_person = PERSONA.id_persona
                WHERE ALUMNO.codigo=? AND PERSONA.dni=?",$parametros);

            if($rc[1]->rowCount() > 0 ){
                $data = $rc[1]->fetchAll(PDO::FETCH_ASSOC);

                $key = $data[0]["id_alumno"];


                $param=array($key);

                $filterData=$ObjetoBD->RetornaConsulta("SELECT ALUMNO_GRUPO.id_alumno_grupo, GRUPO.*, NOTA.* FROM ALUMNO_GRUPO
                    INNER JOIN GRUPO ON ALUMNO_GRUPO.id_grupo = GRUPO.id_grupo
                    INNER JOIN NOTA ON NOTA.id_alumno = ALUMNO_GRUPO.id_alumno
                    WHERE ALUMNO_GRUPO.id_alumno=?",$param);
                if ($filterData[1]->rowCount() > 0 ) {
                    $datagroup = $filterData[1]->fetchAll(PDO::FETCH_ASSOC);
                ?>

                <div class="header" id="divHeader">
                    <div class="col-md-10 col-md-offset-1">
                        <img src="images/cecin2.png" class="imgLogo">
                    </div>
                </div>
                <div class="card border-primary">
                    <div class="card-header bg-primary">
                        <h3 class="text-white">Resultado de Busqueda</h3> 
                    </div>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row col-md-12">
                                <div class="col-md-2"><h5>Datos:</h5></div>
                                <div class="col-md-8"><?php echo $data[0]["a_paterno"]." ".$data[0]["a_materno"].", ".$data[0]["nombres"]; ?>
                                    
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-danger btn-sm" onClick="location.href=location.href">Atras</button>
                                    
                                </div>

                            </div>
                        </li>
                        <li class="list-group-item">



                            <div class="table-responsive m-t-20 no-wrap">
                                <table class="table vm no-th-brd pro-of-month">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Grupo</th>
                                            <th>Teoria y Trab.</th>
                                            <th>Evaluacion Final</th>
                                            <th>Promedio</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($datagroup as $value) { ?>
                                    
                                        <tr>
                                            <td>
                                                <h6><?php echo $value['nombre'] ?></h6><small class="text-muted">Inicio: <?php echo $value['f_inicio'] ; ?></small></td>
                                                <td><span class="label label-info label-rounded">
                                                <?php 
                                                switch ($value['state']) {
                                                    case 'A':
                                                        echo "APROBADO";
                                                        break;
                                                    
                                                    case 'P':
                                                        echo "PENDIENTE";
                                                        break;
                                                }

                                                 ?>
                                                 </span>
                                                </td>
                                                <td><?php echo $value['nota1'] ; ?></td>
                                                <td><?php echo $value['nota2'] ; ?></td>
                                                <td><?php echo $value['promedio'] ; ?></td>
                                            </tr>
                                      <?php  } ?>
                                            </tbody>
                                        </table>
                                    </div>


                                </li>
                                <li class="list-group-item">Todos los derechos por CECIN</li>
                            </ul>
                        </div>
            <?php 
                }else{ ?>
                    <div class="header" id="divHeader">
                        <div class="col-md-10 col-md-offset-1">
                            <img src="images/cecin2.png" class="imgLogo">
                        </div>
                    </div>
                    <div class="card border-primary">
                        <div class="card-header bg-primary">
                            <h3 class="text-white">Criterios de Busqueda</h3> 
                        </div>
                        <div class="card-body">
                            <div class="alert alert-warning" role="alert">
                            <strong>Aviso!</strong> Datos no encontrados.
                            <button class="btn btn-danger btn-sm" onClick="location.href=location.href">Atras</button>
                          </div>
                      </div>
                    </div>
               <?php  }
            }else{ ?>
                <div class="header" id="divHeader">
                        <div class="col-md-10 col-md-offset-1">
                            <img src="images/cecin2.png" class="imgLogo">
                        </div>
                    </div>
                    <div class="card border-primary">
                        <div class="card-header bg-primary">
                            <h3 class="text-white">Criterios de Busqueda</h3> 
                        </div>
                        <div class="card-body">
                            <div class="alert alert-warning" role="alert">
                            <strong>Aviso!</strong> Datos no encontrados.
                            <button class="btn btn-danger btn-sm" onClick="location.href=location.href">Atras</button>
                          </div>
                      </div>
                    </div>
           <?php  }
            
     }else{ ?>
            <div class="header" id="divHeader">
                        <div class="col-md-10 col-md-offset-1">
                            <img src="images/cecin2.png" class="imgLogo">
                        </div>
                    </div>
                    <div class="card border-primary">
                        <div class="card-header bg-primary">
                            <h3 class="text-white">Resultados</h3> 
                        </div>
                        <div class="card-body">
                            <div class="alert alert-warning" role="alert">
                            <strong>Aviso!</strong> reCAPCHA invalido.
                            <button class="btn btn-danger btn-sm" onClick="location.href=location.href">Atras</button>
                          </div>
                      </div>
                    </div>
  <?php }
        
     }else{ ?>
            <div class="header" id="divHeader">
                        <div class="col-md-10 col-md-offset-1">
                            <img src="images/cecin2.png" class="imgLogo">
                        </div>
                    </div>
                    <div class="card border-primary">
                        <div class="card-header bg-primary">
                            <h3 class="text-white">Resultados</h3> 
                        </div>
                        <div class="card-body">
                            <div class="alert alert-warning" role="alert">
                            <strong>Aviso!</strong> reCAPCHA no  encontrado.
                            <button class="btn btn-danger btn-sm" onClick="location.href=location.href">Atras</button>
                          </div>
                      </div>
                    </div>
  <?php }
?>
            