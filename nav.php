<!-- ######################     Main Navigation   ########################## -->
<nav>
    <ul>
        <?php
        // This sets a class for current page so you can style it differently
        
        print '<li ';
        if ($PATH_PARTS['filename'] == 'index') {
            print ' class="activePage" ';
        }
        print '><a href="index.php">Home</a></li>';
       
        
        print '<li ';
        if ($PATH_PARTS['filename'] == 'about') {
            print ' class="activePage" ';
        }
        print '><a href="about.php">About</a></li>';
       
        
        
        print '<li ';
        if ($PATH_PARTS['filename'] == 'search-courses') {
            print ' class="activePage" ';
        }
        print '><a href="search-courses.php">Search Courses</a></li>';

        print '<li ';
        if ($PATH_PARTS['filename'] == 'form') {
            print ' class="activePage" ';
        }
        print '><a href="form.php">Review a Course</a></li>';
        
        
       print '<li ';
        if ($PATH_PARTS['filename'] == 'form') {
            print ' class="activePage" ';
        }
        print '><a href="update-delete.php">Browse Recent Reviews</a></li>';
        
        
        print '<li ';
        if ($PATH_PARTS['filename'] == 'site-feedback') {
            print ' class="activePage" ';
        }
        print '><a href="site-feedback.php">Site Feedback</a></li>';

        ?>
    </ul>
</nav>
<!-- #################### Ends Main Navigation    ########################## -->

