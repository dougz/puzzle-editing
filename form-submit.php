<?php // vim:set ts=4 sw=4 sts=4 et:
require_once "config.php";
require_once "html.php";
require_once "utils.php";

// Redirect to the login page, if not logged in
$uid = isLoggedIn();

if (isset($_POST['editTSD'])) {
    $pid = $_POST['pid'];
    $title = $_POST['title'];
    $summary = $_POST['summary'];
    $description = $_POST['description'];

    changeTitleSummaryDescription($uid, $pid, $title, $summary, $description);

    header('Location: ' . URL . "/puzzle.php?pid=$pid");
    exit(0);
}

if (isset($_POST['cancelTSD'])) {
    $pid = $_POST['pid'];

    header('Location: ' . URL . "/puzzle.php?pid=$pid");
    exit(0);
}

if (isset($_POST['changeAnswers'])) {
    $pid = $_POST['pid'];

    if (isset($_POST['addAns'])) {
        $add = $_POST['addAns'];
    } else {
        $add = NULL;
    }

    if (isset($_POST['removeAns'])) {
        $remove = $_POST['removeAns'];
    } else {
        $remove = NULL;
    }

    changeAnswers($uid, $pid, $add, $remove);

    header("Location: " . URL . "/puzzle.php?pid=$pid");
    exit(0);
}

if (isset($_POST['changeFactcheckers'])) {
    $pid = $_POST['pid'];

    if (isset($_POST['addFactchecker'])) {
        $add = $_POST['addFactchecker'];
    } else {
        $add = NULL;
    }

    if (isset($_POST['removeFactchecker'])) {
        $remove = $_POST['removeFactchecker'];
    } else {
        $remove = NULL;
    }

    changeFactcheckers($uid, $pid, $add, $remove);

    header("Location: " . URL . "/puzzle.php?pid=$pid");
    exit(0);
}

if (isset($_POST['changeAuthors'])) {
    $pid = $_POST['pid'];

    if (isset($_POST['addAuth'])) {
        $add = $_POST['addAuth'];
    } else {
        $add = NULL;
    }

    if (isset($_POST['removeAuth'])) {
        $remove = $_POST['removeAuth'];
    } else {
        $remove = NULL;
    }

    changeAuthors($uid, $pid, $add, $remove);

    header("Location: " . URL . "/puzzle.php?pid=$pid");
    exit(0);
}

if (isset($_POST['changeSpoiled'])) {
    $pid = $_POST['pid'];

    if (isset($_POST['removeSpoiledUser'])) {
        $removeUser = $_POST['removeSpoiledUser'];
    } else {
        $removeUser = NULL;
    }

    if (isset($_POST['addSpoiledUser'])) {
        $addUser = $_POST['addSpoiledUser'];
    } else {
        $addUser = NULL;
    }

    changeSpoiled($uid, $pid, $removeUser, $addUser);
    if ($removeUser[0] == $uid) {
        head();
        echo "<div class='okmsg'>Removed you as spoiled. Not redirecting to avoid re-spoiling you.</div>\n";
        exit(0);
    }

    header("Location: " . URL . "/puzzle.php?pid=$pid");
    exit(0);
}

if (isset($_POST['changeNeededEditors'])) {
    $pid = $_POST['pid'];
    $need = $_POST['needed_editors'];
    changeNeededEditors($uid, $pid, $need);
    header("Location: " . URL . "/puzzle.php?pid=$pid");
    exit(0);
}

if (isset($_POST['changeEditors'])) {
    $pid = $_POST['pid'];

    if (isset($_POST['addEditor'])) {
        $add = $_POST['addEditor'];
    } else {
        $add = NULL;
    }
    if (isset($_POST['removeEditor'])) {
        $remove = $_POST['removeEditor'];
    } else {
        $remove = NULL;
    }
    changeEditors($uid, $pid, $add, $remove);

    header("Location: " . URL . "/puzzle.php?pid=$pid");
    exit(0);
}

if (isset($_POST['changeApprovers'])) {
    $pid = $_POST['pid'];

    if (isset($_POST['addApprover'])) {
        $add = $_POST['addApprover'];
    } else {
        $add = NULL;
    }
    if (isset($_POST['removeApprover'])) {
        $remove = $_POST['removeApprover'];
    } else {
        $remove = NULL;
    }
    changeApprovers($uid, $pid, $add, $remove);

    header("Location: " . URL . "/puzzle.php?pid=$pid");
    exit(0);
}

