# geopaths

Geopaths is a small project I put together to track how far the treasure in Geocaches travel.

1. First you print out a QR code with the link to a finding page.

2. Go Geocaching and place that QR Token inside one of the hidden caches you find.

3. Sit back and watch where the token travels.

Anyone can view where the token has been, but you can only submit when you have found the QR token. When on a submission page, the browser will ask for location. From that the reverse Geocoding API from Google maps is used to get a rough idea of where you are. The user can add their name and any comments to the log.

##How do you add new tokens?

It is easy! All you have to do is add a new item to the array in the 'pass_hashes.php' file. The .txt logfile and the php page are generated when the first person finds the QR code and submits their info.

This is my first open sourced project. Go easy on me.
