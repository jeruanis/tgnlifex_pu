<?php

$badwords = [ "/(fuck)/", "/(ashole)/", "/(bitch)/", "/(whore)/", "/(tangina)/", "/(puta)/", "/(inamo)/", "/(putang)/", "/(bitch)/", "/(pota)/", "/(iyot)/", "/(kantot)/", "/(hindot)/", "/(tamod)/", "/(kupal)/","/(Fuck)/", "/(Ashole)/", "/(ashole)/", "/(Asshole)/", "/(asshole)/", "/(Bitch)/", "/(Whore)/", "/(Tangina)/", "/(Puta)/", "/(Inamo)/", "/(Putang)/", "/(Pota)/", "/(Iyot)/", "/(Kantot)/", "/(Hindot)/", "/(Tamod)/", "/(Kupal)/", "/(bolbol)/", "/(Bolbol)/", "/(Bullshit)/",  "/(bullshit)/", "/(hayop)/", "/(Hayop)/", "/(HAYOP)/", "/(TSUPA)/", "/(Tsupa)/", "/(tsupa)/", "/(shit)/", "/(Shit)/", "/(SHIT)/"];

$comment_body= preg_replace_callback(
        $badwords,
        function ($matches) {
            return str_repeat('*', strlen($matches[0]));
        },
        $comment_body
    );
