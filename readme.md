# Podcast Search Suggestions for Alfred
This workflow lets you search for a podcast with search suggestions (powered by [PodLink](https://pod.link/)) right from your Alfred launcher. 

![Demo gif](demo-640.gif)

## Installation
**<a download href="https://github.com/ResonantConcepts/alfred-podcast/releases/latest/download/alfred-podcast.alfredworkflow">Download and install the latest release</a>** 

_You will need [Alfred Powerpack](https://www.alfredapp.com/powerpack/) to enable this workflow._

## Basic Usage
1. Invoke Alfred and type the keyword `pod` followed by your query. Results, including the artwork and title of the podcast, will populate below.
2. Press <kbd>Return</kbd> to open the selected result in your default browser.
3. Press <kbd>⌘</kbd> + <kbd>C</kbd> to copy the URL of the selected result to your clipboard.

## Advanced Usage
If you prefer to open a link directly to a specific platform, you can specify a keyword before your query, such as `pod overcast accidental`, to open the results in that platform. Supported keywords includes:
- apple
- breaker
- bullhorn
- castbox
- castro
- google
- listennotes
- overcast
- playerfm
- pocketcasts
- podbean
- podcastaddict
- podcastguru
- podchaser
- podhero
- podknife
- podnews
- radiopublic
- spotify
- stitcher
- rss

## Known Issues
PodLink sources shows from the Apple Podcasts directory. If a show is not listed there, it will not appear in search results.

Not all shows are available on all platforms. In the event that a show is not found on an platform, the link will redirect back to the PodLink page for that show. For example, `pod spotify exponent` isn't on Spotify, so the link will direct to PodLink instead.

## Credits
- Hat tip to [Chris Messina](https://twitter.com/chrismessina) for the nudge to create this!
- Inspired by [alfred-web-search-suggest](https://github.com/zqzten/alfred-web-search-suggest)
- Built with [alfred-workflow](https://github.com/joetannenbaum/alfred-workflow)
