<?php
$fileToCreate = "./list_gov.ar_worked.csv";
$fileToOpen = "./listado_gov.ar.csv";
$fila = 1;
$rows = ''; 

if (($gestor = fopen($fileToOpen, "r")) !== FALSE) {
    while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
        $numero = count($datos);
// echo "$numero de campos en la línea $fila: \n";
    
        for ($c=0; $c < $numero; $c++) {
// Verifica dominio
        $domain = $datos[$c] . '.gov.ar';
        $wwwdomain = 'www.' . $domain;
    
        if((checkdnsrr($domain, "A")) || checkdnsrr($domain, "CNAME") ||  
           (checkdnsrr($wwwdomain, "A")) || checkdnsrr($wwwdomain, "CNAME"))
         {   
            $rows .= "'$domain','Existe' \n";
            //file_put_contents($fileToCreate,$row, FILE_APPEND);
            echo "$fila - '$domain','Existe' \n";
        } else {
            $rows .= "'$domain', 'No Existe' \n";
           // file_put_contents($fileToCreate,$row, FILE_APPEND); 
            echo "$fila - '$domain', 'No Existe' \n"; 
        }   
// Fin Verifica Dominio                  
          // echo $datos[$c] . "\n";
        $fila++;
        }   
    }   
            fclose($gestor);
}
        file_put_contents($fileToCreate,$rows, FILE_APPEND); 
 
?>
