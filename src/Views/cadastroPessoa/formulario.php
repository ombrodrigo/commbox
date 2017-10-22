<?php if (isset($erros)) { ?>
    <div class="callout callout-danger"><h4>Ocorreu um erro</h4>
        <ul>
            <?php foreach($erros as $atributo => $erro ) { ?>
            <li><p><?php echo $erro; ?></p></li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>

<div class="row">
    <div class="col-xs-12">
        <?php if (isset($registro['id'])) { ?>
            <form class="form-horizontal" action="?cadastroPessoa/atualizarRegistro" method="post" autocomplete="off">
        <?php } else { ?>
            <form class="form-horizontal" action="?cadastroPessoa/novo" method="post" autocomplete="off">
        <?php } ?>

            <?php if (isset($registro['id'])) { ?>
                <input type="hidden" name="id" value="<?php echo $registro['id']; ?>">
            <?php } ?>

            <div class="box box-default">
                <div class="box-header">
                    <h3 class="box-title">Cadastro de pessoa</h3>
                </div>
                <div class="container">
                    <div class="box-body">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-group input-group col-sm-10 <?php echo isset($erros['nome']) ? 'has-error' : ''; ?> nome">
                                    <input type="text" class="form-control" name="nome" maxlength="64" placeholder="Nome" value="<?php echo isset($registro['nome']) ? $registro['nome'] : ''; ?>">
                                    <i class="ion-ios-chatboxes-outline form-control-feedback"></i>
                                </div>

                                <div class="form-group input-group col-sm-10 <?php echo isset($erros['dataNascimento']) ? 'has-error' : ''; ?> dataNascimento">
                                    <input type="date" class="form-control" name="dataNascimento" maxlength="10" placeholder="Data de nascimento" value="<?php echo isset($registro['dataNascimento']) ? $registro['dataNascimento'] : ''; ?>">
                                    <i class="ion-ios-calendar-outline form-control-feedback"></i>
                                </div>

                                <div class="form-group input-group col-sm-10 <?php echo isset($erros['cpf']) ? 'has-error' : ''; ?> cpf">
                                    <input type="text" class="form-control" name="cpf" id="cpf" maxlength="11" placeholder="CPF" value="<?php echo isset($registro['cpf']) ? $registro['cpf'] : ''; ?>">
                                    <i class="ion-ios-barcode-outline form-control-feedback"></i>
                                </div>

                                <div class="form-group input-group col-sm-10 <?php echo isset($erros['senha']) ? 'has-error' : ''; ?> senha">
                                    <input type="password" class="form-control" name="senha" maxlength="8" placeholder="Senha" value="<?php echo isset($registro['senha']) ? $registro['senha'] : ''; ?>">
                                    <i class="ion-ios-locked-outline form-control-feedback"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-group input-group col-sm-10 <?php echo isset($erros['pai']) ? 'has-error' : ''; ?> pai">
                                    <input type="text" class="form-control" name="pai" maxlength="64" placeholder="Nome do pai" value="<?php echo isset($registro['pai']) ? $registro['pai'] : ''; ?>">
                                    <i class="ion-ios-chatboxes-outline form-control-feedback"></i>
                                </div>

                                <div class="form-group input-group col-sm-10 <?php echo isset($erros['mae']) ? 'has-error' : ''; ?> mae">
                                    <input type="text" class="form-control" name="mae" maxlength="64" placeholder="Nome da mãe" value="<?php echo isset($registro['mae']) ? $registro['mae'] : ''; ?>">
                                    <i class="ion-ios-chatboxes-outline form-control-feedback"></i>
                                </div>

                                <div class="form-group input-group col-sm-10 <?php echo isset($erros['cidade']) ? 'has-error' : ''; ?> cidade">
                                    <input type="text" class="form-control" name="cidade" maxlength="32" placeholder="Cidade" value="<?php echo isset($registro['cidade']) ? $registro['cidade'] : ''; ?>">
                                    <i class="ion-ios-location-outline form-control-feedback"></i>
                                </div>

                                <div class="form-group input-group col-sm-10">
                                    <textarea class="form-control" id="letterInText" name="observacao" placeholder="Observação" maxlength="36" rows="3"><?php echo isset($registro['observacao']) ? $registro['observacao'] : ''; ?></textarea>
                                    <i class="ion-ios-chatboxes-outline form-control-feedback"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="container">
                    <div class="box-footer">
                        <div class="col-xs-12 text-center">
                            <button type="submit" class="btn btn-default  btn-flat contar">
                                <i class="ion-ios-checkmark-outline"></i>&nbsp;Cadastrar
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

<script src="public/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="public/js/cadastroPessoa.js"></script>

