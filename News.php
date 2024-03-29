<?php
session_start();
include('loginfunctions.php');
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/generalstylesheet.css">
<link rel="stylesheet" type="text/css" href="css/News.css">
<link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
  <?php include('header.html');?>
  <?php isLoggedIn() ?>

<div class ="header centered">
<img src="images/news_header.jfif">
<h1>News</h1>
</div>

<section>
	<article>
			<h1 class="title">Seven Lions Tour</h1>
				<input type="checkbox" class="read-more-state" id="post-1" />
				<p class="read-more-wrap">Nghtmre and Slander have a sweet thing going with their Gud Vibrations supergroup.
          They perform under the name as a trio, release tunes under a record label by the same name and often take
           over festival stages to present top-tier electronic talent. Now, Gud Vibrations moves into arena territory,
           but they're not doing it alone. Nghtmre and Slander's supergroup will be joined by Seven Lions and The Glitch
           Mob. <br> <span class="read-more-target"> All three acts are popular for their unique take on bass music. Gud
           Vibrations are great at blending chaos and melody. Seven Lions is known for dreamy, sing-along melodies
           delivered with a dark aesthetic. The Glitch Mob is a time-tested trio that takes live beats and synth
           experimentation to rock-star levels. The heavy-hitting lineup put a lot of thought into creating magical
           moments together on the Alchemy Tour from September through October.</span></p>
				<label for="post-1" class="read-more-trigger"></label>
	</article>
</section>
<section>
	<article>
		<h1 class="title">'Hallucination': Pvris' EP Has Arrived</h1>
			<input type="checkbox" class="read-more-state" id="post-2" />
				<p class="read-more-wrap">Ever since the release of the critically-acclaimed second album All We Know of Heaven,
          All We Need of Hell, fans of Pvris have been clammoring to hear new music from the alt-pop trio. Lucky for them,
          today is the day. <br><span class="read-more-target">On Friday (Oct. 25), Pvris unveiled their new EP
          Hallucinations, a 5-song set that sees the band embracing their pop sound more than ever before. Their first
          project under their new deal with Reprise/Warner Records, the EP gives glimpses of their more rock-infused
          roots on tracks like "Nightmare" and "Death of Me" while taking modern pop sounds and fitting them to their
          darker, more complex sound on the Marshmello-assisted title track.</span></p>
				<label for="post-2" class="read-more-trigger"></label>
	</article>
</section>
<section>
	<article>
		<h1 class="title">A Day to Remember Singer: New Album Feels Like ‘Happiest Record That We’ve Ever Written’</h1>
			<input type="checkbox" class="read-more-state" id="post-3" />
				<p class="read-more-wrap">For a band that just a few years back put out an album titled Bad Vibrations, it's
          sounding like things are downright sunny in the A Day to Remember camp these days.
          <br><span class="read-more-target">Singer Jeremy McKinnon spoke with NME and revealed that their
          forthcoming album has a happier vibe overall. “The mood in the camp is positive,” said the singer. “I think
          that shows in the songs too. It kind of feels like the happiest record that we’ve written in a minute – or ever.
          It's definitely the happiest record we wrote to date. That’s definitely exciting for me. The name of the game
          this time was collaboration. You know, getting in a room together, getting in a room with people who inspire us,
          seeing what comes out.” <br>When asked if there was any darkness in the album, the singer added, "There's hints
          of it everywhere, but I wouldn't say as a whole it's that. There are songs here and there that have those topics,
          those moods, but for the most part it's pretty positive."</span></p>
				<label for="post-3" class="read-more-trigger"></label>
	</article>
</section>

<?php include('footer.html');?>
</body>
</html>
