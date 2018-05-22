<?php 

    session_start(); 

    include "../conexion/conexion.php"; 
    $clase = new sistema;
    if (!isset($_SESSION["dni"])) {
        header("location: ../login.php");
    }

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
                        <h3 class="text-themecolor">Alumnos</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Lista alumnos</li>
                        </ol>
                    </div>
                    <div class="col-md-7 align-self-center">
                        <a href="#" class="btn waves-effect waves-light btn-primary btn-circle pull-right hidden-sm-down"><i class="fa fa-plus"></i></a>
                    </div>
                </div>


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-success">Buscar alumnos</h5>

                                <div class="row">
                                    <div class="col-2"></div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="sel1">Año</label>
                                            <select class="form-control" id="year">
                                                <option value="">-Seleccioné-</option>
                                                <?php 
                                                    $year_now = date('Y');
                                                    for ($i=0; $i < 5; $i++) { 
                                                        ?>
                                                        <option value="<?php echo $year_now?>"><?php echo $year_now?></option>
                                                        <?php
                                                        $year_now--;
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="sel1">Grupo</label>
                                            <select class="form-control " id="grups">
                                                <option value="">-Selecione año-</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <a href="##" class="btn btn-success" style="margin-top: 28px;" id="search_all"> <i class="fa fa-search"></i> Buscar</a>
                                    </div>

                                </div>
                                <div class="col-12">
                                    <div class="" id="search_list">
                                        
                                    </div>
                                </div>

                                
                            </div>
                        </div>
                    </div>

                </div>




                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->

</div>
<!-- =================FOOTER================ -->
<?php include '../extends/footer.php' ?>
<!-- =================END - FOOTER================ -->
<script>

$(document).ready(function() {
    //cargamos regiatroa
    $("#year").on('change', function(){
        var year = $(this).val();
        if (year) {
            $.ajax({
                url : "php/anios.php?id="+year,
                type : 'GET',
                success : function(data){
                    $("#grups").html(data);
                }
            });
        }else{
            alert("Seleccione un Año")
        }

    });

    $('#search_all').on('click', function(){
        var year            = $("#year").val();
        var grups           = $("#grups").val();

        var data ={
            year    :year,
            grups   :grups 
        }

        $.ajax({
            url : "php/searchxgrups.php",
            type : 'POST',
            data : data,
            success : function(response){
                $("#search_list").html(response);
            }
        });
    });

});
</script>