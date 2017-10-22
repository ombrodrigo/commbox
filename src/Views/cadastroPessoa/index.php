<?php
    $numeroDeRegistros = count($registros);
?>

<div class="box">
   <div class="box-header">
      <h3 class="box-title">Pessoas</h3>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
      <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
         <div class="row">
            <form class="form-horizontal" action="?cadastroPessoa" method="post" autocomplete="off">
                <div class="col-sm-2">
                   <div class="dataTables_length2">
                      <label>
                         Pesquisar por:
                         <select name="key" class="form-control input-sm">
                            <option value="nome">Nome</option>
                            <option value="cpf">CPF</option>
                         </select>
                      </label>
                   </div>
                </div>
                <div class="col-sm-8">
                   <div id="example1_filter" class="dataTables_filter">
                        <label>
                            <input type="text" name="value" class="form-control input-sm nome_cpf" size="50" placeholder="Informe o nome ou CPF" >
                            <button type="submit" class="btn btn-default  btn-flat pesquisar">
                                <i class="ion-funnel"></i>
                            </button>
                        </label>
                    </div>
                </div>
            </form>
            <div class="col-sm-2">
               <div id="example1_filter" class="dataTables_filter">
                    <label>
                        <a href="?cadastroPessoa/novo" class="btn btn-block btn-primary btn-sm">
                            <i class="fa fa-user-plus"></i>
                            Adicionar Pessoa
                        </a>
                    </label>
                </div>
            </div>
         </div>
         <div class="row">&nbsp;</div>
         <div class="row">
            <div class="col-sm-12">
               <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                  <thead>
                     <tr role="row">
                        <th class="col-sm-9">Nome</th>
                        <th class="col-sm-3" colspan="2">CPF</th>
                     </tr>
                  </thead>
                  <tbody>

                    <?php if ($numeroDeRegistros == 0) { ?>
                        <tr role="row" class="warning">
                            <td class="text-center" colspan="4">Nenhum registro localizado</td>
                        </tr>
                    <?php
                        } else {
                            foreach ($registros as $registro) {
                    ?>
                            <tr role="row" class="odd">
                                <td class="col-sm-9"><?php echo $registro['nome']; ?></td>
                                <td class="col-sm-2"><?php echo $registro['cpf']; ?></td>
                                <td class="col-sm-1 text-center">
                                    <a href="?cadastroPessoa/atualizar&id=<?php echo $registro['id']; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    &nbsp;&nbsp;
                                    <a href="?cadastroPessoa/excluir&id=<?php echo $registro['id']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                </td>
                             </tr>
                    <?php
                            }
                        }
                    ?>
                  </tbody>
               </table>
            </div>
         </div>
         <div class="row">
            <div class="col-sm-12">
               <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Número de resultados: <?php echo $numeroDeRegistros; ?></div>
            </div>
         </div>
      </div>
   </div>
   <!-- /.box-body -->
</div>

<script src="public/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="public/js/cadastroPessoa.js"></script>
