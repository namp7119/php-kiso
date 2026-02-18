<?php

abstract class Media {
    abstract public function play();
}

class Music extends Media {
    private $songTitle;

    public function __construct($songTitle) {
        $this->songTitle = $songTitle;
    }

    public function play() {
        return "「{$this->songTitle}を再生中」";
    }

}

class Video extends Media {
    private $videoTitle;

    public function __construct($videoTitle) {
        $this->videoTitle = $videoTitle;
    }

    public function play() {
        return "「{$this-> videoTitle}を再生中」";
    }
}

class Podcast extends Media {
    private $episodeTitle;

    public function __construct($episodeTitle) {
        $this->episodeTitle = $episodeTitle;
    }

    public function play() {
        return "「{$this-> episodeTitle}を再生中」";
    }
}

$playlist = [
    new Music("[ディズニー]"),
    new Video("[旅行Vlog]"),
    new Podcast("[英会話]"),
];

foreach ($playlist as $item) {
    echo $item->play() . PHP_EOL;
}