if (isset($_POST['changeTags'])) {
    $pid = $_POST['pid'];

    if (isset($_POST['addTag'])) {
        $add = $_POST['addTag'];
    } else {
        $add = NULL;
    }
    if (isset($_POST['removeTag'])) {
        $remove = $_POST['removeTag'];
    } else {
        $remove = NULL;
    }
    changeTags($uid, $pid, $add, $remove);

    header("Location: " . URL . "/puzzle.php?pid=$pid");
    exit(0);
}

if (isset($_POST['changeRoundCaptain'])) {
    $pid = $_POST['pid'];

    if (isset($_POST['addRoundCaptain'])) {
        $add = $_POST['addRoundCaptain'];
    } else {
        $add = NULL;
    }

    if (isset($_POST['removeRoundCaptain'])) {
        $remove = $_POST['removeRoundCaptain'];
    } else {
        $remove = NULL;
    }

    changeRoundCaptains($uid, $pid, $add, $remove);

    header("Location: " . URL . "/puzzle.php?pid=$pid");
    exit(0);
}

if (isset($_POST['changeTesterLimit'])) {
    $pid = $_POST['pid'];
    $tester_limit = $_POST['tester_limit'];
    changeTesterLimit($uid, $pid, $tester_limit);
    header("Location: " . URL . "/puzzle.php?pid=$pid");
    exit(0);
}

if (isset($_POST['changePuzzleStatus'])) {
    $pid = $_POST['pid'];

    $status = $_POST['status'];

    changePuzzleStatus($uid, $pid, $status);

    header("Location: " . URL . "/puzzle.php?pid=$pid");
    exit(0);
}

if (isset($_POST['changeCredits'])) {
    $pid = $_POST['pid'];

    $credits = $_POST['credits'];

    changeCredits($uid, $pid, $credits);

    header("Location: " . URL . "/puzzle.php?pid=$pid");
    exit(0);
}

if (isset($_POST['changeNotes'])) {
    $pid = $_POST['pid'];

    $notes = $_POST['notes'];

    changeNotes($uid, $pid, $notes);

    header("Location: " . URL . "/puzzle.php?pid=$pid");
    exit(0);
}

if (isset($_POST['changeEditorNotes'])) {
    $pid = $_POST['pid'];

    $notes = $_POST['notes'];

    changeEditorNotes($uid, $pid, $notes);

    header("Location: " . URL . "/puzzle.php?pid=$pid");
    exit(0);
}

if (isset($_POST['changeRuntime'])) {
    $pid = $_POST['pid'];

    $notes = $_POST['notes'];

    changeRuntime($uid, $pid, $notes);

    header("Location: " . URL . "/puzzle.php?pid=$pid");
    exit(0);
}

if (isset($_POST['changeWikiPage'])) {
    $pid = $_POST['pid'];

    $wikiPage = $_POST['wikiPage'];

    changeWikiPage($uid, $pid, $wikiPage);

    header("Location: " . URL . "/puzzle.php?pid=$pid");
    exit(0);
}

if (isset($_POST['uploadFile'])) {
    $pid = $_POST['pid'];

    $type = $_POST['filetype'];
    $file = $_FILES['fileupload'];

    uploadFiles($uid, $pid, $type, $file);

    header("Location: " . URL . "/puzzle.php?pid=" . $pid);
    exit(0);
}

if (isset($_POST['addcomment'])) {
    $pid = $_POST['pid'];

    $comment = $_POST['comment'];

    addComment($uid, $pid, $comment, FALSE, FALSE, TRUE);

    header("Location: " . URL . "/puzzle.php?pid=" . $pid);
    exit(0);
}

if (isset($_POST['requestTestsolve'])) {
    $pid = $_POST['pid'];
    $notes = $_POST['notes'];

    requestTestsolve($uid, $pid, $notes);

    header("Location: " . URL . "/puzzle.php?pid=" . $pid);
    exit(0);
}

if (isset($_POST['clearTestsolveRequests'])) {
    $pid = $_POST['pid'];

    clearTestsolveRequests($pid);

    header("Location: " . URL . "/puzzle.php?pid=" . $pid);
    exit(0);
}

