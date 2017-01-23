<?php 
// $domain = $_GET['url'];
function getGoogleCount($domain) {
    $content = file_get_contents('http://ajax.googleapis.com/ajax/services/' .
        'search/web?v=1.0&filter=0&q=site:' . urlencode($domain));
    $data = json_decode($content);
    return intval($data->responseData->cursor->estimatedResultCount);
}

function getBingCount($domain) {
    $content = file_get_contents('http://api.bing.net/json.aspx?Appid=<YourAppIDHere>&sources=image&query=site:' . urlencode($domain));
    $data = json_decode($content);
    return intval($jsonobj->SearchResponse->Image->Results);
}

echo getGoogleCount('SodoroLaw.com');
echo getBingCount('SodoroLaw.com');


// if (isset($_POST['submit'])) {

// $request =

// 'http://api.bing.net/json.aspx?Appid=<YourAppIDHere>&sources=image&query=' . urlencode( $_POST["searchText"]);

// $response = file_get_contents($request);

// $jsonobj = json_decode($response);

// echo('<ul ID="resultList">');

 

// foreach($jsonobj->SearchResponse->Image->Results as $value)

// {

// echo('<li class="resultlistitem"><a href="' . $value->Url . '">');

// echo('<img src="' . $value->Thumbnail->Url. '"></li>');

 

// }

// echo("</ul>");

// } 
?>