<nav class="navbar bg-secondary navbar-dark">
    <a href="index.html" class="navbar-brand mx-4 mb-3">
        <h3 class="text-primary"><i class=""></i>DarkPan</h3>
    </a>
    <div class="d-flex align-items-center ms-4 mb-4">
        <div class="position-relative">
            <img class="rounded-circle img1" src="img/user.jpg" alt="">
            <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
        </div>
        <div class="ms-3">
            <?php
            if($_SESSION["status"]=="administrator" || $_SESSION["status"]=="super_administrator"){
                ?>
                <h6 class="mb-0"><?php /** @var Admin $admin */
                    echo $admin->get_name() ?> <?php echo $admin->getLast_name() ?></h6>
                <span><?php echo $admin->get_status() ?></span>
                <?php
            }

            if($_SESSION["status"]=="driver"){
                ?>
                <h6 class="mb-0"><?php /** @var Driver $driver */
                    echo $driver->getName() ?> <?php echo $driver->getLastName() ?></h6>
                <?php
            }
            ?>

        </div>
    </div>

    <div class="navbar-nav w-100">

        <?php
            if($_SESSION["status"]=="administrator" || $_SESSION["status"]=="super_administrator"){
                ?>
                <a href="https://airportdrivervienna24.at/TsQWxwWDtP_admin/" class="nav-item nav-link <?php echo check_current("index"); ?>">
                    <i class="fa fa-tachometer-alt me-2 before-none">
                        <svg height="30" width="30" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="p-1"
                             viewBox="0 0 612 612" xml:space="preserve">
                    <g>
                        <g>
                            <path d="M175.205,239.62c0.127-1.965-0.533-3.902-1.833-5.381l-58.84-66.941c-1.3-1.479-3.135-2.381-5.102-2.508
                                c-1.975-0.126-3.902,0.533-5.381,1.833c-27.037,23.766-49.479,51.794-66.706,83.305c-0.944,1.729-1.165,3.762-0.611,5.651
                                c0.554,1.89,1.836,3.483,3.565,4.427l78.205,42.748c1.131,0.619,2.352,0.912,3.557,0.912c2.627,0,5.174-1.398,6.523-3.866
                                c11.386-20.828,26.229-39.359,44.114-55.08C174.178,243.422,175.08,241.587,175.205,239.62z"/>
                            <path d="M201.462,214.829c1.334,2.515,3.907,3.948,6.568,3.948c1.174,0,2.365-0.279,3.473-0.867
                                c20.962-11.117,43.512-18.371,67.025-21.561c4.064-0.551,6.913-4.293,6.362-8.358l-11.979-88.316
                                c-0.551-4.064-4.304-6.909-8.358-6.362c-35.708,4.843-69.949,15.857-101.772,32.736c-3.623,1.922-5.002,6.416-3.082,10.041
                                L201.462,214.829z"/>
                            <path d="M105.785,334.345l-86.017-23.338c-1.901-0.514-3.929-0.255-5.638,0.725s-2.958,2.598-3.475,4.499
                                C3.586,342.295,0,369.309,0,396.523c0,4.657,0.111,9.329,0.342,14.284c0.185,3.981,3.468,7.083,7.414,7.083
                                c0.116,0,0.234-0.002,0.35-0.008l89.031-4.113c1.967-0.09,3.82-0.96,5.145-2.415c1.327-1.455,2.022-3.38,1.93-5.347
                                c-0.155-3.341-0.23-6.444-0.23-9.484c0-18.02,2.365-35.873,7.029-53.066C112.082,339.499,109.743,335.42,105.785,334.345z"/>
                            <path d="M438.731,120.745c-32.411-15.625-67.04-25.308-102.925-28.786c-1.972-0.198-3.918,0.408-5.439,1.659
                                c-1.521,1.252-2.481,3.056-2.671,5.018l-8.593,88.712c-0.396,4.082,2.594,7.713,6.677,8.108
                                c23.652,2.291,46.463,8.669,67.8,18.954c1.015,0.49,2.118,0.738,3.225,0.738c0.826,0,1.654-0.139,2.45-0.416
                                c1.859-0.649,3.385-2.012,4.24-3.786l38.7-80.287C443.978,126.965,442.427,122.525,438.731,120.745z"/>
                            <path d="M569.642,245.337c0.48-1.911,0.184-3.932-0.828-5.624c-18.432-30.835-41.933-57.983-69.848-80.686
                                c-1.529-1.242-3.48-1.824-5.447-1.627c-1.959,0.203-3.758,1.174-5,2.702l-56.237,69.144c-1.242,1.529-1.828,3.488-1.625,5.447
                                c0.201,1.959,1.173,3.758,2.702,5.002c18.47,15.019,34.015,32.975,46.205,53.369c1.392,2.326,3.855,3.618,6.383,3.618
                                c1.297,0,2.61-0.34,3.803-1.054l76.501-45.728C567.94,248.889,569.16,247.248,569.642,245.337z"/>
                            <path d="M598.044,304.939c-1.228-3.915-5.397-6.096-9.308-4.867l-85.048,26.648c-3.915,1.226-6.093,5.393-4.867,9.306
                                c6.104,19.486,9.199,39.839,9.199,60.494c0,3.041-0.076,6.144-0.23,9.484c-0.092,1.967,0.602,3.892,1.93,5.347
                                c1.327,1.456,3.178,2.325,5.145,2.415l89.031,4.113c0.118,0.005,0.234,0.008,0.35,0.008c3.944,0,7.228-3.103,7.414-7.083
                                c0.229-4.955,0.342-9.627,0.342-14.284C612,365.306,607.306,334.494,598.044,304.939z"/>
                            <path d="M305.737,380.755c-1.281,0-2.555,0.042-3.824,0.11l-120.65-71.185c-2.953-1.745-6.702-1.308-9.176,1.065
                                c-2.476,2.371-3.07,6.099-1.456,9.121l65.815,123.355c-0.242,2.376-0.371,4.775-0.371,7.195c0,18.608,7.246,36.101,20.403,49.258
                                c13.158,13.158,30.652,20.404,49.26,20.404c18.608,0,36.101-7.248,49.258-20.404c13.158-13.157,20.403-30.65,20.403-49.258
                                c0-18.608-7.246-36.101-20.403-49.258C341.839,388.001,324.344,380.755,305.737,380.755z"/>
                        </g>
                    </g>
                </svg>
                    </i>
                    <span class="en">Dashboard</span><span class="sr">Komandna tabla</span><span class="de">Armaturenbrett</span>
                </a>

                <?php
                if($admin->is_super_admin()){
                    //just super admin
                    ?>
                    <a href="view-admins.php" class="nav-item nav-link <?php echo check_current("view-admins"); ?>">
                        <i class="fa fa-tachometer-alt me-2 before-none">
                            <svg width="30" height="30" viewBox="0 0 32.000001 32.000001" xmlns="http://www.w3.org/2000/svg" version="1.1" class="p-1">
                                <circle r="7.5" cy="9.5" cx="16" id="path839" style="opacity:1;vector-effect:none;fill:#373737;fill-opacity:1;stroke:none;stroke-width:2;stroke-linecap:butt;stroke-linejoin:bevel;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:3.20000005;stroke-opacity:1"/><path id="rect841" d="M16 19c6.648 0 12 2.899 12 6.5V32H4v-6.5C4 21.899 9.352 19 16 19z" style="opacity:1;vector-effect:none;fill:#373737;fill-opacity:1;stroke:none;stroke-width:2;stroke-linecap:butt;stroke-linejoin:bevel;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:3.20000005;stroke-opacity:1"/>
                            </svg>
                        </i>
                        <span class="en">View admins</span><span class="sr">Vidi admine</span><span class="de">Administratoren anzeigen</span>
                    </a>
                    <?php
                }

                if($admin->is_admin() || $admin->is_super_admin()){
                    //admin or superadmin
                    ?>
                    <a href="view-drivers.php" class="nav-item nav-link <?php echo check_current("view-drivers"); ?>">
                        <i class="fa fa-tachometer-alt me-2 before-none">
                            <svg width="30" height="30" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="p-1">
                                <path d="M462 241.64l-22-84.84c-9.6-35.2-41.6-60.8-76.8-60.8H352V64c0-17.67-14.33-32-32-32H192c-17.67 0-32 14.33-32 32v32h-11.2c-35.2 0-67.2 25.6-76.8 60.8l-22 84.84C21.41 248.04 0 273.47 0 304v48c0 23.63 12.95 44.04 32 55.12V448c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32v-32h256v32c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32v-40.88c19.05-11.09 32-31.5 32-55.12v-48c0-30.53-21.41-55.96-50-62.36zM96 352c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm20.55-112l17.2-66.36c2.23-8.16 9.59-13.64 15.06-13.64h214.4c5.47 0 12.83 5.48 14.85 12.86L395.45 240h-278.9zM416 352c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32z"/>
                            </svg>
                        </i>
                        <span class="en">View drivers</span><span class="sr">Vidi vozace</span><span class="de">Treiber ansehen</span>
                    </a>
                    <a href="view-cities.php" class="nav-item nav-link <?php echo check_current("view-cities"); ?>">
                        <i class="fa fa-tachometer-alt me-2 before-none">
                            <svg width="30" height="30" viewBox="0 0 512 512" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(106.666667, 42.666667)">
                                        <path d="M149.333333,7.10542736e-15 C231.807856,7.10542736e-15 298.666667,66.8588107 298.666667,149.333333 C298.666667,176.537017 291.413333,202.026667 278.683512,224.008666 C270.196964,238.663333 227.080238,313.32711 149.333333,448 C71.5864284,313.32711 28.4697022,238.663333 19.9831547,224.008666 C7.25333333,202.026667 2.84217094e-14,176.537017 2.84217094e-14,149.333333 C2.84217094e-14,66.8588107 66.8588107,7.10542736e-15 149.333333,7.10542736e-15 Z M149.333333,85.3333333 C113.987109,85.3333333 85.3333333,113.987109 85.3333333,149.333333 C85.3333333,184.679557 113.987109,213.333333 149.333333,213.333333 C184.679557,213.333333 213.333333,184.679557 213.333333,149.333333 C213.333333,113.987109 184.679557,85.3333333 149.333333,85.3333333 Z">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                        </i>
                        <span class="en">View cities</span><span class="sr">Vidi gradove</span><span class="de">Städte ansehen</span>
                    </a>

                    <a href="regular-rides.php" class="nav-item nav-link <?php echo check_current("regular-rides"); ?>">
                        <i class="fa fa-tachometer-alt me-2 before-none">
                            <svg width="30" height="30" viewBox="0 -64 640 640" xmlns="http://www.w3.org/2000/svg" class="p-1">
                                <path d="M624 448H16c-8.84 0-16 7.16-16 16v32c0 8.84 7.16 16 16 16h608c8.84 0 16-7.16 16-16v-32c0-8.84-7.16-16-16-16zM80.55 341.27c6.28 6.84 15.1 10.72 24.33 10.71l130.54-.18a65.62 65.62 0 0 0 29.64-7.12l290.96-147.65c26.74-13.57 50.71-32.94 67.02-58.31 18.31-28.48 20.3-49.09 13.07-63.65-7.21-14.57-24.74-25.27-58.25-27.45-29.85-1.94-59.54 5.92-86.28 19.48l-98.51 49.99-218.7-82.06a17.799 17.799 0 0 0-18-1.11L90.62 67.29c-10.67 5.41-13.25 19.65-5.17 28.53l156.22 98.1-103.21 52.38-72.35-36.47a17.804 17.804 0 0 0-16.07.02L9.91 230.22c-10.44 5.3-13.19 19.12-5.57 28.08l76.21 82.97z"/>
                            </svg>
                        </i>
                        <?php
                        $num = count(Ride2::getNewRides());
                        if($num>0){
                            ?>
                            <span class="en">Regular rides (<span class="text-danger fw-bold"><?php echo count(Ride2::getNewRides()); ?></span>)</span><span class="sr">Klasicne voznje (<span class="text-danger fw-bold"><?php echo count(Ride2::getNewRides()); ?></span>)</span><span class="de">Reg Fahrten (<span class="text-danger fw-bold"><?php echo count(Ride2::getNewRides()); ?></span>)</span>
                            <?php
                        }else{
                            ?>
                            <span class="en">Regular rides (<?php echo count(Ride2::getNewRides()); ?>)</span><span class="sr">Nove voznje (<?php echo count(Ride2::getNewRides()); ?>)</span><span class="de">Neue Fahrten (<?php echo count(Ride2::getNewRides()); ?>)</span>
                            <?php
                        }
                        ?>
                    </a>

                    <a href="view-rides.php" class="nav-item nav-link <?php echo check_current("view-rides"); ?>">
                        <i class="fa fa-tachometer-alt me-2 before-none">
                            <svg width="30" height="30" viewBox="0 -64 640 640" xmlns="http://www.w3.org/2000/svg" class="p-1">
                                <path d="M624 448H16c-8.84 0-16 7.16-16 16v32c0 8.84 7.16 16 16 16h608c8.84 0 16-7.16 16-16v-32c0-8.84-7.16-16-16-16zM80.55 341.27c6.28 6.84 15.1 10.72 24.33 10.71l130.54-.18a65.62 65.62 0 0 0 29.64-7.12l290.96-147.65c26.74-13.57 50.71-32.94 67.02-58.31 18.31-28.48 20.3-49.09 13.07-63.65-7.21-14.57-24.74-25.27-58.25-27.45-29.85-1.94-59.54 5.92-86.28 19.48l-98.51 49.99-218.7-82.06a17.799 17.799 0 0 0-18-1.11L90.62 67.29c-10.67 5.41-13.25 19.65-5.17 28.53l156.22 98.1-103.21 52.38-72.35-36.47a17.804 17.804 0 0 0-16.07.02L9.91 230.22c-10.44 5.3-13.19 19.12-5.57 28.08l76.21 82.97z"/>
                            </svg>
                        </i>
                        <?php
                        $num = count(Ride::getNewRides());
                        if($num>0){
                            ?>
                            <span class="en">New rides (<span class="text-danger fw-bold"><?php echo count(Ride::getNewRides()); ?></span>)</span><span class="sr">Nove voznje (<span class="text-danger fw-bold"><?php echo count(Ride::getNewRides()); ?></span>)</span><span class="de">Neue Fahrten (<span class="text-danger fw-bold"><?php echo count(Ride::getNewRides()); ?></span>)</span>
                            <?php
                        }else{
                            ?>
                            <span class="en">New rides (<?php echo count(Ride::getNewRides()); ?>)</span><span class="sr">Nove voznje (<?php echo count(Ride::getNewRides()); ?>)</span><span class="de">Neue Fahrten (<?php echo count(Ride::getNewRides()); ?>)</span>
                            <?php
                        }
                        ?>
                    </a>
                    <a href="assigned-rides.php" class="nav-item nav-link <?php echo check_current("assigned-rides"); ?>">
                        <i class="fa fa-tachometer-alt me-2 before-none">
                            <svg class="p-1" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 width="30" height="30" viewBox="0 0 512 512"  xml:space="preserve">
                            <g>
                                <path class="st0" d="M34.313,250.891c2.297-5.016,6.688-13.281,14.438-27.813c3.531-6.672,7.5-14.047,11.563-21.625H24.719
                                    C11.063,201.453,0,212.516,0,226.188c0,13.641,11.063,24.703,24.719,24.703H34.313z"/>
                                <path class="st0" d="M487.281,201.453h-35.594c4.078,7.578,8.031,14.953,11.563,21.625c7.75,14.531,12.125,22.797,14.438,27.813
                                    h9.594c13.656,0,24.719-11.063,24.719-24.703C512,212.516,500.938,201.453,487.281,201.453z"/>
                                <path class="st0" d="M39.391,465.188c0,18.406,14.938,33.328,33.328,33.328c18.406,0,33.313-14.922,33.313-33.328v-31.516H39.391
                                    V465.188z"/>
                                <path class="st0" d="M405.938,465.188c0,18.406,14.938,33.328,33.344,33.328s33.328-14.922,33.328-33.328v-31.516h-66.672V465.188z
                                    "/>
                                <path class="st0" d="M467.875,257.109c1.688,0.484-61.688-115.828-64.719-122.109c-8-16.672-27.781-26.703-47.063-26.703
                                    c-22.281,0-84.344,0-84.344,0s-93.563,0-115.859,0c-19.297,0-39.031,10.031-47.047,26.703
                                    c-3.031,6.281-66.391,122.594-64.719,122.109c0,0-20.5,20.438-22.063,22.063c-8.625,9.281-8,17.297-8,25.313c0,0,0,75.297,0,92.563
                                    c0,17.281,3.063,26.734,23.438,26.734h437c20.375,0,23.469-9.453,23.469-26.734c0-17.266,0-92.563,0-92.563
                                    c0-8.016,0.594-16.031-8.063-25.313C488.406,277.547,467.875,257.109,467.875,257.109z M96.563,221.422
                                    c0,0,40.703-73.313,43.094-78.109c4.125-8.203,15.844-14.141,27.828-14.141h177.031c12,0,23.703,5.938,27.828,14.141
                                    c2.406,4.797,43.109,78.109,43.109,78.109c3.75,6.75,0.438,19.313-10.672,19.313H107.219
                                    C96.109,240.734,92.813,228.172,96.563,221.422z M91.125,384.469c-20.656,0-37.406-16.734-37.406-37.391
                                    c0-20.672,16.75-37.406,37.406-37.406s37.391,16.734,37.391,37.406C128.516,367.734,111.781,384.469,91.125,384.469z
                                     M312.781,394.578c0,2.734-2.219,4.953-4.938,4.953H204.172c-2.734,0-4.953-2.219-4.953-4.953v-45.672
                                    c0-2.703,2.219-4.906,4.953-4.906h103.672c2.719,0,4.938,2.203,4.938,4.906V394.578z M420.875,384.469
                                    c-20.656,0-37.422-16.734-37.422-37.391c0-20.672,16.766-37.406,37.422-37.406s37.406,16.75,37.406,37.406
                                    S441.531,384.469,420.875,384.469z"/>
                                <path class="st0" d="M152.906,49.25c0.016-10.047,8.172-18.203,18.219-18.219h169.75c10.031,0.016,18.188,8.172,18.203,18.219
                                    v49.172h17.547V49.25c0-19.75-16-35.75-35.75-35.766h-169.75c-19.75,0.016-35.75,16.016-35.766,35.766v49.172h17.547V49.25z"/>
                                <path class="st0" d="M195.141,92.938h8.891c0.438,0,0.719-0.266,0.719-0.672V56.328c0-0.281,0.156-0.422,0.406-0.422h12.063
                                    c0.406,0,0.719-0.266,0.719-0.672v-7.469c0-0.406-0.313-0.688-0.719-0.688h-35.25c-0.438,0-0.719,0.281-0.719,0.688v7.469
                                    c0,0.406,0.281,0.672,0.719,0.672h12.047c0.281,0,0.422,0.141,0.422,0.422v35.938C194.438,92.672,194.719,92.938,195.141,92.938z"
                                />
                                <path class="st0" d="M237.438,47.078c-0.5,0-0.781,0.281-0.922,0.688l-16.391,44.5c-0.156,0.406,0,0.672,0.469,0.672h9.203
                                    c0.484,0,0.766-0.203,0.906-0.672l2.672-8.031h16.688l2.719,8.031c0.156,0.469,0.438,0.672,0.938,0.672h9.094
                                    c0.5,0,0.625-0.266,0.5-0.672l-16.125-44.5c-0.156-0.406-0.406-0.688-0.922-0.688H237.438z M247.25,75.813h-11l5.406-16.047h0.203
                                    L247.25,75.813z"/>
                                <path class="st0" d="M269.844,92.938h9.688c0.625,0,0.906-0.203,1.188-0.672l8.531-13.969h0.219l8.5,13.969
                                    c0.281,0.469,0.531,0.672,1.188,0.672h9.734c0.516,0,0.641-0.406,0.453-0.813l-14.313-22.859l13.297-21.375
                                    c0.234-0.406,0.078-0.813-0.406-0.813h-9.734c-0.563,0-0.844,0.203-1.141,0.688l-7.578,12.391h-0.219l-7.563-12.391
                                    c-0.266-0.484-0.547-0.688-1.125-0.688h-9.75c-0.469,0-0.625,0.406-0.406,0.813l13.266,21.375l-14.234,22.859
                                    C269.156,92.531,269.359,92.938,269.844,92.938z"/>
                                <path class="st0" d="M320.422,47.766v44.5c0,0.406,0.281,0.672,0.688,0.672h8.922c0.406,0,0.688-0.266,0.688-0.672v-44.5
                                    c0-0.406-0.281-0.688-0.688-0.688h-8.922C320.703,47.078,320.422,47.359,320.422,47.766z"/>
                            </g>
                        </svg>
                        </i>
                        <span class="en">Assigned rides (<?php echo count(Ride::getAssignedRides()); ?>)</span><span class="sr">Dodeljene voznje (<?php echo count(Ride::getAssignedRides()); ?>)</span><span class="de">Zugewiesene Fahrten (<?php echo count(Ride::getAssignedRides()); ?>)</span>
                    </a>
                    <a href="history.php" class="nav-item nav-link <?php echo check_current("history"); ?>">
                        <i class="fa fa-tachometer-alt me-2 before-none">
                            <svg width="25" height="25" viewBox="0 0 512 512" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g>
                                <path d="M437.11,74.98c-99.974-99.974-262.064-99.973-362.038,0.001l0,0c-12.09-12.09-32.776-5.827-36.129,10.939L24.801,156.63   c-2.996,14.979,10.211,28.186,25.19,25.19l70.711-14.142c16.766-3.353,23.029-24.039,10.939-36.129l0,0   c68.622-68.622,180.279-68.622,248.901-0.001c68.9,68.899,68.9,180.003,0,248.903c-68.623,68.622-180.279,68.622-248.901-0.001   C97.329,346.14,80.174,301.07,80.174,256h-0.082c0-22.215-18.109-40.2-40.37-39.998c-22.076,0.2-39.694,18.688-39.629,40.765   c0.194,65.26,25.187,130.46,74.98,180.253c99.974,99.974,262.064,99.974,362.038,0.001C536.84,337.291,536.84,174.709,437.11,74.98   z"/>
                                <path d="M336.837,267.978l-50.746-29.298v-88.596c0-16.569-13.431-30-30-30h0c-16.569,0-30,13.431-30,30V256   c0,11.103,6.036,20.79,15.002,25.978l-0.002,0.003l65.746,37.958c14.349,8.284,32.696,3.368,40.981-10.981v0   C356.102,294.61,351.186,276.262,336.837,267.978z"/>
                            </g>
                        </svg>
                        </i>
                        <span class="en">History</span><span class="sr">Istorja</span><span class="de">Geschichte</span>
                    </a>

                    <a href="search.php" class="nav-item nav-link <?php echo check_current("search"); ?>">
                        <i class="fa fa-tachometer-alt me-2 before-none">
                            <svg viewBox="0 0 600 600" version="1.1" width="25" height="25" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg">
                                <g transform="matrix(0.95173205,0,0,0.95115787,13.901174,12.168794)">
                                    <path d="m 206.04492,-12.792969 c -121.380675,0 -220.650389,99.36284 -220.650389,220.783199 0,121.42037 99.269714,220.78321 220.650389,220.78321 121.38068,0 220.65039,-99.36284 220.65039,-220.78321 0,-121.420359 -99.26971,-220.783199 -220.65039,-220.783199 z m 0,84.082031 c 75.90523,10e-7 136.56641,60.688518 136.56641,136.701168 0,76.01266 -60.66118,136.70118 -136.56641,136.70118 -75.90522,0 -136.568357,-60.68852 -136.568358,-136.70118 10e-7,-76.01265 60.663138,-136.701168 136.568358,-136.701168 z"/>
                                    <g transform="matrix(1.3807551,0,0,1.2700888,273.60014,263.99768)" />
                                    <g transform="matrix(1.5092301,0,0,1.3955555,36.774048,-9.4503933)"/>
                                    <path d="m 332.15625,292.14648 a 42.041302,42.041302 0 0 0 -29.73242,12.30469 42.041302,42.041302 0 0 0 -0.0176,59.45508 l 241.63867,241.78711 a 42.041302,42.041302 0 0 0 59.45508,0.0176 42.041302,42.041302 0 0 0 0.0195,-59.45508 L 361.87891,304.4707 a 42.041302,42.041302 0 0 0 -29.72266,-12.32422 z"/>
                                    <path d="m 300.47656,-223.75195 a 10.51035,10.51035 0 0 0 -10.51172,10.50976 c 0,27.82165 -12.93301,54.03401 -35.0039,70.94922 -22.07089,16.91522 -50.72689,22.58021 -77.56641,15.33399 a 10.51035,10.51035 0 0 0 -12.88672,7.40625 10.51035,10.51035 0 0 0 7.40821,12.88671 c 33.14139,8.947634 68.5821,1.9411 95.83203,-18.94336 27.24993,-20.88445 43.23828,-53.29099 43.23828,-87.63281 a 10.51035,10.51035 0 0 0 -10.50977,-10.50976 z" transform="scale(1,-1)" />
                                </g>
                            </svg>
                        </i>
                        <span class="en">Search rides</span><span class="sr">Pretraga voznji</span><span class="de">Fahrten suchen</span>
                    </a>

                    <a href="trash-rides.php" class="nav-item nav-link <?php echo check_current("trash-rides"); ?>">
                        <i class="fa fa-tachometer-alt me-2 before-none">
                            <svg class="p-1" width="30" height="30" viewBox="-6.7 0 122.88 122.88" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  enable-background="new 0 0 109.484 122.88" xml:space="preserve">
                                <g>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2.347,9.633h38.297V3.76c0-2.068,1.689-3.76,3.76-3.76h21.144 c2.07,0,3.76,1.691,3.76,3.76v5.874h37.83c1.293,0,2.347,1.057,2.347,2.349v11.514H0V11.982C0,10.69,1.055,9.633,2.347,9.633 L2.347,9.633z M8.69,29.605h92.921c1.937,0,3.696,1.599,3.521,3.524l-7.864,86.229c-0.174,1.926-1.59,3.521-3.523,3.521h-77.3 c-1.934,0-3.352-1.592-3.524-3.521L5.166,33.129C4.994,31.197,6.751,29.605,8.69,29.605L8.69,29.605z M69.077,42.998h9.866v65.314 h-9.866V42.998L69.077,42.998z M30.072,42.998h9.867v65.314h-9.867V42.998L30.072,42.998z M49.572,42.998h9.869v65.314h-9.869 V42.998L49.572,42.998z"/>
                                </g>
                            </svg>
                        </i>
                        <span class="en">Trash rides (<?php echo count(Ride::getTrashRides()); ?>)</span><span class="sr">Izbrisane voznje (<?php echo count(Ride::getTrashRides()); ?>)</span><span class="de">Müllfahrten (<?php echo count(Ride::getTrashRides()); ?>)</span>
                    </a>
                    <?php
                }


                if($admin->is_super_admin()){
                    ?>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="far me-2">
                                <svg class="p-1" height="30" width="30" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     viewBox="0 0 512 512" xml:space="preserve">
                                        <g>
                                            <g>
                                                <path d="M509.629,439.507l-70.171-117.398c-3.011-5.043-8.457-8.13-14.325-8.13h-40.314l-13.926-13.925
                                                    c-5.32-0.239-10.628-0.638-15.889-1.379l-63.582,63.572l22.563,22.566v40.303c0,5.871,3.086,11.317,8.13,14.328l117.408,70.181
                                                    c6.548,3.929,14.948,2.899,20.369-2.522l47.216-47.227C512.519,454.464,513.563,446.073,509.629,439.507z"/>
                                            </g>
                                        </g>
                                    <g>
                                        <g>
                                            <path d="M504.281,88.676c-4.081-11.437-18.794-14.933-27.531-6.195l-68.29,68.301l-39.357-7.869l-7.869-39.357l68.29-68.29
				c8.641-8.618,5.359-23.407-6.195-27.531c-48.37-17.23-102.998-4.937-139.236,31.301c-33.705,33.694-46.694,83.301-34.51,128.951
				l-143.917,143.93c-51.75-4.852-105.648,39.018-105.648,99.909c0,55.237,44.933,100.17,100.17,100.17
				c60.755,0,104.772-53.778,99.909-105.648l143.928-143.918c45.651,12.205,95.246-0.805,128.941-34.498
				C509.215,191.683,521.508,137.021,504.281,88.676z M100.188,445.215c-18.412,0-33.39-14.978-33.39-33.39
				c0-18.412,14.978-33.39,33.39-33.39c18.412,0,33.39,14.978,33.39,33.39C133.578,430.237,118.601,445.215,100.188,445.215z"/>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M215.696,97.645l-82.998-82.998c-19.552-19.552-51.352-19.494-70.823,0L14.649,61.862
				c-19.532,19.532-19.532,51.302,0,70.835l111.508,111.508l47.217-47.224L71.69,95.295c-6.521-6.521-6.521-17.087,0-23.608
				c6.521-6.521,17.087-6.521,23.608,0L196.98,173.37l16.357-16.36C210.518,137.076,211.45,116.978,215.696,97.645z"/>
                                        </g>
                                    </g>
</svg>
                            </i>
                            <span class="en">Technical</span><span class="sr">Tehnicki</span><span class="de">Technisch</span>
                        </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="options.php" class="nav-item nav-link dropdown-item <?php echo check_current("options"); ?>">
                                <i class="far me-2">
                                    <svg width="30" height="30" viewBox="0 0 32 32" enable-background="new 0 0 32 32" id="Stock_cut" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g>
                                            <path d="M31,19v-6h-4.425   c-0.252-0.888-0.611-1.729-1.065-2.51L29,7l-4-4l-3.49,3.49C21.028,6.21,20.525,5.967,20,5.761V1h-8v4.761   c-0.525,0.205-1.028,0.449-1.51,0.728L7,3L3,7l3.49,3.49C6.036,11.271,5.676,12.112,5.425,13H1v6h4.425   c0.252,0.888,0.611,1.729,1.065,2.51L3,25l4,4l3.49-3.49c0.482,0.28,0.986,0.523,1.51,0.728V31h8v-4.761   c0.525-0.205,1.028-0.449,1.51-0.728L25,29l4-4l-3.49-3.49c0.454-0.781,0.813-1.622,1.065-2.51H31z" fill="none" stroke="#000000" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
                                            <circle cx="16" cy="16" fill="none" r="5" stroke="#000000" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
                                        </g>
                                </i>
                                <span class="en">options</span><span class="sr">opcije</span><span class="de">optionen</span>
                            </a>

                            <a href="?backup" class="nav-item nav-link dropdown-item">
                                <i class="far me-2">
                                    <svg width="30" height="30" viewBox="0 0 36 36" version="1.1"  preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <path class="clr-i-solid clr-i-solid-path-1" d="M18,19.84l6.38-6.35A1,1,0,1,0,23,12.08L19,16V4a1,1,0,1,0-2,0V16l-4-3.95a1,1,0,0,0-1.41,1.42Z"></path>
                                        <path class="clr-i-solid clr-i-solid-path-2" d="M19.41,21.26l-.74.74H33.93c-.17-.57-.79-2.31-3.09-8.63A1.94,1.94,0,0,0,28.93,12H26.55a3,3,0,0,1-.76,2.92Z"></path>
                                        <path class="clr-i-solid clr-i-solid-path-3" d="M16.58,21.26,10.2,14.91A3,3,0,0,1,9.44,12H7.07a1.92,1.92,0,0,0-1.9,1.32C2.86,19.68,2.24,21.43,2.07,22H17.33Z"></path>
                                        <path class="clr-i-solid clr-i-solid-path-4" d="M2,24v6a2,2,0,0,0,2,2H32a2,2,0,0,0,2-2V24Zm28,4H26V26h4Z"></path>
                                        <rect x="0" y="0" width="36" height="36" fill-opacity="0"/>
                                    </svg>
                                </i>
                                <span class="en">backup</span><span class="sr">rezervna kopija</span><span class="de">Sicherung</span>
                            </a>

                            <a href="error-logs.php" class="nav-item nav-link dropdown-item <?php echo check_current("error-logs"); ?>">
                                <i class="fa fa-tachometer-alt me-2 before-none p-2">
                                    <svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10zm-1.5-5.009c0-.867.659-1.491 1.491-1.491.85 0 1.509.624 1.509 1.491 0 .867-.659 1.509-1.509 1.509-.832 0-1.491-.642-1.491-1.509zM11.172 6a.5.5 0 0 0-.499.522l.306 7a.5.5 0 0 0 .5.478h1.043a.5.5 0 0 0 .5-.478l.305-7a.5.5 0 0 0-.5-.522h-1.655z"/>
                                    </svg>
                                </i>
                                <span class="en">Error logs</span><span class="sr">Greske log</span><span class="de">Fehlerprotokolle</span>
                            </a>

                            <a href="test-data" class="nav-item nav-link dropdown-item <?php echo check_current("test-data"); ?>">
                                <i class="fa fa-tachometer-alt me-2 before-none p-2">
                                    <svg height="30" width="30" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         viewBox="0 0 512 512"  xml:space="preserve">
                                    <g>
                                        <path class="st0" d="M328.897,0H183.103c-19.013,0-34.488,15.47-34.488,34.499c0,12.292,6.478,23.1,16.193,29.208v3.121v353.98
                                            c0,50.282,40.91,91.193,91.193,91.193c50.281,0,91.192-40.911,91.192-91.193V66.827v-3.121
                                            c9.719-6.107,16.193-16.916,16.193-29.208C363.385,15.47,347.915,0,328.897,0z M193.098,93.438h29.36v11.274h-29.36V93.438z
                                             M193.098,134.32h50.624v11.284h-50.624V134.32z M193.098,175.211h29.36v11.284h-29.36V175.211z M193.098,216.103h50.624v11.274
                                            h-50.624V216.103z M193.098,256.985h29.36v11.274h-29.36V256.985z M318.902,420.807c0,34.688-28.214,62.907-62.902,62.907
                                            c-34.684,0-62.903-28.219-62.903-62.907V305.783h125.804V420.807z"/>
                                    </g>
                                </svg>
                                </i>
                                <span class="en">Test data</span><span class="sr">Test podaci</span><span class="de">Testdaten</span>
                            </a>
                        </div>
                    </div>
                    <?php
                }

                ?>

                <a href="assets/php/logout.php" class="nav-item nav-link">
                    <i class="fa fa-tachometer-alt me-2">
                        <svg width="30" height="30" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 9.875v12.219c0 1.125 0.469 2.125 1.219 2.906 0.75 0.75 1.719 1.156 2.844 1.156h6.125v-2.531h-6.125c-0.844 0-1.5-0.688-1.5-1.531v-12.219c0-0.844 0.656-1.5 1.5-1.5h6.125v-2.563h-6.125c-1.125 0-2.094 0.438-2.844 1.188-0.75 0.781-1.219 1.75-1.219 2.875zM6.719 13.563v4.875c0 0.563 0.5 1.031 1.063 1.031h5.656v3.844c0 0.344 0.188 0.625 0.5 0.781 0.125 0.031 0.25 0.031 0.313 0.031 0.219 0 0.406-0.063 0.563-0.219l7.344-7.344c0.344-0.281 0.313-0.844 0-1.156l-7.344-7.313c-0.438-0.469-1.375-0.188-1.375 0.563v3.875h-5.656c-0.563 0-1.063 0.469-1.063 1.031z"></path>
                        </svg>
                    </i>
                    <span class="en">Logout</span><span class="sr">Izloguj se</span><span class="de">Ausloggen</span>
                </a>
                <?php
            }

        if($_SESSION["status"]=="driver"){
            ?>
            <a href="assets/php/logout.php?driver" class="nav-item nav-link">
                <i class="fa fa-tachometer-alt me-2">
                    <svg width="30" height="30" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 9.875v12.219c0 1.125 0.469 2.125 1.219 2.906 0.75 0.75 1.719 1.156 2.844 1.156h6.125v-2.531h-6.125c-0.844 0-1.5-0.688-1.5-1.531v-12.219c0-0.844 0.656-1.5 1.5-1.5h6.125v-2.563h-6.125c-1.125 0-2.094 0.438-2.844 1.188-0.75 0.781-1.219 1.75-1.219 2.875zM6.719 13.563v4.875c0 0.563 0.5 1.031 1.063 1.031h5.656v3.844c0 0.344 0.188 0.625 0.5 0.781 0.125 0.031 0.25 0.031 0.313 0.031 0.219 0 0.406-0.063 0.563-0.219l7.344-7.344c0.344-0.281 0.313-0.844 0-1.156l-7.344-7.313c-0.438-0.469-1.375-0.188-1.375 0.563v3.875h-5.656c-0.563 0-1.063 0.469-1.063 1.031z"></path>
                    </svg>
                </i>
                <span class="en">Logout</span><span class="sr">Izloguj se</span><span class="de">Ausloggen</span>
            </a>
            <?php
        }
        ?>



        
    </div>
</nav>