if (isset($_POST['clearOneTestsolveRequest'])) {
    $pid = $_POST['pid'];

    clearOneTestsolveRequest($pid);

    header("Location: " . URL . "/puzzle.php?pid=" . $pid);
    exit(0);
}

if (isset($_POST['emailSub'])) {
    $pid = $_POST['pid'];
    subscribe($uid, $pid);

    header("Location: " . URL . "/puzzle.php?pid=" . $pid);
    exit(0);
}

if (isset($_POST['emailUnsub'])) {
    $pid = $_POST['pid'];
    unsubscribe($uid, $pid);

    header("Location: " . URL . "/puzzle.php?pid=" . $pid);
    exit(0);
}

if (isset($_POST['getTest'])) {

    $pid = getPuzzleToTest($uid);
    if ($pid) {
        addPuzzleToTestQueue($uid, $pid);
    } else {
        $_SESSION['failedToAdd'] = TRUE;
    }

    header("Location: " . URL . "/testsolving.php");
    exit(0);
}

if (isset($_POST['SelfAddFactchecker'])) {
    // User wishes to opt in to factchecking duty.
    grantFactcheckPowers($uid);
    header("Location: " . URL . "/factcheck.php");
    exit(0);
}

if (isset($_POST['FactcheckPuzzle'])) {
    $pid = $_POST['pid'];

    addFactcheckers($uid, $pid, array($uid));

    header("Location: " . URL . "/factcheck.php");
    exit(0);
}

if (isset($_POST['TestAdminPuzzle'])) {
    $pid = $_POST['pid'];

    if (!addToTestAdminQueue($uid, $pid)) {
        $_SESSION['failedToAdd'] = TRUE;
    }
    header("Location: " . URL . "/testadmin.php");
    exit(0);
}

if (isset($_POST['getTestId'])) {
    $pid = $_POST['pid'];

    if (!validPuzzleId($pid)) {
        utilsError("Invalid puzzle ID.");
    }

    if (hasTestAdminPermission($uid)) {
        header("Location: " . URL . "/test.php?pid=" . $pid);
        exit(0);
    }

    if (canTestPuzzle($uid, $pid, TRUE) && !isTesterOnPuzzle($uid, $pid)) {
        addPuzzleToTestQueue($uid, $pid);
        header("Location: " . URL . "/test.php?pid=" . $pid);
    } elseif (isTesterOnPuzzle($uid, $pid)) {
        header("Location: " . URL . "/test.php?pid=" . $pid);
    } else {
        if (!isset($_SESSION['testError'])) {
            $_SESSION['testError'] = "Could not add Puzzle $pid to your queue";
        }
        header("Location: " . URL . "/testsolving.php");
    }
    exit(0);
}

if (isset($_POST['getPuzz'])) {
    $pid = $_POST['pid'];

    if ($pid && isEditorAvailable($uid, $pid)) {
        addPuzzleToEditorQueue($uid, $pid);
    } else {
        $_SESSION['failedToAdd'] = TRUE;
        $_SESSION['failedToAddEdit'] = TRUE;
    }

    header("Location: " . URL . "/editor.php");
    exit(0);
}

if (isset($_POST['checkAns'])) {
    $pid = $_POST['pid'];
    $answer = $_POST['ans'];

    $_SESSION['answer'] = $answer;

    makeAnswerAttempt($uid, $pid, $answer);

    header("Location: " . URL . "/test.php?pid=$pid");
    exit(0);
}

if (isset($_POST['makeTester'])) {
    $pid = $_POST['pid'];

    addPuzzleToTestQueue($uid, $pid);

    header("Location: " . URL . "/test.php?pid=$pid");
    exit(0);
}

if (isset($_POST['feedback'])) {
    $pid = $_POST['pid'];
    $done = $_POST['done'];
    $spoilage = $_POST['spoilage'];
    $time = $_POST['time'];
    $tried = $_POST['tried'];
    $liked = $_POST['liked'];
    $breakthrough = $_POST['breakthrough'];
    $skills = $_POST['skills'];
    $fun = $_POST['fun'];
    $difficulty = $_POST['difficulty'];
    $when_return = $_POST['when_return'];
    insertFeedback($uid, $pid, $done, $spoilage, $time, $tried, $liked, $skills, $breakthrough, $fun, $difficulty, $when_return);
    $_SESSION['feedback'] = "Thank you for giving feedback on this puzzle!";

    if (strcmp($done, 'yes') == 0) {
        header("Location: " . URL . "/test.php?pid=$pid");
    } else {
        header("Location: " . URL . "/testsolving.php");
    }
    exit(0);
}

