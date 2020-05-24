
<?php
include 'top.php';

//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//       
print PHP_EOL . '<!-- SECTION: 1 Initialize variables -->' . PHP_EOL;
// These variables are used in both sections 2 and 3, otherwise we would
// declare them in the section we needed them

$update = false;

print PHP_EOL . '<!-- SECTION: 1a. debugging setup -->' . PHP_EOL;
// We print out the post array so that we can see our form is working.
// Normally i wrap this in a debug statement but for now i want to always
// display it. when you first come to the form it is empty. when you submit the
// form it displays the contents of the post array.
// if ($debug){ 
?>






<?php
// }
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
print PHP_EOL . '<!-- SECTION: 1b form variables -->' . PHP_EOL;
//
// Initialize variables one for each form element
// in the order they appear on the form


$pmkCourseId = -1;
$Subj = "";
$Number = "";
$Instructor = "";
$fldDifficultyLevel = "";

$fldPaperHeavy = true;
$fldReadingHeavy = false;
$fldTestHeavy = false;
$fldPopQuizzes = false;
$fldGroupProjects = false;
$fldParticipationMatters = false;
$fldLotsOfHomework = false;
$fldMandatoryAttendance = false;        
$fldTextbookUse = false;

$fldSkills = "";
$fldComments = "";
$fldEmail = "";




if (isset($_GET["id"])) {
    $pmkCourseId = (int) htmlentities($_GET["id"], ENT_QUOTES, "UTF-8");

    $query = 'SELECT pmkCourseId, fldSubject, fldNumber, fldInstructor, fldDifficultyLevel, fldPaperHeavy, fldReadingHeavy, fldTestHeavy, fldPopQuizzes, fldGroupProjects, fldParticipationMatters, fldLotsOfHomework, fldMandatoryAttendance, fldTextbookUse , fldSkills, fldComments, fldEmail ';
    $query .= 'FROM tblCourses WHERE pmkCourseId = ?';




    $data = array($pmkCourseId);

    if ($thisDatabaseReader->querySecurityOk($query, 1)) {
        $query = $thisDatabaseReader->sanitizeQuery($query);
        $courses = $thisDatabaseReader->select($query, $data);
    }



 


    $Subj = $courses[0]["fldSubject"];
    $Number = $courses[0]["fldNumber"];
    $Instructor = $courses[0]["fldInstructor"];
    $fldDifficultyLevel = $courses[0]["fldDifficultyLevel"];
    $fldPaperHeavy = $courses[0]["fldPaperHeavy"];
    $fldReadingHeavy = $courses[0] ["fldReadingHeavy"];
    $fldTestHeavy = $courses[0] ["fldTestHeavy"];
    $fldPopQuizzes = $courses[0] ["fldPopQuizzes"];
    $fldGroupProjects = $courses[0] ["fldGroupProjects"];
    $fldParticipationMatters = $courses[0] ["fldParticipationMatters"];
    $fldLotsOfHomework = $courses[0] ["fldLotsOfHomework"];
    $fldMandatoryAttendance = $courses[0] ["fldMandatoryAttendance"];
    $fldTextbookUse = $courses[0] ["fldTextbookUse"];
    $fldSkills = $courses[0]["fldSkills"];
    $fldComments = $courses[0]["fldComments"];
    $fldTitle = $courses[0]["fldTitle"];
    $fldEMail = $courses[0]["fldEmail"];
}

//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^% 
//
print PHP_EOL . '<!-- SECTION: 1c form error flags -->' . PHP_EOL;
//
// Initialize Error Flags one for each form element we validate
// in the order they appear on the form

$subjectERROR = false;
$numberERROR = false;
$instructorERROR = false;
$difficultyLevelERROR = false;




////%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
print PHP_EOL . '<!-- SECTION: 1d misc variables -->' . PHP_EOL;
//
// create array to hold error messages filled (if any) in 2d displayed in 3c.
$errorMsg = array();

