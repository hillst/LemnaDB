<?php
include_once "Table.php";

$table1 = new Table("snapshot", "A snapshot marks a measurement at some point in time. This usually is defined as a watering event.", "
		<a href='#analysis'>analysis</a>,
		<a href='#snapshot_changelog'>snapshot changelog</a>, 
		<a href='#tiled_image'>tiled image</a>, 
		<a href='#tiled_intermediate_result'>tiled intermediate result</a>, 
		<a href='#weight_data'>weight data</a>");
	//$table1->addField(new Field($name, $type, example, comments, constraints));
	$table1->addField(new Field("id", "Big Serial"));
	$table1->addField(new Field("propagated", "Boolean",  "Unknown purpose"));
	$table1->addField(new Field("configuration", "Big Int",  "Unknown purpose"));
	$table1->addField(new Field("id_tag", "Text", "", "Seems to be the same as car_tag"));
	$table1->addField(new Field("colour_integer", "Int","Unknown Purpose"));
	$table1->addField(new Field("visited", "Boolean", "If the car has been visited" ));
	$table1->addField(new Field("creator", "text", "Owner of this snapshot's username as defined in the LTSystem DB."));
	$table1->addField(new Field("comment", "Text", "User input comment for this snapshot (meta comment)"));
	$table1->addField(new Field("car_tag", "text", "Value that is the same as id_tag in every instance. Likely refers to the Car tags in LTSystem DB."));
	$table1->addField(new Field("measurement_label", "text", "User created label for this snapshot. IE Media Demo 082613"));
	$table1->addField(new Field("time_stamp", "timestamp", ""));
	$table1->addField(new Field("weight_before", "real", "Weight before measurement (snapshot)."));
	$table1->addField(new Field("weight_after", "real", "Weight after measurement (snapshot)."));
	$table1->addField(new Field("water_amount", "integer", "Amount of water added to car. No unit."));
	$table1->addField(new Field("completed", "boolean"));
	
	
$table2 = new Table("lemnagrid_description", "actual description", "<a href='#lemnagrid_srcimg'>lemnagrid src img</a>");
	//$table1->addField(new Field($name, $type, example, comments, constraints));
	$table2->addField(new Field("id", "bigserial"));
	$table2->addField(new Field("propagated", "Boolean", "Unknown purpose, likely related to the propogated row in the <a href='#snapshot'>snapshot table</a>"));
	$table2->addField(new Field("label", "text", "A user created label for this lemnagrid, that is, image analysis configuration."));
	$table2->addField(new Field("creator", "text", "User who owns this configuration"));
	$table2->addField(new Field("created", "timestamp"));
	$table2->addField(new Field("state", "integer", "Evidence suggests that there are only 2 states, 0 and 1, purpose unknown."));
	$table2->addField(new Field("last_state_change", "timestamp"));
	$table2->addField(new Field("last_state_changed_by", "text", "User who changed the state."));
	$table2->addField(new Field("grid_oid", "lo", "unknown purpose"));
	
	
$table3 = new Table("job_table", "Table purpose is unclear, but seems to contain references to analysis, snapshots, and configurations.", "No formal references, but fields are likely related to other tables.");
	//$table1->addField(new Field($name, $type, example, comments, constraints));
	$table3->addField(new Field("id", "big_serial"));
	$table3->addField(new Field("propagated", "Boolean", "Likely related to all the other propagated tables"));
	$table3->addField(new Field("snapshotid", "bigint", "Child snapshot."));
	$table3->addField(new Field("idtag", "text", "Unknown purpose."));
	$table3->addField(new Field("grid_id", "text", "Id of grid used for this job, that is, image analysis configuration."));
	$table3->addField(new Field("ana_label","text", "Unknown purpose"));
	$table3->addField(new Field("priority", "integer", "Priority of job in the job queue."));
	$table3->addField(new Field("status", "integer", "Current status of the job"));
	$table3->addField(new Field("creator", "text", "Username of the creator of this job, as in the LemnaSystemDB"));
	$table3->addField(new Field("errorness","text", "Purpose unclear"));
$table4 = new Table("analysis", "Table is designed for tying all of the pieces together. It contains a reference
		to the snapshot, grid (image analysis config), and images.", 
		"
		<a href='#snapshot'>snapshot</a>, <a href='#lemnagrid_description'>grid</a>
		");
	$table4->addField(new Field("id", "big_serial", "Primary key. All image tables will refer to the analysis by this ID."));
	$table4->addField(new Field("label","text", "User designed label for identifying this analysis."));
   $table4->addField(new Field("partial_analysis","boolean", "Unknown purpose"));
   $table4->addField(new Field("grid_id", "text", "Image analysis configuration ID. Id of the grid used for this analysis."));
   $table4->addField(new Field("time_stamp", "timestamp"));
   $table4->addField(new Field("creator", "text", "User who owns this analysis"));
   $table4->addField(new Field("overwritten_by_ana_i", "integer", "Unknown purpose"));
   $table4->addField(new Field("snapshot_id","bigint", "Foreign key that references an associated snapshot."));

//GLOBAL SETTINGS -- LTSYSTEM
//TODO: FILLOUT
$system1 = new Table("plants", "Table used for identifying plants on the conveyer belts.");
	$system1->addField(new Field("id", "big_serial"));
	$system1->addField(new Field("propagated", "Boolean", "Recurring field of unknown purpose"));
	$system1->addField(new Field("identcode", "text", "Purpose unclear, but likely some identification of the plant"));
	$system1->addField(new Field("carid", "text", "Id of the hobo the plant is involved with."));
	$system1->addField(new Field("type","text", "No entries in database, but likely a text label for the plant (genotype)."));
	$system1->addField(new Field("creator", "text", "User who created this plant entry."));
	$system1->addField(new Field("active", "boolean", "Marker distinguishing if the plant is currently being used."));
	$system1->addField(new Field("timestamp", "timestamp"));
	$system1->addField(new Field("on_system","boolean", "Similar to active."));
$system2 = new Table("watering", "Table for global watering schedule.");
	$system2->addField(new Field("id", "big_serial"));
	$system2->addField(new Field("identcode", "text", "Some code that uniquely identifies the entry."));
	$system2->addField(new Field("time", "timestamp"));
	$system2->addField(new Field("starthour", "int","0-24 range marking when the watering should begin."));
	$system2->addField(new Field("finishhour","int", "0-24 range marking when the watering should finish."));
	$system2->addField(new Field("quantity", "int", "Quantity that will be output."));
	$system2->addField(new Field("pumpname", "text", "Human readable label for the pump(s)"));
	$system2->addField(new Field("type","text", "Human readable label for the watering entry."));
	$system2->addField(new Field("formula", "text", "purpose unclear"));
	$system2->addField(new Field("done", "boolean"));
	$system2->addField(new Field("status", "text", "Current status of the watering event."));
	$system2->addField(new Field("processed", "timestamp","Time at which the event was processed."));
	$system2->addField(new Field("deficiency", "text", "Purpose unclear."));
	$system2->addField(new Field("creator", "text", "User who created this watering entry"));
	$system2->addField(new Field("deflimit", "int", "Purpose unclear."));
	$system2->addField(new Field("created", "timestamp"));
	$system2->addField(new Field("pumpconfigid", "int", "Id of the pumps being used in this process. Should be comma seperated list."));
$SystemTables = new Nav();
$SystemTables->addTable($system1);
$SystemTables->addTable($system2);
//might not use nav o:
$MainTables = new Nav();
$MainTables ->addTable($table1);
$MainTables	->addTable($table2);
$MainTables	->addTable($table3);
$MainTables ->addTable($table4);


?>
<?php
//to render the nav!!!
//foreach($array as $name => $link){
  //  echo "<a href='$link'>$name</a>\n";
//}
?>