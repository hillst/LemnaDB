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
	$table1->addField(new Field("id_tag", "Text", "Barcode of the plant."));
	$table1->addField(new Field("colour_integer", "Int","Unknown Purpose"));
	$table1->addField(new Field("visited", "Boolean", "If the car has been visited" ));
	$table1->addField(new Field("creator", "text", "Owner of this snapshot's username as defined in the LTSystem DB."));
	$table1->addField(new Field("comment", "Text", "User input comment for this snapshot (meta comment)"));
	$table1->addField(new Field("car_tag", "text", "Refers to the Car tags in LTSystem DB."));
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
   
$table5 = new Table("tiled_image", "Contains intermediate information about tiles. Tiles are typically the image set associated with a snapshot.");
	$table5->addField(new Field("id", "serial", "ID. Referenced by the tile table."));
	$table5->addField(new Field("camera_label", "text", "Label of the camera, nir_tv, flou_tv, vis_sv0.. etc."));
	$table5->addField(new Field("mm_pro_pixel_x", "double precision"));
	$table5->addField(new Field("mm_pro_pixel_y", "double precision"));
	$table5->addField(new Field("snapshot_id", "bigint", "ID of associated snapshot."));
$table6 = new Table("tile", "Contains metadata about images, references the tiled_image.");
	$table6->addField(new Field("id", "serial"));
	$table6->addField(new Field("image_oid", "lo", "no data"));
	$table6->addField(new Field("null_image_oid", "lo", "no data"));
	$table6->addField(new Field("row", "integer", "all entries set to 0"));
	$table6->addField(new Field("column", "integer", "all entries set to 0"));
	$table6->addField(new Field("frame", "integer", "Fluorescent camera has three frames, this records which image belongs to which frame"));
	$table6->addField(new Field("additional_information","text"));
	$table6->addField(new Field("tiled_image_id","integer", "reference to the tiled image table."));
	$table6->addField(new Field("raw_image_oid", "lo", "id of the image on the filesystem, should say blob<ID>"));
	$table6->addField(new Field("raw_null_image_oid", "Id of the null image, that is, the image without the plant in it, probably used for subtraction."));
	$table6->addField(new Field("dataformat", "integer"));
	$table6->addField(new Field("width", "integer"));
	$table6->addField(new Field("height", "integer"));
	
$table7 = new Table("overallconfig", "Table which represents the overall configs in the system.");
	$table7->addField(new Field("timestamp", "timestamp"));
	$table7->addField(new Field("creator", "text"));
	$table7->addField(new Field("grid_id", "bigint", "purpose unclear"));
	$table7->addField(new Field("mpconfig_id", "bigint", "unclear what mpconfig is."));
	$table7->addField(new Field("id", "bigserial"));
	$table7->addField(new Field("propagated", "boolean","purpose unclear."));
	$table7->addField(new Field("configname", "text", "Name of the overall config as seen by the user."));
	$table7->addField(new Field("compname", "text", "Possibly name of the computer that uses this config"));
	
//GLOBAL SETTINGS -- LTSYSTEM
$system1 = new Table("plants", "Table used for identifying plants(cars) on the conveyer belts.");
	$system1->addField(new Field("id", "big_serial"));
	$system1->addField(new Field("propagated", "Boolean", "Recurring field of unknown purpose"));
	$system1->addField(new Field("identcode", "text", "Barcode of the plant. This is how the plant is uniqely referenced on the user end."));
	$system1->addField(new Field("carid", "text", "Id of the car the plant is involved with."));
	$system1->addField(new Field("type","text", "No entries in database, but likely a text label for the plant (genotype)."));
	$system1->addField(new Field("creator", "text", "User who created this plant entry."));
	$system1->addField(new Field("active", "boolean", "Marker distinguishing if the plant is currently being used."));
	$system1->addField(new Field("timestamp", "timestamp"));
	$system1->addField(new Field("on_system","boolean", "Similar to active."));
	
