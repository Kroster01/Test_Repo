<?php
	/**
	* write a message to a file in the same directory
	*/
	$file = dirname(__FILE__) . '/output.txt';
	$date = "";
	$dbhost = 'localhost';
	$dbuser = 'id4872962_root1';
	$dbpass = '83322050';
	$dbname = 'id4872962_rucamanque_rc_test';
	$ccnnx = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	/* verificar la conexión */
	if (mysqli_connect_errno()) {
		$date .= "Conexión fallida: ". mysqli_connect_error()."\n";
		file_put_contents($file, $date, FILE_APPEND);
		exit();
	}

	$sql = "SELECT JUGA.JUG_PK,JUGA.JUG_FEC_INI_CLUB,JUGA.JUG_CONT_EMERGENCIA,JUGA.JUG_ESTATURA,JUGA.JUG_PESO,JUGA.JUG_SEURO_ACCIDENTE, ";
	$sql .= " JUGA.JUG_STADO_IN_CLUB,JUGA.JUG_MEDICAMENTOS,JUGA.JUG_EVA_NUTRI,JUGA.JUG_ALERGIAS,JUGA.JUG_OBS,JUGA.JUG_CREATED,JUGA.JUG_CREATED_BY, ";
	$sql .= " JUGA.JUG_MODIFIED,JUGA.JUG_MODIFIED_BY,JUGA.PVS_PK,JUGA.GSO_PK,JUGA.CAT_PK,JUGA.UBC_PK,BEN.BEF_DESCRIPCION,BEN.BEF_MONTO ";
	$sql .= " FROM jugador JUGA ";
	$sql .= " INNER JOIN beneficio_jugador BEJU on JUGA.JUG_PK = BEJU.JUG_PK ";
	$sql .= " INNER JOIN beneficios BEN on BEJU.BEF_PK = BEN.BEF_PK ";
	$sql .= " WHERE JUG_STADO_IN_CLUB = 'ACTIVO' ";
	$sql .= " AND BEN.BEF_MONTO <> 0 ";

	$query = mysqli_query($ccnnx, $sql);
	$numrows = (int)mysqli_num_rows($query);

	$date .= "******************************************************************"."\n";
	$date .= "SQL Request: \n\n".$sql."\n\n";
	$date .= "***** fecha del registro: ".date('d/m/Y H:i:s')."\n";
	$date .= "***** Cantidadd e Rows: ".(int)$numrows."\n";

	if ((int)$numrows > 0) {
		$fecha = new DateTime();
		while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
			//$CCS_PK = '';
			$PERIODO_PAGO = $fecha->format('Y-m-d');
			$MONTO_PAGO   = $row['BEF_MONTO'];
			$ESTADO_PAGO  = "PENDIENTE";
			$FECHA_PAGO   = "NULL";
			$CREATED      = $fecha>format('Y-m-d');
			$CREATED_BY   = "user_test";
			$MODIFIED     = "NULL";
			$MODIFIED_BY  = "NULL";
			$JUG_PK       = $row['JUG_PK'];

			$queryInsert = "INSERT INTO cobro_cuota_social "."\n"."( ";
			//$queryInsert .= " CCS_PK, ";
			$queryInsert .= " CCS_PERIODO_PAGO, ";
			$queryInsert .= " CCS_MONTO_PAGO, ";
			$queryInsert .= " CCS_ESTADO_PAGO, ";
			$queryInsert .= " CCS_FECHA_PAGO, ";
			$queryInsert .= " CCS_CREATED, ";
			$queryInsert .= " CCS_CREATED_BY, ";
			$queryInsert .= " CCS_MODIFIED, ";
			$queryInsert .= " CCS_MODIFIED_BY, "."\n";
			$queryInsert .= " JUG_PK) ";
			$queryInsert .= " VALUES ( ";
			//$queryInsert .= " NULL, ";
			$queryInsert .= "'".$PERIODO_PAGO."', ";
			$queryInsert .= "".$MONTO_PAGO.", ";
			$queryInsert .= "'".$ESTADO_PAGO."', ";
			$queryInsert .= "".$FECHA_PAGO.", ";
			$queryInsert .= "'".$CREATED."', ";
			$queryInsert .= "'".$CREATED_BY."', ";
			$queryInsert .= "".$MODIFIED.", ";
			$queryInsert .= "".$MODIFIED_BY.", ";
			$queryInsert .= "".$JUG_PK."); ";

			//$queryResult = mysqli_query($ccnnx, $queryInsert);

			$queryInsert .= "\n\n";
			$date .= $queryInsert;
		}

		$date .= "**************************      -     ****************************"."\n";
	}

	mysqli_free_result($query);
	mysqli_close($ccnnx);

	file_put_contents($file, $date, FILE_APPEND);

?>