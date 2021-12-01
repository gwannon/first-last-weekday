<?php
/**
 * class weekDay:
 *
 * This class check a date and says if it's the first/last monday,tuesday, wednesday, ... of the current month.
 * Also it says you the position (1st/2nd/3th/4th/5th) monday,tuesday, wednesday, ... of the current month.    
 * The idea is to check recurrent events that happen, for example, the first monday of April, the last sunday of August, the first and third tuesdays of all months  
 */

class weekDay {
	public $date;
	public $weekday;
	private $first;
	private $last;
	public $position;

	function weekDay($date) {
		$this->date = strtotime($date);
		$this->weekday = date("l", $this->date);
		$this->first = strtotime('first '.$this->weekday.' of '.date("Y-m", $this->date));	
		$this->last = strtotime('last '.$this->weekday.' of '.date("Y-m", $this->date));
		$this->position = floor((date("j", $this->date) - date("d", $this->first)) / 7) + 1;
		return $this;
	}
	
	//GETs
	function getFormattedDate($format = "Y-m-d") { return date($format, $this->date); }
	
	//ISs
	function isFirst() { return ($this->first == $this->date ? true : false); }
	function isLast() { return ($this->last == $this->date ? true : false); }
}

/**
 * Example code
 */
 
$mydate = new weekDay(date("Y-m-d"));
echo $mydate->getFormattedDate().PHP_EOL;
echo "The first ".$mydate->weekday." of the month: ".($mydate->isFirst() ? "YES" : "NO").PHP_EOL;
echo "The last ".$mydate->weekday." of the month: ".($mydate->isLast() ? "YES" : "NO").PHP_EOL;
echo "It's the ".$mydate->position."th ".$mydate->weekday." of the month".PHP_EOL;
