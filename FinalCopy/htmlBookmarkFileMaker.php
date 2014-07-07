 <?php
    
    include 'comparisonFunction.php';
    include 'downloadFile.php';
    
    function sortandmerge() {
        $sessionID     = $_SESSION['UID'];
        $userDirectory = 'upload/' . $sessionID;
        
        $wikipediaUrlArray = array();
        $acedemiaUrlArray  = array();
        $videoUrlArray     = array();
        $socialUrlArray    = array();
        $otherUrlArray     = array();
        $resultantArray    = array();
        
        $timeStamp          = time();
        $bookMarkHtmlString = '<!DOCTYPE NETSCAPE-Bookmark-file-1>
<!-- This is an automatically generated file.
     It will be read and overwritten.
     DO NOT EDIT! -->
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<TITLE>Bookmarks</TITLE>
<DL>' . "\n";
        
        $wikipatternName = '(wikipedia)i';
        $wikipatternURL  = '((wikipedia.org)|(wikihow.com))i';
        
        $acedemiapatternName = '((php)|(jquery)|(html)|(java)|(SQL)|(C++)|(stackoverflow))i';
        $acedemiapatternURL  = '((php.net)|(jquery.com)|(w3schools.com)|(tutorialspoint.com)|(stackoverflow.com))i';
        
        $videopatternName = '((video)|(film)|(motion picture))i';
        $videopatternURL  = '((youtube.com)|(vimeo.com))i';
        
        $socialpatternName = '((facebook)|(social)|(social networking)|(microblogging)|(tweets)|(pinterest))i';
        $socialpatternURL  = '((facebook.com)|(twitter.com)|(pinterest.com))i';
        
        for ($fileIndex = 0; $fileIndex < $_SESSION['fileCount']; $fileIndex++) {
            
            $json         = file_get_contents($userDirectory . "/" . $fileIndex . "Bookmarks");
            $bookmarkFILE = json_decode($json);
            $urlArray     = array();
            
            if ($bookmarkFILE == NULL) {
                echo "File can't be decoded and is possibly corrupted.";
            } else {
                $categories = $bookmarkFILE->roots;
                foreach ($categories as $categoryMajor) {
                    foreach ($categoryMajor->children as $child) {
					    if (!empty($child)) {
                            if ((preg_match($wikipatternName, $child->name)) || (preg_match($wikipatternURL, $child->url))) {
                                array_push($wikipediaUrlArray, $child);
                            } else if ((preg_match($acedemiapatternName, $child->name)) || (preg_match($acedemiapatternURL, $child->url))) {
                                array_push($acedemiaUrlArray, $child);
                            } else if ((preg_match($socialpatternName, $child->name)) || (preg_match($socialpatternURL, $child->url))) {
                                array_push($socialUrlArray, $child);
                            } else {
                                array_push($otherUrlArray, $child);
                            }
                        }
                        
                    }
                }
            }
        }
        echo '<br><br>';
        
        if (!empty($wikipediaUrlArray)) {
            
            $bookMarkHtmlString  = $bookMarkHtmlString . '<DT><H3 ADD_DATE="' . $timeStamp . '" LAST_MODIFIED="0">Wikipedia</H3>' . "\n" . '<DL>' . "\n";
            $wikipediaArrayFinal = array_unique($wikipediaUrlArray, SORT_REGULAR);
            echo '<br>Sorted WiKis<br>';
            usort($wikipediaArrayFinal, "cmp");
            foreach ($wikipediaArrayFinal as $wiki) {
                $bookMarkHtmlString = $bookMarkHtmlString . '<DT><A HREF="' . $wiki->url . '" ADD_DATE="' . $timeStamp . '">' . $wiki->name . '</A>' . "\n";
            }
            $bookMarkHtmlString = $bookMarkHtmlString . '</DL>' . "\n";
        }
        
        if (!empty($acedemiaUrlArray)) {
            
            $bookMarkHtmlString = $bookMarkHtmlString . '<DT><H3 ADD_DATE="' . $timeStamp . '" LAST_MODIFIED="0">Acedemia</H3>' . "\n" . '<DL>' . "\n";
            $acedemiaArrayFinal = array_unique($acedemiaUrlArray, SORT_REGULAR);
            echo '<br>Sorted Acedemia<br>';
            usort($acedemiaArrayFinal, "cmp");
            foreach ($acedemiaArrayFinal as $acedemia) {
                $bookMarkHtmlString = $bookMarkHtmlString . '<DT><A HREF="' . $acedemia->url . '" ADD_DATE="' . $timeStamp . '">' . $acedemia->name . '</A>' . "\n";
            }
            $bookMarkHtmlString = $bookMarkHtmlString . '</DL>' . "\n";
        }
        
        if (!empty($videoUrlArray)) {
            
            $bookMarkHtmlString = $bookMarkHtmlString . '<DT><H3 ADD_DATE="' . $timeStamp . '" LAST_MODIFIED="0">Videos</H3>' . "\n" . '<DL>' . "\n";
            $videoArrayFinal    = array_unique($videoUrlArray, SORT_REGULAR);
            echo '<br>Sorted Videos<br>';
            usort($videoArrayFinal, "cmp");
            foreach ($videoArrayFinal as $video) {
                $bookMarkHtmlString = $bookMarkHtmlString . '<DT><A HREF="' . $video->url . '" ADD_DATE="' . $timeStamp . '">' . $video->name . '</A>' . "\n";
            }
            $bookMarkHtmlString = $bookMarkHtmlString . '</DL>' . "\n";
        }
        
        if (!empty($socialUrlArray)) {
            
            $bookMarkHtmlString = $bookMarkHtmlString . '<DT><H3 ADD_DATE="' . $timeStamp . '" LAST_MODIFIED="0">Social</H3>' . "\n" . '<DL>' . "\n";
            $socialArrayFinal   = array_unique($socialUrlArray, SORT_REGULAR);
            echo '<br>Sorted Socials<br>';
            usort($socialArrayFinal, "cmp");
            foreach ($socialArrayFinal as $social) {
                $bookMarkHtmlString = $bookMarkHtmlString . '<DT><A HREF="' . $social->url . '" ADD_DATE="' . $timeStamp . '">' . $social->name . '</A>' . "\n";
            }
            $bookMarkHtmlString = $bookMarkHtmlString . '</DL>' . "\n";
        }
        
        if (!empty($otherUrlArray)) {
            
            $bookMarkHtmlString = $bookMarkHtmlString . '<DT><H3 ADD_DATE="' . $timeStamp . '" LAST_MODIFIED="0">Social</H3>' . "\n" . '<DL>' . "\n";
            $otherArrayFinal    = array_unique($otherUrlArray, SORT_REGULAR);
            echo '<br>Sorted Others<br>';
            usort($otherArrayFinal, "cmp");
            foreach ($otherArrayFinal as $other) {
                $bookMarkHtmlString = $bookMarkHtmlString . '<DT><A HREF="' . $other->url . '" ADD_DATE="' . $timeStamp . '">' . $other->name . '</A>' . "\n";
            }
            $bookMarkHtmlString = $bookMarkHtmlString . '</DL>' . "\n";
        }
        
        $bookMarkHtmlString = $bookMarkHtmlString . '</DL>';
        $resultFILE         = "upload/" . $sessionID . "/" . "Result.html";
        $resultFileHandle = fopen($resultFILE, 'w') or die("can't open file");
        fwrite($resultFileHandle, $bookMarkHtmlString);
        
    }
?> 