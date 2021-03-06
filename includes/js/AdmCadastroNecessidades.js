 var app =  angular.module(
    "appAngular",
    [
        'angular-loading-bar',
        'ui.materialize'
    ]
);

app.controller("ctrlrAdmCadastroNecessidades", function($scope,$rootScope,$http) {
	
	angular.element(document).ready(function () {
		$scope.__construct();	
	});


	$scope.__construct = function() {

        $scope.id_necessidade_especial = null;
        $scope.is_alterar = false;
        $scope.arrNecessidadesEspeciais = [];

        $scope.necessidades_especiais();
    };

    $scope.necessidades_especiais = function() {
        $http.post(
            '../AdmCadastroNecessidades/necessidades_especiais'
        ).success(function (data) {
            $scope.arrNecessidadesEspeciais = data;
            $scope.cancelar();
        });
    };

    $scope.salvarNecessidade = function() {
        if ($scope.descricao == undefined) {
            $("#descricao")
            .notify("Não pode ser vazio", "error")
            .val("")
            .focus();

            return;
        }

        if ($scope.form_necessidade.$invalid) {
            return;
        }

        if($scope.necessidadeCadastrada($scope.descricao)) {
            $("#descricao")
            .notify("Necessidade já cadastrada", "error")
            .val("")
            .focus();

            return;
        }

        var arrNecessidadesSalvar = {
            'descricao' : $scope.descricao            
        }  

        $http.post(
            '../AdmCadastroNecessidades/salvar',
            arrNecessidadesSalvar
        ).success(function (data) {
            $scope.arrNecessidadesEspeciais = data;
            $scope.cancelar();
        });
    };

    $scope.necessidadeCadastrada = function(descricao) {
        for (var i = $scope.arrNecessidadesEspeciais.length - 1; i >= 0; i--) {
            if ($scope.arrNecessidadesEspeciais[i].descricao == descricao) {
                return true;
            }
        }
        
        return false;
    };

    $scope.alterarNecessidade = function() {
        var arrNecessidadesAlterar = {
            'id_necessidade_especial' : $scope.id_necessidade_especial,
            'descricao' : $scope.descricao
        }

        $http.post(
            '../AdmCadastroNecessidades/alterar',
            arrNecessidadesAlterar
        ).success(function (data) {
            $scope.arrNecessidadesEspeciais = data;
            $scope.cancelar();
        });
    };

    $scope.carregarExcluir = function(necessidades_especiais) {
        $("#modal_excluir_necessidade").modal();
        $("#modal_excluir_necessidade").modal('open');
        $scope.id_necessidade_especial = necessidades_especiais.id_necessidade_especial;
    };

    $scope.excluirNecessidade = function() {
        var arrNecessidadesExcluir = {
            "id_necessidade_especial" : $scope.id_necessidade_especial
        }

        $http.post(
            '../AdmCadastroNecessidades/excluir',
            arrNecessidadesExcluir
        ).success(function (data) {
            $scope.arrNecessidadesEspeciais = data;
            $scope.fecharModalExcluir();
            $scope.necessidades_especiais();
        });
    }

    $scope.fecharModalExcluir = function() {
        $("#modal_excluir_necessidade").modal();
        $("#modal_excluir_necessidade").modal('close');
    };

    $scope.cancelar = function () {
        $scope.is_alterar = false;
        $scope.id_necessidade_especial = null;
        $scope.descricao = null;
    }

    $scope.carregarAlterar = function(necessidades_especiais) {
        $scope.is_alterar = true;
        $scope.id_necessidade_especial = necessidades_especiais.id_necessidade_especial;
        $scope.descricao = necessidades_especiais.descricao;
    };

    angular.element(document).ready(function () {
		$scope.__construct();	
	});

});



