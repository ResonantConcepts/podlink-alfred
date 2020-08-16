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
        $subtitles = array(
            'podlink' => "Open in PodLink",
            'apple' => "Open in Apple Podcasts",
            'breaker' => "Open in Breaker",
            'castbox' => "Open in Castbox",
            'castro' => "Open in Castro",
            'google' => "Open in Google Podcasts",
            'overcast' => "Open in Overcast",
            'playerfm' => "Open in PlayerFM",
            'podcastaddict' => "Open in Podcast Addict",
            'pocketcasts' => "Open in Pocketcasts",
            'spotify' => "Open in Spotify",
            'stitcher' => "Open in Stitcher",
            'rss' => "Open in Stitcher"
        );
        $links = array(
            'podlink' => "https://pod.link/{$iTunesID}",
            'apple' => "https://pod.link/{$iTunesID}/listen/applepodcasts",
            'breaker' => "https://pod.link/{$iTunesID}/listen/breaker",
            'castbox' => "https://pod.link/{$iTunesID}/listen/castbox",
            'castro' => "https://pod.link/{$iTunesID}/listen/castro",
            'google' => "https://pod.link/{$iTunesID}/listen/googlepodcasts",
            'overcast' => "https://pod.link/{$iTunesID}/listen/overcast",
            'playerfm' => "https://pod.link/{$iTunesID}/listen/playerfm",
            'podcastaddict' => "https://pod.link/{$iTunesID}/listen/podcastaddict",
            'pocketcasts' => "https://pod.link/{$iTunesID}/listen/pocketcasts",
            'spotify' => "https://pod.link/{$iTunesID}/listen/spotify",
            'stitcher' => "https://pod.link/{$iTunesID}/listen/stitcher",
            'rss' => $feedUrl
        );
        $argument = array_key_exists($app, $links) ? $links[$app] : $links['podlink'];
        $subtitle = array_key_exists($app, $subtitles) ? $subtitles[$app] : $subtitles['podlink'];

        $wf->result()
            ->uid($iTunesID)
            ->title($showName)
            ->subtitle($subtitle)
            ->arg($argument)
            ->cmd($argument, $argument)
            ->icon(saveAndReturnFile($icon))
            ->autocomplete($showName);
    }
}
echo $wf->output();