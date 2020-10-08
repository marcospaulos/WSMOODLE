<?php
	echo '<p>Fechando Conexões...</p>';
	//pg_close($bd_moodle);
//	pg_close($bd_integracao);
//	pg_close($bd_prod_sagres);
	//pg_close($bd_prod_sagu);
	
	sqlsrv_close($con );
?>
