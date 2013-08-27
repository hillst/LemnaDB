<?php
Class Nav{
	private $tables; /* dicitonary */
	public function __construct(){
		$this->tables = array();
	}
	public function addTable(Table $table){
		$this->tables[$table->getName()] = $table;
	}
	public function getTables(){
		return $this->tables;
	}
	
}
/**
 * Class for generating table html. That is, html for tables in our database.
 * 
 * @field name			Name used to address the table, table name in the database
 * @field fields		Fields that belong to the table. Should be of type field.
 * @field description	Description of the table. May be empty or very descriptive, depending on the clarity of the names and the importance of the table
 * @field references	String which points to all tables referenced by this table (use <a href="#tablename">)
 * 
 * @author shill
 *
 */
Class Table{
	private $name;
	private $fields;
	private $description;
	private $references;
	public function __construct($name, $description, $references = NULL){
		$this->name = $name;
		$this->description = $description;
		$this->references = $references;
		$this->fields = array();
	}
	
	public function getName(){
		return $this->name;
	}
	
	public function addField(Field $field){
		array_push($this->fields, $field);
	}
	
	public function generateTableHTML(){
		$output = "
				<div class='bs-docs-section'>
				<h3 id='".$this->name."'>".$this->name."</h3>
				<p>
				<div class='panel panel-default'>
				<div class='panel-heading'>". $this->name ."</div>
				<div class='panel-body'>
				<p>".
				$this->description
				."</p>
				<h5>References</h5>
				<p>
				". $this->references."
				</p>
				</div>
				<table class='table'>
				<tr>
				<th>fieldname</th><th>attribute</th><th>description</th><th>example</th></tr>
				<tr>";
		$ending = "</table></div></div>";
		foreach($this->fields as $field){
			//pass
			$output .= "<td>".$field->getName() ."</td><td>". $field->getType()."</td><td>". $field->getComments() ."</td><td>".$field->getExample()."</td></tr>";
		}
		$final = $output . $ending;
		return $final;
	}
}

Class Field{
	private $name;
	private $type;
	private $constraint;
	private $comments;
	public function __construct($name, $type, $comments= "", $constraint =""){
		$this->name = $name;
		$this->type = $type;
		$this->constraint = $constraint;
		$this->comments = $comments;	
	}
	
	public function getName(){
		return $this->name;
	}
	
	public function getType(){
		return $this->type;
	}
	public function getConstraint()
	{
		return $this->constraint;
	}
	public function getComments(){
		return $this->comments;
	}
	public function getExample(){
		return $this->example;
	}
}

?>