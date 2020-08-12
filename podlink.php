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

if (strpos($query, ' ') !== false) {
    $parts = explode(' ', $query);
    $app = array_shift($parts);
    $query = implode(' ', $parts);
}

if (strlen($query)>1){
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
        "apple" => 'https://podcasts.apple.com/podcast/id'.$iTunesID.'?ct=podlink&mt=2&app=podcast&ls=1',
        "breaker" => "https://www.breaker.audio/shows?feed_url=".urlencode($feedUrl),
        "castbox" => 'https://castbox.fm/vic/'.$iTunesID,
        "castro" => 'https://castro.fm/itunes/'.$iTunesID,
        "google" => "https://podcasts.google.com/?feed=".base64_encode($feedUrl),
        "overcast" => 'https://overcast.fm/itunes'.$iTunesID,
        "podcastaddict" => 'https://podcastaddict.com/feed/'.urlencode($feedUrl),
        "pocketcasts" => 'https://pca.st/itunes/'.$iTunesID,
        "rss" => $feedUrl
    );
    $externalUrl = array_key_exists($app, $links) ? $links[$app] : $podlinkUrl;

    $wf->result()
        ->uid($iTunesID)
        ->title($showName)
        ->subtitle($externalUrl)
        ->arg($externalUrl)
        ->icon(saveAndReturnFile($icon))
        ->autocomplete($showName);
}
}
echo $wf->output();