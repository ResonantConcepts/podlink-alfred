<?php
use Alfred\Workflows\Workflow;

require_once('vendor/joetannenbaum/alfred-workflow/Workflow.php');
require_once('vendor/joetannenbaum/alfred-workflow/Result.php');
require_once('util/request.php');
require_once('util/download.php');

const ICON = '81C7654E-46DC-4AC4-8F57-A9D6A834F9A0.png';

$wf = new Workflow;

$download_dir = getenv('alfred_workflow_cache').'/podlink';
initDownloadDir(true);

$response = request('https://itunes.apple.com/search?term='.urlencode($query).'&limit=10&media=podcast');
$json = json_decode($response);
$results = $json->results;

foreach ($results as $sugg) {
    $iTunesID = $sugg->collectionId;
    $feedUrl = $sugg->feedUrl;
    $showName = $sugg->collectionName;
    $artistName = $sugg->artistName;
    $icon = $sugg->artworkUrl100 === null ? ICON : $sugg->artworkUrl100;
    $podlinkUrl = 'https://pod.link/'.$iTunesID;
    $links = array(
        "applepodcasts" => 'https://podcasts.apple.com/podcast/id'.$iTunesID.'?ct=podlink&mt=2&app=podcast&ls=1',
        "castro" => 'https://castro.fm/itunes/'.$iTunesID,
        "googlepodcasts" => "https://podcasts.google.com/?feed=".base64_encode($iTunesID),
        "overcast" => 'https://overcast.fm/itunes'.$iTunesID,
        "pocketcasts" => 'https://pca.st/itunes/'.$iTunesID,
        "rss" => $feedUrl
    );
    $alternate = array_key_exists($favorite, $links) ? $favorite : "rss";
    
    $wf->result()
        ->uid($iTunesID)
        ->title($showName)
        ->subtitle($artistName)
        ->arg($podlinkUrl)
        ->cmd('Open in your favorite player', $links[$alternate])
        ->icon(saveAndReturnFile($icon))
        ->autocomplete($showName);
}

echo $wf->output();