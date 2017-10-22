<?php if (isset($erro)) { ?>
    <div class="callout callout-danger"><h4>Ocorreu um erro</h4><p><?php echo $erro; ?></p></div>
<?php } ?>

<div class="row">
    <div class="col-xs-12">
        <form class="form-horizontal" action="?contaCaracter" method="post" enctype="multipart/form-data" autocomplete="off">
            <div class="box box-default">
                <div class="box-header">
                    <h3 class="box-title">Conta carácter</h3>
                </div>
                <div class="container">
                    <div class="box-body">

                        <!-- arquivo -->
                        <div class="form-group">
                            <div class="input-group col-sm-7">
                                <span class="input-group-addon">de arquivo:</span>
                                <span class="input-group-addon">
                                    <input type="radio" class="tipoDeContagem" name="tipoDeContagem" value="1" data-enable="letterInFile" data-disable="letterInText">
                                </span>
                                <input type="file" class="form-control btn-file" id="letterInFile" name="letterInFile" disabled>
                                <i class="ion-ios-cloud-upload-outline form-control-feedback"></i>
                            </div>
                        </div>
                        <!-- arquivo -->

                        <!-- formulario -->
                        <div class="form-group">
                            <div class="input-group col-sm-7">
                                <span class="input-group-addon">de texto:&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                <span class="input-group-addon">
                                    <input type="radio" class="tipoDeContagem" name="tipoDeContagem" value="2" data-enable="letterInText" data-disable="letterInFile">
                                </span>
                                <!-- <input type="text" class="form-control" id="letterInText" nome="letterInText" disabled> -->
                                <textarea class="form-control" id="letterInText" name="letterInText" disabled rows="1"></textarea>
                                <i class="ion-ios-chatboxes-outline form-control-feedback"></i>
                            </div>
                        </div>
                        <!-- formulario -->

                        <!-- caracter -->
                        <div class="form-group">
                            <div class="input-group col-sm-12">
                                <input type="text" class="form-control" name="caracter" placeholder="Carácter, palavra ou frase a ser pesquisado ...">
                                <i class="ion-ios-search form-control-feedback"></i>
                            </div>
                        </div>
                        <!-- caracter -->

                        <!-- case sensitive -->
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="caseSensitive"> <i>Case Sensitive</i>
                                </label>
                            </div>
                        </div>
                        <!-- case sensitive -->

                    </div>
                </div>

                <div class="container">
                    <div class="box-footer">
                        <div class="col-xs-12 text-center">
                            <button type="submit" class="btn btn-default  btn-flat contar">
                                <i class="ion-ios-color-wand"></i>&nbsp;Contar caractéres
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

<?php

if (isset($ocorrencias) && $ocorrencias > 0) {

?>

<div class="row resultado">
    <div class="col-md-6 col-sm-offset-3">
        <div class="box box-widget widget-user">
            <div class="widget-user-header bg-purple-gradient">
                <h5 class="text-center">Carácter, palavra ou frase informado</h5>
                <h3 class="widget-user-desc text-center"><?php echo $caracter; ?></h3>
            </div>
            <div class="box-footer">
                <div class="row">

                    <div class="col-sm-5 border-right">
                        <div class="description-block">
                            <h5 class="description-block">
                                <div class="description-block">
                                    <h5 class="description-header">NÚMERO</h5>
                                    <span class="description-text">OCORRÊNCIAS</span>
                                </div>
                            </h5>
                        </div>
                    </div>

                    <div class="col-sm-2 border-right">
                        <div class="description-block">
                            <i class="ion-ios-calculator-outline fa-2x"></i>
                        </div>
                    </div>

                    <div class="col-sm-5">
                        <div class="description-block">
                            <h5 class="description-header"><?php echo $ocorrencias; ?></h5>
                            <span class="description-text">OCORRÊNCIAS</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php } ?>

<script src="public/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="public/js/contaCaracter.js"></script>








