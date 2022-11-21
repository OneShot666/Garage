<?php
    include("php/function.php");
    Connexion();
    session_start();
    global $nom_du_site;
    $page_name = $nom_du_site . " - Design";
    $nav = "design";
?>

<!DOCTYPE html>

<html lang="fr">
    <head>
        <title>
            <?php echo $page_name; ?>
        </title>
        <meta charset="utf-8">
          <link rel="icon" type="image/png" href="https://ionic.io/ionicons">
          <ion-icon name="car-sport-outline"></ion-icon>
          <link rel="stylesheet" type="text/css" href="css/style.css">
          <link rel="stylesheet" type="text/css" href="css/design.css">
        <meta name="viewport" content="width=device-width">
    </head>

    <body class="design">
        <?php require_once "include/header.php" ?>
        <br>

        <h1>
            <span class="digital_clock_title">Digital clock</span>
        </h1>

        <div class="digital_clock">
            <div id="time">
                <div class="circle" style="--clr: #FF2972;">
                    <div class="dots h_dot"></div>
                    <svg>
                        <circle cx="70" cy="70" r="70"></circle>
                        <circle cx="70" cy="70" r="70" id="hh"></circle>
                    </svg>
                    <div id="hours">00</div>
                </div>
                <div class="circle" style="--clr: #FEE800;">
                    <div class="dots min_dot"></div>
                    <svg>
                        <circle cx="70" cy="70" r="70"></circle>
                        <circle cx="70" cy="70" r="70" id="mm"></circle>
                    </svg>
                    <div id="minutes">00</div>
                </div>
                <div class="circle" style="--clr: #04FC43;">
                    <div class="dots sec_dot"></div>
                    <svg>
                        <circle cx="70" cy="70" r="70"></circle>
                        <circle cx="70" cy="70" r="70" id="ss"></circle>
                    </svg>
                    <div id="seconds">00</div>
                </div>
                <div class="ap">
                    <div id="ampm">AM</div>
                </div>
            </div>

            <!--suppress JSValidateTypes -->
            <script>
                setInterval(() => {
                    let hours = document.getElementById('hours');               // Récupère les éléments sur la page
                    let minutes = document.getElementById('minutes');
                    let seconds = document.getElementById('seconds');
                    let ampm = document.getElementById('ampm');

                    let hh = document.getElementById('hh');
                    let mm = document.getElementById('mm');
                    let ss = document.getElementById('ss');

                    let h_dot = document.querySelector(".h_dot");
                    let min_dot = document.querySelector(".min_dot");
                    let sec_dot = document.querySelector(".sec_dot");

                    let h = new Date().getHours();                              // Va chercher l'heure actuelle
                    let m = new Date().getMinutes();
                    let s = new Date().getSeconds();
                    let a = h >= 12 ? "PM" : "AM";

                    if (h > 12) {                                               // Donne le format 12h
                        h = h - 12;
                    }

                    h = (h < 10) ? "0" + h : h;                                 // Garde les nombres à 2 longueurs
                    m = (m < 10) ? "0" + m : m;
                    s = (s < 10) ? "0" + s : s;

                    hours.innerHTML = h + "<br><span>Hours</span>";             // Affecte la valeur (h, m, s, a)
                    minutes.innerHTML = m + "<br><span>Minutes</span>";         // aux éléments (hours, minutes, seconds, ampm)
                    seconds.innerHTML = s + "<br><span>Seconds</span>";         // sur la page web du site
                    ampm.innerHTML = a;

                    hh.style.strokeDashoffset = 440 - (440 * h) / 12;           // Calcule la longueur actuelle (cercle coloré)
                    mm.style.strokeDashoffset = 440 - (440 * m) / 60;
                    ss.style.strokeDashoffset = 440 - (440 * s) / 60;

                    h_dot.style.transform = `rotate(${h * 30}deg)`;
                    min_dot.style.transform = `rotate(${m * 6}deg)`;
                    sec_dot.style.transform = `rotate(${s * 6}deg)`;
                })
            </script>
        </div>

        <br>

        <h1 id="sommaire">
            <span class="navigation_title">Navigation</span>
        </h1>

        <div class="navigation_main">
            <div class="navigation">
                <ul>
                    <li class="list active">
                        <a href="#sommaire">
                            <span class="icon">
                                <ion-icon name="home-outline"></ion-icon>
                            </span>
                            <span class="text">Home</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="#sommaire">
                            <span class="icon">
                                <ion-icon name="person-outline"></ion-icon>
                            </span>
                            <span class="text">Profiles</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="#sommaire">
                            <span class="icon">
                                <ion-icon name="chatbubble-outline"></ion-icon>
                            </span>
                            <span class="text">Messages</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="#sommaire">
                            <span class="icon">
                                <ion-icon name="camera-outline"></ion-icon>
                            </span>
                            <span class="text">Photos</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="#sommaire">
                            <span class="icon">
                                <ion-icon name="settings-outline"></ion-icon>
                            </span>
                            <span class="text">Settings</span>
                        </a>
                    </li>

                    <div class="indicator"></div>
                </ul>

                <script>
                    const list = document.querySelectorAll('.list');
                    function ActiveLink() {
                        list.forEach((item) => item.classList.remove('active'));
                        this.classList.add('active');
                    }
                    list.forEach((item) => item.addEventListener('click', ActiveLink));
                </script>

                <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
                <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
            </div>
        </div>

        <br>

        <h1>
            <span class="animhover_title">Animations & Hover</span>
        </h1>

        <div class="animhover_main">
            <div class="loader">
                <span style="--i:10"></span>
                <span style="--i:9"></span>
                <span style="--i:8"></span>
                <span style="--i:7"></span>
                <span style="--i:6"></span>
                <span style="--i:5"></span>
                <span style="--i:4"></span>
                <span style="--i:3"></span>
                <span style="--i:2"></span>
                <span style="--i:1"></span>
            </div>
        </div>

        <br>

        <h1>
            <span class="fingerprint_title">Finger print</span>
        </h1>

        <div class="fingerprint_main">
            <div class="scan">
                <div class="fingerprint"></div>
                <h3>Scanning...</h3>
            </div>
        </div>

        <br>

        <h1>
            <span class="radio_button_title">Radio button</span>
        </h1>

        <div class="radio_button_main">
            <label><input type="radio" name="bouton" checked></label>
            <label><input type="radio" name="bouton"></label>
        </div>

        <br>

        <h1>
            <span class="checkbox_button_title">Checkbox button</span>
        </h1>

        <div class="checkbox_button_main">
            <label><input type="checkbox" name="bouton"></label>
        </div>

        <br>

        <h1>
            <span class="potion_title">Potion bowl</span>
        </h1>

        <div class="potion_main">
            <div class="shadow"></div>
            <div class="potion">
                <div class="liquid"></div>
            </div>
        </div>

        <br>

        <h1>
            <span class="menu_dots_title">Menu dots</span>
        </h1>

        <div class="menu_dots_main">
            <div class="menu_dots">
                <span style="--i:0;--x:-1;--y:-1;">
                    <ion-icon name="camera-outline"></ion-icon>
                </span>
                <span style="--i:1;--x:0;--y:-1;">
                    <ion-icon name="diamond-outline"></ion-icon>
                </span>
                <span style="--i:2;--x:1;--y:-1;">
                    <ion-icon name="chatbubble-outline"></ion-icon>
                </span>
                <span style="--i:3;--x:-1;--y:0;">
                    <ion-icon name="alarm-outline"></ion-icon>
                </span>
                <span style="--i:4;--x:0;--y:0;">
                    <ion-icon name="game-controller-outline"></ion-icon>
                </span>
                <span style="--i:5;--x:1;--y:0;">
                    <ion-icon name="moon-outline"></ion-icon>
                </span>
                <span style="--i:6;--x:-1;--y:1;">
                    <ion-icon name="notifications-outline"></ion-icon>
                </span>
                <span style="--i:7;--x:0;--y:1;">
                    <ion-icon name="water-outline"></ion-icon>
                </span>
                <span style="--i:8;--x:1;--y:1;">
                    <ion-icon name="time-outline"></ion-icon>
                </span>
            </div>

            <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
            <script>
                let menu_dots = document.querySelector('.menu_dots');
                menu_dots.onclick = function () {
                    menu_dots.classList.toggle('active');
                }
            </script>
        </div>

        <br>

        <h1>
            <span class="infinite_title">Infinite loop</span>
        </h1>

        <div class="infinite_main">
            <div class="container">
                <div class="infinite">
                    <span style="--inf:0;"></span>
                    <span style="--inf:1;"></span>
                    <span style="--inf:2;"></span>
                    <span style="--inf:3;"></span>
                    <span style="--inf:4;"></span>
                    <span style="--inf:5;"></span>
                    <span style="--inf:6;"></span>
                    <span style="--inf:7;"></span>
                    <span style="--inf:8;"></span>
                    <span style="--inf:9;"></span>
                    <span style="--inf:10;"></span>
                    <span style="--inf:11;"></span>
                    <span style="--inf:12;"></span>
                    <span style="--inf:13;"></span>
                    <span style="--inf:14;"></span>
                    <span style="--inf:15;"></span>
                    <span style="--inf:16;"></span>
                    <span style="--inf:17;"></span>
                    <span style="--inf:18;"></span>
                    <span style="--inf:19;"></span>
                    <span style="--inf:20;"></span>
                </div>
                <div class="infinite">
                    <span style="--inf:0;"></span>
                    <span style="--inf:1;"></span>
                    <span style="--inf:2;"></span>
                    <span style="--inf:3;"></span>
                    <span style="--inf:4;"></span>
                    <span style="--inf:5;"></span>
                    <span style="--inf:6;"></span>
                    <span style="--inf:7;"></span>
                    <span style="--inf:8;"></span>
                    <span style="--inf:9;"></span>
                    <span style="--inf:10;"></span>
                    <span style="--inf:11;"></span>
                    <span style="--inf:12;"></span>
                    <span style="--inf:13;"></span>
                    <span style="--inf:14;"></span>
                    <span style="--inf:15;"></span>
                    <span style="--inf:16;"></span>
                    <span style="--inf:17;"></span>
                    <span style="--inf:18;"></span>
                    <span style="--inf:19;"></span>
                    <span style="--inf:20;"></span>
                </div>
            </div>
        </div>

        <br>

        <hr>

        <br>

        <?php require_once "include/footer.php" ?>
    </body>
</html>
