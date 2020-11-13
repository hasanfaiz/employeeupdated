<?php


	function DateDisplayToDatabase($date)
	{
	    return @$date && $date !== null && $date != 'null' && $date != '1970-01-01' ? date('Y-m-d', strtotime($date)) : null;
	}

	function DateDatabaseToDisplay($date, $strtotime = false, $today = true)
	{
	    $current = ($strtotime) ? date('d.m.Y', strtotime($strtotime)) : date('d.m.Y');
	    $current = ($today) ? $current : '';
	    $date    = ($date) ? date('d.m.Y', strtotime($date)) : $current;
	    return $date;
	}


	function formatSelectedRows($results)
	{
	    $format = array();
	    if ($results) {
	        foreach ($results as $result) {
	                $format[] = $result->$field;
	        }
	    }
	    $format = array_unique($format);
	    return $format;
	}


	