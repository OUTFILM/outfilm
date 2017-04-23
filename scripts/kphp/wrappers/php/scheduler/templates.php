<?php
require_once '../lib/Kendo/Autoload.php';

require_once '../include/header.php';
$data = array(
           array(
                'title' => 'Fast and furious 6',
                'image' => '../content/web/scheduler/fast-and-furious.jpg',
                'imdb' => 'http://www.imdb.com/title/tt1905041/',
                'start' => new DateTime('2013/6/13 17:00'),
                'end' => new DateTime('2013/6/13 18:30')
            ),
            array(
                'title' => 'The Internship',
                'image' => '../content/web/scheduler/the-internship.jpg',
                'imdb' => 'http://www.imdb.com/title/tt2234155/',
                'start' => new DateTime('2013/6/13 14:00'),
                'end' => new DateTime('2013/6/13 15:30')
            ),
            array(
                'title' => 'The Perks of Being a Wallflower',
                'image' => '../content/web/scheduler/wallflower.jpg',
                'imdb' => 'http://www.imdb.com/title/tt1659337/',
                'start' => new DateTime('2013/6/13 16:00'),
                'end' => new DateTime('2013/6/13 17:30')
            ),
            array(
                'title' => 'The Help',
                'image' => '../content/web/scheduler/the-help.jpg',
                'imdb' => 'http://www.imdb.com/title/tt1454029/',
                'start' => new DateTime('2013/6/13 12:00'),
                'end' => new DateTime('2013/6/13 13:30')
            ),
            array(
                'title' => 'Now You See Me',
                'image' => '../content/web/scheduler/now-you-see-me.jpg',
                'imdb' => 'http://www.imdb.com/title/tt1670345/',
                'start' => new DateTime('2013/6/13 10:00'),
                'end' => new DateTime('2013/6/13 11:30')
            ),
            array(
                'title' => 'Fast and furious 6',
                'image' => '../content/web/scheduler/fast-and-furious.jpg',
                'imdb' => 'http://www.imdb.com/title/tt1905041/',
                'start' => new DateTime('2013/6/13 19:00'),
                'end' => new DateTime('2013/6/13 20:30')
            ),
            array(
                'title' => 'The Internship',
                'image' => '../content/web/scheduler/the-internship.jpg',
                'imdb' => 'http://www.imdb.com/title/tt2234155/',
                'start' => new DateTime('2013/6/13 17:30'),
                'end' => new DateTime('2013/6/13 19:00')
            ),
            array(
                'title' => 'The Perks of Being a Wallflower',
                'image' => '../content/web/scheduler/wallflower.jpg',
                'imdb' => 'http://www.imdb.com/title/tt1659337/',
                'start' => new DateTime('2013/6/13 17:30'),
                'end' => new DateTime('2013/6/13 19:00')
            ),
            array(
                'title' => 'The Help',
                'image' => '../content/web/scheduler/the-help.jpg',
                'imdb' => 'http://www.imdb.com/title/tt1454029/',
                'start' => new DateTime('2013/6/13 13:30'),
                'end' => new DateTime('2013/6/13 15:00')
            ),
            array(
                'title' => 'Now You See Me',
                'image' => '../content/web/scheduler/now-you-see-me.jpg',
                'imdb' => 'http://www.imdb.com/title/tt1670345/',
                'start' => new DateTime('2013/6/13 12:30'),
                'end' => new DateTime('2013/6/13 14:00')
            )
);

$dataSource = new \Kendo\Data\DataSource();
$dataSource->data($data);

$scheduler = new \Kendo\UI\Scheduler('scheduler');
$scheduler->date(new DateTime('2013/6/13'))
        ->height(600)
        ->addView(
            array('type' => 'day', 'startTime' => new DateTime('2013/6/13 10:00'), 'endTime' => new DateTime('2013/6/13 23:00')),
            array('type' => 'agenda', 'startTime' => new DateTime('2013/6/13 10:00'), 'endTime' => new DateTime('2013/6/13 23:00'))
        )
        ->editable(false)
        ->eventTemplateId('event-template')
        ->dataSource($dataSource);

echo $scheduler->render();
?>

<script id="event-template" type="text/x-kendo-template">
    <div class='movie-template'>
        <img src="#= image #">
        <p>
            #: kendo.toString(start, "hh:mm") # - #: kendo.toString(end, "hh:mm") #
        </p>
        <h3>#: title #</h3>
        <a href="#= imdb #">Movie in IMDB</a>
    </div>
</script>

<style>
    .movie-template img {
        float: left;
        margin: 0 8px;
    }
    .movie-template p {
        margin: 5px 0 0;
    }
    .movie-template h3 {
        padding: 0 8px 5px;
        font-size: 12px;
    }
    .movie-template a {
        color: #ffffff;
        font-weight: bold;
        text-decoration: none;
    }
    .k-state-hover .movie-template a,
    .movie-template a:hover {
        color: #000000;
    }
    
    body, h1, h2, h3
    {
        margin: 0px;        
    }
</style>

<?php require_once '../include/footer.php'; ?>
