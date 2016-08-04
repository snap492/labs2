<? $visitCounter = 0;
$lastVisit = '';
$cookieDate =  $_COOKIE ['lastVisit'];
$currentDate = date ('d-m-Y');
if ($cookieDate != $currentDate)	{
	if (isset($_COOKIE ['visitCounter']))
	{	
		$visitCounter = $_COOKIE ['visitCounter'];
		$visitCounter++;
		setcookie ('visitCounter', $visitCounter, 0x7fffffff);
	}
		else{
		setcookie ('visitCounter', $visitCounter, 0x7fffffff);
		} 
	if (isset($_COOKIE ['lastVisit']))
	{
		$lastVisit = $_COOKIE ['lastVisit'];
		$lastVisit = date ('d-m-Y');
	
	}
	setcookie ('lastVisit', date('d-m-Y'), 0x7fffffff);
}

	
