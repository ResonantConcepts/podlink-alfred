# PodLink Autocomplete for Alfred
PodLink generates a free landing page for every podcast to help listeners find shows in their favorite podcast app. This Alfred workflow brings the PodLink autocomplete straight to your Alfred launcher. [Alfred Powerpack](https://www.alfredapp.com/powerpack/) is required to run Alfred Workflows.

![Demo gif](demo-640.gif)

## Get Started
1. [**Download and install the latest release**](https://github.com/ResonantConcepts/podlink-alfred/releases)
2. Invoke Alfred and then run this workflow by typing the keyword `pod` followed by your query.
3. Results will appear including the artwork and title of the podcast.
4. Select a result and hit <kbd>⏎</kbd> to open the PodLink page in your default browser.
5. Select a result and hit <kbd>⌘</kbd> + <kbd>C</kbd> to copy the URL to your clipboard.
6. Alternatively, specify a keyword before your query, such as `pod overcast accidental`, to open the link for your preferred app. Currently, the list of supported keywords are:
	- apple
	- breaker
	- castbox
	- castro
	- google
	- overcast
	- playerfm
	- podcastaddict
	- pocketcasts
	- spotify
	- stitcher
	- rss
7. Searching with the app keywords will still find shows on PodLink even if that show isn’t in that particular app, such as `pod spotify exponent`. In that case, the link will redirect back to the PodLink page for that show. 

## Credits
- Hat tip to [Chris Messina](https://twitter.com/chrismessina) for the nudge to get this working!
- Derived from [alfred-web-search-suggest](https://github.com/zqzten/alfred-web-search-suggest)
- Using the [alfred-workflow](https://github.com/joetannenbaum/alfred-workflow) library
