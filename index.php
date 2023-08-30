<!DOCTYPE html>
<html lang="en">
    <head>
        <title>GCC</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../estilos.css?n=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DataTablesJuancho</title>
        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="../libs/DataTables/bootstrap/bootstrap-4.0.0/dist/css/bootstrap.min.css">
        <!--CSS PERSONALIZADO-->
        <link rel="stylesheet" href="../libs/DataTables/main.css">
        <!--datatables estilos basico para SELECT-->
        <link rel="stylesheet" type="text/css" href="../libs/DataTables/datatables/Select-1.6.1/css/select.bootstrap.min.css"></link>
        <!--datatables estilos basico-->
        <link rel="stylesheet" type="text/css" href="../libs/DataTables/datatables/DataTables-1.13.2/css/dataTables.bootstrap4.min.css">
        <!--datatables estilos basico para BUTTONS-->
        <link rel="stylesheet" type="text/css" href="../libs/DataTables/datatables/Buttons-2.3.6/css/buttons.bootstrap.min.css"></link>
        <!--datatables estilos JQUERY para alinear y mas-->
        <!--<link rel="stylesheet" type="text/css" href="../libs/DataTables/datatables/DataTables-1.13.2/css/jquery.dataTables.min.css"></link>-->             
	</head>
    <body>
        <h1 class='labelName'>BIENVENID@ <?php 
        $Usuario=$respuesta->nombre();
        echo $Usuario?></h1>
        <!--AJAX, SE DEBE ACTIVA SI NO FUNCIONA AJAX-->
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
        <div id="container1">
            <img src="../IMG/LogoCSJ.png" id="imagenes">
            <div id="list">
                <form>
                    <select id="seccional" class="selectholder" name="seccional">
                        <?php
                        $respuesta->validarSeccionales();
                        //$objeto10->seleccionarAbogado(); //se ejecuta el objeto ya creado en Comprobar.php
                        //print_r($respuesta); 
                        ?>
                    </select>
                    <select name="tipoCartera" id="tipoCartera">
                    <?php
                        $respuesta->seleccionarTipoCartera();
                        
                        ?>
                    </select>
                    <input type="submit" class="btn btn-danger" onclick="listProcesos();return false;"></input> 
                </form>
            </div>
            <section id="loginStat">
                <a href="http://localhost:8081/GCC/Login_FF/login.html">Cerrar Sesion</a></br>  
            </section>
        </div>
        <div id="header">
            <nav> <!-- Aqui estamos iniciando la nueva etiqueta nav -->
                <ul class="nav">
                    <li><a href="#" onclick="inicioMenu();return false;">Inicio</a></li>
                    <!--<li><a href="#" onclick="listChequeo();return false;">Lista de Chequeo</a></li>--><!--llamar funcion javascript desde hipervincuklo-->
                    <li><a href="javascript:json();">Actualización</a></li><!--llamar funcion javascript desde hipervincuklo-->
                    <li><a href="">Autorizaciones</a></li>
                    <li><a href="">Ayuda de GCC</a></li>
                    <li><a href="">Busquedas</a></li>
                    <li><a class="dropdown-toggle" href="">Configuración<span class="caret"></span></a>
                        <ul>
                            <li><a href="" >6. Actas 3</a></li>
                            <li><a href="" >Abogados</a></li>
                            <li><a href="" >Actuaciones</a></li>
                            <li><a href="" >Alertas</a></li>
                            <li><a href="" >Cárceles</a></li>
                            <li><a href="" >Ciudades</a></li>
                            <li><a href="" >Conceptos</a></li>
                            <li><a href="" >Departamentos</a></li>
                            <li><a href="" >Depósitos Judiciales</a></li>
                            <li><a href="" >Despachos/Juzgados</a></li>
                            <li><a href="" >Empresas</a></li>
                            <li><a href="" >Entidades</a></li>
                            <li><a href="" >Especialidades</a></li>
                            <li><a href="" >Estados</a></li>
                            <li><a href="" >Etapas</a></li>
                            <li><a href="" >Festivos</a></li>
                            <li><a href="" >Motivos Terminación</a></li>
                            <li><a href="" >Naturaleza</a></li>
                            <li><a href="" >Niveles</a></li>
                            <li><a href="" >Oficios</a></li>
                            <li><a href="" >Oficios Sigobius</a></li>
                            <li><a href="" >Operaciones</a></li>
                            <li><a href="" >Parejas</a></li>
                            <li><a href="" >Presupuestos</a></li>
                            <li><a href="" >Reportes</a></li>
                            <li><a href="" >Salarios</a></li>
                            <li><a href="" >Seccionales</a></li>
                            <li><a href="" >Tasas Comerciales</a></li>
                            <li><a href="" >Tasas TES (Deterioro de Cartera)</a></li>
                            <li><a href="" >Tasas Tributarias</a></li>
                            <li><a href="" >Test</a></li>
                            <li><a href="" >Tipos de Alertas</a></li>
                            <li><a href="" >Tipos de Cartera</a></li>
                            <li><a href="" >Tipos Documentos</a></li>
                            <li><a href="" >Uvt</a></li>
                        </ul>
                    </li>
                    <li><a class="dropdown-toggle" href="">Consultoría</a>
                    <ul>
                        <li><a class="dropdown-toggle"href="">Acceso</a>
                            <ul>
                                <li><a href="" >Crear Usuarios</a></li>
                                <li><a href="" >Horarios</a></li>
                                <li><a href="" >IPs Restringidas</a></li>
                                <li><a href="" >Menus</a></li>
                                <li><a href="" >Roles</a></li>
                                <li><a href="" >Usuarios</a></li>
                            </ul>
                        </li>
                        <li><a href="">Auditoría</a></li>
                        <li><a href="">Auditoría de Procesos</a></li>
                        <li><a href="">Ayudas GCC</a>
                            <ul>
                                <li><a href="">Ayudas</a></li>
                                <li><a href="">Temas</a></li>
                            </ul>
                        </li>
                        <li><a href="">Tipos de Alertas</a></li> 
                    </ul>
                    <li><a href="">Correspondencia</a></li>
                    <li><a href="">Importaciones</a>
                        <ul>
                            <li><a href="">Importaciones</a></li>
                            <li><a href="">Indeterminados</a></li>
                            <li><a href="">Recaudos</a></li>
                        </ul>
                    </li>
                    <li><a href="#" onclick="listChequeo();return false;">Lista de Chequeo</a></li>
                    <li><a href="">Minjusticia</a>
                        <ul>
                            <li><a href="">1. Lista de Chequeo</a></li>
                            <li><a href="">2. Actas</a></li>
                            <li><a href="">3. Lista de Chequeo 2</a></li>
                            <li><a href="">4. Actas 2</a></li>
                            <li><a href="">5. Lista de chequeo 3</a></li>
                            <li><a href="">6. Actas 3</a></li>
                        </ul>
                    </li>
                    <li><a href="" onclick="listProcesos();return false;">Procesos</a></li>
                    <li><a href="">Procesos Automaticos</a>
                        <ul>
                            <li><a href="">Mandamientos</a></li>
                            <li><a href="">Prescritos</a></li>
                        </ul>
                    </li>
                    <li><a href="">Reasignaciones</a></li>
                    <li><a href="">Reportes</a>
                        <ul>
                            <li><a href="">Base de Datos - Historico</a></li>
                            <li><a href="">BDME</a>
                                <ul>
                                    <li><a href="">BDME Actualización</a></li>
                                    <li><a href="">BDME Cancelación Acuerdo de Pago</a></li>
                                    <li><a href="">BDME Excluidos</a></li>
                                    <li><a href="">BDME Guía del Deudor Moroso</a></li>
                                    <li><a href="">BDME Incumplimiento Acuerdo de Pago Semestral</a></li>
                                    <li><a href="">BDME Reporte Semestral</a></li>
                                    <li><a href="">BDME Retiros</a></li>
                                </ul>
                            </li>
                            <li><a href="">Certificado del Resumen Mensual</a></li>
                            <li><a href="">Certificado del Resumen por Periodo</a></li>
                            <li><a href="">Consolidados por Conceptos</a></li>
                            <li><a href="">Contabilización</a></li>
                            <li><a href="">Deterioro de Cartera por Persona</a></li>
                            <li><a href="">Indicadores de Gestión</a></li>
                            <li><a href="">Informe Ejecutivo de Gestión</a></li>
                            <li><a href="">Intereses por Proceso</a></li>
                            <li><a href="">Listado Medidas Cautelares</a></li>
                            <li><a href="">Listados</a>
                                <ul>
                                    <li><a href="">Acuerdos de Pago</a></li>
                                    <li><a href="">Clasificaciones Cartera</a></li>
                                    <li><a href="">Corporaciones - Especialidades</a></li>
                                    <li><a href="">Mandamientos de Pago Automáticos</a></li>
                                    <li><a href="">Prescripciones Automáticas</a></li>
                                    <li><a href="">Procesos Sin Notificación</a></li>
                                    <li><a href="">Remanentes</a></li>
                                </ul>
                            </li>
                            <li><a href="">Listados Indicadores</a>
                                <ul>
                                    <li><a href="">Cumplimiento Metas de Reacaudo</a></li>
                                    <li><a href="">Indicaodres búsquedas</a></li>
                                    <li><a href="">Indicadores Recaudos</a></li>
                                    <li><a href="">Indicadores Sin Actuaciones</a></li>
                                </ul>
                            </li>
                            <li><a href="">Movimiento Mensual</a></li>
                            <li><a href="">Presunción Prescripción</a></li>
                            <li><a href="">Privados de la libertad</a></li>
                            <li><a href="">Recaudo por Años</a></li>
                            <li><a href="">Reportes</a></li>
                            <li><a href="">Tableros de Control</a></li>
                            <li><a href="">Test de Deterioro (Resumen)</a></li>
                            <li><a href="">Transacciones Usuarios</a></li>
                        </ul>
                    </li>
                    <li><a href="">Sancionados</a></li>
                </ul>
			</nav><!-- Aqui estamos cerrando la nueva etiqueta nav -->
		</div>
        <div id="tabla">
        </div>
        <div class="container2" id="containerInicio" style="text-align: center;">
            <h1 style="text-align: center;font-size: 18px!important;"><strong>¿COMO PUEDO AYUDARTE?</strong></h1>
            <select id="ayuda" name="ayuda">
                <option disabled selected>Coloque su pregunta o describa el problema aquí. Ej: Cómo ingresar a GCC</option>
                <?php 
                require_once "Modelo/models.php";
                $respuestas=new DB;
                $respuestas->inicio(); //se ejecuta el objeto ya creado en Comprobar.php
                ?>
            </select>
        <div id="cuadroAyuda" >    
        </div>
        </div><br><br>
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Lista de Chequeo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="Columna form-horizontal" method="POST" action="../Modelo/models_insert.php" id="form1">
                        <div class="div2">
                            <label  class="col-sm-5 control-label"style="display:none">Tipo Cartera *</label><input type="text" name="carteraTipoId" id="carteraTipoId" readonly class="input-listChequeo" style="display:none">
                            <label  class="col-sm-5 control-label" style="display:none">Seccional *</label><input type="text" name="seccionalID" id="seccionalID" readonly class="input-listChequeo" style="display:none"><br>  
                            <label  class="col-sm-5 control-label">Tramite *</label>
                            <select name="tramite" class="select-chequeo" >
                                <?php
                                    $formChequeo=new DB;
                                    $formChequeo->seleccionarTramites();
                                    ?>
                                </select><br>
                                <label  class="col-sm-5 control-label">Concepto-Naturaleza *</label> 
                                <select name="conceptoNaturaleza" class="select-chequeo" >
                                    <?php
                                    $formChequeo->seleccionarConceptoNaturaleza();
                                    ?>
                                </select><br> 
                                <label  class="col-sm-5 control-label">Tipo Liquidacion</label>
                                <select name="tipoLiquidacion" id="tipoLiquidacion">
                                    <?php
                                    $formChequeo->seleccionarTipoLiquidacion();
                                    ?>
                                </select><br>
                                <label  class="col-sm-5 control-label">Competencia *</label>
                                <select class="select-chequeo" name="competencia">
                                    <?php
                                    $formChequeo->seleccionarCompetencia();
                                    ?>
                                </select><br>
                                <label  class="col-sm-5 control-label">No. Radicado de Origen</label><input type="text" name="radicado"><br>
                                <label  class="col-sm-5 control-label">Fecha Liquidación</label><input type="date" name="fechaLiquidacion" id="fechaLiquidacion"/><br><br><br>
                        </div>
                                <label>Cantidad</label><input type='text' id="cantidad" name="cantidad"><br>
                                <label>Cant/Letras</label><input type='text' id="texto" readonly class="input-listLetras"><br> 
                                <label>Obligación *</label>
                                        <input type='text' id="obligacion" name="obligacion" ><br> 
                                        <label>Obli/Letras</label><input type='text' id="obligacionLetras" readonly class="input-listLetras"><br><br> 
                                    <div class="div2">
                                        <div class="buttons-group">
                                            <label  class="col-sm-5 control-label"># Folios *</label><input type='text' name="folios" class="input-listChequeo"><br> 
                                            <button id='aumentar' onclick="aumentar()" style="display:none">▲</button>
                                            <button id='disminuir' onclick="disminuir()" style="display:none">▼</button>
                                        </div>
                                        <label class="col-sm-5 control-label">Ejecutoría</label><input name="ejecutoria" type="date" /><br>
                                        <label class="col-sm-5 control-label">1a. Copia *</label><input type="checkbox" name="copia" value="" /><br>
                                        <label class="col-sm-5 control-label">Presta Mérito Ejecutivo *</label><input type="checkbox" name="prestaMerito"/><br>
                                        <label class="col-sm-5 control-label">Expresa *</label><input type="checkbox" name="expresa" /><br>
                                        <label class="col-sm-5 control-label">Competencia *</label><input type="checkbox" name="checkCompetencia" /><br>
                                        <label class="col-sm-5 control-label">Falta de Competencia *</label><input type="checkbox" name="faltaCompetencia" /><br>
                                        <label class="col-sm-5 control-label">Min. Justicia *</label><input type="checkbox" name="minJusticia" /><br>
                                        <label class="col-sm-5 control-label">No. Remisorio *</label><input type="text" name="remisorio" /><br>
                                        <label class="col-sm-5 control-label">Exp. Físico *</label><input type="checkbox" name="expFisico" /><br>
                                        <label class="col-sm-5 control-label">Providencia</label><input type="date" name="providencia" /><br>
                                        <label class="col-sm-5 control-label">F. Plazo</label><input type="date" value="" name="fechaPlazo"/><br>
                                        <label class="col-sm-5 control-label">Auténtica *</label><input type="checkbox" name="autentica" /><br>
                                        <label class="col-sm-5 control-label">Clara *</label><input type="checkbox" name="clara" /><br>
                                        <label class="col-sm-5 control-label">Actualmente Exigible *</label><input type="checkbox" name="actExigible" /><br>
                                        <label class="col-sm-5 control-label">Falta de Requisitos *</label><input type="checkbox" name="faltaRequisitos"/><br>
                                        <label class="col-sm-5 control-label">Prescripcion *</label><input type="checkbox" name="prescripcion" /><br>
                                        <label class="col-sm-5 control-label">Seccional Destino</label>
                                        <select class="select-chequeo" name="seccionalIdDestino">
                                            <?php
                                                    $formChequeo->seleccionarSeccionalDestino();
                                                    ?>
                                                </select><br>
                                                <label class="col-sm-5 control-label">Abogado *</label><select name="abogado" class="select-chequeo">
                                                    <?php
                                                    //require_once "Modelo/listaChequeo.php";
                                                    $formChequeo->seleccionarAbogado();
                                                    //$objeto10->seleccionarAbogado();
                                                    //print_r("valor del objeto:".$objeto10);
                                                    ?>
                                                </select><br>
                                                <label class="col-sm-5 control-label">Exp. Digital *</label><input type="checkbox" name="expDigital"/><br><br>
                                    </div>
                                    Observaciones * <textarea name="observaciones" width=100% cols="100" rows="5"></textarea><br>
                                    <div class="div3">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                        <button class="btn btn-primary actualizar">Actualizar</button>
                                    </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade bd-example-modal-sm" id="insertDeudores" tabindex="-1" role="dialog" aria-labelledby="insertDeudoresTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="insertDeudoresLongTitle">Registro de Sancionados</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="Columna form-horizontal" method="POST" action="../Modelo/insertSancionados.php" id="form2">
                        <label  class="col-sm-5 control-label" style="display:none;">ChequeoId</label>
                        <input type="text" name="chequeoId" id="chequeoId" readonly class="input-listChequeo" style="display:none;"><br>
                        <label  class="col-sm-5 control-label">Tipo de Documento *</label>
                        <select name="tipoDocuemnto" class="select-chequeo" >
                                <?php
                                    $formSancionados=new DB;
                                    $formSancionados->seleccionarTipoDocumento();
                                    ?>
                        </select><br>
                        <label  class="col-sm-5 control-label">No. Documento *</label>
                        <input type="text" name="numDocumento">
                        <label  class="col-sm-5 control-label">Deudor *</label>
                        <input type="text" name="deudor">
                        <label  class="col-sm-5 control-label">Genero *</label>
                        <select name="genero" class="select-chequeo" >
                            <option value="0">FEMENINO</option>
                            <option value="1">MASCULINO</option>
                        </select><br>
                        <label  class="col-sm-5 control-label">Observaciones *</label>
                        <textarea name="observaciones" cols="50" rows="3"></textarea><br>
                        <div class="div3">
                            <button type="button" class="btn btn-danger btn-center" data-dismiss="modal">Cancelar</button>
                            <button class="btn btn-primary">Actualizar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade bd-example-modal-sm" id="insertCorrespondencia" tabindex="-1" role="dialog" aria-labelledby="insertDeudoresTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="insertCorrespondenciaLongTitle">Registro de Correspondencia</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="Columna form-horizontal" method="POST" action="../Modelo/insertCorrespondencia.php" id="form3">
                        <input type="text" name="numeroProceso" id="numeroProceso" readonly class="input-listChequeo" style="display:none">
                        <label  class="col-sm-5 control-label">Oficio *</label>
                        <select name="oficios" class="select-chequeo" >
                                <?php
                                    $formSancionados=new DB;
                                    $formSancionados->seleccionarOficio();
                                    ?>
                        </select><br>
                        <label class="col-sm-5 control-label">Fecha *</label>
                        <input name="fechaCorrespondencia" type="date" /><br>
                        <label  class="col-sm-5 control-label">Resolucion *</label>
                        <input type="text" name="resolucion">
                        <label  class="col-sm-5 control-label">Radicado *</label>
                        <input type="text" name="radicado">
                        <label  class="col-sm-5 control-label">Observaciones *</label>
                        <textarea name="observaciones" cols="50" rows="3"></textarea><br>
                        <div class="div3">
                            <button type="button" class="btn btn-danger btn-center" data-dismiss="modal">Cancelar</button>
                            <button class="btn btn-primary">Actualizar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="bienvenida" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REGISTRO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Datos Cargados Correctamente.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
            </div>
            </div>
        </div>
        </div>
    <!--jquery, popper.js, bootstrap JS-->
    <script type='text/javascript' src='../libs/DataTables/jquery/jquery-3.6.3.min.js'></script>
    <script type="text/javascript" src="../libs/DataTables/popper/popper.min.js"></script>
    <script type="text/javascript" src="../libs/DataTables/bootstrap/bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
    <!--datatables JS-->
    <script type="text/javascript" src="../libs/DataTables/datatables/datatables.min.js"></script>
    <!--datatables JS extension SELECT-->
    <script type="text/javascript" src="../libs/DataTables/datatables/Select-1.6.1/js/dataTables.select.min.js"></script>
    <!--Juancho JS-->
    <script type="text/javascript" language="JavaScript" src="../Controlador/js.js?n=1"></script>
    <script type="text/javascript" language="JavaScript" src="../Vista/tablas.js?n=1"></script>
    <!--datatables JS extension BUTTONS-->
    <script type="text/javascript" src="../libs/DataTables/datatables/Buttons-2.3.6/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="../libs/DataTables/datatables/JSZip-2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="../libs/DataTables/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="../libs/DataTables/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
</body>
</html>