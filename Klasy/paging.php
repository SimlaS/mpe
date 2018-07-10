<?php
class paging
{

	
	
function draw_pager($url, $total_pages, $current_page = 1) {
    
    if ( $current_page <= 0 || $current_page > $total_pages ) {
        $current_page = 1;
    }
    
    if ( $current_page > 1 ) {
        if (strpos($url,'?')!==false)
        {
    		printf( "<a href='$url&page=%d'>[Start]</a> \n" , 1);
        	printf( "<a href='$url&page=%d'>[Prev]</a> \n" , ($current_page-1));
        }
        else 
        {
        	printf( "<a href='$url?page=%d'>[Start]</a> \n" , 1);
        	printf( "<a href='$url?page=%d'>[Prev]</a> \n" , ($current_page-1));
        	
        }
    }
    
    for( $i = ($current_page-5); $i <= $current_page+5; $i++ ) {
        
        if ($i < 1) continue;
        if ( $i > $total_pages ) break;
        
        if ( $i != $current_page ) 
        {
        	if (strpos($url,'?')!==false)
        	{
        		printf( "<a href='$url&page=%1\$d'>%1\$d</a> \n" , $i);
        		
        	}
        	else
        	{
            	printf( "<a href='$url?page=%1\$d'>%1\$d</a> \n" , $i);
        	}
        } 
        else 
        {
            if (strpos($url,'?')!==false)
            {
            	printf("<a href='$url&page=%1\$d'><strong>%1\$d</strong></a> \n",$i);	
            }
            else
            {
            	printf("<a href='$url?page=%1\$d'><strong>%1\$d</strong></a> \n",$i);
            }
        	
        }
        
    }
    
    if ( $current_page < $total_pages ) {
        
    	if (strpos($url,'?')!==false)
    	{
    		printf( "<a href='$url&page=%d'>[Next]</a> \n" , ($current_page+1));
        	printf( "<a href='$url&page=%d'>[End]</a> \n" , $total_pages);	
    		
    	}
    	else 
    	{
    		
    		printf( "<a href='$url?page=%d'>[Next]</a> \n" , ($current_page+1));
        	printf( "<a href='$url?page=%d'>[End]</a> \n" , $total_pages);	
    		   		
    	}
    	
        
        
    }
 return $current_page;   
}


function total_pages($total_rows, $rows_per_page) {
    if ( $total_rows < 1 ) $total_rows = 1;
    return ceil($total_rows/$rows_per_page);
}




function page_to_row($current_page, $rows_per_page) {
    $start_row = ($current_page-1) * $rows_per_page + 1;
    return $start_row;
}




function count_rows(& $conn, $select) {
    $sql = "SELECT COUNT(*) AS num_rows FROM($select)";
    $stmt = oci_parse($conn,$sql);
    oci_define_by_name($stmt,"NUM_ROWS",$num_rows);
    oci_execute($stmt);
    oci_fetch($stmt);
    return $num_rows;
}



function & paged_result(& $conn, $what, $tabela, $tabela2, $pol, $where, $start_row, $rows_per_page, $order, $asc, $order2, $asc2, $order3, $asc3) {

	if ($tabela2=='')
	{
		$sql="
		SELECT * FROM (
			SELECT 
			ROWNUM R, 
			T.* FROM 
			(
			SELECT $what FROM $tabela $where ORDER BY $order $asc, $order2 $asc2,$order3 $asc3
			) 
					T
			) 
			WHERE :start_row <= R AND R<= :end_row";
		
		
	}
	else
	{
		
	$sql="
		SELECT * FROM (
			SELECT 
			ROWNUM R, 
			T.* FROM 
			(
			SELECT $what FROM $tabela, $tabela2 $pol $where ORDER BY $order $asc, $order2 $asc2,$order3 $asc3
			) 
					T
			) 
			WHERE :start_row <= R AND R<= :end_row";	
		
		
	}
	
	

//echo $sql;
          
    $stmt = oci_parse($conn,$sql);
    
    oci_bind_by_name($stmt, ':start_row', $start_row);
    
    // Calculate the number of the last row in the page
    $end_row = $start_row + $rows_per_page - 1;
    oci_bind_by_name($stmt, ':end_row', $end_row);
    
    oci_execute($stmt);
    
    // Prefetch the number of rows per page
    oci_set_prefetch($stmt, $rows_per_page);
    
    return $stmt;

}
}

?>