$system2 = new Table("watering", "Table for global watering schedule.");
	$system2->addField(new Field("id", "big_serial"));
	$system2->addField(new Field("identcode", "text", "Identcode of the car that is being watered."));
	$system2->addField(new Field("time", "timestamp"));
	$system2->addField(new Field("starthour", "int","0-24 range marking when the watering should begin."));
	$system2->addField(new Field("finishhour","int", "0-24 range marking when the watering should finish."));
	$system2->addField(new Field("quantity", "int", "Quantity that will be output."));
	$system2->addField(new Field("pumpname", "text", "Human readable label for the pump(s)"));
	$system2->addField(new Field("type","text", "Can be either Absolute or TargetWeight. Refers to, water this amount or water until the car weights this much."));
	$system2->addField(new Field("formula", "text", "purpose unclear"));
	$system2->addField(new Field("done", "boolean"));
	$system2->addField(new Field("status", "text", "Current status of the watering event."));
	$system2->addField(new Field("processed", "timestamp","Time at which the event was processed."));
	$system2->addField(new Field("deficiency", "text", "Purpose unclear."));
	$system2->addField(new Field("creator", "text", "User who created this watering entry"));
	$system2->addField(new Field("deflimit", "int", "Purpose unclear."));
	$system2->addField(new Field("created", "timestamp"));
	$system2->addField(new Field("pumpconfigid", "int", "Id of the pumps being used in this process. Should be comma separated list, or single."));

$system3 = new Table("pumps", "Table which controls the settings of each pump.");
	$system3->addField(new Field("pumpname", "text", "Human readable name of the pump. Will appear to the user"));
	$system3->addField(new Field("comport", "text", "Empty in all cases. Purpose unclear."));
	$system3->addField(new Field("califacmlpr", "real", "One of the calibration settings. Will appear in the LemnaTec watering tool. Presumably mlpr means milliliters per rotation."));
	$system3->addField(new Field("speedinmlpm", "integer", "Speed of the pumps in milliliters per minute."));
	$system3->addField(new Field("backlash", "integer", "Purpose unclear."));
	$system3->addField(new Field("direction", "text", "Direction of the pump, clockwise or counter-clockwise."));
	$system3->addField(new Field("type", "text", "Purpose unclear. Not a necessary field."));
	$system3->addField(new Field("id", "bigserial"));
	$system3->addField(new Field("propagated", "boolean"));
	$system3->addField(new Field("label", "text", "Label of the pump."));
	$system3->addField(new Field("state", "state", "Purpose unclear."));
	$system3->addField(new Field("last_state_change", "timestamp"));
	$system3->addField(new Field("last_state_changed_by", "text"));
	$system3->addField(new Field("creator", "text"));
	$system3->addField(new Field("time_stamp", "timestamp"));

$system4 = new Table("conveyortasks", "Table responsible for running different conveyor tasks, such as watering, weighing, imaging, and some overall tasks.");
	$system4->addField(new Field("id", "serial"));
	$system4->addField(new Field("time", "timestamp", "Scheduled time for the job to run."));
	$system4->addField(new Field("mode", "text", "Complicated column which contains a huge amount of information about what to do. This column appears to be entirely text and colon delemited. Refer to the spreadsheet for more information."));
	$system4->addField(new Field("timespan","bigint", "Minutes that a job is allowed to run if it fails to run the first time. This may be cause by another task not being complete which the current is scheduled to run."));
	$system4->addField(new Field("duration", "bigint", "Estimated duration that the job will run. Input by the user."));
	$system4->addField(new Field("startmode","integer", "Purpose unclear"));
	$system4->addField(new Field("priority", "integer", "If two jobs are scheduled for the same time, higher priority jobs will fire first."));
	$system4->addField(new Field("status", "integer","Purpose unclear."));
	$system4->addField(new Field("oac_id", "bigint", "Id of the overallconfig, however not the same as the id in the overallconfig table (experiment database). Hah."));
	$system4->addField(new Field("oac_label", "text", "Label of the overallconfig that is being used. This is the same as the overallconfig table (experiment database)."));
	$system4->addField(new Field("creator", "text"));
	$system4->addField(new Field("created", "timestamp"));
	$system4->addField(new Field("changedby", "text"));
	$system4->addField(new Field("changedat", "timestamp"));
	
$SystemTables = new Nav();
$SystemTables->addTable($system1);
$SystemTables->addTable($system2);
$SystemTables->addTable($system3);
$SystemTables->addTable($system4);
//might not use nav o:
$MainTables = new Nav();
$MainTables ->addTable($table1);
$MainTables	->addTable($table2);
$MainTables	->addTable($table3);
$MainTables ->addTable($table4);
$MainTables ->addTable($table5);
$MainTables ->addTable($table6);
$MainTables ->addTable($table7);


?>
<?php
//to render the nav!!!
//foreach($array as $name => $link){
  //  echo "<a href='$link'>$name</a>\n";
//}
?>