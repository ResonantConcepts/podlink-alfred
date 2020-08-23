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
    $platform = array_shift($parts);
    $query = implode(' ', $parts);
}

if (strlen($query)>1){
    $response = request('https://itunes.apple.com/search?term='.urlencode($query).'&limit=9&media=podcast');
    $json = json_decode($response);
    $results = $json->results;

    foreach ($results as $result) {
        $iTunesID = $result->collectionId;
        $feedUrl = $result->feedUrl;
        $showName = $result->collectionName;
        $artistName = $result->artistName;
        $icon = $result->artworkUrl100 === null ? ICON : $result->artworkUrl100;
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
            'rss' => "Open RSS Feed"
        );
        $links = array(
            'podlink' => "https://pod.link/{$iTunesID}",
            'apple' => "https://pod.link/{$iTunesID}/listen/applepodcasts",
            'breaker' => "https://pod.link/{$iTunesID}/listen/breaker",
            'bullhorn' => "https://pod.link/{$iTunesID}/listen/bullhorn",
            'castbox' => "https://pod.link/{$iTunesID}/listen/castbox",
            'castro' => "https://pod.link/{$iTunesID}/listen/castro",
            'google' => "https://pod.link/{$iTunesID}/listen/googlepodcasts",
            'listennotes' => "https://pod.link/{$iTunesID}/listen/listennotes",
            'overcast' => "https://pod.link/{$iTunesID}/listen/overcast",
            'playerfm' => "https://pod.link/{$iTunesID}/listen/playerfm",
            'pocketcasts' => "https://pod.link/{$iTunesID}/listen/pocketcasts",
            'podbean' => "https://pod.link/{$iTunesID}/listen/podbean",
            'podcastaddict' => "https://pod.link/{$iTunesID}/listen/podcastaddict",
            'podcastguru' => "https://pod.link/{$iTunesID}/listen/podcastguru",
            'podchaser' => "https://pod.link/{$iTunesID}/listen/podchaser",
            'podhero' => "https://pod.link/{$iTunesID}/listen/podhero",
            'podknife' => "https://pod.link/{$iTunesID}/listen/podknife",
            'podnews' => "https://pod.link/{$iTunesID}/listen/podnews",
            'radiopublic' => "https://pod.link/{$iTunesID}/listen/radiopublic",
            'spotify' => "https://pod.link/{$iTunesID}/listen/spotify",
            'stitcher' => "https://pod.link/{$iTunesID}/listen/stitcher",
            'rss' => $feedUrl
        );
        $argument = array_key_exists($platform, $links) ? $links[$platform] : $links['podlink'];
        $subtitle = array_key_exists($platform, $subtitles) ? $subtitles[$platform] : $subtitles['podlink'];

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