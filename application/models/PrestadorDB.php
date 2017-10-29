<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PrestadorDB extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}

	public function getPrestador($id_servico_solicitacao) {

   	$ds_sql = ' SELECT ' 
			. ' 	pf.id_pessoa_fisica, '
			. ' 	ss.id_servico_solicitacao, '
			. ' 	pf.nome, '
			. ' 	pf.cpf, '
			. ' 	DATE_FORMAT(pf.dt_nascimento,"%d/%m/%Y") dt_nascimento,  '
			. ' 	FORMAT(ROUND(s.valor, 2),2) valor, '
			. ' 	s.descricao descricao_servico, '
			. ' 	c.descricao cidade, '
			. ' 	e.bairro, '
			. ' 	e.rua, '
			. ' 	e.cep, '
			. ' 	e.numero, '
			. ' 	e.complemento, '
			. ' 	es.uf estado_sigla, '
			. ' 	( SELECT ct.descricao  FROM contato ct WHERE ct.id_pessoa = pf.id_pessoa_fisica AND ct.id_tipo_contato = 3 ) celular, '
			. ' 	( SELECT ct.descricao  FROM contato ct WHERE ct.id_pessoa = pf.id_pessoa_fisica AND ct.id_tipo_contato = 4 ) email '
			. ' FROM '
			. '   servico_solicitado ss '
			. ' INNER JOIN servico s ON ( '
			. ' 	s.id_servico = ss.id_servico '
			. ' ) '
			. ' INNER JOIN prestador p on ( '
			. ' 	p.id_prestador = s.id_prestador '
			. ' ) '
			. ' INNER JOIN pessoa_fisica pf ON ( '
			. ' 	pf.id_pessoa_fisica = p.id_pessoa '
			. ' ) '
			. ' LEFT Join endereco e ON ( '
			. ' 	e.id_pessoa = pf.id_pessoa_fisica '
			. ' ) '
			. ' LEFT JOIN cidade c ON ( '
			. ' 	c.id_cidade = e.id_cidade '
			. ' ) '
			. ' LEFT JOIN estado es ON ( '
			. ' 	c.id_estado = es.id_estado '
			. ' ) '
			. ' WHERE '
			. ' 	ss.id_servico_solicitacao = ?';

			$arrCondicao = array(
				$id_servico_solicitacao
			);

   	return $this->db->query(
			$ds_sql,
		   $arrCondicao
		);
  	}

	  
	public function getDadosServicosSolicitados($id_prestador) {
		return $this->db->query("
			select
				ss.id_servico_solicitacao,
				pf.nome,
				s.descricao,
				ss.dia_solicitacao,
				ss.horario_inicio,
				ss.horario_fim,
				eo.id_estado_operacao,
				eo.descricao ds_estado_atual
			from
				pessoa_fisica pf,
				contratante c,
				servico_solicitado ss,
				servico s,
				estado_operacao eo
			where	
				pf.id_pessoa_fisica = c.id_pessoa
			and 
				ss.id_contratante = c.id_contratante
			and
				ss.id_estado_operacao = eo.id_estado_operacao
			and		
				ss.id_servico = s.id_servico
		  	and
				s.id_prestador = ? ",
			array(
				$id_prestador
			)
		);
	}

	public function atualizarEstado($params) {
		$this->db->update(
			'servico_solicitado', 
			$params, 
			array(
				'id_servico_solicitacao' => $params["id_servico_solicitacao"]
			)
		);
	}

}