// have we mailed the information to the user, flag variable?
//$mailed = false;       
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
print PHP_EOL . '<!-- SECTION: 2 Process for when the form is submitted -->' . PHP_EOL;
//
if (isset($_POST["btnSubmit"])) {

    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    print PHP_EOL . '<!-- SECTION: 2a Security -->' . PHP_EOL;

    // the url for this form
    $thisURL = DOMAIN . PHP_SELF;

    if (!securityCheck($thisURL)) {
        $msg = '<p>Sorry you cannot access this page.</p>';
        $msg .= '<p>Security breach detected and reported.</p>';
        die($msg);
    }

    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    print PHP_EOL . '<!-- SECTION: 2b Sanitize (clean) data  -->' . PHP_EOL;
    // remove any potential JavaScript or html code from users input on the
    // form. Note it is best to follow the same order as declared in section 1c.




    if ($pmkCourseId > 0) {
        $update = true;
    }

    $Subj = htmlentities($_POST["lstSubjects"], ENT_QUOTES, "UTF-8");
    $Number = htmlentities($_POST["lstNumbers"], ENT_QUOTES, "UTF-8");
    $Instructor = htmlentities($_POST["lstInstructors"], ENT_QUOTES, "UTF-8");
    $fldDifficultyLevel = htmlentities($_POST["radDifficultyLevel"], ENT_QUOTES, "UTF-8");
    $fldPaperHeavy = htmlentities($_POST["chkPaperHeavy"], ENT_QUOTES, "UTF-8");
    $fldReadingHeavy = htmlentities($_POST["chkReadingHeavy"], ENT_QUOTES, "UTF-8");
    $fldTestHeavy = htmlentities($_POST["chkTestHeavy"], ENT_QUOTES, "UTF-8");
    $fldPopQuizzes = htmlentities($_POST["chkPopQuizzes"], ENT_QUOTES, "UTF-8");
    $fldGroupProjects = htmlentities($_POST["chkGroupProjects"], ENT_QUOTES, "UTF-8");
    $fldParticipationMatters = htmlentities($_POST["chkParticipationMatters"], ENT_QUOTES, "UTF-8");
    $fldLotsOfHomework = htmlentities($_POST["chkLotsOfHomework"], ENT_QUOTES, "UTF-8");
    $fldMandatoryAttendance = htmlentities($_POST["chkMandatoryAttendance"], ENT_QUOTES, "UTF-8");
    $fldTextbookUse = htmlentities($_POST["chkTextbookUse"], ENT_QUOTES, "UTF-8");
    $fldSkills = htmlentities($_POST["txtSkills"], ENT_QUOTES, "UTF-8");
    $fldComments = htmlentities($_POST["txtComments"], ENT_QUOTES, "UTF-8");
    $fldEmail = htmlentities($_POST["txtEmail"], ENT_QUOTES, "UTF-8");



    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    print PHP_EOL . '<!-- SECTION: 2c Validation -->' . PHP_EOL;
    //
    // Validation section. Check each value for possible errors, empty or
    // not what we expect. You will need an IF block for each element you will
    // check (see above section 1c and 1d). The if blocks should also be in the
    // order that the elements appear on your form so that the error messages
    // will be in the order they appear. errorMsg will be displayed on the form
    // see section 3b. The error flag ($emailERROR) will be used in section 3c.

    ?>
    
    <span id="error-message">
    
    <?php


    if ($Subj == "") {
        $errorMsg[] = 'Please select a subject.';
        $subjectERROR = true;
    } elseif (!verifyAlpha($Subj)) {
        $errorMsg[] = 'This subject appears to be incorrect.';
        $subjectERROR = true;
    }


    if ($Number == "") {
        $errorMsg[] = 'Please select a course number';
        $numberERROR = true;
    } elseif (!is_numeric($Number)) {
        $errorMsg[] = 'This course number appears to be incorrect.';
        $numberERROR = true;
    }

   
    if ($Instructor == "") {
        $errorMsg[] = 'Please select an instructor.';
        $instructorERROR = true;
    }



    if ($fldDifficultyLevel == "") {
        $errorMsg[] = 'Please select a difficulty level.';
        $difficultyLevelERROR = true;
    } elseif (!verifyAlpha($fldDifficultyLevel)) {
        $errorMsg[] = 'This difficulty level appears to be incorrect.';
        $difficultyLevelERROR = true;
    }



    ?>
    
    </span>
    
    <?php

    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    print PHP_EOL . '<!-- SECTION: 2d Process Form - Passed Validation -->' . PHP_EOL;
    //
    // Process for when the form passes validation (the errorMsg array is empty)
    //    
    if (!$errorMsg) {
        if (DEBUG) {
            print '<p>Form is valid</p>';
        }

        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        //
        print PHP_EOL . '<!-- SECTION: 2e Save Data -->' . PHP_EOL;
        //
        // This block saves the data to a CSV file.   
        // array used to hold form values that will be saved to a CSV file
        $dataRecord = array();

        // assign values to the dataRecord array
        $dataRecord[] = $Subj;
        $dataRecord[] = $Number;
        $dataRecord[] = $Instructor;
        $dataRecord[] = $fldDifficultyLevel;
        $dataRecord[] = $fldPaperHeavy;
        $dataRecord[] = $fldReadingHeavy;
        $dataRecord[] = $fldTestHeavy;
        $dataRecord[] = $fldPopQuizzes;
        $dataRecord[] = $fldGroupProjects;
        $dataRecord[] = $fldParticipationMatters;
        $dataRecord[] = $fldLotsOfHomework;
        $dataRecord[] = $fldMandatoryAttendance;
        $dataRecord[] = $fldTextbookUse;
        $dataRecord[] = $fldSkills;
        $dataRecord[] = $fldComments;
        $dataRecord[] = $fldEmail;




        if ($update) {
            $query = 'UPDATE tblCourses SET ';
        } else {
            $query = 'INSERT INTO tblCourses SET ';
        }
        $query .= 'fldSubject = ?, ';
        $query .= 'fldNumber = ?, ';
        $query .= 'fldInstructor = ?, '; 
        $query .= 'fldDifficultyLevel = ?, ';
        $query .= 'fldPaperHeavy = ?, ';
        $query .= 'fldReadingHeavy = ?, ';
        $query .= 'fldTestHeavy = ?, ';
        $query .= 'fldPopQuizzes = ?, ';
        $query .= 'fldGroupProjects = ?, ';
        $query .= 'fldParticipationMatters = ?, ';
        $query .= 'fldLotsOfHomework = ?, ';
        $query .= 'fldMandatoryAttendance = ?, ';
        $query .= 'fldTextbookUse = ?, ';
        $query .= 'fldSkills = ?, ';
        $query .= 'fldComments = ?, ';
        $query .= 'fldEmail = ? ';


        if ($update) {
            $query .= 'WHERE pmkCourseId = ?';
            $dataRecord[] = $pmkCourseId;

            if ($thisDatabaseReader->querySecurityOk($query, 1)) {
                $query = $thisDatabaseWriter->sanitizeQuery($query);
                $records = $thisDatabaseWriter->update($query, $dataRecord);
            }
        } else {
            //$thisDatabaseWriter->testSecurityQuery($query, 0);
            if ($thisDatabaseWriter->querySecurityOk($query, 0)) {
                $query = $thisDatabaseReader->sanitizeQuery($query);
                $records = $thisDatabaseWriter->insert($query, $dataRecord);
            }
        }
        if ($records) {
            if ($update) {
                print '<p class="indexbox">Record updated</p>';
            } else {


                print '<p class="indexbox">Record Saved</p>';
            }
        } else {
            print '<p class="indexbox">Record NOT Saved</p>';
           
        }

        print PHP_EOL . '<!-- SECTION: 2f Create message -->' . PHP_EOL;
        ?>
       
<?php
        $message = '<h2 class="indexbox">Your  information:</h2>';

        foreach ($_POST as $htmlName => $value) {

            $message .= '<p class="indexbox">';

            $camelCase = preg_split('/(?=[A-Z])/', substr($htmlName, 3));

            foreach ($camelCase as $oneWord) {
                $message .= $oneWord . ' ';
            }

            $message .= ' = ' . htmlentities($value, ENT_QUOTES, "UTF-8") . '</p>';
        }
        ?>
              
            <?php
    } // end form is valid     
}   // ends if form was submitted.
//#############################################################################
//
?>
<fieldset class ="formbox">
<?php
print PHP_EOL . '<!-- SECTION 3 Display Form -->' . PHP_EOL;
//
?>       


