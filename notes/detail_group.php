<?php 

    session_start(); 

    include "../conexion/conexion.php"; 
    $clase = new sistema;
    if (!isset($_SESSION["dni"])) {
        header("location: ../login.php");
    }

    $key = $_REQUEST['group'];
    header('Content-Type: text/html; charset=iso-8859-1'); 
?>

<!-- =================================HEADER================ -->
<?php include '../extends/header.php' ?>
<!-- =================================END - HEADER================ -->

<div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">Bienvenido</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Notas</li>
                        </ol>
                    </div>
                    <div class="col-md-7 align-self-center">
                        <a href="#" class="btn waves-effect waves-light btn-primary btn-circle pull-right hidden-sm-down"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <?php 
                    $clase->conexion();
                    $bd_group= mysql_query("SELECT GRUPO.*, ALUMNO.*, PERSONA.* FROM GRUPO
                                INNER JOIN ALUMNO_GRUPO ON GRUPO.id_grupo = ALUMNO_GRUPO.id_grupo
                                INNER JOIN ALUMNO ON ALUMNO_GRUPO.id_alumno= ALUMNO.id_alumno
                                INNER JOIN PERSONA ON ALUMNO.id_person = PERSONA.id_persona
                                WHERE GRUPO.id_grupo='$key'");

                 ?>
                <div class="row">
                    <?php if (mysql_num_rows($bd_group)>0): ?>
                                    
                                        
                                        
                        <div class="col-lg-12">
                            
                            <div class="card">
                            <div class="card-body">
                                
                            

                            <div class="table-responsive m-t-20 no-wrap">
                                    <table class="table vm no-th-brd pro-of-month">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Asignado</th>
                                                <th>Datos</th>
                                                <th>Teoria y Trab.</th>
                                                <th>Evaluacion Final</th>
                                                <th>Promedio</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php while($array = mysql_fetch_array($bd_group)){
                                            $k_a= $array['id_alumno'];
                                            $bd_nota= mysql_query("SELECT NOTA.* FROM GRUPO
                                                        INNER JOIN NOTA ON GRUPO.id_grupo = NOTA.id_grupo
                                                        INNER JOIN ALUMNO ON NOTA.id_alumno = ALUMNO.id_alumno
                                                        WHERE GRUPO.id_grupo='$key' AND ALUMNO.id_alumno='$k_a'");
                                            $arraynotas = mysql_fetch_array($bd_nota);
                                            $array['n1']=$arraynotas['nota1'];
                                            $array['n2']=$arraynotas['nota2'];
                                            $array['pf']=$arraynotas['promedio'];
                                        ?>
                                            <tr>
                                                <td style="width:50px;"><span class="round">A</span></td>
                                                <td>
                                                    <h6><?php echo $array['a_paterno']." ".$array['a_materno'].", ".$array['nombres'] ?></h6><small class="text-muted"><?php echo $array['cargo']." - ".$array['dni'] ?></small></td>
                                                <td><?php echo $array['correo'] ?></td>
                                                <td>
                                                    <input type="number" value="<?php echo $array['n1'] ?>" class="form-control input-sm note_1">
                                                </td>
                                                <td>
                                                    <input type="number" value="<?php echo $array['n2'] ?>" class="form-control input-sm note_2">
                                                </td>
                                                <td>
                                                    <input type="number" style="border-color: #80fff9;" value="<?php echo $array['pf'] ?>" class="form-control input-sm note_f" readonly>
                                                </td>
                                                <td>

                                                    <a href="#" class="btn btn-success save_note" pa="<?php echo $array['id_alumno']?>" pg="<?php echo $array['id_grupo'] ?>" onclick="saveNotas(this,event)"> Guardar</a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                                </div>
                        </div>
                                

                    <?php else: ?>
                        <div class="col">
                            <div class="alert alert-warning" role="alert">
                                <strong>Aviso!</strong> No tiene matriculados en el curso o grupo, comunicate con el administrador.
                            </div>
                        </div>
                    <?php endif ?>

                </div>




                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->

            </div>
<!-- =================FOOTER================ -->
<?php include '../extends/footer.php' ?>
<!-- =================END - FOOTER================ -->

<script>
    $(document).ready( function () {

    } );

    function saveNotas(scope,e){
        e.preventDefault();
        var pg=$(scope).attr('pg');
        var pa=$(scope).attr('pa');
        var n1 = $(scope).parent().parent().find(".note_1").val();
        var n2 = $(scope).parent().parent().find(".note_2").val();

        if (!n1){n1=0}
        if (!n2){n2=0}

        var re = ((parseInt(n1)+parseInt(n2))/2)

        $(scope).parent().parent().find(".note_f").val(Math.round(re));

        var n3 = $(scope).parent().parent().find(".note_f").val();

        if (!n3){n3=0}

        data_edit={
            pg:pg,
            pa:pa,
            n1:n1,
            n2:n2,
            n3:n3
        }
        // readonly
        $.ajax({
            url : 'php/savedata.php',
            type : 'POST',
            data : data_edit,
            dataType: "json",

            success : function(response){
                console.log(response)
                if(response.res==="verdadero"){
                    alert("Guardo con exito")
                }else{
                    alert("no se guardo")
                }
            }
        });
    }
</script>