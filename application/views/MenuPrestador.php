<div ng-controller="controllerMenu">
  <header>
      <div class="navbar-fixed">
        <nav>
          <div class="nav-wrapper blue #1889ff">
           <a href="#!" class="left-align" style="font-size:23px; color:white !important; " >
             <?php echo $titulo_tela ?>
           </a>
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
              <li>
                  <a href="#perfil_implementar">Perfil</a>
              </li>
              <li>
                  <a href="../ListarServico/">Meus serviços</a>
              </li>
              <li>
                  <a href="../ControlePrestador/">Serviços solicitados</a>
              </li>
              <li>
                  <a ng-show="podeExcluirContaRetorno" id="delete_forever_header">Excluir minha conta</a>
              </li>
              <li>
                <a href="../Login/sairSistema">Sair</a>
              </li>
            </ul>

          </div>
        </nav>
      </div>
      <ul id="mobile-demo" class="side-nav">
        <li>
          <div class="user-view">
          <div class="background blue #1889ff">
            <div class="blue lighten-1"></div>
          </div>
          <a href="#!user"><img alt="<?php echo $this->session->userdata('nome');?>" class="circle" src="../includes/imagens/<?php echo $this->session->userdata('imagem_pessoa');?>"></a>
          <a href="#!name"><span class="white-text name"><?php echo $this->session->userdata('nome');?></span></a>
          <a href="#!email"><span class="white-text email"><?php echo $this->session->userdata('login');?></span></a>
          </div>
        </li>
        <li><a href="#perfil_implementar"><i class="material-icons">face</i>Perfil</a></li>
        <li><a href="../ListarServico/"><i class="material-icons">room_service</i>Meus serviços</a></li>
        <li><a href="../ControlePrestador/"><i class="material-icons">history</i>Serviços solicitados</a></li>
        <li><a ng-show="podeExcluirContaRetorno" id="delete_forever"><i class="material-icons">delete_forever</i>Excluir minha conta</a></li>
        <li><a href="../Login/sairSistema"><i class="material-icons">rowing</i>Sair</a></li>
      </ul>
  </header>

  <div class="row"><div class="col-sm-12">&nbsp;</div></div>

  <div class="modal fade" id="modal_excluir_ajudante" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">

      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="gridSystemModalLabel">Tem certeza que deseja excluir sua conta?</h4>
              </div>

              <div class="modal-footer">
                  <button type="button" class="btn btn-success" ng-click="excluir()">Sim</button>
                  <button type="button" class="btn btn-danger" ng-click="fechar()">Não</button>
              </div>
          </div>
      </div>
  </div>
</div>