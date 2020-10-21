'use strict';
const path = require('path');
const fs = require('fs');
const https = require('https');
const alfy = require('alfy');

let media = path.join(__dirname, 'media');
let cachelength = 60 * 60 * 1000; // 1 hour cache

function ensureDirectoryExistence(filePath) {
	var dirname = path.dirname(filePath);
	if (fs.existsSync(dirname)) {
	  return true;
	}
	ensureDirectoryExistence(dirname);
	fs.mkdirSync(dirname);
}


function download(filename, url, callback) {
	ensureDirectoryExistence(filename)
	let file = fs.createWriteStream(filename);

	https.get(url, function (response) {
		if (callback !== undefined) {
			response.pipe(file).on('finish', () => {
				callback(file);
			});
		}
	});
}

(async () => {
	const data = await alfy.fetch(`https://itunes.apple.com/search?term=${encodeURIComponent(alfy.input)}&limit=20&media=podcast`, {maxAge: cachelength});

	const results = data.results.map(result => {
		const trackCount = (result.trackCount === 300) ? '300+' : result.trackCount;
		const iconPath = path.join(media, `${result.collectionId}.jpg`);

		return {
			uid: result.collectionId,
			title: result.collectionName,
			subtitle: `${result.artistName} · Genre: ${result.primaryGenreName} · Episodes: ${trackCount}`,
			arg: result.collectionId,
			icon: {
				path: iconPath
			}
		};
	});

	data.results.forEach(result => {
		const iconPath = path.join(media, `${result.collectionId}.jpg`);

		fs.exists(iconPath, exists => {
			if (!exists) {
				download(iconPath, result.artworkUrl100, () => {
					return true;
				});
			}
		});
	});

	alfy.output(results);
})();
