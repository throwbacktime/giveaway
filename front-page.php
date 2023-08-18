<?php
    get_header();
?>
<div class="body__container">
    <div class="bg">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/notebook.webp" alt="Notebook with working app">
    </div>
    <header>
        <div class="header__container">
            <a href="#">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg" alt="Logo of SentiOne">
            </a>
        </div>
    </header>
    <main>
        <div class="headlines">
            <h1>
                Enter to get free SentiOne premium account
            </h1>
            <h2>
                This contest is open worldwide, please be sure to read the terms and conditions before entering.
            </h2>
        </div>
        <div class="giveaway">
            <div class="giveaway__bg"></div>
            <div class="giveaway__container">
                <div class="giveaway__container-col">
                    <button onclick="openForm()">
                        Sign up to enter
                    </button>
                </div>
                <div class="giveaway__container-col">
                    <h3>
                        Follow
                    </h3>
                    <a href="#"  target="_blank">
                        @sentione
                    </a>
                </div>
                <div class="giveaway__container-col">
                    <h3>
                        Giveaway Ends In
                    </h3>
                    <div class="giveaway__clock">
                        <div class="giveaway__clock-numbers">
                            <p id="countDown"></p>
                        </div>
                        <div class="giveaway__clock-names">
                            <p>Days</p>
                            <p>Hours</p>
                            <p>Mins</p>
                            <p>Secs</p>
                        </div>
                    </div>
                </div>
                <div class="giveaway__container-col">
                    <h3>
                        ENDS
                    </h3>
                    <p>
                        Sep 31, 2023
                    </p>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div class="footer__container">
            <p>
                To participate in giveaway you need to register on our website and complete your profile. Read the <a href="#" target="_blank">Terms & Conditions</a>.
            </p>
        </div>
    </footer>
    <div class="form-popup" id="signUp">
        <form class="form-container ajax" action="" method="post" enctype="multipart/form-data">
            <input type="text" placeholder="Enter Email" name="email" class="email" required>
            <input type="password" placeholder="Enter Password" name="password" class="password" required>
            <button type="submit" class="btn">Sign Up</button>
            <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
        </form>
    </div>
</div>

<?php
    get_footer();
?>