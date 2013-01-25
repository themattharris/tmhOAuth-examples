<?php

require '../tmhOAuth.php';
require '../tmhUtilities.php';

date_default_timezone_set('GMT');

$search = 'MY_SEARCH_TAG';

$tmhOAuth = new tmhOAuth(array());
$tmhOAuth->request(
  'GET','http://search.twitter.com/search.json',
	array(
		'q'        => $search,
		'rpp'      => '100', //total results
    'lang'    => 'en', //language
    'include_entities' => true //include entities
    //More options here -> https://dev.twitter.com/docs/api/1.1/get/search/tweets
	),
	false
);


if ($tmhOAuth->response['code'] == 200) {
	$data = json_decode($tmhOAuth->response['response'], true);
} else {
	$data = htmlentities($tmhOAuth->response['response']);
	echo 'There was an error.' . PHP_EOL;
	break;
}

foreach ($data['results'] as $result) :
	print_r($result);
	echo '<br /><br />';
endforeach;
?>
