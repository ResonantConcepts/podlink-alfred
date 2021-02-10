# Podcast Search for Alfred

Search for podcasts from Alfred (powered by [pod.link](https://pod.link/))

![](demo.gif)

## Installation
**<a download href="https://github.com/ResonantConcepts/podlink-alfred/releases/latest/download/podcast-search.alfredworkflow">Download and install the latest release</a>** 

_You will need the [Alfred Powerpack](https://www.alfredapp.com/powerpack/) to enable this workflow._

## Usage
1. Type the keyword `pod` followed by your query to generate results.
2. Press <kbd>⌘</kbd> + <kbd>C</kbd> to copy the pod.link URL of the selected show to you clipboard.
3. Select a podcast to reveal a list of supported platforms.
4. Select your preferred platform or type its name to filter the list.
   * Press <kbd>Return</kbd> to open the selected result in your browser.
   * Press <kbd>⌘</kbd> + <kbd>C</kbd> to copy the URL of the selected result to your clipboard.

## Supported Platforms
Alfred learns and will sort the results based on usage. Here’s the list of platforms currently supported:

![Apple Podcasts](List%20Filter%20Images/icon-applepodcasts.png)
![Breaker](List%20Filter%20Images/icon-breaker.png)
![Castbox](List%20Filter%20Images/icon-castbox.png)
![Castro](List%20Filter%20Images/icon-castro.png)
![Google Podcasts](List%20Filter%20Images/icon-googlepodcasts.png)
![Listen Notes](List%20Filter%20Images/icon-listennotes.png)
![Overcast](List%20Filter%20Images/icon-overcast.png)
![Player FM](List%20Filter%20Images/icon-playerfm.png)
![Pocket Casts](List%20Filter%20Images/icon-pocketcasts.png)
![Podcast Addict](List%20Filter%20Images/icon-podcastaddict.png)
![RadioPublic](List%20Filter%20Images/icon-radiopublic.png)
![Spotify](List%20Filter%20Images/icon-spotify.png)
![Stitcher](List%20Filter%20Images/icon-stitcher.png)
![RSS](List%20Filter%20Images/icon-rss.png)


## Limitations
* If a podcast is not listed in the Apple Podcasts directory, it will not appear in search results.
* All podcasts are not necessarily available on all platforms. If pod.link cannot find a match on an platform, the link will redirect back to the pod.link page for that podcast.

## Credits
* Hat tip to [Chris Messina](https://twitter.com/chrismessina) for the nudge to create this
* Built with [alfy](https://github.com/sindresorhus/alfy) via [generator-alfred](https://github.com/SamVerschueren/generator-alfred)

## License

MIT © [Nathan Gathright](https://github.com/nathangathright)