if (isset($_POST['getTestAdminPuzz'])) {

    $p = getPuzzleForTestAdminQueue($uid);
    if ($p != FALSE) {
        addToTestAdminQueue($uid, $p);
    } else {
        $_SESSION['failedToAdd'] = TRUE;
    }
    header("Location: " . URL . "/testadmin.php");
    exit(0);
}

if (isset($_POST['postprod'])) {
    $pid = $_POST['pid'];

    pushToPostProd($uid, $pid);

    header("Location: " . URL . "/puzzle.php?pid=$pid");
    exit(0);
}

if (isset($_POST['postprodAll'])) {

    postprodAll($uid);

    header("Location: " . URL . "/postprod.php");
    exit(0);
}

if (isset($_POST['setPuzzApprove'])) {
    $pid = $_POST['pid'];
    $approve = $_POST['puzzApprove'];

    setPuzzApprove($uid, $pid, $approve);

    header("Location: "  . URL . "/puzzle.php?pid=$pid");
    exit(0);
}

if (isset($_POST['setPuzzPriority'])) {
    $pid = $_POST['pid'];
    $priority = $_POST['puzzPriority'];

    setPuzzPriority($uid, $pid, $priority);

    header("Location: "  . URL . "/puzzle.php?pid=$pid");
    exit(0);
}

if (isset($_POST['killPuzzle'])) {
    $pid = $_POST['pid'];

    changePuzzleStatus($uid, $pid, getDeadStatusId());

    header("Location: "  . URL . "/puzzle.php?pid=$pid");
    exit(0);
}

if (isset($_POST['setflag'])) {
    $pid = $_POST['pid'];
    $flag = $_POST['flag'];

    if ($flag) {
        setFlag($uid, $pid, 1);
    } else {
        setFlag($uid, $pid, 0);
    }
    header("Location: " . URL . "/puzzle.php?pid=$pid");
    exit(0);
}

if (isset($_POST['markunseen'])) {
    $pid = $_POST['pid'];

    markUnseen($uid, $pid);

    header("Location: " . URL);
    exit(0);
}

if (isset($_POST['setUserTestTeam'])) {
    $tid = $_POST['tid'];
    $user_uid = $_POST['uid'];

    //echo "tid=$tid";
    //echo "<br>uid=$uid";

    setUserTestTeam($user_uid, $tid);

    header("Location: "  . URL . "/testsolveteams.php");
    exit(0);
}

if (isset($_POST['setPuzzleTestTeam'])) {
    $tid = $_POST['tid'];
    $pid = $_POST['pid'];
    $notfrompuzz = $_POST['notfrompuzzle'];

    //echo "tid=$tid";
    //echo "<br>uid=$uid";

    setPuzzleTestTeam($pid, $tid);

    if ($notfrompuzz == "YES") {
        header("Location: " .  URL  . "/testsolveteams.php");
    } else {
        header("Location: "  . URL . "/puzzle.php?pid=$pid");
    }
    exit(0);
}
//-------------------------------------

head();

echo '<div class="errormsg">';

$max_upload_size = 1048576 * ((int)ini_get('post_max_size'));
if (isset($_SERVER['CONTENT_LENGTH']) && ((int)$_SERVER['CONTENT_LENGTH']) > $max_upload_size) {
    echo 'The file upload was too large. The uploaded file was ';
    echo $_SERVER['CONTENT_LENGTH'];
    echo ' bytes, and the maximum supported upload size is ';
    echo $max_upload_size;
    echo ' bytes.<br />';
    echo 'Please reduce the file size if possible. If your puzzle truly requires a large upload, contact <a href="mailto:';
    echo HELP_EMAIL;
    echo '">the Server Administrators</a> for help.';
} else {
    echo 'An unknown error seems to have occurred. <br />';
    echo 'Please try again, or contact <a href="mailto:';
    echo HELP_EMAIL;
    echo '">the Server Administrators</a> for help.';
}
echo '</div>';

foot();

