<!DOCTYPE html>
<html lang="en">
        <head> <title> about us </title>
        </head>
         
        <body>
                <header>
                        <h1><img src="download.png" alt="FreeDOS logo" /></h1>
                </header>

                <nav>
                        <a href="https://cse.wustl.edu/index.html">Home</a>
                </nav>

                <main>
                        <h2>Welcome to WUSTL CSE News</h2>
                        <p>From its origin back in 1965 as the Department of Applied Mathematics and Computer Science, the department has paved the way for computer science departments, awarding the first computer science PhD in the United States.</p>
                        <p><a href="https://cse.wustl.edu/academics/index.html">Academics</a></p>
                        <p><a href="https://cse.wustl.edu/faculty-research/index.html">Faculty & Research</a></p>
                        <p><a href="https://cse.wustl.edu/news-events/index.html">News & Events</a></p>
                </main>
                
                <footer>
                        <p>Contact me at <i>zelinzhong@wustl.edu</i></p>
                </footer>
                  <?php
                  session_start();
                  if(empty($_SESSION['Username'])){
                   echo '<form action=wustlcsenews.php method="POST">
                        <input type="submit" name="return" value="Return">
                   </form>';
                  }
                  else{
                    echo '<form action=wustlcsenewsLoggedIn.php method="POST">
                    <input type="submit" name="return" value="Return">
               </form>';
                  }

                   ?>
        </body>
</html>
