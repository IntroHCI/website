<?php

$project_id = $_GET['id'];

$data = array();

if ($project_id == 'random') {
	$project_id = strval(rand(1,2));
}

if ($project_id == '1') {
	$data['title'] = 'Waiting in Line';
	$data['date'] = 'January 9';
	$data['summary'] = <<<SUMMARY
<p>Think about some of the designs that you consider to be great innovations. Quite likely, they came about because the design team was able to see a new problem or opportunity, or reframe things in a new way. As the light bulb joke illustrates, an important strategy of successful designers is to reframe things so that... we can see things in a new light. This first week's exercise is intended to work your perception and reframing "muscles". How creative can you be? (Later exercises will work different "muscles".)</p>
<p>Any questions about this assignment should be posed to the forums and will be answered promptly by the staff. </p>
<p>For this first project, <b>your mission is to redesign the experience of waiting in line</b>.</p>
<p>An important part of the designer's role is to come up with a point of view. For example, your point of view might be that standing in line is intrinsic, but being bored is not.</p>
<p>What can we do with our time that is more productive, more interesting, or more entertaining than just wait? Maybe it's reading the news, playing a game, or preempt the parents by giving them a surprise call? Alternatively, your point of view might be to eliminate the line by preordering, or hire people to act as placeholders in the line? Or maybe this is precious time for us to do nothing? A few minutes to space out, or quickly center ourselves. No matter what you come up with, it should be something that <b>improves the experience of standing in line</b>. For one jumping off point, <a href="http://www.nytimes.com/2012/08/19/opinion/sunday/why-waiting-in-line-is-torture.html?pagewanted=all&amp;_r=1&amp;">here's a few thoughts from the New York Times</a>.</p>
<p>This assignment will introduce iterative design so that during the main course project, the steps of the design process will be more familiar. For further explanations about the design process, have a look at the <b>d.school Bootcamp Bootleg</b> <a href="http://dschool.stanford.edu/use-our-methods/">here</a>.</p>
SUMMARY;
	$data['image'] = 'http://upload.wikimedia.org/wikipedia/commons/3/3b/Bowery_men_waiting_for_bread_in_bread_line,_New_York_City,_Bain_Collection.jpg';
}

else if ($project_id == '2') {
	$data['title'] = 'Needfinding';
	$data['date'] = 'January 16';
	$data['summary'] = <<<SUMMARY
<p>As Yogi Berra said, you can observe a lot just by watching. Watching how people do things is a great way to learn their goals and values, and come up with design insight. We call this <b>needfinding</b>. This assignment helps you train your eyes and ears to come up with design ideas. Your goal is to uncover user needs, breakdowns, clever hacks, and opportunities for improvement.</p>
SUMMARY;
	$data['image'] = 'http://developertodesigner.files.wordpress.com/2012/11/observing.jpg';	
}

else if ($project_id == '3') {
	$data['title'] = 'Prototyping';
	$data['date'] = 'January 23';
	$data['summary'] = <<<SUMMARY
<p>This is the first team assignment. Review and share the user needs you brainstormed. This week, you'll flesh out your design ideas by creating a point of view, seeking inspiration, storyboarding, and making paper prototypes. These are the blueprints for the mobile web application you'll make.</p>
SUMMARY;
	$data['image'] = 'http://www.google.com/think/images/prototyping-for-success_articles_lg.jpg';	
}

else if ($project_id == '4') {
	$data['title'] = 'Heuristic Evaluation';
	$data['date'] = 'January 30';
	$data['summary'] = <<<SUMMARY
<p>As Carolyn Snyder writes, "Paper prototyping is a variation of usability testing where the representative users perform realistic tasks by interacting with a paper version of the interface that is manipulated by a person 'playing computer' who doesn't explain how the interface is intended to work." In this assignment, your group will conduct heuristic evaluations (HEs) of your paper prototypes and you will individually help out other groups by evaluating theirs. This will complete the prototyping phase of the project, providing you with the feedback you need to begin implementing.</p>
SUMMARY;
	$data['image'] = 'http://searchwide.com/wp-content/uploads/2013/11/evaluation.jpg';	
}

else if ($project_id == '5') {
	$data['title'] = 'Skeleton and a Plan';
	$data['date'] = 'February 6';
	$data['summary'] = <<<SUMMARY
<p>Start by taking a look at the feedback you got last week from the Heuristic Evaluations of your prototypes. Distill the HE results into a list of concrete changes you want to make to your prototype. Use what worked, and improve what didn't. If you haven't already, make a decision about the prototype you are going with. This could be one of the two you tested or a combination of them. Again, take the time you need. This is what you will be working on for the rest of the course, so make sure you will feel invested in it.</p>
SUMMARY;
	$data['image'] = 'http://www.sccc.premiumdw.com/wp-content/uploads/2009/04/tutorial-wireframe-01.png';	
}

else {
	header_status(400);
	die('Project id ' . $project_id . ' not known');
}

$data['id'] = $project_id;

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
print(json_encode($data));





function header_status($statusCode) {
    static $status_codes = null;

    if ($status_codes === null) {
        $status_codes = array (
            100 => 'Continue',
            101 => 'Switching Protocols',
            102 => 'Processing',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            207 => 'Multi-Status',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            307 => 'Temporary Redirect',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            422 => 'Unprocessable Entity',
            423 => 'Locked',
            424 => 'Failed Dependency',
            426 => 'Upgrade Required',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported',
            506 => 'Variant Also Negotiates',
            507 => 'Insufficient Storage',
            509 => 'Bandwidth Limit Exceeded',
            510 => 'Not Extended'
        );
    }

    if ($status_codes[$statusCode] !== null) {
        $status_string = $statusCode . ' ' . $status_codes[$statusCode];
        header($_SERVER['SERVER_PROTOCOL'] . ' ' . $status_string, true, $statusCode);
    }
}

?>
