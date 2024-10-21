<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar"
            src="https://randomuser.me/api/portraits/men/1.jpg" alt="User Image">
        <div>
            <?php
                        if (!isset($_SESSION['admin_email'])) {
                                echo "<p class='app-sidebar__user-name'>$user_name</p>";
                                echo "<p class='app-sidebar__user-designation'>$user_level</p>";
                        } else {
                                echo "<p class='app-sidebar__user-name'>$admin_name</p>";
                                echo "<p class='app-sidebar__user-designation'>$admin_role</p>";
                        }
                        ?>
        </div>
    </div>
    <ul class="app-menu">
        <li><a class="app-menu__item" href="dashboard.php"><i class="app-menu__icon bi bi-columns-gap"></i><span
                    class="app-menu__label">Dashboard</span></a></li>
        <li><a class="app-menu__item" href="user_view.php"><i class="app-menu__icon bi bi-people"></i><span
                    class="app-menu__label">Users</span></a></li>
        <li><a class="app-menu__item" href="section_view.php"><i class="app-menu__icon bi bi-check2-square"></i><span
                    class="app-menu__label">Sections</span></a></li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                    class="app-menu__icon bi bi-ui-checks"></i><span class="app-menu__label">Category</span><i
                    class="treeview-indicator bi bi-chevron-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="option_add.php"><i class="icon bi bi-circle-fill"></i> Add
                        Category</a></li>
                <li><a class="treeview-item" href="option_view.php"><i class="icon bi bi-circle-fill"></i> View
                        Categories</a></li>
            </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                    class="app-menu__icon bi bi-heart-pulse"></i><span class="app-menu__label">ECG</span><i
                    class="treeview-indicator bi bi-chevron-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="ecg_add.php"><i class="icon bi bi-circle-fill"></i>
                        Add ECG</a></li>
                <li><a class="treeview-item" href="ecg_view.php"><i class="icon bi bi-circle-fill"></i> View ECG</a>
                </li>
            </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                    class="app-menu__icon bi bi-patch-question"></i><span class="app-menu__label">Question</span><i
                    class="treeview-indicator bi bi-chevron-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="question_add.php"><i class="icon bi bi-circle-fill"></i> Add
                        Question</a></li>
                <li><a class="treeview-item" href="question_view.php"><i class="icon bi bi-circle-fill"></i> View
                        Question</a></li>

                <?php if (!isset($_SESSION['admin_email'])) { ?>
                <li><a class="treeview-item" href="sectionselected_view.php"><i class="icon bi bi-circle-fill"></i>
                        View Section Selected</a></li>
                <?php } ?>
            </ul>
        </li>
        <?php if (!isset($_SESSION['admin_email'])) { ?>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                    class="app-menu__icon bi bi-file-earmark"></i><span class="app-menu__label">Answer</span><i
                    class="treeview-indicator bi bi-chevron-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="answer_add.php"><i class="icon bi bi-circle-fill"></i> Add
                        Answer</a></li>
                <li><a class="treeview-item" href="answer_view.php"><i class="icon bi bi-circle-fill"></i>
                        View Answer</a></li>
            </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                    class="app-menu__icon bi bi-code-square"></i><span class="app-menu__label">ECG Attempt</span><i
                    class="treeview-indicator bi bi-chevron-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="ecgattempt_add.php"><i class="icon bi bi-circle-fill"></i> Add
                        Ecg Attempt</a></li>
                <li><a class="treeview-item" href="ecgattempt_view.php"><i class="icon bi bi-circle-fill"></i>
                        View Ecg Attempt</a></li>
            </ul>
        </li>

        <?php } ?>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                    class="app-menu__icon bi bi-file-pdf"></i><span class="app-menu__label">Document</span><i
                    class="treeview-indicator bi bi-chevron-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="document_add.php"><i class="icon bi bi-circle-fill"></i> Add
                        Document</a></li>
                <li><a class="treeview-item" href="document_view.php"><i class="icon bi bi-circle-fill"></i>
                        View Document</a></li>
            </ul>
        </li>
        <!--   <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-files"></i><span class="app-menu__label">Pop Quiz</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
                        <ul class="treeview-menu">
                                <li><a class="treeview-item" href="popquiz_add.php"><i class="icon bi bi-circle-fill"></i>
                                                Add Pop Quiz</a></li>
                                <li><a class="treeview-item" href="popquiz_view.php" rel="noopener"><i class="icon bi bi-circle-fill"></i> View Pop Quiz</a></li>

                        </ul>
                </li> -->
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                    class="app-menu__icon bi bi-camera-reels"></i><span class="app-menu__label">Reels</span><i
                    class="treeview-indicator bi bi-chevron-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="reel_add.php"><i class="icon bi bi-circle-fill"></i>
                        Add Reel</a></li>
                <li><a class="treeview-item" href="reel_view.php" rel="noopener"><i class="icon bi bi-circle-fill"></i>
                        View Reel</a></li>

            </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                    class="app-menu__icon bi bi-person-video3"></i><span class="app-menu__label">Lectures</span><i
                    class="treeview-indicator bi bi-chevron-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="lecture_add.php"><i class="icon bi bi-circle-fill"></i>
                        Add Lecture</a></li>
                <li><a class="treeview-item" href="lecture_view.php" rel="noopener"><i
                            class="icon bi bi-circle-fill"></i> View Lecture</a></li>

            </ul>
        </li>
        <li><a class="app-menu__item" href="page.php"><i class="app-menu__icon bi bi-file-earmark"></i><span
                    class="app-menu__label">Pages</span></a></li>
        <li><a class="app-menu__item" href="setting.php"><i class="app-menu__icon bi bi bi-gear"></i><span
                    class="app-menu__label">Settings</span></a></li>
        <!-- <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-laptop"></i><span class="app-menu__label">Results</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
                        <ul class="treeview-menu">
                                <li><a class="treeview-item" href="question_result.php"><i class="icon bi bi-circle-fill"></i>
                                                User Questions Results</a></li>
                                <li><a class="treeview-item" href="popquiz_view.php" rel="noopener"><i class="icon bi bi-circle-fill"></i> User Quiz Results</a></li>

                        </ul>
                </li>
                 <li class="treeview is-expanded"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                    class="app-menu__icon bi bi-file-earmark"></i><span class="app-menu__label">Pages</span><i
                    class="treeview-indicator bi bi-chevron-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item active" href="blank-page.html"><i class="icon bi bi-circle-fill"></i>
                        Blank Page</a></li>
                <li><a class="treeview-item" href="page-login.html"><i class="icon bi bi-circle-fill"></i> Login
                        Page</a></li>
                <li><a class="treeview-item" href="page-lockscreen.html"><i class="icon bi bi-circle-fill"></i>
                        Lockscreen Page</a></li>
                <li><a class="treeview-item" href="page-user.html"><i class="icon bi bi-circle-fill"></i> User
                        Page</a></li>
                <li><a class="treeview-item" href="page-invoice.html"><i class="icon bi bi-circle-fill"></i> Invoice
                        Page</a></li>
                <li><a class="treeview-item" href="page-mailbox.html"><i class="icon bi bi-circle-fill"></i>
                        Mailbox</a></li>
                <li><a class="treeview-item" href="page-error.html"><i class="icon bi bi-circle-fill"></i> Error
                        Page</a></li>
            </ul>
        </li>
        <li><a class="app-menu__item" href="docs.html"><i class="app-menu__icon bi bi-code-square"></i><span
                    class="app-menu__label">Docs</span></a></li> -->
    </ul>
</aside>