<?php
//####################################
//
print PHP_EOL . '<!-- SECTION 3a  -->' . PHP_EOL;
// 
// If its the first time coming to the form or there are errors we are going
// to display the form.

if (isset($_POST["btnSubmit"]) AND empty($errorMsg)) { // closing of if marked with: end body submit
    print '<h2 id="form-head">Thank you for providing your information.</h2>';
    print $message;
} else {

    print '<h2 id="form-head">Tell us about a course.</h2>';


    //####################################
    //
        print PHP_EOL . '<!-- SECTION 3b Error Messages -->' . PHP_EOL;
    //
    // display any error messages before we print out the form

    if ($errorMsg) {
        print '<div id="errors">' . PHP_EOL;
        print '<h2>The following errors need to be fixed.</h2>' . PHP_EOL;
        print '<ol>' . PHP_EOL;

        foreach ($errorMsg as $err) {
            print '<li>' . $err . '</li>' . PHP_EOL;
        }

        print '</ol>' . PHP_EOL;
        print '</div>' . PHP_EOL;
    }

    //####################################
    //
        print PHP_EOL . '<!-- SECTION 3c html Form -->' . PHP_EOL;
    ?> 
        <form action = "<?php print PHP_SELF; ?>"
              id = "frmCourses"
              method = "post"
              action="send_form_email.php"
              >

            <fieldset class="listbox <?php if ($subjectERROR) print ' mistake'; ?>">

    <?php
    $query = "SELECT distinct Subj ";
    $query .= "FROM tblSections ";
    $query .= "ORDER BY  Subj";


    // Step Three: run your query being sure to implement security
    if ($thisDatabaseReader->querySecurityOk($query, 0, 1)) {
        $query = $thisDatabaseReader->sanitizeQuery($query);
        $subjects = $thisDatabaseReader->select($query);
    }


    print '<label for="lstSubjects"';
    if ($subjectERROR) {
        print ' class = "mistake"';
    }
    print '>Subject: ';
    print '<select id="lstSubjects" ';
    print '        name="lstSubjects"';
    print '        tabindex="300" >';


    foreach ($subjects as $subject) {

        print '<option ';
        if ($Subj == $subject["Subj"])
            print " selected='selected' ";

        print 'value="' . $subject["Subj"];

        print '">';


        print $subject["Subj"];
        print '</option>';
    }

    print '</select></label>';
    ?>    

            </fieldset>

            <fieldset class="listbox <?php if ($numberERROR) print ' mistake'; ?>">

    <?php
    $query = "SELECT distinct Number ";
    $query .= "FROM tblSections ";
    $query .= "ORDER BY  Number";


    // Step Three: run your query being sure to implement security
    if ($thisDatabaseReader->querySecurityOk($query, 0, 1)) {
        $query = $thisDatabaseReader->sanitizeQuery($query);
        $nums = $thisDatabaseReader->select($query);
    }


    print '<label for="lstNumbers"';
    if ($numberERROR) {
        print ' class = "mistake"';
    }
    print '>Course #: ';
    print '<select id="lstNumbers" ';
    print '        name="lstNumbers"';
    print '        tabindex="300" >';


    foreach ($nums as $num) {

        print '<option ';
        if ($Number == $num["Number"])
            print " selected='selected' ";

        print 'value="' . $num["Number"];

        print '">';


        print $num["Number"];
        print '</option>';
    }

    print '</select></label>';
    ?>    

            </fieldset>

            
            <fieldset class="listbox <?php if ($instructorERROR) print ' mistake'; ?>">

    <?php
    $query = "SELECT distinct Instructor ";
    $query .= "FROM tblSections ";
    $query .= "ORDER BY Instructor";


    // Step Three: run your query being sure to implement security
    if ($thisDatabaseReader->querySecurityOk($query, 0, 1)) {
        $query = $thisDatabaseReader->sanitizeQuery($query);
        $instructors = $thisDatabaseReader->select($query);
    }


    print '<label for="lstInstructors"';
    if ($instructorERROR) {
        print ' class = "mistake"';
    }
    print '>Instructor: ';
    print '<select id="lstInstructors" ';
    print '        name="lstInstructors"';
    print '        tabindex="300" >';


    foreach ($instructors as $instructor) {

        print '<option ';
        if ($Instructor == $instructor["Instructor"])
            print " selected='selected' ";

        print 'value="' . $instructor["Instructor"];

        print '">';


        print $instructor["Instructor"];
        print '</option>';
    }

    print '</select></label>';
    ?>    

            </fieldset>


            <fieldset class="radio <?php if ($fldDifficultyLevel) print ' mistake'; ?>">
                <legend>Difficulty level of course:</legend>
                <p>    
                    <label class="radio-field"><input type="radio" id="radDifficultyLevelEasy" name="radDifficultyLevel" value="Easy" tabindex="572" 
    <?php if ($fldDifficultyLevel == "Easy") echo ' checked="checked" '; ?>>
                        Easy</label>
                </p>
                <p>
                    <label class="radio-field"><input type="radio" id="radDifficultyLevelModerate" name="radDifficultyLevel" value="Moderate" tabindex="574" 
    <?php if ($fldDifficultyLevel == "Moderate") echo ' checked="checked" '; ?>>
                        Moderate</label>
                </p>

                <p>
                    <label class="radio-field"><input type="radio" id="radDifficultyLevelHard" name="radDifficultyLevel" value="Hard" tabindex="574" 
    <?php if ($fldDifficultyLevel == "Hard") echo ' checked="checked" '; ?>>
                        Hard </label>
                </p>

                <p>
                    <label class="radio-field"><input type="radio" id="radDifficultyLevelVeryHard" name="radDifficultyLevel" value="Very Hard" tabindex="574" 
    <?php if ($fldDifficultyLevel == "VeryHard") echo ' checked="checked" '; ?>>
                        Very Hard </label>
                </p>
            </fieldset>


            <fieldset class="checkbox">
                <legend>Check the boxes that apply to this course:</legend>

                <p>
                    <label class="check-field">
                        <input <?php if ($fldPaperHeavy == "Paper Heavy") print " checked "; ?>
                            id="chkPaperHeavy"
                            name="chkPaperHeavy"
                            tabindex="420"
                            type="checkbox"
                            value="Paper Heavy">Paper Heavy</label>
                </p>

                <p>
                    <label class="check-field">
                        <input <?php if ($fldReadingHeavy == "Reading Heavy") print " unchecked "; ?>
                            id="chkReadingHeavy"
                            name="chkReadingHeavy"
                            tabindex="420"
                            type="checkbox"
                            value="Reading Heavy">Reading Heavy</label>
                </p>

                <p>
                    <label class="check-field">
                        <input <?php if ($fldTestHeavy == "Test Heavy") print " unchecked "; ?>
                            id="chkTestHeavy"
                            name="chkTestHeavy"
                            tabindex="420"
                            type="checkbox"
                            value="Test Heavy">Test Heavy</label>
                </p>

                <p>
                    <label class="check-field">
                        <input <?php if ($fldPopQuizzes == "Pop Quizzes") print " unchecked "; ?>
                            id="chkPopQuizzes"
                            name="chkPopQuizzes"
                            tabindex="420"
                            type="checkbox"
                            value="Pop Quizzes">Pop Quizzes</label>
                </p>

                <p>
                    <label class="check-field">
                        <input <?php if ($fldGroupProjects == "Group Projects") print " unchecked "; ?>
                            id="chkGroupProjects"
                            name="chkGroupProjects"
                            tabindex="420"
                            type="checkbox"
                            value="Group Projects">Group Projects</label>
                </p>

                <p>
                    <label class="check-field">
                        <input <?php if ($fldParticipationMatters == "Participation Matters") print " unchecked "; ?>
                            id="chkParticipationMatters"
                            name="chkParticipationMatters"
                            tabindex="420"
                            type="checkbox"
                            value="Participation Matters">Participation Matters</label>
                </p>


                <p>
                    <label class="check-field">
                        <input <?php if ($fldLotsOfHomework == "Lots of Homework") print " unchecked "; ?>
                            id="chkLotsOfHomework"
                            name="chkLotsOfHomework"
                            tabindex="420"
                            type="checkbox"
                            value="Lots of Homework">Lots of Homework</label>
                </p>

                <p>
                    <label class="check-field">
                        <input <?php if ($fldMandatoryAttendance == "Mandatory Attendance") print " unchecked "; ?>
                            id="chkMandatoryAttendance"
                            name="chkMandatoryAttendance"
                            tabindex="420"
                            type="checkbox"
                            value="Mandatory Attendance">Mandatory Attendance</label>
                </p>

                <p>
                    <label class="check-field">
                        <input <?php if ($fldTextbookUse == "Textbook Use") print " unchecked "; ?>
                            id="chkTextbookUse"
                            name="chkTextbookUse"
                            tabindex="420"
                            type="checkbox"
                            value="Textbook Use">Textbook Use</label>
                </p>



            </fieldset>



          

            <fieldset class = "skills">


                <p>
                    <label>Skills you learned in this course: (optional)</label>
                    <textarea

                        id = "txtSkills"     
                        name = "txtSkills"
                        onfocus = "this.select()"
                        placeholder = ""
                        tabindex = "120"
                        type = "text"
                        value = "<?php print $fldSkills; ?>"
                        maxlength="1000" 
                        cols="25" 
                        rows="6"
                        >
                    </textarea>
                </p>     
            </fieldset> 


            <fieldset class = "comments">


                <p>
                    <label>Additional Comments: (optional)</label>
                    <textarea

                        id = "txtComments"     
                        maxlength="1000" 
                        cols="25" 
                        rows="6"
                        name = "txtComments"
                        onfocus = "this.select()"
                        placeholder = ""
                        tabindex = "120"
                        type = "text"
                        value = "<?php print $fldComments; ?>"
                        >
                    </textarea>
                </p>     
            </fieldset> 


            <fieldset class = "email">


                <p>

                    <label>Email address: (Optional)</label>
                    <input 

                        id = "txtEmail"     
                        maxlength = "90"
                        name = "txtEmail"
                        onfocus = "this.select()"
                        placeholder = "youremail@uvm.edu"
                        tabindex = "120"
                        type = "text"
                        value = "<?php print $fldEmail; ?>"
                        >
                </p>     
            </fieldset>


            <fieldset class="buttons">
                <legend></legend>
                <input class = "button" id = "btnSubmit" name = "btnSubmit" tabindex = "900" type = "submit" value = "Submit" >
            </fieldset> <!-- ends buttons -->
        </form>     

    <?php
}
?>
</fieldset>     


<?php include 'footer.php'; ?>


