$playlist = $musicData->playlists->items[0];
Final Spotify Example Code
Here is what the code ultimately looks like:

<?php

/*
Here is what my command would look like on the command line
curl -X "GET" "https://api.spotify.com/v1/search?q=Omar%20Apollo&type=artist" 
-H "Accept: application/json" 
-H "Content-Type: application/json" 
-H "Authorization: Bearer BQBejDt1ZRP2YOEZEOojwO_uCH4F4yGKB4xyDcDLBzlTSkTO11Udqvv9nVnh4G4N_ngjMPWoX5FpjiGDOapUZw2f2BvrUk6BEVOFmyzMMfI4bWKyOcgPqkgYYex0ACdddP9kuEcG1g_b_JDhuR7TWDbdySn4mz4vHr-KoQ"
*/

// Set the API key for my test account
$apiKey = "BQBejDt1ZRP2YOEZEOojwO_uCH4F4yGKB4xyDcDLBzlTSkTO11Udqvv9nVnh4G4N_ngjMPWoX5FpjiGDOapUZw2f2BvrUk6BEVOFmyzMMfI4bWKyOcgPqkgYYex0ACdddP9kuEcG1g_b_JDhuR7TWDbdySn4mz4vHr";

// Setup the CURL session
$cSession = curl_init();

// Setup the CURL options
curl_setopt($cSession,CURLOPT_URL,"https://api.spotify.com/v1/search");
curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
curl_setopt($cSession,CURLOPT_HEADER, false);

// Add headers to the HTTP command
curl_setopt($cSession,CURLOPT_HTTPHEADER, array(
    "Accept: application/json",
    "Content-Type: application/json",
    "Authorization: Bearer $apiKey"
));

// Execute the CURL command
$results = curl_exec($cSession);

// Check for specific non-zero error numbers
$errno = curl_errno($cSession);
if ($errno) {
    switch ($errno) {
        default:
            echo "Error #$errno...execution halted";
            break;
    }

    // Close the session and exit
    curl_close($cSession);
    exit();
}

// Close the session
curl_close($cSession);

// HintL: it is sometimes helpful to take echo the
// $results out and copy the array, then paste it into
// a beautifier online to see the data. For example, you
// could put the string JSON $results into the site
// https://codebeautify.org/jsonviewer

// Convert the results to an associative array
$musicData = json_decode($results);


// Let's just get one of the items and echo the JSON for that only.
echo json_encode($musicData->tracks->items[0]);

?>