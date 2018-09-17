<?php

require_once 'Crud.php';
class cliente extends Crud{
	
	protected $table = 'clientes';
	private $nome;
  private $divida;
  private $telefone;
	public function setNome($nome){
		$this->nome = $nome;
	}
	public function getNome(){
		return $this->nome;
	}
	public function setDivida($divida){
		$this->divida = $divida;
  }
  public function getDivida(){
		return $this->divida;
	}
  public function setTelefone($telefone){
		$this->telefone = $telefone;
  }
  public function Telefone(){
		return $this->telefone;
	}
	public function insert(){
		$sql  = "INSERT INTO $this->table (nome, divida, telefone) VALUES (:nome, :divida, :telefone)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':nome', $this->nome);
    $stmt->bindParam(':divida', $this->divida);
    $stmt->bindParam(':telefone', $this->telefone);
		return $stmt->execute(); 
	}
	public function update($id){
		$sql  = "UPDATE $this->table SET nome = :nome, divida = :divida, telefone = :telefone WHERE id = :id";
		$stmt = DB::prepare($sql);
    $stmt->bindParam(':nome', $this->nome);
    $stmt->bindParam(':divida', $this->divida);
		$stmt->bindParam(':telefone', $this->telefone);
		$stmt->bindParam(':id', $id);
		return $stmt->execute();
	}
}