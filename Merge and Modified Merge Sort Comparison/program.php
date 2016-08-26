<?php


/**
*  Sort Comparison
*/
class SortComparison
{

	function __construct()
	{
		# code...
	}

	public static function getArray($size, $min = 0, $max=1000)
	{
		$A = range($min, $max);
		shuffle($A );
		return array_slice($A , 0, $size);
	}

	public static function mergeSort($A)
	{
		$Asize = count($A);
		//echo "<br/>mergeSort called with s=$Asize, k=$k array = ".implode(',', $A)."<br/>";
		if($Asize <= 1) {
			return $A;
		}
		else {
			$m = (int) $Asize/2;

			$left = self::mergeSort( array_slice($A, 0, $m) );
			$right = self::mergeSort( array_slice($A, $m) );

			$c1 = $c2 = 0;
			for ($i=0; $i < $Asize; $i++) {

				if(!isset($left[$c1]))
					$A[$i] = $right[$c2++];
				else if(!isset($right[$c2]))
					$A[$i] = $left[$c1++];
				else if($left[$c1] <= $right[$c2])
					$A[$i] = $left[$c1++];
				else
					$A[$i] = $right[$c2++];
			}

			return $A;
		}
	}

	public static function insertionSort($A)
	{
		for ($i=1; $i < count($A); $i++) {
			$j = $i;
			while ( $j > 0 && $A[$j-1] > $A[$j]) {
				$tmp = $A[$j];
				$A[$j] = $A[$j-1];
				$A[$j-1] = $tmp;
				$j--;
			}
		}
		return $A;
	}

	public static function mergeInsertionSort($A, $k=3)
	{
		$Asize = count($A);
		// echo "<br/>mergeSort called with s=$Asize, k=$k array = ".implode(',', $A)."<br/>";
		if($Asize <= 1) {
			return $A;
		}
		else if($Asize <= $k) {
			// echo 'insertion called';
			return self::insertionSort($A);
		}
		else {
			$m = (int) $Asize/2;

			$left = self::mergeInsertionSort( array_slice($A, 0, $m), $k );
			$right = self::mergeInsertionSort( array_slice($A, $m), $k );

			$c1 = $c2 = 0;
			for ($i=0; $i < $Asize; $i++) {

				if(!isset($left[$c1]))
					$A[$i] = $right[$c2++];
				else if(!isset($right[$c2]))
					$A[$i] = $left[$c1++];
				else if($left[$c1] <= $right[$c2])
					$A[$i] = $left[$c1++];
				else
					$A[$i] = $right[$c2++];
			}

			return $A;
		}
	}

}

set_time_limit(0);


$N = array(1000, 10000, 50000, 100000,1000000); //, 50000, 100000,1000000
	echo '<table border=1>';
	echo '<tr><th>n</th><th>Populating Array </th><th>Merge Sort Time</th><th>Modified Merge Sort Time</th></tr>';
foreach ($N as $n) {
	echo '<tr><td>'.$n.'</td>';
	$time1 = microtime(true);
	$A = SortComparison::getArray($n, 0, $n*2);
	$time2 = microtime(true);

	// echo 'Populating Array: '.implode(',', $A);
	echo '<td><b>'. number_format($time2-$time1,3) .'s</b></td>';


	$time1 = microtime(true);
	$sorted = SortComparison::mergeSort($A);
	$time2 = microtime(true);

	// echo '<br/><br/>Sorted Array with Merge Sort: '.implode(',', $sorted);
	echo '<td><b>'. number_format($time2-$time1,3) .'s</b></td>';


	// $time1 = microtime(true);
	// $sorted = SortComparison::insertionSort($A);
	// $time2 = microtime(true);

	// // echo '<br/><br/>Sorted Array with Insertion Sort: '.implode(',', $sorted);
	// echo '<br/>Insertion: Time Taken: <b>'.number_format($time2-$time1,3) .'s</b>';

	$K = SortComparison::getArray(10, 5, 100);
	$k = array();
	echo '<td><table border=1>';
	echo '<tr>';
	for ($i=0; $i < 10; $i++) {
		echo '<th>'.$K[$i].'</th>';
	}
	echo '<th>avg</th>';
	echo '</tr>';
	echo '<tr>';
	for ($i=0; $i < 10; $i++) {
		$time1 = microtime(true);
		$sorted = SortComparison::mergeInsertionSort($A, $K[$i]);
		$time2 = microtime(true);

		$k[] = $time2-$time1;
		// echo '<br/><br/>Sorted Array with Modified Merge Sort:'.implode(',', $sorted);
		echo '<td><b>'. number_format($time2-$time1,3) .'s</b></td>';
	}
	echo '<td><b>'. number_format(array_sum($k)/count($k),3) .'s</b></td>';
	echo '</tr>';
	echo '</table></td></tr>';
}
echo '</table>';
?>
<style type="text/css">
th, td { text-align: center;}
</style>
