<!DOCTYPE html>
<html>
<head>
    <title>Course list</title>
    <meta charset="utf-8" />
    <link href="courses.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="header">
    <h1>Courses at CSE</h1>
<!-- Ex. 1: File of Courses -->
    <?php
        $filename = "courses.tsv";
        $lines = file($filename);
    ?>
    <p>
        Course list has <?= count($lines) ?> total courses
        and
        size of <?= filesize($filename) ?>bytes.
    </p>
</div>
<div class="article">
    <div class="section">
        <h2>Today's Courses</h2>
<!-- Ex. 2: Today’s Courses & Ex 6: Query Parameters -->
        <?php
            function getCoursesByNumber($listOfCourses, $numberOfCourses){
                $resultArray = array();
//                implement here.
                shuffle($listOfCourses);
                foreach ($listOfCourses as $word) {
                    $resultArray[] = $word;
                    if (count($resultArray) == $numberOfCourses) { 
                        break; 
                    }
                }
                return $resultArray;
            }
            $number_of_courses=3;
            if(isset($_GET["number_of_courses"])){
                if($_GET["number_of_courses"]==""){
                    $todaysCourses = getCoursesByNumber($lines,$number_of_courses);
                }else{
                    $todaysCourses = getCoursesByNumber($lines,$_GET["number_of_courses"]);
                }
            }else{
                $todaysCourses = getCoursesByNumber($lines,$number_of_courses);
            }
            
        ?>
        <ol>
            <?php foreach ($todaysCourses as $word) { 
                $tmp = explode("\t", $word);
                ?>
                <li><?= $tmp[0] ?> - <?= $tmp[1] ?></li>
            <?php } ?>
        </ol>
    </div>
    <div class="section">
        <h2>Searching Courses</h2>
<!-- Ex. 3: Searching Courses & Ex 6: Query Parameters -->
        <?php
            function getCoursesByCharacter($listOfCourses, $startCharacter){
                $resultArray = array();
//                implement here.
                foreach ($listOfCourses as $word) {
                    $tmp = explode("\t", $word);
                    if(substr($tmp[0], 0,1)==$startCharacter){
                        $resultArray[]=$word;
                    }
                }
                return $resultArray;
            }
            $character = 'C';
            if(isset($_GET["character"])){
                if($_GET["character"]==""){
                    $character= 'C';
                }else{
                    $character = $_GET["character"];
                }
            }
            $searchedCourses = getCoursesByCharacter($lines, $character);
        ?>
        <p>
            Courses that started by <strong><?= $character ?></strong> are followings :
        </p>
        <ol>
            <?php 
                foreach ($searchedCourses as $word) { 
                    $tmp = explode("\t", $word); ?>
                    <li><?= $tmp[0] ?> - <?= $tmp[1] ?></li>
            <?php } ?>
        </ol>
    </div>
    <div class="section">
        <h2>List of Courses</h2>
<!-- Ex. 4: List of Courses & Ex 6: Query Parameters -->
        <?php
            function getCoursesByOrder($listOfCourses, $orderby){
                $resultArray = $listOfCourses;
//                implement here.
                if($orderby ==0){
                    sort($resultArray);
                }else if($orderby==1){
                    rsort($resultArray);
                }
                return $resultArray;
            }
            $orderby = 0;
            if(isset($_GET["orderby"])){
                if($_GET["orderby"]==""){
                    $orderby=0;
                }else{
                    $orderby = $_GET["orderby"];
                }
                
            }
            $orderedCourses = getCoursesByOrder($lines, $orderby);
        ?>
        
        <?php if($orderby == 0) { ?>
            <p>All of courses ordered by <strong>alphabetical order</strong> are followings :</p>
        <?php } else if ($orderby == 1) { ?>
            <p>All of courses ordered by <strong>alphabetical reverse order</strong> are followings :</p>
        <?php } ?>
        <ol>
            <?php 
                foreach ($orderedCourses as $word) {
                    if($tmp){
                        $tmp = explode("\t", $word); 
                        if(strlen($tmp[0])>20){ ?>
                            <li class="long"> <?= $tmp[0] ?> - <?= $tmp[1] ?></li>
                        <?php } else {?>
                         <li> <?= $tmp[0] ?> - <?= $tmp[1] ?></li>
            <?php }}} ?>
        </ol>

    </div>
    <div class="section">
        <h2>Adding Courses</h2>
<!-- Ex. 5: Adding Courses & Ex 6: Query Parameters -->
            <?php 
            $new_course = "";
            $code_of_course = "";
            
            if(isset($_GET["new_course"]) && isset($_GET["code_of_course"])){
                if($_GET["new_course"]=="" || $_GET["code_of_course"]==""){ ?>
                    <p>Input course or code of the course doesn't exist.</p>
                <?php } else {
                 file_put_contents($filename, "\n".$_GET["new_course"]."\t".$_GET["code_of_course"], FILE_APPEND); ?>
                <p>Adding a course is success!<p>
            <?php } 
            }else{ ?>
            <p>Input course or code of the course doesn't exist.</p>
            <?php } ?>
    </div>
</div>
<div id="footer">
    <a href="http://validator.w3.org/check/referer">
        <img src="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/images/w3c-html.png" alt="Valid HTML5" />
    </a>
    <a href="http://jigsaw.w3.org/css-validator/check/referer">
        <img src="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/images/w3c-css.png" alt="Valid CSS" />
    </a>
</div>
</body>
</html>